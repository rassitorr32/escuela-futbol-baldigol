<div class="modal-header btn-primary">
    <h4 class="modal-title"><i class="<?= $title['icon'] ?? '' ?>"></i> <?= $title['page'] ?? '' ?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 col-lg-4 text-center align-self-center">
        <img src="<?= base_url() ?>assets/dist/img/estudiantes/<?= (isset($obj['foto'])&&file_exists(FCPATH.'assets/dist/img/estudiantes/'.$obj['foto']))? $obj['foto']:'user_default.png' ?>" alt="" width="240">
        </div>
        <div class="col-md-12 col-lg-8">
            <table class="table">
                <tr>
                    <th>Nombre</th>
                    <td><?= $obj['nombres'] ?></td>
                </tr>
                <tr>
                    <th>Apellido(s)</th>
                    <td><?= $obj['ap_paterno'] .' '. isset($obj['ap_materno'])?$obj['ap_materno']:'' ?></td>
                </tr>
                <tr>
                    <th>C.I.</th>
                    <td><?= $obj['dni'] .' '. $obj['extension'] ?></td>
                </tr>
                <tr>
                    <th>Fecha Nac.</th>
                    <td><?= $obj['fecha_nac'] ?></td>
                </tr>
                <tr>
                    <th>Género</th>
                    <td><?= $obj['sexo'] ?></td>
                </tr>
                <tr>
                    <th>Dirección</th>
                    <td><?= $obj['direccion'] ?></td>
                </tr>
                <tr>
                    <th>Nacionalidad</th>
                    <td><?= $obj['nacionalidad'] ?></td>
                </tr>
                <tr>
                    <th>Tutor</th>
                    <td><?= isset($objTutor['nombres'])?$objTutor['nombres'].' '.$objTutor['ap_paterno'].' '.(isset($objTutor['ap_materno'])?$objTutor['ap_materno']:''):'Ninguno' ?></td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td><span class="badge bg-<?= $obj['valido'] == true ? 'success' : 'danger' ?>"><?= $obj['valido'] == true ? 'Activo' : 'Inactivo' ?></span></td>
                </tr>
            </table>
        </div>
    </div>
</div>


</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>