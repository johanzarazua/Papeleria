$(document).ready(function(){
    $('#prec_costo').change(function(){
        let valor = $(this).val();
        $('#prec_venta').val( parseFloat(valor * 0.5) + parseFloat(valor) );
    });

    $('#prec_costo2').change(function(){
        let valor = $(this).val();
        $('#prec_venta2').val( parseFloat(valor * 0.5) + parseFloat(valor) );
    });
});

$('#inventario').click(function(){
    $.ajax({
        url:'/inventario',
        type: 'GET',
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

            $('#titulo').append('Inventario');
            $('#btn-titulo').append(res.botones);
            $('#contenido').append(res.contenido);

            $('#tablaInventario').DataTable();
        },
        error:function(res){
            console.log(res);
            alert('error ajax inventario');
        }
    });
});

$('#departamento').change(function(){
    console.log()
    if($(this).val() == 1){
        $('.ps').show('slow');
        $('.p').show('slow');
    }else{
        $('.ps').show('slow');
        $('.p').hide('slow');
        $('#prec_costo').val()
        $('#prec_venta').val('')
        $('#prec_mayoreo').val('')
        $('#existencia').val('')
        $('#inventario_min').val('')
        $('#colores_producto').val('')
    }
});

$('#guardarProducto').click(function(){
    if ($('.prod').val() == "" ) {
        alert('Llena todos los campos');
    }else{
        let colors;
        if ($('#colores_producto').is(':checked')) {
            //alert('si tome colres');
            colors = $('#colores_producto').val();
        }else{
            //alert('no tome colres');
            colors = 0;
        }
        $.ajax({
            url:'/inventario_crear',
            type:'POST',
            data:{
                "_token": $("meta[name='csrf-token']").attr("content"),
                "descripcion" : $('#descripcion').val(),
                "p_costo": $('#prec_costo').val(),
                "p_venta": $('#prec_venta').val(),
                "p_mayoreo": $('#prec_mayoreo').val(),
                "existencia": $('#existencia').val(),
                "inventario_min": $('#inventario_min').val(),
                "departamento" : $('#departamento').val(),
                "colores" : colors
            },
            beforeSend:function(){
                $('.sGP').css('display', '');
                $('#guardarProducto').attr('disabled', true);
                $('#CancelarsGP').attr('disabled', true);
            },
            success:function(resp){
                $('#agregarProducto').modal('hide');
                $('#descripcion').val('');
                $('#prec_costo').val('');
                $('#prec_venta').val('');
                $('#prec_mayoreo').val('');
                $('#existencia').val('');
                $('#inventario_min').val('');
                $('#departamento').val('');
                swal({
                    "timer":1600,
                    type: "success",
                    "title":"Producto guardado correctamente!",
                    "showConfirmButton":false
                });
                $('.ps').hide();
                $('.p').hide();
                $.ajax({
                    url:'/inventario',
                    type: 'GET',
                    success:function(res){
                        $('#contenido').empty();
                        $('#contenido').append(res.contenido);

                        $('#tablaInventario').DataTable();
                        $('.sGP').css('display', 'none');
                        $('#guardarProducto').attr('disabled', false);
                        $('#CancelarsGP').attr('disabled', false);
                    },
                    error:function(res){
                        console.log(res);
                        alert('error ajax inventario');
                    }
                });
                if (resp.c == 1) {
                    console.log(resp)
                    $('#row_tabla_colores').empty();
                    $('#agregarColorProducto').modal('show');
                    $('#colores_producto_id').val(resp.producto);

                }
            },
            error:function(resp){
                console.log(resp);
                alert('error ajax crear producto');
            }
        });
    }
});

$('#guardarColorProducto').click(function(){
    if($('.color_prod').val() == ''){
        console.log($('.color_prod').val())
        alert('Llena el campo');
    }else{
        $.ajax({
            url:'/inventario/colores',
            type:'POST',
            data:{
                "_token": $("meta[name='csrf-token']").attr("content"),
                "producto":$('#colores_producto_id').val(),
                "color":$('#color_p').val(),
            },
            beforeSend:function(){
                $('.sGCP').css('display', '');
                $('#guardarColorProducto').attr('disabled', true);
                $('#CancelarsGCP').attr('disabled', true);
            },
            success:function(resp){
                $('#color_p').val('')
                $('#row_tabla_colores').empty();
                $('#row_tabla_colores').append(resp.tabla);
                $('.sGCP').css('display', 'none');
                $('#guardarColorProducto').attr('disabled', false);
                $('#CancelarsGCP').attr('disabled', false);
            },
            error:function(resp){
                console.log(resp);
                alert('error ajax crear colores producto');
            }
        });
    }
});

