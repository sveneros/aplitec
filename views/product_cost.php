<link rel="stylesheet" type="text/css" href="../assets/vendor/datatable/jquery.dataTables.min.css">
<link rel="stylesheet" href="../assets/vendor/chartjs/Chart.min.css">

<?php include('../layout/header.php'); ?>

<div class="container-fluid">
  <div class="row m-1">
    <div class="col-12">
      <h4 class="main-title">Costos y Precios de Productos</h4>
      <ul class="app-line-breadcrumbs mb-3">
        <li class="">
          <a href="#" class="f-s-14 f-w-500">
            <span><i class="ph-duotone ph-table f-s-16"></i> Operaciones</span>
          </a>
        </li>
        <li class="active">
          <a href="#" class="f-s-14 f-w-500">Costos de Productos</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5>Factores de Costo por Producto</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table display" id="costFactorsTable">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Costo Base</th>
                  <th>Moneda</th>
                  <th>Tipo Cambio</th>
                  <th>Precio Actual</th>
                  <th>Precio Sugerido</th>
                  <th>Diferencia</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para edición de costos -->
  <div class="modal fade" id="costModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Factores de Costo</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="costForm">
            <input type="hidden" id="cost_product_id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Costo Base (USD)<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="base_cost" step="0.01" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Impuesto Importación (%)<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="import_tax" step="0.01" required>
              </div>
            </div>
            <div class="row g-3 mt-2">
              <div class="col-md-4">
                <label class="form-label">Envío Internacional</label>
                <input type="number" class="form-control" id="shipping_cost" step="0.01">
              </div>
              <div class="col-md-4">
                <label class="form-label">Transporte Local</label>
                <input type="number" class="form-control" id="local_transport" step="0.01">
              </div>
              <div class="col-md-4">
                <label class="form-label">Almacenamiento</label>
                <input type="number" class="form-control" id="storage_cost" step="0.01">
              </div>
            </div>
            <div class="row g-3 mt-2">
              <div class="col-md-4">
                <label class="form-label">Seguro</label>
                <input type="number" class="form-control" id="insurance" step="0.01">
              </div>
              <div class="col-md-4">
                <label class="form-label">Gastos Aduaneros</label>
                <input type="number" class="form-control" id="customs_fees" step="0.01">
              </div>
              <div class="col-md-4">
                <label class="form-label">Tipo de Cambio</label>
                <input type="number" class="form-control" id="currency_exchange_rate" step="0.0001" required>
              </div>
            </div>
            <div class="row g-3 mt-2">
              <div class="col-md-4">
                <label class="form-label">Margen Ganancia (%)<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="profit_margin" step="0.01" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Factor Demanda (1.0 = normal)</label>
                <input type="number" class="form-control" id="market_demand_factor" step="0.01" min="0.5" max="2.0">
              </div>
              <div class="col-md-4">
                <label class="form-label">Factor Competencia (1.0 = normal)</label>
                <input type="number" class="form-control" id="competition_factor" step="0.01" min="0.5" max="2.0">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <div class="alert alert-info">
                  <strong>Precio Sugerido:</strong> <span id="suggested_price_display">$0.00</span>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="saveCostFactors">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('../layout/footer.php'); ?>

<script src="../assets/vendor/datatable/jquery.dataTables.min.js"></script>
<script src="../assets/vendor/chartjs/Chart.min.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>

