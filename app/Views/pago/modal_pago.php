<div class="modal-header bg-info">
    <h4 class="modal-title"><i class="<?= $title['icon'] ?? '' ?>"></i> <?= $title['page'] ?? '' ?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <button type="button" class="btn btn-success mb-3" id="cerrarModal"><i class="fa fa-plus"></i></button>
    <div class="row justify-content-center">
        <div class="row" style="max-height: 300px; overflow-y: auto;">
            <?= $table ?>
        </div>
    </div>
</div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
<script>
    // Esperar a que se cargue el DOM
    // document.addEventListener("DOMContentLoaded", function() {
    console.log('Script ejecutándose...');
    var table = document.getElementById('tablePagoModal');
    console.log('Tabla encontrada:', table);

    // Obtener la tabla por su ID
    var table = document.getElementById('tablePagoModal');

    // Verificar si la tabla existe
    if (table) {
        // Obtener todas las celdas de la tabla
        var cells = table.querySelectorAll('td');

        // Aplicar el estilo white-space: normal a cada celda
        cells.forEach(function(cell) {
            cell.style.whiteSpace = 'normal';
        });
    }
    // });
    document.getElementById('cerrarModal').addEventListener('click', function() {
        console.log('<?=$idDep?>')
        let obj = "";

        $.ajax({
            type: "POST",
            url: 'pago/addCuota/<?=$idDep?>',
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