
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Invoice Analytic')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Report')); ?></li>
    <li class="breadcrumb-item"><?php echo e(__('Invoice Analytic')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="cardcard-body">
                    <div class="collapse show float-end" id="collapseExample" style="">
                        <?php echo e(Form::open(array('route' => array('report.invoiceanalytic'),'method'=>'get'))); ?>

                        <div class="row filter-css">
                            <div class="col-auto">
                                <?php echo e(Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:date('Y-01'),array('class'=>'form-control'))); ?>

                            </div>
                            <div class="col-auto">
                                <?php echo e(Form::month('end_month',isset($_GET['end_month'])?$_GET['end_month']:date('Y-12'),array('class'=>'form-control'))); ?>

                            </div>

                            <div class="col-auto">
                                <?php echo e(Form::select('account',$account,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control '))); ?>

                            </div>
                            <div class="col-auto" style="margin-left: -29px;">
                                <?php echo e(Form::select('status', [''=>'Select Status']+$status,isset($_GET['status'])?$_GET['status']:'', array('class' => 'form-control ','style'=>'margin-left: 29px;'))); ?>

                            </div>
                            <div class="action-btn bg-primary ms-5">
                            <div class="col-auto">
                                <button type="submit" class="mx-3 btn btn-sm align-items-center text-white" data-bs-toggle="tooltip" data-title="<?php echo e(__('Apply')); ?>" title="<?php echo e(__('Apply')); ?>"><i class="ti ti-search"></i></button>
                            </div>
                            </div>
                            <div class="action-btn bg-danger ms-2">
                            <div class="col-auto">
                                <a href="<?php echo e(route('report.invoiceanalytic')); ?>" data-bs-toggle="tooltip" data-title="<?php echo e(__('Reset')); ?>" title="<?php echo e(__('Reset')); ?>" class="mx-3 btn btn-sm align-items-center text-white"><i class="ti ti-trash-off"></i></a>
                            </div>
                            </div>
                            <div class="action-btn bg-primary ms-2">
                            <div class="col-auto">
                                <a href="#" onclick="saveAsPDF();" class="mx-3 btn btn-sm align-items-center text-white" data-bs-toggle="tooltip" data-title="<?php echo e(__('Download')); ?>" title="<?php echo e(__('Download')); ?>" id="download-buttons">
                                    <i class="ti ti-download"></i>
                                </a>
                            </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div >
        <div class="row">
            <div class="col-lg-12" >
                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <?php if(isset($report['startDateRange']) || isset($report['endDateRange'])): ?>
                                <input type="hidden" value="<?php echo e(__('Invoice Report of').' '.$report['startDateRange'].' to '.$report['endDateRange']); ?>" id="filesname">
                            <?php else: ?>
                                <input type="hidden" value="<?php echo e(__('Invoice Report')); ?>" id="filesname">
                            <?php endif; ?>

                            <div class="col">
                                <?php echo e(__('Report')); ?> : <h6><?php echo e(__('Invoice Summary')); ?></h6>
                            </div>
                            <div class="col">
                                <?php echo e(__('Duration')); ?> : <h6><?php echo e($report['startDateRange'].' to '.$report['endDateRange']); ?></h6>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>


        <div class="col-lg-12" id="printableArea">
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
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Status')); ?></th>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Created At')); ?></th>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Amount')); ?></th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($result['name']); ?>

                                    </td>
                                    <td>
                                        <?php echo e(!empty($result['account_name'])?$result['account_name']:'-'); ?>

                                    </td>
                                    <td>
                                        <?php if($result->status == 0): ?>
                                            <span
                                                class="badge bg-secondary p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$status[$result->status])); ?></span>
                                        <?php elseif($result->status == 1): ?>
                                            <span
                                                class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$status[$result->status])); ?></span>
                                        <?php elseif($result->status == 2): ?>
                                            <span
                                                class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$status[$result->status])); ?></span>
                                        <?php elseif($result->status == 3): ?>
                                            <span
                                                class="badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$status[$result->status])); ?></span>
                                        <?php elseif($result->status == 4): ?>
                                            <span
                                                class="badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$status[$result->status])); ?></span>
                                        <?php endif; ?>

                                        
                                    </td>
                                    <td class="">
                                        <?php echo e(\Auth::user()->dateFormat($result['created_at'])); ?>

                                    </td>
                                    <td class="">
                                        <?php echo e(\Auth::user()->priceFormat($result['amount'])); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
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


    <script src="../assets/js/plugins/simple-datatables.js"></script>
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
        $(document).ready(function () {
            var filename = $('#filename').val();
            setTimeout(function () {
                $('#export').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            title: filename
                        }, {
                            extend: 'csvHtml5',
                            title: filename
                        }, {
                            extend: 'pdfHtml5',
                            title: filename
                        },
                    ],
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
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>

    <script>
        var WorkedHoursChart = (function () {
            var $chart = $('#report-chart');

            (function () {
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
                name: 'Invoice',
                data: <?php echo json_encode($invoiceTotal); ?>,
            }],
            xaxis: {
                categories: <?php echo json_encode($monthList); ?>,
                title: {
                            text: '<?php echo e(__('Invoice')); ?>'
                        },
            },
            colors: ['#FF3A6E', '#FF3A6E'],

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
                $chart.each(function () {
                    init($(this));
                });
            }
        })();
    </script>


<script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/report/invoiceanalytic.blade.php ENDPATH**/ ?>