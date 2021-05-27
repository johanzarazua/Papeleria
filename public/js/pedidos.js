$(document).ready(function(){
    function revisarPedidos(){
        $.ajax({
            url:'/pedidos_nuevos',
            type:'GET',
            success:function(res){
                //alert('hay ' + res.pedidos + ' nuevos');
                if(res.pedidos != '0'){
                    $('.noti').css('display', '');
                    $('#noti').empty();
                    $('#noti').append(res.pedidos);
                }else{
                    $('.noti').css('display', 'none');
                }
            },
            error: function(res){
                console.log(res);
                alert('error ajax nuevos pedidos');
            }
        });
    }
    setInterval(revisarPedidos,40000);
});

$('#pedidos').click(function(){
    $.ajax({
        url:'/pedidos',
        type:'GET',
        beforeSend:function(){
            $('#btn-titulo').empty();
            $('#titulo').empty();
            $('#titulo').html('<div class="d-flex justify-content-center"><div class="spinner-border text-info" style="width: 3rem; height: 3rem;" role="status"><span class="visually-hidden">Loading...</span></div></div>');
            $('#contenido').empty();
            $('#contenido').html('<div class="d-flex justify-content-center"><div class="spinner-border text-info" style="width: 3rem; height: 3rem;" role="status"><span class="visually-hidden">Loading...</span></div></div>');
        },
        success:function(res){
            $('#titulo').empty();
            $('#btn-titulo').empty();
            $('#contenido').empty();

            $('#titulo').append('Pedidos');
            //$('#btn-titulo').append(res.botones);
            $('#contenido').append(res.contenido);

            $('#tablaPedidos').DataTable();
            $.ajax({
                url:'/pedidos_leidos',
                type:'GET',
                success:function(){

                },
                error:function(resp){
                    alert('error ajax avtualizar pedidos');
                    console.log(resp)
                }
            });
        },
        error:function(res){
            alert('error ajax ver pedidos');
            console.log(res)
        }
    });
});

function PedidoEnCamino(pedido){
    $.ajax({
        url:'/pedido_en_cammino',
        type:'POST',
        data:{
            "_token": $("meta[name='csrf-token']").attr("content"),
            "id" : pedido,
        },
        beforeSend: function(){
            $('.sBAEC'+pedido).css('display', '');
            $('#BAEC'+pedido).attr('disabled', true);
        },
        success:function(resp){
            swal({
                "timer":1600,
                type: "success",
                "title":"Pedido actualizado correctamente!",
                "showConfirmButton":false
            });
            $.ajax({
                url:'/pedidos',
                type:'GET',
                success:function(res){
                    $('#contenido').empty();
                    $('#contenido').append(res.contenido);
                    $('#tablaPedidos').DataTable();
                    $('.sBAEC'+pedido).css('display', 'none');
                    $('#BAEC'+pedido).attr('disabled', false);
                },
                error:function(res){
                    alert('error ajax ver pedidos');
                    console.log(res)
                }
            });
        },
        error:function(resp){
            alert('error actualizar pedido');
            console.log(resp)
        }
    });
};


function PedidoEntregado(pedido){
    $('#cargarImagenEntrega').modal('show');
    $('#id_pedido_f').val(pedido);
    
};

$('#form_img_entrega').submit(function(e){
    e.preventDefault();
    let form_data = new FormData( document.getElementById("form_img_entrega") );
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/pedido_entregado',
        type:'POST',
        data:form_data,
        cache:false,
        contentType: false,
        processData: false,
        success:function(resp){
            console.log(resp);
            swal({
                "timer":1600,
                type: "success",
                "title":"Pedido actualizado correctamente!",
                "showConfirmButton":false
            });
            
            $.ajax({
                url:'/pedidos',
                type:'GET',
                success:function(res){
                    $('#contenido').empty();
                    $('#contenido').append(res.contenido);
                    $('#tablaPedidos').DataTable();
                    $('#cargarImagenEntrega').modal('hide');
                    $('#id_pedido_f').val('');
                },
                error:function(res){
                    alert('error ajax ver pedidos');
                    console.log(res)
                }
            });
        },
        error:function(resp){
            alert('error actualizar pedido entregado');
            console.log(resp)
        }
    });
});

function imagenPedido(id, imagen){
    $('#verImagenPedido').modal('show');
    $("#imagen_pedido").attr("src",'../../pedidos_entregados/'+imagen);
};