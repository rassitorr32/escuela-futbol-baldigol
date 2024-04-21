<!-- Start Page title and tab -->
<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center ">
            <div class="header-action">
                <h1 class="page-title">Calendar</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Ericsson</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Calendar</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="row clearfix row-deck">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Tipos de Prioridad</h3>
                        <div id="event-list" class="fc event_list">
                            <div class='fc-event bg-primary' data-class="bg-primary">Opcional</div>
                            <div class='fc-event bg-info' data-class="bg-info">Bajo</div>
                            <div class='fc-event bg-yellow' data-class="bg-yellow">Moderado</div>
                            <div class='fc-event bg-warning' data-class="bg-warning">Importante</div>
                            <div class='fc-event bg-danger' data-class="bg-danger">Crucial</div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                /* Aplica el scroll horizontal solo a partir de la clase 'col-md' de Bootstrap */
@media (max-width: 576px) {
    .card-body {
        overflow-x: auto;
    }
}
            </style>
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php

                        use App\Controllers\Calendario;

                        $calendario = new Calendario();
                        echo $calendario->getViewCalendario(1);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>