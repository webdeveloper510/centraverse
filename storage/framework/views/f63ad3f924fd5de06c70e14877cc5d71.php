
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Lead Analytic')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Report')); ?></li>
    <li class="breadcrumb-item"><?php echo e(__('Lead Analytic')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="cardcard-body">
                    <div class="collapse show float-end" id="collapseExample" style="">
                        <?php echo e(Form::open(['route' => ['report.leadsanalytic'], 'method' => 'get'])); ?>

                        <div class="row filter-css">
                            <div class="col-auto">
                                <?php echo e(Form::month('start_month', isset($_GET['start_month']) ? $_GET['start_month'] : date('Y-01'), ['class' => 'form-control'])); ?>

                            </div>
                            <div class="col-auto">
                                <?php echo e(Form::month('end_month', isset($_GET['end_month']) ? $_GET['end_month'] : date('Y-12'), ['class' => 'form-control'])); ?>

                            </div>

                            <div class="col-auto">
                                <?php echo e(Form::select('leadsource', $leadsource, isset($_GET['leadsource']) ? $_GET['leadsource'] : '', ['class' => 'form-control '])); ?>

                            </div>
                            <div class="col-auto" style="margin-left: -29px;">
                                <?php echo e(Form::select('status', ['' => 'Select Status'] + $status, isset($_GET['status']) ? $_GET['status'] : '', ['class' => 'form-control', 'style' => 'margin-left: 29px;'])); ?>

                            </div>
                            <div class="action-btn bg-primary ms-5">
                                <div class="col-auto ">
                                    <button type="submit" class="mx-3 btn btn-sm align-items-center text-white"
                                        data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>"
                                        data-title="<?php echo e(__('Apply')); ?>"><i class="ti ti-search"></i></button>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                            <div class="action-btn bg-danger ms-2">
                                <div class="col-auto">
                                    <a href="<?php echo e(route('report.leadsanalytic')); ?>" data-bs-toggle="tooltip"
                                        title="<?php echo e(__('Reset')); ?>"data-title="<?php echo e(__('Reset')); ?>"
                                        class="mx-3 btn btn-sm align-items-center text-white"><i
                                            class="ti ti-trash-off"></i></a>
                                </div>
                            </div>
                            <div class="action-btn bg-primary ms-2">
                                <div class="col-auto">
                                    <a href="#" onclick="saveAsPDF();"
                                        class="mx-3 btn btn-sm align-items-center text-white" data-bs-toggle="tooltip"
                                        data-title="<?php echo e(__('Download')); ?>"title="<?php echo e(__('Download')); ?>"
                                        id="download-buttons">
                                        <i class="ti ti-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="printableArea">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <?php if(isset($report['startDateRange']) || isset($report['endDateRange'])): ?>
                                <input type="hidden"
                                    value="<?php echo e(__('Lead Report of') . ' ' . $report['startDateRange'] . ' to ' . $report['endDateRange']); ?>"
                                    id="filesname">
                            <?php else: ?>
                                <input type="hidden" value="<?php echo e(__('Lead Report')); ?>" id="filesname">
                            <?php endif; ?>

                            <div class="col">
                                <?php echo e(__('Report')); ?> : <h6><?php echo e(__('Lead Summary')); ?></h6>
                            </div>
                            <div class="col">
                                <?php echo e(__('Duration')); ?> : <h6><?php echo e($report['startDateRange'] . ' to ' . $report['endDateRange']); ?>

                                </h6>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="report-chart"></div>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div>
                        <button class="btn btn-light-primary btn-sm csv">Export CSV</button>
                        
                        <button class="btn btn-light-primary btn-sm txt">Export TXT</button>
                        
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table" id="pc-dt-export">
                            <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Account Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Campaign Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Email')); ?></th>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Phone')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php echo e($result['name']); ?>

                                        </td>
                                        <td>
                                            <?php echo e(!empty($result['account_name']) ? $result['account_name'] : '-'); ?>

                                        </td>
                                        <td>
                                            <?php echo e(!empty($result['campaign_name']) ? $result['campaign_name'] : '-'); ?>

                                        </td>
                                        <td class="">
                                            <?php echo e($result['email']); ?>

                                        </td>
                                        <td class="">
                                            <?php echo e($result['phone']); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('script-page'); ?>
        <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/dataTables.buttons.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/pdfmake.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/buttons.html5.min.js')); ?>"></script>

        <script src="<?php echo e(asset('assets/js/plugins/simple-datatables.js')); ?>"></script>
        <script>
            const table = new simpleDatatables.DataTable("#pc-dt-export");
            document.querySelector("button.csv").addEventListener("click", () => {
                table.export({
                    type: "csv",
                    download: true,
                    lineDelimiter: "\n\n",
                    columnDelimiter: ";"
                })
            })
            document.querySelector("button.txt").addEventListener("click", () => {
                table.export({
                    type: "txt",
                    download: true,
                })
            })
            document.querySelector("button.sql").addEventListener("click", () => {
                table.export({
                    type: "sql",
                    download: true,
                    tableName: "export_table"
                })
            })

            document.querySelector("button.json").addEventListener("click", () => {
                table.export({
                    type: "json",
                    download: true,
                    escapeHTML: true,
                    space: 3
                })
            })
            document.querySelector("button.excel").addEventListener("click", () => {
                table.export({
                    type: "excel",
                    download: true,

                })
            })
            document.querySelector("button.pdf").addEventListener("click", () => {
                table.export({
                    type: "pdf",
                    download: true,


                })
            })
        </script>


        <script>
            $(document).ready(function() {
                var filename = $('#filename').val();
                setTimeout(function() {
                    $('#reportTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                            extend: 'excelHtml5',
                            title: filename
                        }, {
                            extend: 'csvHtml5',
                            title: filename
                        }, {
                            extend: 'pdfHtml5',
                            title: filename
                        }, ],

                    });
                }, 500);

            });
        </script>

        <script>
            var filename = $('#filesname').val();

            function saveAsPDF() {
                var element = document.getElementById('printableArea');
                var opt = {
                    margin: 0.3,
                    filename: filename,
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    html2canvas: {
                        scale: 4,
                        dpi: 72,
                        letterRendering: true
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'A2'
                    }
                };
                html2pdf().set(opt).from(element).save();
            }
        </script>


        <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>

        <script>
            var WorkedHoursChart = (function() {
                var $chart = $('#report-chart');

                (function() {
                    var options = {
                        chart: {
                            height: 180,
                            type: 'area',
                            toolbar: {
                                show: false,
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            width: 2,
                            curve: 'smooth'
                        },
                        series: [{
                            name: 'Lead',
                            data: <?php echo json_encode($data); ?>,
                        }],
                        xaxis: {
                            categories: <?php echo json_encode($labels); ?>,
                            title: {
                                text: '<?php echo e(__('Lead')); ?>'
                            },
                        },
                        colors: ['#3ec9d6', '#FF3A6E'],

                        grid: {
                            strokeDashArray: 4,
                        },
                        legend: {
                            show: true,
                            position: 'top',
                            horizontalAlign: 'right',
                        },

                    };
                    var chart = new ApexCharts(document.querySelector("#report-chart"), options);
                    chart.render();
                })();



                // Events
                if ($chart.length) {
                    $chart.each(function() {
                        init($(this));
                    });
                }
            })();
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/report/leadsanalytic.blade.php ENDPATH**/ ?>