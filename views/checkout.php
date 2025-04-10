<link rel="stylesheet" type="text/css" href="../assets/vendor/datatable/jquery.dataTables.min.css">

        <?php
        include('../layout/header.php');
        ?>

       
            <div class="container-fluid">

            <div class="modal fade bd-example-modal-lg" id="add-carrito" tabindex="-1" role="dialog" aria-labelledby="editCardModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                

                                <div class="modal-header">
                                    <h4 class="modal-title">Lista de Compra</h4>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="FormAgregarCarrito">
                                    
                                    <div class="form-group">
                                        <input type="hidden" id="carrito_id_producto"/>
                                        <h5 for="carrito_modelo">Producto:</h5>
                                        <input type="text" class="form-control" id="carrito_descripcion" name="carrito_descripcion" placeholder="Medida" readonly>
                                    </div>
                                            

                                    <div class="form-group">
                                        <h5 for="carrito_precio">Precio:</h5>
                                        <input type="number" class="form-control" id="carrito_precio" placeholder="Precio" maxlength="10" readonly="">
                                    </div>
                                    <div class="quantity form-group">
                                        
                                            <h5 for="carrito_cantidad">Cantidad:</h5>
                                            <input type="number" class="numberformat" id="carrito_cantidad" name="carrito_cantidad" min="1" max="999999" step="1" maxlength="9" required >
                                    
                                    </div>     
                                </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info waves-effect" id="btn_submit">Guardar</button>
                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                
                                </form>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                    <!-- /.modal-dialog -->
                    </div>
                </div>
                <!-- Breadcrumb start -->
                <div class="row m-1">
                    <div class="col-12 ">
                        <h4 class="main-title">Cotización</h4>
                        <ul class="app-line-breadcrumbs mb-3">
                            <li class="">
                                <a href="#" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-stack f-s-16"></i> Operaciones
                      </span>
                                </a>
                            </li>
                           
                            <li class="active">
                                <a href="#" class="f-s-14 f-w-500">Cotización</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Breadcrumb end -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="checkout-tabs-step">
                                    <div class="tab checkout-current-step d-flex" data-tab="tab-1">

                                        <div class="tabs-steps">
                                            <i class="ti ti-user-circle"></i>
                                        </div>

                                        <div class="px-2">
                                            <h6 class="mb-0">Datos del cliente</h6>
                                            <span class="text-secondary">Paso 1 </span>
                                        </div>

                                    </div>
                                    <div class="tab d-flex" data-tab="tab-2">
                                        <div class="tabs-steps">
                                            <i class="ti ti-shopping-cart"></i>
                                        </div>

                                        <div class="px-2">
                                            <h6 class="mb-0"> Productos </h6>
                                            <span class="text-secondary">Paso 2</span>
                                        </div>

                                    </div>

                                    
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="checkout-content-list">
                                    <div id="tab-1" class="tabs-contents checkout-current-step">
                                        <form class="app-form" id="FormCliente">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre</label>
                                                        <input type="text" class="form-control" name="nombre" id="nombre" required minlength="2" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Primer Apellido</label>
                                                        <input type="text" class="form-control" name="apellido1" id="apellido1" required minlength="2" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Segundo Apellido</label>
                                                        <input type="text" class="form-control" name="apellido2" id="apellido2" required minlength="2" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email" required minlength="2" maxlength="150">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Teléfono fijo</label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text" placeholder=""
                                                                   aria-label="Recipient's username" name="telefono1" id="telefono1"><span class="input-group-text"><i
                                                                        class="fa-solid fa-phone" required minlength="2" maxlength="12"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Celular</label>
                                                        <input type="tel" class="form-control" pattern="[0-9]{8}" name="telefono2" id="telefono2" required minlength="7" maxlength="12">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="mb-3">
                                                        <label class="form-label">Direccion</label>
                                                        <input type="text" class="form-control" name="direccion" id="direccion" required minlength="2" maxlength="50">
                                                    </div>
                                                </div>
                                               
                                                <div class="col-12">
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">Continuar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <div id="tab-2" class="tabs-contents">
                                        <div class="row">
                                                
                                            <div class="app-scroll table-responsive app-datatable-default">
                                            <table class="display app-data-table default-data-table" id="basic-1">
                                
                                <thead>
                                    <tr>
                                        
                                        <th>Código</th>
                                        <th>Descripción</th>
                                        <th>Marca</th>
                                        <th>Categoría</th>
                                        <th>Precio BS.</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="DetalleTabla">
                                    <tr>
                                        <td>CARGANDO...</td>                                                
                                    </tr>
                                </tbody>
                            </table>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                               Productos seleccionados:
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                            <table class="table" id="carritoList">
                                                    
                                                
                                                </table>
                                    </div>

                                <div class="pricing-details">
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <h4 class="tx-primary tx-bold" id="total_venta">0.00</h4>
                                        </div>
                                    </div>
                                    
                                    
                                    <form id="FormFinalizarCotizacion">
                                        <h4 class="price-lable text-white bg-success"> Total Bs.</h4>
                                        <h2 class="text-center" id="total_menos_descuento">0.00</h2>
                                        
                                        
                                        <div class="price-row" id="boton_fin_venta">
                                            
                                        </div>
                                        <a role="button" target="_blank" href="orders.php" class="btn btn-primary w-100" id="next">Buy Order</a>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
   
    <?php
    include('../layout/footer.php');
    ?>

