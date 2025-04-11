<!-- header -->
<?php
include('../layout/header.php');
?>
            <div class="container-fluid ">
                <div class="row m-1">
                    <div class="col-6">
                    <a href="quotes.php" class="btn m-1">
                            <i class="ti ti-door"></i> Volver
                        </a>
                    </div>

                    <div class="col-6">
                        <button type="button" class="btn btn-lg" onclick="window.print()">
                            <i class="ti ti-printer"></i> Imprimir
                        </button>
                        <button type="button" class="btn btn-lg ms-2" id="btnConvertToDollars">
                            <i class="ti ti-currency-dollar"></i> <span id="btnConvertText">Mostrar en Dólares</span>
                        </button>
                    </div>

                </div>
               
            </div>

            <!-- Invoice start -->
            <div class="container invoice-container">
                <div class="row">
                    <div id="quoteDetails"></div>
                </div>
            </div>
            <!-- Invoice end -->
       
    <!-- footer -->
    <?php
    include('../layout/footer.php');
    ?>

<script>
// Variables globales
var monedaActual = 'BS';
var tipoCambio = 1; // Valor inicial desde PHP

$(document).ready(function() {
    obtenerTipoCambioActual().then(() => {
        mostrarQuote();
    });
});

function obtenerParametroId() {
    var params = new URLSearchParams(window.location.search);
    return params.get('id');
}

function formatearMoneda(valor, moneda) {
    return moneda === 'USD' ? 
        `$${parseFloat(valor).toFixed(2)}` : 
        `Bs. ${parseFloat(valor).toFixed(2)}`;
}

function convertirMonto(monto, aDolares) {
    return aDolares ? 
        (parseFloat(monto) / tipoCambio).toFixed(2) : 
        (parseFloat(monto) * tipoCambio).toFixed(2);
}

// Función para obtener el tipo de cambio actual desde el controller
function obtenerTipoCambioActual() {
    return $.ajax({
        url: '../controllers/tipo_cambio_controller.php?current=true',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response && response.tasa) {
                tipoCambio = parseFloat(response.tasa);
                console.log('Tipo de cambio actualizado:', tipoCambio);
            } else {
                console.warn('No se pudo obtener el tipo de cambio actual, usando valor por defecto');
            }
        },
        error: function() {
            console.error('Error al obtener tipo de cambio, usando valor por defecto');
        }
    });
}

// Modificar la función mostrarQuote para incluir el tipo de cambio
function mostrarQuote() {
    var id = obtenerParametroId();
    if (!id) return;

    var localData = JSON.parse(localStorage.getItem('sml2025_quotes')) || [];
    var quote = localData.find(q => q.numero == id);
    
    if (quote) {
        // Actualizar el tipo de cambio en la UI
        $('#tipoCambioActual').text(tipoCambio.toFixed(2));
        renderizarQuote(quote);
    } else {
        $('#quoteDetails').html('<p>No se encontró la cotización.</p>');
    }
}


