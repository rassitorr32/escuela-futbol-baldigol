<div class="modal-header btn-primary">
    <h4 class="modal-title"><i class="<?= $title['icon'] ?? '' ?>"></i> <?= $title['page'] ?? '' ?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <button type="button" class="btn btn-primary mb-3" id="cerrarModal"><i class="fa fa-plus"></i></button>
    <div class="row justify-content-center">
        <div class="table-responsive card">
            <?= $table ?>
        </div>
    </div>
</div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
<script>
    document.getElementById('cerrarModal').addEventListener('click', function() {
        console.log('<?= $idDep ?>')
        let obj = "";

        $.ajax({
            type: "POST",
            url: 'pago/addCuota/<?= $idDep ?>',
            data: obj,
            success: function(data) {
                $("#content-lg").fadeOut('slow', function() {
                    // Cuando se complete la solicitud AJAX, reemplazar el contenido actual con el nuevo contenido
                    // y mostrarlo con una transición de desvanecimiento
                    $("#content-lg").html(data).fadeIn('slow');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar el contenido:', error);
            }
        });

    });
</script>