<!-- checkout js -->
<script src="../assets/js/checkout.js"></script>
<script src="../assets/vendor/datatable/jquery.dataTables.min.js"></script>

<script src="../assets/js/jquery.validate.min.js"></script>

<script>
var elCodigoProducto;var ventas=[];
$(function($){
    ObtenerProductosIngreso(); 
 $('#caja').focus(); 

  $('#caja').keydown(function(e){if(e.keyCode==13){CargarProductosIngreso();}});
    });

$("#FormCliente").submit(function(e) {
    e.preventDefault();
}).validate({  
    submitHandler: function(form) { 
        alert("vaya a paso 2");
        return false;  //This doesn't prevent the form from submitting.
    }
});



$('#btn_limpiar').on('click', function(e){
          e.preventDefault();
        $('#caja').val("");
        $('#resultados').empty();
        $('#caja').focus();
        });



function ObtenerProductosIngreso() {
    $.ajax({
      url: '../controllers/product_controller.php',
      type: 'GET',
      dataType: "json",
      data: {  },
      success: function (data) {
        
        localStorage.setItem('sml2020_productos', JSON.stringify(data)); // Store all categories in localStorage

        actualizarTabla();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (textStatus === 'timeout') {
          Swal.fire('Error', '¡La conexión a internet se ha interrumpido!', 'error');
        } else {
          Swal.fire('Error', 'Error al cargar productos de ingreso: ' + errorThrown, 'error');
        }
      }
    });
  }

  function actualizarTabla() {
    $('#DetalleTabla').empty();

    if ($.fn.dataTable.isDataTable('#basic-1')) {
        $('#basic-1').DataTable().destroy();
    }
    var localData=JSON.parse(localStorage.getItem('sml2020_productos'));
    cant_prod=localData.length;

    let html = '';
  $.each(localData, function(key, value) {
    const est = value.estado === 'V' ?
      '<span class="badge rounded-pill bg-success badge-notification">HABILITADO</span>' :
      '<span class="badge rounded-pill bg-danger badge-notification">DESHABILITADO</span>';

    const edi = '<button class="btn btn-info" onclick="Editar(\'' + value.id + '\')"><i class="fa fa-shopping-cart"></i></button>';

    html += `
      <tr role="row" class="odd">
        
        <td class="sorting_1">${value.codigo}</td>
        <td>${value.descripcion}</td>
        <td>${value.marca}</td>
        <td>${value.categoria}</td>
        <td> ${value.puntos}</td>
        <td>${est}</td>
        <td>${edi}</td>
      </tr>
        `;
    });

    $('#DetalleTabla').html(html);
    $('#basic-1').DataTable();    
  }


function Editar(elId){ 
    var validator = $( "#FormAgregarCarrito" ).validate();
        validator.resetForm();
    var localData=JSON.parse(localStorage.getItem('sml2020_productos'));

       $.each(localData,function(key,value){
        if (value.id===elId) { 
            
        
        $('#carrito_id_producto').val(value.id);
        $('#carrito_descripcion').val(value.descripcion);
        precio=parseFloat(value.puntos);
        $('#carrito_precio').val(precio.toFixed(2));
        //$('#carrito_cantidad').prop('max', value.existencias); 
        $('#carrito_cantidad').val("1");
        return}
      }); 
           
    $('#add-carrito').modal("show");
            
}  




$("#FormAgregarCarrito").submit(function(e) {
    e.preventDefault();
}).validate({  
    submitHandler: function(form) { 
      GuardarEnCarrito(); //submit via ajax
        return false;  //This doesn't prevent the form from submitting.
    }
});
$("#FormDescuento").submit(function(e) {
    e.preventDefault();
}).validate({  
    submitHandler: function(form) { 
        UpdateCarrito();
        
        $('#ModalDescuento').modal('hide');
  
        return false;  //This doesn't prevent the form from submitting.
    }
});