function renderizarQuote(quote) {
    // Calcular totales
    var totalBs = quote.detalle.reduce((sum, item) => sum + parseFloat(item.precio_total), 0);
    var totalUsd = (totalBs / tipoCambio).toFixed(2);
    
    var html = `
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>
                                        <table class="table table-lg w-100 invoice-header">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="mb-3">
                                                            <img src="../assets/images/logo/1.png" class="w-200" alt="">
                                                            <address>
                                                                Av. 20 de Octubre Nro 2332, Edif. Guadalquivir<BR>
                                                                Tel/Fax: 2417461 <br>
                                                                Email: info@aplitec.com<br>
                                                                La Paz - Bolivia
                                                            </address>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <h3 class="text-primary">COTIZACIÓN</h3>
                                                            <p>Nro. <strong>${quote.numero}</strong></p>
                                                            <p>Para: <strong>${quote.nombre} ${quote.apellido1} ${quote.apellido2}</strong></p>
                                                            <p>Fecha:<strong> ${quote.fecha}</strong></p>
                                                            <p>Tipo de cambio:<strong> Bs. <span id="tipoCambioActual">${tipoCambio.toFixed(2)}</span></strong></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="mb-3">
                                                            <h6 class="f-w-600">Cliente</h6>
                                                            <b>Nombre: </b>${quote.nombre} ${quote.apellido1} ${quote.apellido2}
                                                            <address>
                                                                <b>Dirección: </b>${quote.direccion}<br>
                                                                <b>Teléfono: </b>${quote.telefono} <br>
                                                                <b>Celular: </b>${quote.celular}
                                                            </address>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table class="table table-lg table-bottom-border invoice-table w-100" id="tablaProductos">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Descripción</th>
                                                    <th>Cantidad</th>
                                                    <th>P.U. (<span id="monedaHeader">Bs.</span>)</th>
                                                    <th>Total (<span id="monedaHeaderTotal">Bs.</span>)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
    `;
    
    quote.detalle.forEach((detalle, index) => {
        html += `
            <tr>
                <td>${index + 1}</td>
                <td class="f-s-14"><p class="text-elips mb-0"><b>${detalle.producto}</b><br>${detalle.descripcion}</p></td>
                <td>${detalle.cantidad}</td>
                <td class="precio-unitario">${formatearMoneda(detalle.precio_unitario, 'BS')}</td>
                <td class="precio-total">${formatearMoneda(detalle.precio_total, 'BS')}</td>
            </tr>
        `;
    });
    html += `<tr>
                                    <td class="border-0 pb-0" colspan="4">TOTAL</th>
                                    <td class="border-0 pb-0 total-cotizacion">${formatearMoneda(totalBs, 'BS')}</th>
                                </tr>`;
    html += `
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                               
                            </table>
                            
                            <table class="table mb-0">
                                <tbody>
                                <tr>
                                    <td><b>Garantía:</b></td>
                                    <td>1 año por defectos de fábrica</td>
                                </tr>
                                <tr>
                                    <td><b>Validez de la oferta:</b></td>
                                    <td>30 días Calendario</td>
                                </tr>
                                <tr>
                                    <td><b>Forma de pago:</b></td>
                                    <td>A convenir</td>
                                </tr>
                                <tr>
                                    <td><b>Costo de envío</b></td>
                                    <td class="envio">${formatearMoneda(50, 'BS')}</td>
                                </tr>
                                
                                <tr>
                                    <th class="border-0 pb-0">Tiempo de entrega</th>
                                    <th class="border-0 pb-0">Aproximadamente 40 días calendario; computables desde el siguiente día hábil de recibida su Orden de Compra, firma de contrato o Pago por adelantado</th>
                                </tr>
                                </tbody>
                            </table>
                                                
                        </div>
                    </div>
                </div>
                <div class="invoice-footer float-end mb-3">
                    
                </div>
            </div>
        </div>
    `;
    
    $('#quoteDetails').html(html);
    
    // Evento para el botón de conversión
    $('#btnConvertToDollars').off('click').on('click', function() {
        if (monedaActual === 'BS') {
            convertirADolares();
            $(this).html('<i class="ti ti-currency-dollar"></i> Mostrar en Bolivianos');
            monedaActual = 'USD';
        } else {
            convertirABolivianos();
            $(this).html('<i class="ti ti-currency-dollar"></i> Mostrar en Dólares');
            monedaActual = 'BS';
        }
    });
}

function convertirADolares() {
    $('.precio-unitario').each(function() {
        var valorBs = $(this).text().replace('Bs. ', '').trim();
        $(this).text(formatearMoneda(convertirMonto(valorBs, true), 'USD'));
    });
    
    $('.precio-total').each(function() {
        var valorBs = $(this).text().replace('Bs. ', '').trim();
        $(this).text(formatearMoneda(convertirMonto(valorBs, true), 'USD'));
    });
    
    $('.envio').each(function() {
        var valorBs = $(this).text().replace('Bs. ', '').trim();
        $(this).text(formatearMoneda(convertirMonto(valorBs, true), 'USD'));
    });
    
    $('.total-cotizacion').each(function() {
        var valorBs = $(this).text().replace('Bs. ', '').trim();
        $(this).text(formatearMoneda(convertirMonto(valorBs, true), 'USD'));
    });
    
    $('#monedaHeader, #monedaHeaderTotal').text('$');
}

function convertirABolivianos() {
    $('.precio-unitario').each(function() {
        var valorUsd = $(this).text().replace('$', '').trim();
        $(this).text(formatearMoneda(convertirMonto(valorUsd, false), 'BS'));
    });
    
    $('.precio-total').each(function() {
        var valorUsd = $(this).text().replace('$', '').trim();
        $(this).text(formatearMoneda(convertirMonto(valorUsd, false), 'BS'));
    });
    
    $('.envio').each(function() {
        var valorUsd = $(this).text().replace('$', '').trim();
        $(this).text(formatearMoneda(convertirMonto(valorUsd, false), 'BS'));
    });
    
    $('.total-cotizacion').each(function() {
        var valorUsd = $(this).text().replace('$', '').trim();
        $(this).text(formatearMoneda(convertirMonto(valorUsd, false), 'BS'));
    });
    
    $('#monedaHeader, #monedaHeaderTotal').text('Bs.');
}
</script>