<script>
$(document).ready(function() {
    // Inicializar tabla de costos
    const costTable = $('#costFactorsTable').DataTable({
        ajax: {
            url: '../controllers/product_price_controller.php?action=pricing_analysis',
            dataSrc: ''
        },
        columns: [
            { data: 'codigo' },
            { data: 'nombre' },
            { 
                data: 'base_cost',
                render: function(data, type, row) {
                    return '$' + parseFloat(data).toFixed(2) + ' ' + row.currency_code;
                }
            },
            { data: 'currency_code' },
            { data: 'currency_exchange_rate' },
            { 
                data: 'precio_actual',
                render: function(data) {
                    return '$' + parseFloat(data).toFixed(2);
                }
            },
            { 
                data: 'precio_sugerido',
                render: function(data) {
                    return '$' + parseFloat(data).toFixed(2);
                }
            },
            { 
                data: 'porcentaje_diferencia',
                render: function(data, type, row) {
                    const diff = parseFloat(data);
                    const diffClass = diff > 0 ? 'text-success' : 'text-danger';
                    const icon = diff > 0 ? '↑' : '↓';
                    return `<span class="${diffClass}">${icon} ${Math.abs(diff).toFixed(2)}%</span>`;
                }
            },
            {
                data: 'id',
                render: function(data) {
                    return `<button class="btn btn-sm btn-primary edit-cost" data-id="${data}">
                                <i class="fa fa-edit"></i> Editar
                            </button>`;
                }
            }
        ]
    });

    // Manejar clic en botón editar
    $('#costFactorsTable').on('click', '.edit-cost', function() {
        const productId = $(this).data('id');
        loadProductCostData(productId);
    });

    // Cargar datos de costos para edición
    function loadProductCostData(productId) {
        $.get(`../controllers/product_price_controller.php?action=pricing_data&id=${productId}`, function(data) {
            $('#cost_product_id').val(productId);
            $('#base_cost').val(data.base_cost || '0');
            $('#import_tax').val(data.import_tax || '0');
            $('#shipping_cost').val(data.shipping_cost || '0');
            $('#local_transport').val(data.local_transport || '0');
            $('#storage_cost').val(data.storage_cost || '0');
            $('#insurance').val(data.insurance || '0');
            $('#customs_fees').val(data.customs_fees || '0');
            $('#currency_exchange_rate').val(data.currency_exchange_rate || '6.96');
            $('#profit_margin').val(data.profit_margin || '25');
            $('#market_demand_factor').val(data.market_demand_factor || '1.0');
            $('#competition_factor').val(data.competition_factor || '1.0');
            
            // Calcular y mostrar precio sugerido
            calculateAndDisplaySuggestedPrice();
            
            $('#costModal').modal('show');
        });
    }

    // Calcular precio sugerido en tiempo real
    $('.modal-body input').on('change keyup', function() {
        calculateAndDisplaySuggestedPrice();
    });

    function calculateAndDisplaySuggestedPrice() {
        const productId = $('#cost_product_id').val();
        if (!productId) return;

        const costData = {
            base_cost: $('#base_cost').val(),
            import_tax: $('#import_tax').val(),
            shipping_cost: $('#shipping_cost').val(),
            local_transport: $('#local_transport').val(),
            storage_cost: $('#storage_cost').val(),
            insurance: $('#insurance').val(),
            customs_fees: $('#customs_fees').val(),
            currency_exchange_rate: $('#currency_exchange_rate').val(),
            profit_margin: $('#profit_margin').val(),
            market_demand_factor: $('#market_demand_factor').val(),
            competition_factor: $('#competition_factor').val()
        };

        $.get(`../controllers/product_price_controller.php?action=suggested_price&id=${productId}`, function(response) {
            $('#suggested_price_display').text('$' + parseFloat(response.suggested_price).toFixed(2));
        });
    }

    // Guardar factores de costo
    $('#saveCostFactors').click(function() {
        const productId = $('#cost_product_id').val();
        const costData = {
            base_cost: $('#base_cost').val(),
            import_tax: $('#import_tax').val(),
            shipping_cost: $('#shipping_cost').val(),
            local_transport: $('#local_transport').val(),
            storage_cost: $('#storage_cost').val(),
            insurance: $('#insurance').val(),
            customs_fees: $('#customs_fees').val(),
            currency_exchange_rate: $('#currency_exchange_rate').val(),
            currency_code: 'USD',
            profit_margin: $('#profit_margin').val(),
            market_demand_factor: $('#market_demand_factor').val(),
            competition_factor: $('#competition_factor').val()
        };

        $.ajax({
            url: '../controllers/product_price_controller.php?action=update_cost_factors',
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify({
                product_id: productId,
                ...costData
            }),
            success: function(response) {
                if (response.success) {
                    $('#costModal').modal('hide');
                    costTable.ajax.reload();
                    Swal.fire('Éxito', 'Factores de costo actualizados correctamente', 'success');
                } else {
                    Swal.fire('Error', response.error || 'Error al guardar los datos', 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error', 'Error en la comunicación con el servidor', 'error');
            }
        });
    });
});
</script>