function verColores(id){
    $('#agregarColorProducto').modal('show');
    $('#colores_producto_id').val(id);
    $('#row_tabla_colores').empty();
    $.ajax({
        url:'/inventario/colores',
        type:'POST',
        data:{
            "_token": $("meta[name='csrf-token']").attr("content"),
            "producto":$('#colores_producto_id').val(),
        },
        beforeSend:function(){
            $('#row_tabla_colores').append('<div class="d-flex justify-content-center"><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
        },
        success:function(resp){
            $('#color_p').val('')
            $('#row_tabla_colores').empty();
            $('#row_tabla_colores').append(resp.tabla);
        },
        error:function(resp){
            console.log(resp);
            alert('error ajax ver colores producto');
        }
    });
}

function eliminarColorProducto(id){
    console.log(id)
}

function editarProducto(id, descripcion, pc, pv, pm, inv, inv_m, dep){
    $('#id_prod').val(id)
    $('#descripcion2').val(descripcion)
    $('#prec_costo2').val(pc)
    $('#prec_venta2').val(pv)
    $('#prec_mayoreo2').val(pm)
    $('#existencia2').val(inv)
    $('#inventario_min2').val(inv_m)
    console.log(dep);
    $('#departamento2 option[value='+dep+']').attr("selected",true);
    $('#editarProducto').modal('show');
};

$('#guardarProducto2').click(function(){
    $.ajax({
        url:'/inventario_actualizar',
        type:'POST',
        data:{
            "_token": $("meta[name='csrf-token']").attr("content"),
            "id" : $('#id_prod').val(),
            "descripcion" : $('#descripcion2').val(),
            "p_costo": $('#prec_costo2').val(),
            "p_venta": $('#prec_venta2').val(),
            "p_mayoreo": $('#prec_mayoreo2').val(),
            "existencia": $('#existencia2').val(),
            "inventario_min": $('#inventario_min2').val(),
            "departamento" : $('#departamento2').val(),
        },
        beforeSend:function(){
            $('.sGP2').css('display', '');
            $('#guardarProducto2').attr('disabled', true);
            $('#CancelarsGP2').attr('disabled', true);
        },
        success:function(resp){
            $('#editarProducto').modal('hide');
            $('#descripcion2').val(''),
            $('#prec_costo2').val(''),
            $('#prec_venta2').val(''),
            $('#prec_mayoreo2').val(''),
            $('#existencia2').val(''),
            $('#inventario_min2').val(''),
            swal({
                "timer":1600,
                type: "success",
                "title":"Cambios guardados correctamente!",
                "showConfirmButton":false
            });
            $.ajax({
                url:'/inventario',
                type: 'GET',
                success:function(res){
                    $('#contenido').empty();
                    $('#contenido').append(res.contenido);

                    $('#tablaInventario').DataTable();
                    $('.sGP2').css('display', 'none');
                    $('#guardarProducto2').attr('disabled', false);
                    $('#CancelarsGP2').attr('disabled', false);
                },
                error:function(res){
                    console.log(res);
                    alert('error ajax inventario');
                }
            });
        },
        error:function(resp){
            console.log(resp);
            alert('error ajax crear producto');
        }
    });
});



function imagenProducto(id, imagen){
    if (imagen == "") {
        $('#cargarImagenProducto').modal('show');
        $('#id_producto_f').val(id);
    }else{
        $('#verImagenProducto').modal('show');
        $("#imagen_producto").attr("src",'../../inv/'+imagen);
        $('#id_producto').val(id);
    }
    
};

$('#cambiar_img').click(function(){
    $('#verImagenProducto').modal('hide');
    $('#cargarImagenProducto').modal('show');
    $('#id_producto_f').val( $('#id_producto').val() );
});


$('#form_img').submit(function(e){
    e.preventDefault();

    let form_data = new FormData( document.getElementById("form_img") );

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/inventario/imagen_subir',
        type:'POST',
        data: form_data,
        cache:false,
        contentType: false,
        processData: false,
        beforeSend:function(){
            $('.sGI').css('display', '');
            $('#guardarImagen').attr('disabled', true);
            $('#CancelarsGI').attr('disabled',true);
        },
        success:function(res){
            console.log(res);
            $('.sGI').css('display', 'none');
            $('#guardarImagen').attr('disabled', false);
            $('#CancelarsGI').attr('disabled',false);
            $('#cargarImagenProducto').modal('hide');

            swal({
                "timer":1600,
                type: "success",
                "title":"La imagen se guardo correctamente!",
                "showConfirmButton":false
            });

            $('#imagen_p').val('');
            $.ajax({
                url:'/inventario',
                type: 'GET',
                success:function(res){

                    $('#contenido').empty();
                    $('#contenido').append(res.contenido);

                    $('#tablaInventario').DataTable();
                    $('.sGI').css('display', 'none');
                    $('#guardarImagen').attr('disabled', false);
                    $('#CancelarsGI').attr('disabled',false);
                },
                error:function(res){
                    console.log(res);
                    alert('error ajax inventario');
                }
            });
        },
        error:function(res){
            console.log(res);
        }
    });

    

});

function eliminarProducto(id){
    swal({
        type: "warning",
        title: 'Deseas eliminar el producto?',
        text: "una vez eliminado no se podra recuperar!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Si, borralo!',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function(isConfirm){
        if (isConfirm) {
            $.ajax({
                url: '/inventario_eliminar',
                type:'POST',
                data:{
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "id" : id,
                },
                success:function(resp){
                    $.ajax({
                        url:'/inventario',
                        type: 'GET',
                        success:function(res){
                            swal({
                                "timer":1600,
                                type: "success",
                                "title":"Producto eliminado correctamente!",
                                "showConfirmButton":false
                            });
                            $('#contenido').empty();
                            $('#contenido').append(res.contenido);
        
                            $('#tablaInventario').DataTable();
                        },
                        error:function(res){
                            console.log(res);
                            alert('error ajax inventario');
                        }
                    });
                },
                error:function(resp){
                    console.log(resp);
                }
            });
        } else {
            
        }
    });
};