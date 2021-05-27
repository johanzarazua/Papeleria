<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Exception\PayPalConnectionException;
use Cart;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\PaymentExecution;
use App\Orden;
use App\Pago;
use App\Pedidos;
use App\Inventario;

class PaymentController extends Controller
{
    //
    private $apiContext;

    public function __construct(){
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);
    }

    public function payWithPayPal(Request $request)
    {
        //dd($request->pedido_id);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        foreach(Cart::getContent() as $producto){
            $item = new Item();
            $item->setName($producto->name)
            ->setCurrency('MXN')
            ->setQuantity($producto->quantity)
            ->setPrice(strval($producto->attributes->total/$producto->quantity));

            $items[] = $item;
        }

        if(Cart::getSubTotal() < 200){
            $item = new Item();
            $item->setName('Costo de envio')
            ->setCurrency('MXN')
            ->setQuantity('1')
            ->setPrice('30.00');

            $items[] = $item;
        }

        $item_list = new ItemList();
        $item_list->setItems($items);

        $amount = new Amount();
        $amount->setTotal(strval(Cart::getTotal()));
        $amount->setCurrency('MXN');

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Compra papeleria la economica');

        // $transaction->setDescription('See your IQ results');

        $callbackUrl = url('/paypal/status', ['pedido_id' => $request->pedido_id]);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        
        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
            echo 'Transaccion :'.$transaction;
            echo 'Lista de productos:'.$item_list;
            echo 'Carrito :'. json_encode(Cart::getContent());
        }
    }

    public function payPalStatus(Request $request)
    {
        
        //dd($request->pedido_id);
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect('/tienda/checkout')->with(['status'=>$status, 'pedido_id' => $request->pedido_id]);
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {
            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
    
            if($request->pedido_id){
                foreach (Cart::getContent() as $item){
                    Orden::create([
                        'pedidos_id' => $request->pedido_id,
                        'inventario_id' => $item->id,
                        'cantidad' =>$item->quantity
                    ]);

                    $producto = Inventario::find($item->id);
                    $producto->update(['inventario' => $producto->inventario - $item->quantity]);
                }

                Pago::create([
                    'pedidos_id' => $request->pedido_id,
                    'monto' => Cart::getTotal(),
                    'tipo_pago' => 'PayPal',
                    'id_PayPal' => $result->getId(),
                    'status_PayPal' => $result->getState(),
                    'payerId_PayPal' =>  $payerId,
                ]);

                $pedido = Pedidos::find($request->pedido_id);
                $pedido->update(['statuspago_id' => 2]);

                Cart::clear();
            }

            return redirect('/tienda/checkout')->with(['status'=>$status, 'pedido_id' => $request->pedido_id, 'pago' => true]);
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect('/tienda/checkout')->with(['status'=>$status, 'pedido_id' => $request->pedido_id]);
    }
}
