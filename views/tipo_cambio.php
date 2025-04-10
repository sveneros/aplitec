<link rel="stylesheet" type="text/css" href="../assets/vendor/datatable/jquery.dataTables.min.css">
<?php
include('../layout/header.php');
?>

<style>
    .error {
        color: red;
    }
    .success {
        color: green;
        display: none;
    }
</style>

<div class="container-fluid">
  <!-- Breadcrumb start -->
  <div class="row m-1">
    <div class="col-12 ">
      <button type="button" class="btn btn-primary m-1 float-end" id="btn_nuevo" data-bs-toggle="modal" data-original-title="test"
      data-bs-target="#exampleModal"><i class="ti ti-plus"></i> Nuevo Tipo de Cambio</button>
      <h4 class="main-title">Tipos de Cambio</h4>
      <ul class="app-line-breadcrumbs mb-3">
        <li class="">
          <a href="#" class="f-s-14 f-w-500">
            <span>
              <i class="ph-duotone ph-table f-s-16"></i> Operaciones
            </span>
          </a>
        </li>
        <li class="active">
          <a href="#" class="f-s-14 f-w-500">Tipos de Cambio</a>
        </li>
      </ul>
    </div>
  </div>
  <!-- Breadcrumb end -->

  <!-- Modal para crear/editar tipo de cambio -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="editCardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tipo de Cambio</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formTipoCambio">
            <div class="row g-3">
              <div class="col-md-6">
                    <input type="hidden" class="form-control" id="id_tipo_cambio">
                    <label class="form-label">FECHA <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">TASA (Bs por $) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tasa" name="tasa" required>
                    <div class="error" id="tasaError">Formato inválido. Use 6.97 o 6,97 con exactamente 2 decimales</div>
                    <div class="success" id="tasaSuccess">Formato válido</div>
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
  <!-- Fin del Modal -->

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
                  <th>Fecha</th>
                  <th>Tasa (Bs/$)</th>
                  <th>Última actualización</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
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

