
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="page-header-title">
        <h4 class="m-b-10"><?php echo e(__('Report')); ?></h4>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Report')); ?></li>
    <li class="breadcrumb-item"><?php echo e(__('Custom Report')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Report')): ?>
        <div class="action-btn  ms-2">
            <a href="#" data-size="md" data-url="<?php echo e(route('report.create', ['report', 0])); ?>" data-ajax-popup="true"
                data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Report')); ?>" title="<?php echo e(__('Create')); ?>"
                class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i>
            </a>
            <a href="<?php echo e(route('report.export')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>"
                class="btn btn-sm btn-primary">
                <i class="ti ti-file-export"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <div class="card body table-border-style"></div>
                        <table id="datatable" class="table datatable align-items-center" id="pc-dt-export">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Entity Type')); ?>

                                    </th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Group By')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Chart Type')); ?>

                                    </th>
                                    <?php if(Gate::check('Show Report') || Gate::check('Edit Report') || Gate::check('Delete Report')): ?>
                                        <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('report.show', $report->id)); ?>"
                                                class="action-item text-primary">
                                                <?php echo e($report->name); ?>

                                            </a>
                                        </td>
                                        <td class="budget">
                                            <span><?php echo e(__(\App\Models\Report::$entity_type[$report->entity_type])); ?></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary p-2 px-3 rounded" style="width: 85px;">
                                                <?php if($report->entity_type == 'users'): ?>
                                                    <?php echo e(__(\App\Models\Report::$users[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'quotes'): ?>
                                                    <?php echo e(__(\App\Models\Report::$quotes[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'accounts'): ?>
                                                    <?php echo e(__(\App\Models\Report::$accounts[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'contacts'): ?>
                                                    <?php echo e(__(\App\Models\Report::$contacts[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'leads'): ?>
                                                    <?php echo e(__(\App\Models\Report::$leads[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'opportunities'): ?>
                                                    <?php echo e(__(\App\Models\Report::$opportunities[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'invoices'): ?>
                                                    <?php echo e(__(\App\Models\Report::$invoices[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'cases'): ?>
                                                    <?php echo e(__(\App\Models\Report::$cases[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'products'): ?>
                                                    <?php echo e(__(\App\Models\Report::$products[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'tasks'): ?>
                                                    <?php echo e(__(\App\Models\Report::$tasks[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'calls'): ?>
                                                    <?php echo e(__(\App\Models\Report::$calls[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'campaigns'): ?>
                                                    <?php echo e(__(\App\Models\Report::$campaigns[$report->group_by])); ?>

                                                <?php elseif($report->entity_type == 'sales_orders'): ?>
                                                    <?php echo e(__(\App\Models\Report::$sales_orders[$report->group_by])); ?>

                                                <?php else: ?>
                                                    <?php echo e(__(\App\Models\Report::$users[$report->group_by])); ?>

                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td class="budget">
                                            <?php echo e(__(\App\Models\Report::$chart_type[$report->chart_type])); ?>

                                        </td>
                                        <?php if(Gate::check('Show Report') || Gate::check('Edit Report') || Gate::check('Delete Report')): ?>
                                            <td>
                                                <div class="d-flex float-end">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Report')): ?>
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="<?php echo e(route('report.show', $report->id)); ?>"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                                data-title="<?php echo e(__('Report Details')); ?>">
                                                                <i class="ti ti-eye"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Report')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="<?php echo e(route('report.edit', $report->id)); ?>"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"
                                                                data-title="<?php echo e(__('Report Edit')); ?>"><i
                                                                    class="ti ti-edit"></i></a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Report')): ?>
                                                        <div class="action-btn bg-danger ms-2 float-end">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['report.destroy', $report->id]]); ?>

                                                            <a href="#!"
                                                                class="mx-3 btn btn-sm align-items-center text-white show_confirm"
                                                                data-bs-toggle="tooltip" title='Delete'>
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        <?php endif; ?>
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
    <script>
        $(document).on('change', 'select[name=entity_type]', function() {
            var parent = $(this).val();
            getparent(parent);
        });

        function getparent(bid) {
            console.log(bid);
            $.ajax({
                url: '<?php echo e(route('report.getparent')); ?>',
                type: 'POST',
                data: {
                    "parent": bid,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    console.log(data);
                    $('#group_by').empty();
                    

                    $.each(data, function(key, value) {
                        $('#group_by').append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (data == '') {
                        $('#group_by').empty();
                    }
                }
            });
        }
    </script>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/report/index.blade.php ENDPATH**/ ?>