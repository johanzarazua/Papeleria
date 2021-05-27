  $('#empleados').click(function(){
    $.ajax({
      url:'/empleados',
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

        $('#titulo').append('Empleados');
        $('#btn-titulo').append(res.botones);
        $('#contenido').append(res.contenido);

        $('#tablaEmpleados').DataTable();
      },
      error:function(res){
        console.log(res);
        alert('error ajax empleado');
      }
    });
  });

  $('#guardarEmpleado').click(function(){
    if ($(".emp").val() != "") {
      $.ajax({
        url:'/empleado_crear',
        type:'POST',
        data:{
          "_token": $("meta[name='csrf-token']").attr("content"),
          "nombre": $("#name").val(),
          "puesto": $("#puesto").val(),
          "correo": $("#email").val(),

        },
        beforeSend:function(){
          $('.sGE').css('display', '');
          $('#guardarEmpleado').attr('disabled', true);
          $('#CancelarsGE').attr('disabled', true);
        },
        success:function(resp){
          $('#registrarEmpleado').modal('hide');
          $("#name").val("");
          $("#puesto").prop('selectedIndex',0);
          $("#email").val("");
          swal({
            "timer":1600,
            type: "success",
            "title":"Empleado guardado correctamente!",
            "showConfirmButton":false
          });
          $.ajax({
            url:'/empleados',
            type: 'GET',
            success:function(res){
              $('#contenido').empty();
              $('#contenido').append(res.contenido);
              $('#tablaEmpleados').DataTable();
              $('.sGE').css('display', 'none');
              $('#guardarEmpleado').attr('disabled', false);
              $('#CancelarsGE').attr('disabled', false);
            },
            error:function(res){
              console.log(res);
              alert('error ajax empleado');
            }
          });

        },
        error:function(resp){
          console.log(resp);
          alert('error ajax registrar empleado');
        }
      });
    }else{
      alert('Llena todos los campos');
    }
  });

  function editarEmpleado(id, nombre, puesto, correo){
    //console.log(id,nombre, puesto, correo)
    $('#id2').val(id);
    $('#name2').val(nombre);
    $('#puesto2 option[value='+puesto+']').attr("selected",true);
    $('#email2').val(correo);
    $('#editarEmpleado').modal('show');
  };

  $('#guardarEmpleado2').click(function(){
    $.ajax({
      url:'/empleado_editar',
      type:'POST',
      data:{
        "_token": $("meta[name='csrf-token']").attr("content"),
        "id" : $("#id2").val(),
        "nombre": $("#name2").val(),
        "puesto": $("#puesto2").val(),
        "correo": $("#email2").val(),
      },
      beforeSend:function(){
        $('.sGE2').css('display', '');
        $('#guardarEmpleado2').attr('disabled', true);
        $('#CancelarsGE2').attr('disabled', true);
      },
      success:function(resp){
          $('#editarEmpleado').modal('hide');
          swal({
            "timer":1600,
            type: "success",
            "title":"Empleado editado correctamente!",
            "showConfirmButton":false
          });
          $.ajax({
            url:'/empleados',
            type: 'GET',
            success:function(res){
              $('#contenido').empty();
              $('#contenido').append(res.contenido);
              $('#tablaEmpleados').DataTable();
              $('.sGE2').css('display', 'none');
              $('#guardarEmpleado2').attr('disabled', false);
              $('#CancelarsGE2').attr('disabled', false);
            },
            error:function(res){
              console.log(res);
              alert('error ajax empleado');
            }
          });
      },
      error:function(resp){
        console.log(resp);
        alert('error ajax registrar empleado');
      }
    });
  });

  function despedirEmpleado(id_empleado){
    $.ajax({
      url:'/empleado_despedir',
      type:'POST',
      data:{
        "_token": $("meta[name='csrf-token']").attr("content"),
        "id" : id_empleado,
      },
      beforeSend:function(){
        $('.sDE'+id_empleado).css('display', '');
        $('#BEE'+id_empleado).attr('disabled', true);
        $('#BDE'+id_empleado).attr('disabled', true);
        $('#BRE'+id_empleado).attr('disabled', true);
        $('#BBE'+id_empleado).attr('disabled', true);
      },
      success:function(resp){
        swal({
          "timer":1600,
          type: "success",
          "title":"Empleado despedido correctamente!",
          "showConfirmButton":false
        });
        $.ajax({
          url:'/empleados',
          type: 'GET',
          success:function(res){
            $('#contenido').empty();
            $('#contenido').append(res.contenido);
            $('#tablaEmpleados').DataTable();
            $('.sDE'+id_empleado).css('display', 'none');
            $('#BEE'+id_empleado).attr('disabled', false);
            $('#BDE'+id_empleado).attr('disabled', false);
            $('#BRE'+id_empleado).attr('disabled', false);
            $('#BBE'+id_empleado).attr('disabled', false);
          },
          error:function(res){
            console.log(res);
            alert('error ajax empleado');
          }
        });
      },
      error:function(resp){
        console.log(resp);
        alert('error ajax despedir empleado');
      }
    });
  };

  function recuperarEmpleado(id_empleado){
    $.ajax({
      url:'/empleado_recuperar',
      type:'POST',
      data:{
        "_token": $("meta[name='csrf-token']").attr("content"),
        "id" : id_empleado,
      },
      beforeSend:function(){
        $('.sRE'+id_empleado).css('display', '');
        $('#BEE'+id_empleado).attr('disabled', true);
        $('#BDE'+id_empleado).attr('disabled', true);
        $('#BRE'+id_empleado).attr('disabled', true);
        $('#BBE'+id_empleado).attr('disabled', true);
      },
      success:function(resp){
        swal({
          "timer":1600,
          type: "success",
          "title":"Empleado recuperado correctamente!",
          "showConfirmButton":false
        });
        $.ajax({
          url:'/empleados',
          type: 'GET',
          success:function(res){
            $('#contenido').empty();
            $('#contenido').append(res.contenido);
            $('#tablaEmpleados').DataTable();
            $('.sRE'+id_empleado).css('display', 'none');
            $('#BEE'+id_empleado).attr('disabled', false);
            $('#BDE'+id_empleado).attr('disabled', false);
            $('#BRE'+id_empleado).attr('disabled', false);
            $('#BBE'+id_empleado).attr('disabled', false);
          },
          error:function(res){
            console.log(res);
            alert('error ajax empleado');
          }
        });
      },
      error:function(resp){
        console.log(resp);
        alert('error ajax recuperar empleado');
      }
    });
  };

  function eliminarEmpleado(id_empleado){
    swal({
        type: "warning",
        title: 'Deseas eliminar el empleado?',
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
            url:'/empleado_eliminar',
            type:'POST',
            data:{
              "_token": $("meta[name='csrf-token']").attr("content"),
              "id" : id_empleado,
            },
            success:function(resp){
              $.ajax({
                url:'/empleados',
                type: 'GET',
                success:function(res){
                  swal({
                    "timer":1600,
                    type: "success",
                    "title":"Empleado eliminado correctamente!",
                    "showConfirmButton":false
                  });
                  $('#contenido').empty();
                  $('#contenido').append(res.contenido);
                  $('#tablaEmpleados').DataTable();
                },
                error:function(res){
                  console.log(res);
                  alert('error ajax empleado');
                }
              });
            },
            error:function(resp){
              console.log(resp);
              alert('error ajax eliminar empleado');
            }
          });
        } else {
            
        }
    });
  };