<!-- js-->
<script>
    $(function($) {
        // Inicialización de funciones
        ObtenerTiposCambio();

        // Evento para el botón "Nuevo"
        $('#btn_nuevo').on('click', function(e) {
            e.preventDefault();
            resetTipoCambioForm();
            $('#fecha').focus();
        });

        // Validación del formulario
        $("#formTipoCambio").submit(function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: function(form) {
                GuardarTipoCambio();
                return false;
            }
        });
    });

    // Función para guardar el tipo de cambio
    function GuardarTipoCambio() {
        $('#btn_submit').hide();
    
        const tasaInput = $('#tasa').val();
        const validacion = validarTasa(tasaInput);
        
        if (!validacion.valido) {
            Swal.fire('Error', 'Por favor ingrese una tasa válida con 2 decimales', 'error');
            $('#btn_submit').show();
            return;
        }
        const elId = $('#id_tipo_cambio').val();
        const fecha = $('#fecha').val();
        const tasa = $('#tasa').val();

        const method = elId === "0" || elId === null || elId === "" ? 'POST' : 'PUT';
        const data = {
            id: elId,
            fecha: fecha,
            tasa: tasa
        };

        $.ajax({
            url: '../controllers/tipo_cambio_controller.php',
            type: method,
            dataType: "json",
            data: JSON.stringify(data),
            success: (response) => {
                if (response.success) {
                    $('#exampleModal').modal('hide');
                    Swal.fire('Tipo de Cambio Actualizado', '', 'success');
                    ObtenerTiposCambio();
                } else {
                    Swal.fire('Error', response.error || 'Ocurrió un error al guardar el tipo de cambio.', 'error');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (textStatus === 'timeout') {
                    Swal.fire('Error', '¡La conexión a internet se ha interrumpido!', 'error');
                } else {
                    Swal.fire('Error', 'Error al guardar Tipo de Cambio: ' + errorThrown, 'error');
                }
            }
        }).always(() => {
            $('#btn_submit').show();
        });
    }

    // Función para resetear el formulario
    function resetTipoCambioForm() {
        $('#id_tipo_cambio').val("0");
        $('#fecha').val("");
        $('#tasa').val("");
        // Establecer fecha por defecto a hoy
        $('#fecha').val(new Date().toISOString().split('T')[0]);
    }

    // Función para obtener tipos de cambio
    function ObtenerTiposCambio() {
        $.ajax({
            url: '../controllers/tipo_cambio_controller.php',
            type: 'GET',
            dataType: "json",
            success: function(data) {
                localStorage.setItem('tipos_cambio', JSON.stringify(data));
                actualizarTabla();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (textStatus === 'timeout') {
                    Swal.fire('Error', '¡La conexión a internet se ha interrumpido!', 'error');
                } else {
                    Swal.fire('Error', 'Error al cargar tipos de cambio: ' + errorThrown, 'error');
                }
            }
        });
    }

    // Función para actualizar la tabla
    function actualizarTabla() {
        $('#DetalleTabla').empty();

        if ($.fn.dataTable.isDataTable('#basic-1')) {
            $('#basic-1').DataTable().destroy();
        }

        const localData = JSON.parse(localStorage.getItem('tipos_cambio'));
        let html = '';

        $.each(localData, function(key, value) {
            html += `
                <tr role="row" class="odd">
                    <td class="sorting_1">${value.fecha}</td>
                    <td>${parseFloat(value.tasa).toFixed(2)}</td>
                    <td>${value.actualizado_en}</td>
                    <td><button class="btn btn-primary" onclick="Editar('${value.id}')" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-pencil"></i></button></td>
                    <td><button class="btn btn-danger" onclick="Eliminar('${value.id}')"><i class="fa fa-trash"></i></button></td>
                </tr>
            `;
        });

        $('#DetalleTabla').html(html);
        $('#basic-1').DataTable({
            order: [[0, 'desc']] // Ordenar por fecha descendente
        });
    }

    // Función para editar un tipo de cambio
    function Editar(elId) {
        const localData = JSON.parse(localStorage.getItem('tipos_cambio'));

        $.each(localData, function(key, value) {
            if (value.id == elId) {
                $('#id_tipo_cambio').val(value.id);
                $('#fecha').val(value.fecha);
                $('#tasa').val(value.tasa);
                return;
            }
        });

        $('#tasa').focus();
    }

    // Función para eliminar un tipo de cambio
    function Eliminar(elId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../controllers/tipo_cambio_controller.php?id=' + elId,
                    type: 'DELETE',
                    dataType: "json",
                    success: (response) => {
                        if (response.success) {
                            Swal.fire('Eliminado!', 'El tipo de cambio ha sido eliminado.', 'success');
                            ObtenerTiposCambio();
                        } else {
                            Swal.fire('Error', response.error || 'Ocurrió un error al eliminar.', 'error');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if (textStatus === 'timeout') {
                            Swal.fire('Error', '¡La conexión a internet se ha interrumpido!', 'error');
                        } else {
                            Swal.fire('Error', 'Error al eliminar: ' + errorThrown, 'error');
                        }
                    }
                });
            }
        });
    }

    // Función para validar el formato de la tasa
function validarTasa(tasa) {
    // Reemplazar coma por punto para estandarizar
    tasa = tasa.replace(',', '.');
    
    // Validar formato con exactamente 2 decimales y positivo
    const regex = /^\d+([.,]\d{2})?$/;
    const esValido = regex.test(tasa) && parseFloat(tasa) > 0;
    
    return {
        valido: esValido,
        valor: esValido ? parseFloat(tasa).toFixed(2) : null
    };
}

// Evento para validar en tiempo real
$('#tasa').on('input', function() {
    const tasa = $(this).val();
    const validacion = validarTasa(tasa);
    
    if (validacion.valido) {
        $('#tasaError').hide();
        $('#tasaSuccess').show();
        $(this).removeClass('invalid').addClass('valid');
    } else {
        $('#tasaError').show();
        $('#tasaSuccess').hide();
        $(this).removeClass('valid').addClass('invalid');
    }
});
</script>