<?= $this->extend("plantilla/panel_base") ?>

<?= $this->section("css") ?>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
<style>
  #miniCalendar {
    max-width: 100%;
    margin: 0 auto;
  }
  .fc {
    font-size: 14px;
  }
</style>
<?= $this->endSection(); ?>

<?= $this->section("contenido") ?>
<div class="container py-4">
    <h2 class="mb-4 text-center">Dashboard - Estilo Naye Nails</h2>

    <div class="row mb-4 justify-content-center">
        <div class="col-md-4">
            <div class="card text-bg-success">
                <div class="card-body text-center">
                    <h5 class="card-title">Total de Citas</h5>
                    <p class="display-3 fw-bold"><?= esc($citas) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center g-4">
        <!-- Servicios más solicitados -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Servicios más solicitados</h5>
                    <div style="position: relative; height: 300px; width: 100%;">
                        <canvas id="serviciosChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen de Citas -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Resumen de Citas</h5>
                    <div style="position: relative; height: 300px; width: 100%;">
                        <canvas id="graficaCitas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mini Calendario -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-10"> <!-- más ancho que col-md-6 -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Calendario</h5>
                    <div id="miniCalendar" style="height: 900px; width: 800%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimos Registros y Notificaciones juntos -->
    <div class="row justify-content-center mt-4 mb-5 g-4">
        <!-- Últimos Registros -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Últimos Registros</h5>
                    <?php if (!empty($ultimos_registros)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($ultimos_registros as $registro): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= esc($registro->nombre_persona) ?> - <?= esc($registro->nombre_servicio) ?>
                                    <span class="badge bg-primary rounded-pill"><?= esc($registro->fecha_cita) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-center text-muted">No hay registros recientes.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Notificaciones -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Notificaciones</h5>
                    <?php if (!empty($notificaciones)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($notificaciones as $n): ?>
                                <li class="list-group-item">
                                    <?= esc($n->mensaje) ?> 🔔
                                    <br>
                                    <small class="text-muted"><?= esc($n->fecha) ?></small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-center text-muted">No hay notificaciones nuevas.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("js") ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Gráfica de servicios más solicitados
    const ctxServicios = document.getElementById('serviciosChart').getContext('2d');
    new Chart(ctxServicios, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Citas por servicio',
                data: <?= json_encode($totales) ?>,
                backgroundColor: 'rgba(239, 38, 242, 0.6)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                title: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

    // Gráfica de resumen de citas
    fetch('<?= base_url('dashboard/estadisticas-citas') ?>')
        .then(response => response.json())
        .then(data => {
            const ctxCitas = document.getElementById('graficaCitas').getContext('2d');
            new Chart(ctxCitas, {
                type: 'doughnut',
                data: {
                    labels: ['Pendientes', 'Confirmadas', 'Canceladas'],
                    datasets: [{
                        data: [data.pendientes, data.confirmadas, data.canceladas],
                        backgroundColor: ['#f1c40f', '#2ecc71', '#e74c3c'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return context.label + ': ' + context.parsed;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error al obtener datos de citas:', error);
        });

    // Mini Calendario
    var calendarEl = document.getElementById('miniCalendar');
    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 800,
            locale: 'es',
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: ''
            },
            events: <?= $eventos ?>,
            eventClick: function(info) {
                alert('Información del evento:\n\n' + info.event.title + '\n' + info.event.start.toLocaleString());
            }
        });
        calendar.render();
    }
});
</script>
<?= $this->endSection(); ?>
