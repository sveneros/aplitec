
<link rel="stylesheet" type="text/css" href="../assets/vendor/datatable/jquery.dataTables.min.css">
<?php
include('../layout/header.php');
?>

<div class="container-fluid">
  <!-- Breadcrumb start -->
  <div class="row m-1">
    <div class="col-12 ">
    <button type="button" class="btn btn-primary m-1 float-end" id="btn_nuevo" data-bs-toggle="modal" data-original-title="test"
    data-bs-target="#exampleModal"><i class="ti ti-plus"></i> Nuevo Cliente</button>
      <h4 class="main-title">Clientes</h4>
      <ul class="app-line-breadcrumbs mb-3">
        <li class="">
          <a href="#" class="f-s-14 f-w-500">
            <span>
              <i class="ph-duotone  ph-table f-s-16"></i> Operaciones
            </span>
          </a>
        </li>
        <li class="active">
          <a href="#" class="f-s-14 f-w-500">Clientes</a>
        </li>
      </ul>
    </div>
  </div>

  <!-- Breadcrumb end -->

  <!-- Modal -->

  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="editCardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">CLIENTE</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formProduct">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">NOMBRE<span class="text-danger">*</span></label>
                <input type="text" class="numberformat form-control" id="nombre" name="nombre" maxlength="20" size="13"
                  required>
              </div>
              <div class="col-md-6">
                <input type="hidden" class="form-control" id="id_cliente">
                <label class="form-label">APELLIDO PATERNO<span class="text-danger">*</span></label>

                <input type="text" class="form-control" id="apellido1" name="apellido1" maxlength="20" required>
              </div>
            </div>
            <div class="row g-3">

              <div class="col-md-6">
                <label class="form-label">APELLIDO MATERNO<span class="text-danger">*</span></label>

                <input type="text" class="form-control" id="apellido2" name="apellido2" maxlength="20" required>
              </div>
              <div class="col-md-6 ">
                <label class="form-label">TELÉFONO <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="cel1" name="cel1" maxlength="11" min="1" required>
              </div>
            </div>
            <div class="row g-3">

              <div class="col-md-6 ">
                <label class="form-label">CELULAR <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="cel2" name="cel2" maxlength="11" min="1" required>
              </div>

              <div class="col-md-6">

              </div>
            </div>
            <div class="row g-3">

              <div class="col-md-6 ">
                <label class="form-label">DIRECCIÓN <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="direccion" name="direccion" maxlength="300" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">EMAIL<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" maxlength="300" required>
              </div>
            </div>
            <div class="row g-3">

              <div class="col-md-6 ">
                <label class="form-label">NIT <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="nit" name="nit" maxlength="20" min="1" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">RAZÓN SOCIAL<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="razon_social" name="razon_social" maxlength="100" required>
              </div>
            </div>
            <div class="row g-3">

              <div class="col-md-6 ">

              </div>

              <div class="col-md-6">
                <label class="form-label">ESTADO<span class="text-danger">*</span></label>
                <select class="form-control" id="estado" name="estado">
                  <option value="V">HABILITADO</option>
                  <option value="D">DESHABILITADO</option>
                </select>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary waves-effect" id="btn_submit">Guardar</button>
          <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
      </div>

    </div>
  
  </div>
<!-- Modal -->
<!-- Data Table start -->
  <div class="row">
    <!-- Default Datatable start -->
    <div class="col-12">
      <div class="card ">
       
        <div class="card-body p-0">
          <div class="table-responsive app-scroll app-datatable-default product-list-table">
            <table class="table-sm display align-middle" id="basic-1">

              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Apellido Paterno</th>
                  <th>Apellido Materno</th>
                  <th>Teléfono</th>
                  <th>Celular</th>
                  <th>Dirección</th>
                  <th>Email</th>
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
    <!-- Default Datatable end -->
  </div>
  <!-- Data Table end -->
</div>
          

    <?php
    include('../layout/footer.php');
    ?>


<!-- data table jquery-->
<script src="../assets/vendor/datatable/jquery.dataTables.min.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>
<script src="../assets/js/jquery-key-restrictions.min.js"></script>

<!-- js-->
<script>


