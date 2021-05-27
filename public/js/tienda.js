$(document).ready(function(){
    $("input[name=paymentMethod]").click(function () {
        $('#forma_de_pago_requerimientos').hide();
        //$('#forma_de_pago_requerimientos').empty();
        switch ($(this).val()){
            case 'ContraEntrega':
                /*$('#forma_de_pago_requerimientos').append('<div class="alert alert-warning" role="alert">El repartidor acepta pagos con efectivo o tarjetas. Si el pago es con efectivo considera que el repartidor solo lleva $100 de cambio</div>');*/
                $('#text-boton-checkout').empty();
                $('#forma_de_pago_paypal').hide();
                $('#forma_de_pago_contraentrega').show('slow');
                $('#boton_pasos').show('slow');
                $('#boton_pasos').attr('paso', 'pago');
                $('#text-boton-checkout').append('Confirmar');
                break;
            case 'PayPal':
                $('#forma_de_pago_paypal').show('slow');
                $('#forma_de_pago_contraentrega').hide();
                $('#boton_pasos').hide('slow');
                /*$('#forma_de_pago_requerimientos').append('<div class="col-md-6"><button type="button" class="btn btn-primary" id="bpPP" onclick="URLPP()"><img src="https://www.paypalobjects.com/marketing/web/mx/logos-buttons/Paga-con-yellow_227x44.png" alt="Check out with PayPal" /></button></div>');*/
                //$('#forma_de_pago_requerimientos').append('<div class="col-md-6"><a href="/paypal/pay"  class="btn btn-primary">Pagar con PayPal</a></div>');
                break;
            /*case 'Efectivo':
                $('#forma_de_pago_requerimientos').append('<div class="col-md-6"><label for="cc-name" class="form-label">Name on card</label><input type="text" class="form-control" id="cc-name" placeholder="" required><small class="text-muted">Full name as displayed on card</small><div class="invalid-feedback">Name on card is required</div></div><div class="col-md-6"><label for="cc-number" class="form-label">Credit card number</label><input type="text" class="form-control" id="cc-number" placeholder="" required><div class="invalid-feedback">Credit card number is required</div></div><div class="col-md-3"><label for="cc-expiration" class="form-label">Expiration</label><input type="text" class="form-control" id="cc-expiration" placeholder="" required><div class="invalid-feedback">Expiration date required</div></div><div class="col-md-3"><label for="cc-cvv" class="form-label">CVV</label><input type="text" class="form-control" id="cc-cvv" placeholder="" required><div class="invalid-feedback">Security code required</div></div>');
                break;
            case 'Tarjeta':
                $('#forma_de_pago_requerimientos').append('<div class="col-md-6"><label for="cc-name" class="form-label">Name on card</label><input type="text" class="form-control" id="cc-name" placeholder="" required><small class="text-muted">Full name as displayed on card</small><div class="invalid-feedback">Name on card is required</div></div><div class="col-md-6"><label for="cc-number" class="form-label">Credit card number</label><input type="text" class="form-control" id="cc-number" placeholder="" required><div class="invalid-feedback">Credit card number is required</div></div><div class="col-md-3"><label for="cc-expiration" class="form-label">Expiration</label><input type="text" class="form-control" id="cc-expiration" placeholder="" required><div class="invalid-feedback">Expiration date required</div></div><div class="col-md-3"><label for="cc-cvv" class="form-label">CVV</label><input type="text" class="form-control" id="cc-cvv" placeholder="" required><div class="invalid-feedback">Security code required</div></div>');
                break;*/
        }
        $('#forma_de_pago_requerimientos').show('slow'); 
        $('#div_boton_pasos').show('slow'); 
    });
});

function AgregarCarrito(producto){
    $.ajax({
        url:'/add_cart',
        type:'POST',
        data:{
            "_token": $("meta[name='csrf-token']").attr("content"),
            "id" : producto,
            "cantidad" : $('#input'+producto).val(),
        },
        success:function(resp){
            swal({
                "timer":1600,
                type: "success",
                "title":"Producto agregado correctamente!",
                "showConfirmButton":false
            });
            //location.reload();
            $('#carritoRecarga').load('/actualizar_carrito');
        },
        error:function(resp){
            console.log(resp);
            alert('error al agregar producto')
        }
    }); 
}

function EliminarCarrito(producto){
    $.ajax({
        url:'/remove_item',
        type:'POST',
        data:{
            "_token": $("meta[name='csrf-token']").attr("content"),
            "id" : producto,
        },
        success:function(resp){
            swal({
                "timer":1600,
                type: "success",
                "title":"Producto eliminado",
                "showConfirmButton":false
            });
            //location.reload();
            $('#carritoRecarga').load('/actualizar_carrito');
        },
        error:function(resp){
            console.log(resp);
            alert('error al eliminar producto')
        }
    });
}

