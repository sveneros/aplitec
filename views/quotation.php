<link rel="stylesheet" type="text/css" href="../assets/vendor/datatable/jquery.dataTables.min.css">

        <?php
        include('../layout/header.php');
        ?>

       
<div class="container-fluid">
    <div id="ModalFinVenta" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Finalizar Cotización</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="FormFinVenta">
                    <div class="modal-body">
                        <div class="col-lg-6 col-md-6">
                            <div id="textoVenta">...
                            </div>
                        </div>
                    </div>

            
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info waves-effect" id="btn_finalizar_venta">Registrar
                            Cotizacion</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bd-example-modal-lg" id="add-carrito" tabindex="-1" role="dialog"
        aria-labelledby="editCardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Producto para Cotización</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="FormAgregarCarrito">

                        <div class="form-group">
                            <input type="hidden" id="carrito_id_producto" />
                            <h5 for="carrito_modelo">Producto:</h5>
                            <input type="text" class="form-control" id="carrito_descripcion" name="carrito_descripcion"
                                placeholder="Medida" readonly>
                        </div>

                        <div class="form-group">
                            <h5 for="carrito_precio">Precio:</h5>
                            <input type="text" class="form-control" id="carrito_precio" placeholder="0.00"
                                maxlength="12" required>
                        </div>
                        <div class="form-group">

                            <h5 for="carrito_cantidad">Cantidad:</h5>

                            <div class="d-flex">
                                <a class="btn btn-primary b-r-0 decrement">-</a>
                                <input type="number" class="form-control app-touchspin count" id="carrito_cantidad"
                                    name="carrito_cantidad" min="1" max="999999" step="1" maxlength="9" required>
                                <a class="btn btn-secondary b-r-0 increment">+</a>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info waves-effect" id="btn_submit">Agregar producto <i class="ti ti-shopping-cart"></i><i class="ti ti-arrow-right"></i></button>
                    <button type="button" class="btn btn-secondary waves-effect"
                        data-bs-dismiss="modal">Cancelar</button>
                </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bd-example-modal-lg" id="add-cliente" tabindex="-1" role="dialog"
        aria-labelledby="editCardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Cliente para Cotización</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="FormAgregarCliente">
                        <div class="form-group">
                            <input type="hidden" id="carrito_id_cliente" required/>
                            <h5 for="carrito_modelo">Cliente:</h5>
                            <input type="text" class="form-control" id="carrito_cliente_descripcion" name="carrito_cliente_descripcion"
                                placeholder="Medida" readonly required>
                            <label>Teléfono</label>
                            <input type="text" class="form-control" id="carrito_cel1" name="carrito_cel1" readonly >
                            <label>Celular</label>
                            <input type="text" class="form-control" id="carrito_cel2" name="carrito_cel2" readonly >
                            <label>Email</label>
                            <input type="text" class="form-control" id="carrito_email" name="carrito_email" readonly >
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info waves-effect" id="btn_submit">Seleccionar cliente <i class="ti ti-user"></i><i class="ti ti-arrow-right"></i></button>
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>
                </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
                            <div class="table-responsive app-scroll app-datatable-default product-list-table">
                                <table class="table-sm display align-middle" id="basic-2">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido 1</th>
                                            <th>Apellido 2</th>
                                            <th>Teléfono</th>
                                            <th>Celular</th>
                                            <th>Email</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="DetalleTablaClientes">
                                        <tr>
                                            <td>CARGANDO...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div id="tab-2" class="tabs-contents">
                            <div class="row">

                                <div class="app-scroll table-responsive app-datatable-default">
                                    <table class="display app-data-table default-data-table" id="basic-1">
                                        <thead>
                                            <tr>

                                                <th>Código</th>
                                                <th>Nombre</th>
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

            <div class="card education-profile-card">
                <div class="card-body">
                    <div class="profile-header">
                        <h5 class="header-title-text"><i class="ti ti-user-circle"></i> Cliente:</h5>
                    </div>
                    <div class="profile-top-content">
                        
                        <h6 class="text-dark f-w-600 mb-0" id="fin_nombre_cliente"></h6>
                        <p class="text-secondary f-s-13 mb-0" id="fin_email"></p>
                        
                    </div>
                    <div class="profile-content-box">
                            
                            <div class="profile-details">
                                <p class="f-s-18 mb-0"><i class="ph-fill  ph-phone"></i></p>
                                <span class="badge text-light-secondary" id="fin_cel1"></span>
                            </div>
                            <div class="profile-details">
                                <p class="f-s-18 mb-0"><i class="ph-duotone  ph-phone"></i></p>
                                <span class="badge text-light-success" id="fin_cel2"></span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center gap-2">
                            <img src="../assets/images/ecommerce/01.gif" alt="" class="w-35 h-35">
                            <h6 class="text-dark f-w-600 f-s-18 m-0">Productos seleccionados:</h6>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="carritoList">

                            </table>
                        </div>
                        <div class="pricing-details">

                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Sub total:</th>
                                        <th scope="col" class="text-end">
                                            <h3 class="tx-primary tx-bold" id="total_venta">0.00</h3>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <tr>
                                        <td colspan="2">
                                            <form id="FormFinalizarCotizacion">
                                                <input type="hidden" id="fin_id_cliente" name="fin_id_cliente" required readonly>
                                                <label>Fecha de la cotización:</label>
                                                <div class="dates">
                                                    
                                                    <input class="form-control basic-date flatpickr-input active" type="text" placeholder="Seleccione una fecha" readonly="readonly" id="fin_fecha" name="fin_fecha" required >
                                                    
                                                </div>
                                                <div class="price-row" id="boton_fin_venta">
                                                </div>
                                            </form>
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

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
config = {
    enableTime: false,
}
flatpickr(".basic-date",config);
$(function($){
    ObtenerProductosIngreso();
    ObtenerClientesIngreso();

    $('#carrito_precio').on('blur', function() {
        let value = $(this).val();
        if (value) {
            let isValid = true;
            let dotCount = 0;

            for (let i = 0; i < value.length; i++) {
                const char = value[i];
                if (char === '.') {
                    dotCount++;
                } else if (char < '0' || char > '9') {
                    isValid = false;
                    break;
                }
            }

            if (dotCount > 1 || !isValid) {
                $(this).val('');
                return;
            }

            // Convertir a número y formatear a dos decimales
            value = parseFloat(value).toFixed(2);
            $(this).val(value);
        }
    });
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
        <td class="sorting_1">${value.producto_codigo}</td>
        <td>${value.nombre}</td>
        <td>${value.producto_descripcion}</td>
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

  function ObtenerClientesIngreso() {
    $.ajax({
      url: '../controllers/client_controller.php',
      type: 'GET',
      dataType: "json",
      data: {  },
      success: function (data) {
        
        localStorage.setItem('sml2020_clientes', JSON.stringify(data)); // Store all categories in localStorage

        actualizarTablaClientes();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (textStatus === 'timeout') {
          Swal.fire('Error', '¡La conexión a internet se ha interrumpido!', 'error');
        } else {
          Swal.fire('Error', 'Error al cargar clientes de ingreso: ' + errorThrown, 'error');
        }
      }
    });
  }

  function actualizarTablaClientes() {
    $('#DetalleTablaClientes').empty();

    if ($.fn.dataTable.isDataTable('#basic-2')) {
        $('#basic-2').DataTable().destroy();
    }
    var localData=JSON.parse(localStorage.getItem('sml2020_clientes'));
    cant_prod=localData.length;

    let html = '';
  $.each(localData, function(key, value) {
    
    const edi = '<button class="btn btn-info" onclick="SeleccionarCliente(\'' + value.id + '\')" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="ti ti-user-circle"></i><i class="ti ti-arrow-right"></i></button>';

    html += `
      <tr role="row" class="odd">
        
        <td class="sorting_1">${value.nombre}</td>
        <td>${value.apellido1}</td>
        <td>${value.apellido2}</td>
        <td>${value.cel1}</td>
        <td> ${value.cel2}</td>
        <td> ${value.email}</td>
        <td>${edi}</td>
      </tr>
        `;
    });

    $('#DetalleTablaClientes').html(html);
    $('#basic-2').DataTable();    
  }

function SeleccionarCliente(elId){ 
    var localData=JSON.parse(localStorage.getItem('sml2020_clientes'));
       $.each(localData,function(key,value){
        if (value.id===elId) { 
            $('#carrito_id_cliente').val(value.id);
            $('#carrito_cliente_descripcion').val(value.nombre +" "+value.apellido1+" "+value.apellido2);
            $('#carrito_cel1').val(value.cel1);
            $('#carrito_cel2').val(value.cel2);
            $('#carrito_email').val(value.email);
            return
        }
      });          
    $('#add-cliente').modal("show");
    $('#add-cliente carrito_cliente_descripcion').focus();
            
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

$("#FormAgregarCliente").submit(function(e) {
    e.preventDefault();
}).validate({  
    submitHandler: function(form) { 
        GuardarClienteEnCarrito(); 
        $('#add-cliente').modal('hide');
        return false;  //This doesn't prevent the form from submitting.
    }
});

//agregar cliente seleccionado
function GuardarClienteEnCarrito(){
    var Id=$('#carrito_id_cliente').val();
    var descripcion=$('#carrito_cliente_descripcion').val();
    var cel1=$('#carrito_cel1').val();
    var cel2=$('#carrito_cel2').val();
    var email=$('#carrito_email').val();
    $('#fin_id_cliente').val(Id);
    $('#fin_nombre_cliente').text(descripcion);
    $('#fin_cel1').text(cel1);
    $('#fin_cel2').text(cel2);
    $('#fin_email').text(email);
}

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
    $('#boton_descuento').empty();
    $('#boton_fin_venta').empty();
    var cont=0;var html='<thead><tr><th>Cant.</th><th>Prod.</th><th>P.U.</th><th>P.T.</th><th></th></tr></thead><tbody>';var total=0.00;
    $.each(ventas , function( index, prod ) {
        total+=parseFloat(prod[4]);    
        cont++;
        preciou=parseFloat(prod[3]);
        preciot=parseFloat(prod[4]);
        html+='<tr><td><span class="badge text-bg-dark badge-notification ms-2">'+prod[2]+'</span></td><td><small>'+prod[1]+'</small></td><td><span class="label label-info small">'+preciou.toFixed(2)+'</span></td><td><span class="label label-success small">'+preciot.toFixed(2)+'</span></td><td class="text-nowrap"><a href="#" class="btn btn-outline-danger icon-btn b-r-4 delete-btn" data-toggle="tooltip" data-original-title="Borrar" onclick=\"Borrar(\''+index+'\')\"><i class="ti ti-trash"></i></a></td></tr>';
    });
      
    $('#carritoList').append(html);
        if (cont>0){
            $('#total_venta').append("Bs. " + total.toFixed(2));
            $('#subtotal').val(total.toFixed(2));
            $('#total_descuento').append("- ");
            $('#total_descuento').append(descuento.toFixed(2));
            var total_menos_descuento=total - descuento;
            $('#total_menos_descuento').append(total_menos_descuento.toFixed(2));
            
            $('#boton_fin_venta').append('<br><button class="btn btn-lg btn-info w-100" onclick=\"MostrarModalFinVenta()\"><i class="ti ti-checkout"></i> Finalizar Cotización</button>');       
        }
  }

function Borrar(index){
    ventas.splice(index, 1);
    UpdateCarrito();
     
}

function MostrarModalFinVenta(){
    
    $('#ModalFinVenta').modal("show");
    $('#btn_finalizar_venta').show();    
    
}

$("#FormFinalizarCotizacion").submit(function(e) {
    e.preventDefault();
}).validate({  
    submitHandler: function(form) { 
        MostrarModalFinVenta();
        return false;  
    }
});

//FormFinVenta
$("#FormFinVenta").submit(function(e) {
    e.preventDefault();
}).validate({  
    submitHandler: function(form) { 
       FinalizarCotizacion();
        return false;  //This doesn't prevent the form from submitting.
    }
});

function FinalizarCotizacion() {
    
 var id_cliente=$('#fin_id_cliente').val();
 var fecha=$('#fin_fecha').val();
  $("#btn_finalizar_venta").hide();
   
 var productsJSON = JSON.stringify(ventas);
    $.ajax({
		url: '../controllers/venta_end_service.php',
		type: 'POST',
                dataType:"json", 
		data: {
			'productos': productsJSON ,
            'id_cliente':id_cliente,
            'fecha': fecha,
			},
         success:function(data){ 
            if(data.success){ 
                var documento=JSON.stringify(data.results[0].documento);
                ventas=[];
                //CargarProductosIngreso();
                UpdateCarrito();
                var html='';
                html+='<p>Cotización registrada con Nro: '+documento+'<br>';
                html+='<a href="invoice.php?iddoc='+documento+'" class="btn btn-success"><i class="mdi mdi-barcode-scan"></i> Ver Cotización</a>';
                $('#textoVenta').append(html);
            } 
         },
         error:function(jqXHR,textStatus,errorThrown)
         {
            alert("Error la guardar el cotizacion : "+errorThrown);
	     
         }
	});//end ajax 
}
    </script>

