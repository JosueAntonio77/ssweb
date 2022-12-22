<!-- Modal -->
<div class="modal fade" id="modalFormCompra" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog"> 
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModal">Actualizar Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">|   
                <?php $data;?>
                <form id="formUpdateVenta" name="formUpdateVenta" class="form-horizontal">
                    <input type="hidden" id="idVenta" name="idVenta" value="" required="">
                    <table class="table table-bordered">
                        <tbody>
                    <tr>
                        <td width="210">Folio:</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>Monto total:</td>
                        <td>$2000</td>
                    </tr>
                    <tr>
                        <td>Cliente:</td>
                        <td>Isaac Puc</td>
                    </tr>
                    <tr>
                        <td>Producto:</td>
                        <td>Isaac Puc</td>
                    </tr>
                    <tr>
                        <td>Unidades:</td>
                        <td>Isaac Puc</td>
                    </tr>
                    <tr>
                        <td>Tipo de pago:</td>
                        <td>
                            <select name="listTipopago" id="listTipopago" class="form-control selectpicker" data-live-search="true" required=""></select>
                        </td>
                    </tr>
                    <tr>
                        <td>Fecha:</td>
                        <td>Isaac Puc</td>
                    </tr>
                    <tr>
                        <td>Estado:</td>
                        <td>
                            <select name="listEstado" id="listEstado" class="form-control selectpicker" data-live-search="true" required=""></select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-times-circle"></i>
                Cerrar
            </button>
        </div>
    </form>
</div>
</div>
</div>
</div>