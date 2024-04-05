<div class="modal-header bg-info">
    <h4 class="modal-title"><i class="<?= $title['icon'] ?? '' ?>"></i> <?= $title['page'] ?? '' ?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 col-lg-4 text-center align-self-center">
        <img src="<?= base_url() ?>assets/dist/img/personal/<?= (isset($objPersona['foto'])&&file_exists(FCPATH.'assets/dist/img/personal/'.$objPersona['foto']))? $objPersona['foto']:'user_default.png' ?>" alt="" width="240">
        </div>
        <div class="col-md-12 col-lg-8">
            <table class="table">
                <tr>
                    <th>Nombre</th>
                    <td><?= $objPersona['nombres'] ?></td>
                </tr>
                <tr>
                    <th>Apellido(s)</th>
                    <td><?= $objPersona['ap_paterno'].' '.$objPersona['ap_materno'] ?></td>
                </tr>
                <tr>
                    <th>C.I.</th>
                    <td><?= $objPersona['dni'] ?></td>
                </tr>
                <tr>
                    <th>Fecha Nac.</th>
                    <td><?= $objPersona['fecha_nac'] ?></td>
                </tr>
                <tr>
                    <th>Telefono</th>
                    <td><?= 43253232 ?></td>
                </tr>
                <tr>
                    <th>Usuario</th>
                    <td><?= $obj['usuario'] ?></td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td><span class="badge bg-<?= $obj['estado'] == '1' ? 'success' : 'danger' ?>"><?= $obj['estado'] == '1' ? 'Activo' : 'Inactivo' ?></span></td>
                </tr>
            </table>
        </div>
    </div>
</div>


</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>