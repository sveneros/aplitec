
        <link rel="stylesheet" type="text/css" href="../assets/vendor/datatable/jquery.dataTables.min.css">
        <?php
        include('../layout/header.php');
        ?>
<div class="container-fluid">
                <!-- Breadcrumb start -->
                <div class="row m-1">
                    <div class="col-12 ">
                    <button type="button" class="btn btn-primary m-1 float-end" id="btn_nuevo" data-bs-toggle="modal" data-original-title="test"
    data-bs-target="#exampleModal"><i class="ti ti-plus"></i> Nueva Marca</button>
                        <h4 class="main-title">Marcas</h4>
                        <ul class="app-line-breadcrumbs mb-3">
                            <li class="">
                                <a href="#" class="f-s-14 f-w-500">
                                    <span>
                                        <i class="ph-duotone  ph-table f-s-16"></i> Operaciones
                                    </span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#" class="f-s-14 f-w-500">Marcas</a>
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
                                <h5 class="modal-title" id="exampleModalLabel">MARCA</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form id="FormMarca">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">CÓDIGO<span
                                                    class="text-danger">*</span></label>
                                           
                                            <input type="text" class="form-control" id="codigo" name="codigo"
                                                required minlength="2" maxlength="50">
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">DESCRIPCION<span
                                                    class="text-danger">*</span></label>
                                            <input type="hidden" class="form-control" id="id_marca" name="id_marca"
                                                required
                                                data-validation-required-message="Debe elegir un usuario de la lista"
                                                value="0">
                                            <input type="text" class="form-control" id="descripcion" name="descripcion"
                                                required minlength="4" maxlength="150">
                                        </div>
                                        <div class="col-md-4">
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
                                <button type="button" class="btn btn-secondary waves-effect"
                                    data-bs-dismiss="modal">Cancelar</button>
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
                            <div class="app-datatable-default overflow-auto">
                                <table id="basic-1" class="display app-data-table default-data-table">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>    
                                            <th>Descripción</th>
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
<script src="../assets/js/data_table.js"></script>
<script>
 
$(function($){
    CargarMarcas();
    //validation
    $("#descripcion").lettersOnly();

});

 $('#btn_nuevo').on('click', function(e){
        e.preventDefault();
        $("#id_marca").val("0");
        $("#codigo").val("");
        $("#descripcion").val("");
        }); 

function CargarMarcas() {
    $.ajax({
        url: '../controllers/brand_controller.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            localStorage.setItem('sml2020_marcas', JSON.stringify(data)); // Store all brands in localStorage
            ObtenerMarcas1(); 
        },
        error: function(jqXHR, textStatus, errorThrown) {
            if (textStatus === 'timeout') {
                alert("Internet connection is down!");
            } else {
                alert("Error loading brands: " + errorThrown);
            }
        }
    });
}


function ObtenerMarcas1() {
  $('#DetalleTabla').empty();

  if ($.fn.dataTable.isDataTable('#basic-1')) {
    $('#basic-1').DataTable().destroy();
  }

  const localData = JSON.parse(localStorage.getItem('sml2020_marcas'));

  let html = '';
  $.each(localData, function(key, value) {
    const est = value.estado === 'V' ?
      '<span class="badge rounded-pill bg-success badge-notification">HABILITADO</span>' :
      '<span class="badge rounded-pill bg-danger badge-notification">DESHABILITADO</span>';

    const edi = '<button class="btn btn-primary" onclick="Editar(\'' + value.id + '\')" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-pencil"></i></button>';

    html += `
      <tr role="row" class="odd">
        <td class="sorting_1">${value.codigo}</td>
        <td >${value.descripcion}</td>
        <td>${est}</td>
        <td>${edi}</td>
      </tr>
    `;
  });

  $('#DetalleTabla').html(html);
  $('#basic-1').DataTable();
}

function Editar(elId){ 

var localData=JSON.parse(localStorage.getItem('sml2020_marcas'));
       $.each(localData,function(key,value){
        if(value.id===elId){
        $('#id_marca').val(value.id);
        $('#codigo').val(value.codigo);
        $('#descripcion').val(value.descripcion);
        $('#estado').val(value.estado).prop('selected', true);  
        return}
      });
      $('#descripcion').focus();      
} 

$("#FormMarca").submit(function(e) {
    e.preventDefault();
}).validate({  
    submitHandler: function(form) { 
        GuardarMarca();
        return false;  //This doesn't prevent the form from submitting.
    }
});

function GuardarMarca() {
  // Validación de datos (ejemplo)
  const el_id = $('#id_marca').val();
  const codigo = $('#codigo').val();
  const descripcion = $('#descripcion').val();
  const estado = $('#estado option:selected').val();
  const method = el_id === "0" || el_id === null || el_id === "" ? 'POST' : 'PUT';


  if (!descripcion) {
    alert('Por favor, ingrese una descripción.');
    return;
  }

  // Datos a enviar
  const data = {
    id: el_id,
    codigo: codigo,
    descripcion,
    estado
  };

  $.ajax({
    url: '../controllers/brand_controller.php',
    type: method,
    dataType: 'json',
    data: JSON.stringify(data), // Enviar datos como JSON
    contentType: 'application/json',
    success: (response) => {
      if (response.success) {
        $('#exampleModal').modal('hide');
        Swal.fire(
            'Marca Actualizada',
            '',
            'success'
        ); 
        CargarMarcas();
      } else {
        // Mostrar un mensaje de error más específico basado en la respuesta del servidor
        alert(response.error || 'Ocurrió un error al actualizar la categoría.');
      }
    },
    error: (jqXHR, textStatus, errorThrown) => {
      if (textStatus === 'timeout') {
        alert("La conexión a internet se ha interrumpido.");
      } else {
        alert('Ocurrió un error inesperado: ' + errorThrown);
        Swal.fire(
            'Error',
            errorThrown,
            'danger'
        ); 
      }
    }
  });
}

    </script>