function VaciarCarrito(){
    $.ajax({
        url:'/clear_cart',
        type:'GET',
        success:function(resp){
            swal({
                "timer":1600,
                type: "success",
                "title":"Carrito vaciado",
                "showConfirmButton":false
            });
            //location.reload();
            $('#carritoRecarga').load('/actualizar_carrito');
        },
        error:function(resp){
            console.log(resp);
            alert('error al vaciar carrito')
        }
    });
}

function ActualizarCarrito(producto){
    $.ajax({
        url:'/update_item',
        type:'POST',
        data:{
            "_token": $("meta[name='csrf-token']").attr("content"),
            "id" : producto,
            "cantidad" : $('#input_C'+producto).val(),
        },
        success:function(resp){
            if (resp.error == true) {
                swal({
                    "timer":1600,
                    type: "error",
                    "title":resp.mensaje,
                    "showConfirmButton":false
                });
            }else{
                swal({
                    "timer":1600,
                    type: "success",
                    "title":"Producto actualizado",
                    "showConfirmButton":false
                });
                //location.reload();
                $('#carritoRecarga').load('/actualizar_carrito');
            }
            
        },
        error:function(resp){
            console.log(resp);
            alert('error al vaciar carrito')
        }
    });
}

$('#cp').change(function(){
    
    $.ajax({
        url:'https://api-sepomex.hckdrk.mx/query/info_cp/'+$('#cp').val()+'?type=simplified&token=e397b4f1-62d6-49b4-bfda-2a30eca4e6be',
        type: `GET`,
        dataType: 'json',
        success:function(result, status, xhr){
            if(result.response.estado != 'México'){
                swal({
                    "timer":3500,
                    type: "error",
                    "title":'El codigo postal no es del Estado de México, por favor ingrese otro',
                    "showConfirmButton":false
                });
                $('#cp').val('');
                $('#colonia').empty();
                $("#municipio").val('');
                $("#estado").val('');

            }else{
                $('#colonia').empty();
                $('#colonia').append('<option value="" disabled selected hidden>Seleccione una colonia</option>');
                result.response.asentamiento.forEach(function(item,index){
                    $("#colonia").append(`<option value="${item}">${item}</option>`)
                })
    
                $("#municipio").val(result.response.municipio);
                $("#estado").val(result.response.estado);
            }
        },
        error:function(xhr,status,error){
            alert(error);
        }

    });
});

$("#dia_entrega").change(function(){
    $("#hora_entrega").empty();
    $.ajax({
        url:'/horarios_disponibles',
        type:'POST',
        data:{
            "_token": $("meta[name='csrf-token']").attr("content"),
            "fecha" : $(this).val(),
        },
        success:function(res){
            $("#hora_entrega").append(`<option value="" disabled selected hidden>Seleccione un horario</option>`)
            res.horarios_disponibles.forEach(function(item, index){
                $("#hora_entrega").append(`<option value="${item.id}">${item.hora_in}:00 a ${item.hora_fn}:00</option>`)
            });
        },
        error:function(res){
            alert('error al obtener horarios disponibles');
            console.log(res);
        }
    });
});

$('#boton_pasos').click(function(){
    switch ( $(this).attr('paso') ) {
        case 'datos':
            if($(".validacion").val() != "" ){
                $.ajax({
                    url:'/pedido/crear',
                    type:'POST',
                    data:{
                        "_token": $("meta[name='csrf-token']").attr("content"),
                        "nombre" :      $('#nombre').val(),
                        "apellidos" :   $('#apellidos').val(),
                        "email" :       $('#email').val(),
                        "telefono" :    $('#telefono').val(),
                        "direccion" :   $('#direccion').val(),
                        "cp" :          $('#cp').val(),
                        "municipio" :   $('#municipio').val(),
                        "colonia" :     $('#colonia').val(),
                        "estado" :      $('#estado').val(),
                        "dia_entrega" : $('#dia_entrega').val(),
                        "hora_entrega": $('#hora_entrega').val(),         
                        "comments":     $('#comments').val(),
                    },
                    beforeSend:function(){
                        $('#text-boton-checkout').empty();
                        $('.SBC').css('display', '');
                    },
                    success:function(res){
                        if (res.success == true) {
                            $('#boton_pasos').attr('paso', 'pago');
                            $('.SBC').css('display', 'none');
                            $('#boton_pasos').css('display', 'none');
                            $('#text-boton-checkout').append('Confirmar');
                            $('.informacion_cliente').hide();
                            $('.forma_pago').show('slow');
                            $('#pid').val(res.p_id);
                        }else{
                            alert('error al crar cliente');
                        }
    
                    },
                    error:function(res){
                        alert('error en los datos');
                        console.log(res)
                    }
                });
            }else{
                swal({
                    "timer":2300,
                    type: "error",
                    "title":"Por favor llena todos los campos",
                    "showConfirmButton":false
                  });
            }
            break;
        case 'pago':
            //alert('hola estoy en pago')
            URLF();
            break;
        /*case 'value':
            
            break;
        
        default:
            break;*/
    }
});


    