$(function($){
    ObtenerClientesIngreso();
    //validation
    $("#nombre").lettersOnly();
    $("#apellido1").lettersOnly();
    $("#apellido2").lettersOnly();
   
});

  $('#btn_nuevo').on('click', function (e) {
    e.preventDefault();
    resetClienteForm(); // New function to simplify form reset
    $('#nombre').focus();
  });

  function resetClienteForm() {
    $('#id_cliente').val("0");
    $('#nombre').val("");
    $('#apellido1').val("");
    $('#apellido2').val("");
    $('#cel1').val("");
    $('#cel2').val("");
    $('#direccion').val("");
    $('#email').val("");
    $('#nit').val("");
    $('#razon_social').val("");
    $('#estado').prop('selectedIndex', 0); // Reset dropdown selection
  }
  
  function ObtenerClientesIngreso() {
    $.ajax({
      url: '../controllers/client_controller.php',
      type: 'GET',
      dataType: "json",
      data: {  },
      success: function (data) {
        
        localStorage.setItem('sml2020_clientes', JSON.stringify(data)); // Store all categories in localStorage

        actualizarTabla();
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

  function actualizarTabla() {
    $('#DetalleTabla').empty();

    if ($.fn.dataTable.isDataTable('#basic-1')) {
        $('#basic-1').DataTable().destroy();
    }
    var localData=JSON.parse(localStorage.getItem('sml2020_clientes'));
    cant_prod=localData.length;

    let html = '';
  $.each(localData, function(key, value) {
    const est = value.estado === 'V' ?
      '<span class="badge rounded-pill bg-success badge-notification">HABILITADO</span>' :
      '<span class="badge rounded-pill bg-danger badge-notification">DESHABILITADO</span>';

    const edi = '<button class="btn btn-primary" onclick="Editar(\'' + value.id + '\')" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-pencil"></i></button>';

    html += `
      <tr role="row" class="odd">
        
        <td class="sorting_1">${value.nombre}</td>
        <td>${value.apellido1}</td>
        <td>${value.apellido2}</td>
        <td>${value.cel1}</td>
        <td> ${value.cel2}</td>
        <td> ${value.direccion}</td>
        <td> ${value.email}</td>
        <td>${est}</td>
        <td>${edi}</td>
      </tr>
        `;
    });

    $('#DetalleTabla').html(html);
    $('#basic-1').DataTable();    
  }


  function GuardarCliente() {
  $('#btn_submit').hide();

  const elId = $('#id_cliente').val();
  const nombre = $('#nombre').val();
  const apellido1 = $('#apellido1').val();
  const apellido2 = $('#apellido2').val();
  const cel1 = $('#cel1').val();
  const cel2 = $('#cel2').val();
  const direccion = $('#direccion').val();
  const email = $('#email').val();
  const nit = $('#nit').val();
  const razon_social = $('#razon_social').val();
  const estado = $('#estado option:selected').val();

  const method = elId === "0" || elId === null || elId === "" ? 'POST' : 'PUT';
   // Datos a enviar
   const data = {
    id: elId,
      nombre: nombre,
      apellido1: apellido1,
      apellido2: apellido2,
      cel1: cel1,
      cel2: cel2,
      direccion: direccion,
      email: email,
      estado: estado,
      nit: nit,
      razon_social: razon_social,
  };
  $.ajax({
    url: '../controllers/client_controller.php',
    type: method,
    dataType: "json",
    data: JSON.stringify(data),
    
    success: (response) => {
      if (response.success) {
        $('#exampleModal').modal('hide');
        Swal.fire(
            'Cliente Actualizado',
            '',
            'success'
        ); 
        ObtenerClientesIngreso();
      } else {
        // Mostrar un mensaje de error más específico basado en la respuesta del servidor
        alert(response.error || 'Ocurrió un error al actualizar la categoría.');
      }
    },
    error(jqXHR, textStatus, errorThrown) {
      if (textStatus === 'timeout') {
        Swal.fire('Error', '¡La conexión a internet se ha interrumpido!', 'error');
      } else {
        Swal.fire('Error', 'Error al guardar Cliente: ' + errorThrown, 'error');
      }
    }
  }).always(() => {
    $('#btn_submit').show();
  });
}

function Editar(elId){ 
    var medida;
    var categoria;
    var presentacion;
    var localData=JSON.parse(localStorage.getItem('sml2020_clientes'));
        $.each(localData,function(key,value){
            if(value.id===elId){
            $('#id_cliente').val(value.id);
            
           
            $('#nombre').val(value.nombre);
            $('#apellido1').val(value.apellido1); 
            $('#apellido2').val(value.apellido2); 
            $('#cel1').val(value.cel1); 
            $('#cel2').val(value.cel2);
            $('#direccion').val(value.direccion); 
            $('#email').val(value.email); 
            $('#nit').val(value.nit); 
            $('#razon_social').val(value.razon_social); 
              
            $('#estado').val(value.estado).prop('selected', true);  
            return}
        }); 
            
            
           $('#nombre').focus();      
}


$("#formProduct").submit(function(e) {
    e.preventDefault();
    }).validate({  
    submitHandler: function(form) { 
      GuardarCliente(); //submit via ajax
        return false;  //This doesn't prevent the form from submitting.
    }});

</script>