//agregar a carrito:
function GuardarEnCarrito(){
  
    var Id=$('#carrito_id_producto').val();
    
    var descripcion=$('#carrito_descripcion').val();
    var cant=$('#carrito_cantidad').val();
    var precioU=parseFloat($('#carrito_precio').val());
    var precioT=parseFloat(precioU)*cant; 
    var existe=false;

    
          var product = [Id, descripcion,cant,precioU,precioT];       
          ventas.push(product);
          UpdateCarrito();
         
          
          $('#add-carrito').modal("hide");

                     }

  

  function UpdateCarrito(){
    $('#carritoList').empty();
    $('#total_venta').empty();
    $('#total_descuento').empty();
    $('#total_menos_descuento').empty();
    $('#subtotal').val("");
    var descuento=parseFloat($('#descuento').val());
    //$('#boton_fin_venta_credito').empty();
    $('#boton_descuento').empty();
    $('#boton_fin_venta').empty();
        var cont=0;var html='<thead><tr><th>Cant.</th><th>Prod.</th><th>P.U.</th><th>P.T.</th><th></th></tr></thead><tbody>';var total=0.00;
     $.each(ventas , function( index, prod ) {
      total+=parseFloat(prod[4]);    
     cont++;
      
      preciou=parseFloat(prod[3]);
      preciot=parseFloat(prod[4]);
      html+='<tr><td><span class="label label-danger">'+prod[2]+'</span></td><td><small>'+prod[1]+'</small></td><td><span class="label label-info small">'+preciou.toFixed(2)+'</span></td><td><span class="label label-success small">'+preciot.toFixed(2)+'</span></td><td class="text-nowrap"><a href="#" data-toggle="tooltip" data-original-title="Borrar" onclick=\"Borrar(\''+index+'\')\"> <i class="fa fa-close text-danger"></i></a></td></tr>';
      });
      $('#carritoList').append(html);
         if (cont>0) {
             $('#total_venta').append(total.toFixed(2));
             $('#subtotal').val(total.toFixed(2));
             $('#total_descuento').append("- ");
             $('#total_descuento').append(descuento.toFixed(2));
             var total_menos_descuento=total - descuento;
             $('#total_menos_descuento').append(total_menos_descuento.toFixed(2));
$('#boton_descuento').append('<button class="btn btn-primary btn-block"  onclick=\"MostrarModalDescuento()\"  ><i class="mdi mdi-minus-box-outline"></i> Agregar Descuento</button>');

             $('#boton_fin_venta').append('<br><button class="btn btn-lg btn-success waves-effect waves-light m-t-20" onclick=\"MostrarModalFinVenta()\"><i class="typcn typcn-save"></i> Pago en efectivo</button>');
             //$('#boton_fin_venta_credito').append('<button class="btn btn-danger btn-block"  onclick=\"MostrarModalFinVentaCredito()\"  ><i class="typcn typcn-save"></i> Pago de cliente a Credito</button>');
       
    }
   
  }

  function Borrar(index){
    ventas.splice(index, 1);
    UpdateCarrito();
     
  }

  function MostrarModalDescuento(){
    
   
    $('#ModalDescuento').modal();
    $('#descuento').focus();
  
 }
 function MostrarModalFinVenta(){
    
   
    $('#ModalFinVenta').modal();
    $('#btn_finalizar_venta').show();
    
    $('#FormFinalizarCotizacion inputNit').focus();
  
 }
 function Restar(inputString) {
    var subtotal= parseFloat($('#subtotal').val());
    var descuento= parseFloat($('#descuento').val());
    var total_menos_descuento=subtotal-descuento;

    $('#total_con_descuento').val(total_menos_descuento.toFixed(2));
  } 
  //clientes:
  function lookup2(inputString) {
    if(inputString.length == 0) {
      // Hide the suggestion box.
      $('#suggestions').hide();
    } else {
      ObtenerClientes(inputString);
      
    }
  } // lookup

$("#FormFinalizarCotizacion").submit(function(e) {
    e.preventDefault();
}).validate({  
    submitHandler: function(form) { 
        FinalizarCotizacion(); //submit via ajax
        return false;  //This doesn't prevent the form from submitting.
    }
});
function FinalizarCotizacion() {
   $('#textoVenta').empty();
    
 var id_usuario=$('#id_usuario').val();
  var origen=$('#id_almacen').val();
  var nit=$('#inputNit').val();
  var nombre=$('#inputNombre').val();
  var descuento=$('#descuento').val();
  var factura='SI';
  $("#btn_finalizar_venta").hide();
   
 var productsJSON = JSON.stringify(ventas);
    $.ajax({
		url: '../controllers/venta_end_service.php',
		type: 'POST',
                dataType:"json", 
		data: {
			'productos': productsJSON ,
			'id_usuario':id_usuario,
			'id_almacen_origen':origen,
      'id_cliente':0,
      'nit':nit,
      'nombre':nombre,
      'factura':factura,
      'descuento':descuento
			},
         success:function(data)

         { if(data.success){ 
            var documento=JSON.stringify(data.results[0].documento);
            var factura=JSON.stringify(data.results[0].factura);
            ventas=[];
            CargarProductosIngreso();
	    UpdateCarrito();
      var html='';
      html+='<p>Venta registrada Nro: '+documento+'<br>';
      html+='Factura Nro: '+factura+'</p><br>';
      html+='<a href="bills.php?iddoc='+documento+'" class="btn btn-success"><i class="mdi mdi-barcode-scan"></i> Ver Nota de Venta</a>';

      $('#textoVenta').append(html);
          }
	    	   
           
         },
         error:function(jqXHR,textStatus,errorThrown)
         {
            alert("Error la guardar el ingreso : "+errorThrown);
	     
         }
	});//end ajax 
}
/***PARA INPUT NUMBER: */

jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });
    </script>

