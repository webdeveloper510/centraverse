

<?php $__env->startSection('page-title'); ?>
    <?php echo e('Contract'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo e('Contract'); ?> <?php echo e('(' . $contract->name . ')'); ?>

<?php $__env->stopSection(); ?>
<?php
    $plansettings = App\Models\Utility::plansettings();
?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('contract.index')); ?>"><?php echo e(__('Contract')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e('Show'); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">

    

    <style>
        .nav-tabs .nav-link-tabs.active {
            background: none;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>

    

    <script>
        Dropzone.autoDiscover = true;
        myDropzone = new Dropzone("#my-dropzone", {

            url: "<?php echo e(route('contracts.file.upload', [$contract->id])); ?>",
            success: function(file, response) {
                location.reload();

                if (response.is_success) {
                    if (response.status == 1) {
                        show_toastr('success', response.success_msg, 'success');
                    } else {
                        dropzoneBtn(file, response);
                        show_toastr('<?php echo e(__('Success')); ?>', 'Attachment Create Successfully!', 'success');
                    }
                } else {
                    myDropzone.removeFile(file);
                    show_toastr('<?php echo e(__('Error')); ?>', 'File type must be match with Storage setting.',
                        'error');
                }
            },
            error: function(file, response) {
                myDropzone.removeFile(file);
                if (response.error) {
                    show_toastr('<?php echo e(__('Error')); ?>', response.error, 'error');
                } else {
                    show_toastr('<?php echo e(__('Error')); ?>', response.error, 'error');
                }
            }
        });
        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("contract_id", <?php echo e($contract->id); ?>);
        });

        function dropzoneBtn(file, response) {
            var download = document.createElement('a');
            download.setAttribute('href', response.download);
            download.setAttribute('class', "action-btn btn-primary mx-1 mt-1 btn btn-sm d-inline-flex align-items-center");
            download.setAttribute('data-toggle', "tooltip");
            download.setAttribute('data-original-title', "<?php echo e(__('Download')); ?>");
            download.innerHTML = "<i class='fas fa-download'></i>";

            var del = document.createElement('a');
            del.setAttribute('href', response.delete);
            del.setAttribute('class', "action-btn btn-danger mx-1 mt-1 btn btn-sm d-inline-flex align-items-center");
            del.setAttribute('data-toggle', "tooltip");
            del.setAttribute('data-original-title', "<?php echo e(__('Delete')); ?>");
            del.innerHTML = "<i class='ti ti-trash'></i>";

            del.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (confirm("Are you sure ?")) {
                    var btn = $(this);
                    $.ajax({
                        url: btn.attr('href'),
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.is_success) {
                                btn.closest('.dz-image-preview').remove();
                            } else {
                                show_toastr('<?php echo e(__('Error')); ?>', response.error, 'error');
                            }
                        },
                        error: function(response) {
                            response = response.responseJSON;
                            if (response.is_success) {
                                show_toastr('<?php echo e(__('Error')); ?>', response.error, 'error');
                            } else {
                                show_toastr('<?php echo e(__('Error')); ?>', response.error, 'error');
                            }
                        }
                    })
                }
            });

            var html = document.createElement('div');
            html.setAttribute('class', "text-center mt-10");
            html.appendChild(download);
            html.appendChild(del);

            file.previewTemplate.appendChild(html);
        }

        <?php $__currentLoopData = $contract->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>


    <script>
        // $('.summernote').on('summernote.blur', function () {
        //     alert();
        //     $.ajax({
        //         url: "<?php echo e(route('contracts.note.store', $contract->id)); ?>",
        //         data: {_token: $('meta[name="csrf-token"]').attr('content'), notes: $(this).val()},
        //         type: 'POST',
        //         success: function (response) {
        //             if (response.is_success) {
        //                 // show_toastr('Success', response.success,'success');
        //             } else {
        //                 show_toastr('Error', response.error, 'error');
        //             }
        //         },
        //         error: function (response) {
        //             response = response.responseJSON;
        //             if (response.is_success) {
        //                 show_toastr('Error', response.error, 'error');
        //             } else {
        //                 show_toastr('Error', response, 'error');
        //             }
        //         }
        //     })
        // });



        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
            });
        });
    </script>


    <script>
        $(document).on('click', '#comment_submit', function(e) {
            var curr = $(this);

            var comment = $.trim($("#form-comment textarea[name='comment']").val());

            if (comment != '') {
                $.ajax({
                    url: $("#form-comment").data('action'),
                    data: {
                        comment: comment,
                        "_token": "<?php echo e(csrf_token()); ?>",
                    },
                    type: 'POST',
                    success: function(data) {

                        location.reload();
                        data = JSON.parse(data);
                        console.log(data);
                        var html = "<div class='list-group-item px-0'>" +
                            "                    <div class='row align-items-center'>" +
                            "                        <div class='col-auto'>" +
                            "                            <a href='#' class='avatar avatar-sm rounded-circle ms-2'>" +
                            "                                <img src=" + data.default_img +
                            " alt='' class='avatar-sm rounded-circle'>" +
                            "                            </a>" +
                            "                        </div>" +
                            "                        <div class='col ml-n2'>" +
                            "                            <p class='d-block h6 text-sm font-weight-light mb-0 text-break'>" +
                            data.comment + "</p>" +
                            "                            <small class='d-block'>" + data.current_time +
                            "</small>" +
                            "                        </div>" +
                            "                        <div class='action-btn bg-danger me-4'><div class='col-auto'><a href='#' class='mx-3 btn btn-sm  align-items-center delete-comment' data-url='" +
                            data.deleteUrl +
                            "'><i class='ti ti-trash text-white'></i></a></div></div>" +
                            "                    </div>" +
                            "                </div>";

                        $("#comments").prepend(html);
                        $("#form-comment textarea[name='comment']").val('');
                        load_task(curr.closest('.task-id').attr('id'));
                        show_toastr('is_success', 'Comment Added Successfully!');
                    },
                    error: function(data) {
                        show_toastr('error', 'Some Thing Is Wrong!');
                    }
                });
            } else {
                show_toastr('error', 'Please write comment!');
            }
        });






        $(document).on("click", ".delete-comment", function() {
            var btn = $(this);

            $.ajax({
                url: $(this).attr('data-url'),
                type: 'DELETE',
                dataType: 'JSON',
                data: {
                    comment: comment,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    load_task(btn.closest('.task-id').attr('id'));
                    show_toastr('success', 'Comment Deleted Successfully!');
                    btn.closest('.list-group-item').remove();
                },
                error: function(data) {
                    data = data.responseJSON;
                    if (data.message) {
                        show_toastr('error', data.message);
                    } else {
                        show_toastr('error', 'Some Thing Is Wrong!');
                    }
                }
            });
        });
    </script>


    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>

    <script>
        $(document).on("click", ".status", function() {

            var status = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                type: 'POST',
                data: {

                    "status": status,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    show_toastr('<?php echo e(__('Success')); ?>', 'Status Update Successfully!', 'success');
                    location.reload();
                }

            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="col-md-6 float-end d-flex align-items-center justify-content-end">
        <?php if(\Auth::user()->type == 'owner' && \Auth::user()->type != 'Manager'): ?>
            <?php if($contract->status == 'accept'): ?>
                <div class="action-btn ms-2">
                    <a href="<?php echo e(route('send.mail.contract', $contract->id)); ?>" class="btn btn-sm btn-primary btn-icon"
                        data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Send Email')); ?>">
                        <i class="ti ti-mail text-white"></i>
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(\Auth::user()->type == 'owner' && \Auth::user()->type != 'Manager'): ?>
            <?php if($contract->status == 'accept'): ?>
                <div class="action-btn ms-2">
                    <a href="#" data-size="lg" data-url="<?php echo e(route('contracts.copy', $contract->id)); ?>"
                        data-ajax-popup="true" data-title="<?php echo e(__('Duplicate Contract')); ?>"
                        class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="<?php echo e(__('Duplicate')); ?>"><i class="ti ti-copy text-white"></i></a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="action-btn ms-2">

            <a href="<?php echo e(route('contract.download.pdf', \Crypt::encrypt($contract->id))); ?>"
                class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                title="<?php echo e(__('Download')); ?>" target="_blanks"><i class="ti ti-download text-white"></i></a>
        </div>

        <div class="action-btn ms-2">
            <a href="<?php echo e(route('get.contract', $contract->id)); ?>" target="_blank" class="btn btn-sm btn-primary btn-icon"
                title="<?php echo e(__('Preview')); ?>" data-bs-toggle="tooltip" data-bs-placement="top">
                <i class="ti ti-eye"></i>
            </a>
        </div>

        <?php if(
            ((\Auth::user()->type == 'owner' && $contract->owner_signature == '') ||
                (\Auth::user()->type == 'Manager' && $contract->client_signature == ''))): ?>
            <div class="action-btn ms-2">
                <a href="#" data-size="md"class="btn btn-sm btn-primary btn-icon"
                    data-url="<?php echo e(route('signature', $contract->id)); ?>" data-ajax-popup="true"
                    data-title="<?php echo e(__('Signature')); ?>" data-size="lg" title="<?php echo e(__('Signature')); ?>"
                    data-bs-toggle="tooltip" data-bs-placement="top">
                    <i class="ti ti-writing-sign"></i>
                </a>
            </div>
            <?php elseif($contract->status == 'accept' && $contract->client_signature == ''): ?>
            <div class="action-btn ms-2">
                <a href="#" data-size="md"class="btn btn-sm btn-primary btn-icon"
                    data-url="<?php echo e(route('signature', $contract->id)); ?>" data-ajax-popup="true"
                    data-title="<?php echo e(__('Signature')); ?>" data-size="lg" title="<?php echo e(__('Signature')); ?>"
                    data-bs-toggle="tooltip" data-bs-placement="top">
                    <i class="ti ti-writing-sign"></i>
                </a>
            </div>
        <?php endif; ?>

        <?php
            $status = App\Models\Contract::status();
        ?>
        <?php if(\Auth::user()->type != 'owner'): ?>
            <ul class="list-unstyled mb-0 ms-1">
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0 ms-0 p-2 rounded-1" data-bs-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="drp-text hide-mob">
                            <i class=" drp-arrow nocolor hide-mob"><?php echo e(ucfirst($contract->status)); ?><span
                                    class="ti ti-chevron-down"></span></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">
                        <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="dropdown-item status" data-id="<?php echo e($k); ?>"
                                data-url="<?php echo e(route('contract.status', $contract->id)); ?>"
                                href="#"><?php echo e(ucfirst($status)); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </li>
            </ul>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row mt-4">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#general" class="list-group-item list-group-item-action border-0"><?php echo e(__('General')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#attachments"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Attachment')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#comment" class="list-group-item list-group-item-action border-0"><?php echo e(__('Comment')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#notes" class="list-group-item list-group-item-action border-0"><?php echo e(__('Notes')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">


                    <div id="general">
                        <?php
                        // $products = $contract->products();
                        // $sources = $contract->sources();
                        // $calls = $contract->calls;
                        // $emails = $contract->emails;
                        ?>
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="row">
                                    <div class="col-lg-4 col-6">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 167px;">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-user-plus"></i>
                                                </div>
                                                <h6 class="mb-3 mt-4"><?php echo e(__('Attachment')); ?></h6>
                                                <h3 class="mb-0"><?php echo e(count($contract->files)); ?></h3>
                                                <h3 class="mb-0"></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-6">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 167px;">
                                                <div class="theme-avtar bg-info">
                                                    <i class="ti ti-click"></i>
                                                </div>
                                                <h6 class="mb-3 mt-4"><?php echo e(__('Comment')); ?></h6>
                                                <h3 class="mb-0"><?php echo e(count($contract->comment)); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-6">
                                        <div class="card">
                                            <div class="card-body" style="min-height: 167px;">
                                                <div class="theme-avtar bg-warning">
                                                    <i class="ti ti-file"></i>
                                                </div>
                                                <h6 class="mb-3 mt-4 "><?php echo e(__('Notes')); ?></h6>
                                                <h3 class="mb-0"><?php echo e(count($contract->note)); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-5">
                                <div class="card report_card total_amount_card">
                                    <div class="card-body pt-0 pb-0">
                                        <dl class="row mt-2  align-items-center">
                                            <dt class="col-sm-5 h6 text-sm"><?php echo e(__('Name')); ?></dt>
                                            <dd class="col-sm-5 text-sm"> <?php echo e($contract->name); ?></dd>
                                            <dt class="col-sm-5 h6 text-sm"><?php echo e(__('Subject')); ?></dt>
                                            <dd class="col-sm-5 text-sm"> <?php echo e($contract->subject); ?></dd>
                                            <dt class="col-sm-5 h6 text-sm"><?php echo e(__('Type')); ?></dt>
                                            <dd class="col-sm-5 text-sm"><?php echo e($contract->contract_type->name); ?></dd>
                                            <dt class="col-sm-5 h6 text-sm"><?php echo e(__('Value')); ?></dt>
                                            <dd class="col-sm-5 text-sm">
                                                <?php echo e(Auth::user()->priceFormat($contract->value)); ?></dd>
                                            <dt class="col-sm-5 h6 text-sm"><?php echo e(__('Start Date')); ?></dt>
                                            <dd class="col-sm-5 text-sm">
                                                <?php echo e(Auth::user()->dateFormat($contract->start_date)); ?></dd>
                                            <dt class="col-sm-5 h6 text-sm"><?php echo e(__('End Date')); ?></dt>
                                            <dd class="col-sm-5 text-sm">
                                                <?php echo e(Auth::user()->dateFormat($contract->end_date)); ?></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-header">
                                        <?php if(isset($plansettings['enable_chatgpt']) && $plansettings['enable_chatgpt'] == 'on'): ?>
                                            <div class="float-end">
                                                <a href="#" data-size="md" class="btn btn-sm btn-primary"
                                                    data-ajax-popup-over="true" data-size="md"
                                                    data-title="<?php echo e(__('Generate content with AI')); ?>"
                                                    data-url="<?php echo e(route('generate', ['contract desc'])); ?>"
                                                    data-toggle="tooltip" title="<?php echo e(__('Generate')); ?>">
                                                    <i class="fas fa-robot"></span><span
                                                            class="robot"><?php echo e(__('Generate With AI')); ?></span></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <h5><?php echo e(__('Contract Description')); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <?php echo e(Form::open(['route' => ['contracts.description.store', $contract->id]])); ?>

                                        <div class="form-group mt-3">
                                            <textarea class="tox-target pc-tinymce summernote" name="description" id="summernote" rows="8"><?php echo $contract->description; ?></textarea>
                                        </div>
                                        <?php if(\Auth::user()->type == 'owner'): ?>
                                            <div class="col-md-12 text-end mb-0">
                                                <?php echo e(Form::submit(__('Add'), ['class' => 'btn  btn-primary'])); ?>

                                            </div>
                                        <?php elseif($contract->status == 'accept' && \Auth::user()->can('Manage Contract')): ?>
                                            <div class="col-md-12 text-end mb-0">
                                                <?php echo e(Form::submit(__('Add'), ['class' => 'btn  btn-primary'])); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="attachments">
                        <div class="row ">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Attachments')); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class=" ">
                                            <div class="col-md-12 dropzone browse-file" id="my-dropzone"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $__currentLoopData = $contract->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-sm mb-0">
                                                <a href="#!"><?php echo e($file->files); ?></a>
                                            </h6>
                                            <p class="card-text small text-muted">
                                                <?php echo e(number_format(\File::size(storage_path('contract_attechment/' . $file->files)) / 1048576, 2) . ' ' . __('MB')); ?>

                                            </p>
                                        </div>

                                        <?php
                                            $attachments = \App\Models\Utility::get_file('contract_attechment');

                                        ?>
                                        <div class="action-btn bg-warning p-0 w-auto    ">
                                            <a href="<?php echo e($attachments . '/' . $file->files); ?>"
                                                class=" btn btn-sm d-inline-flex align-items-center" download=""
                                                data-bs-toggle="tooltip" title="Download">
                                                <span class="text-white"><i class="ti ti-download"></i></span>
                                            </a>
                                        </div>


                                        
                                        <div class="col-auto actions">
                                            <?php if((\Auth::user()->type == 'owner' && $contract->status == 'accept') || \Auth::user()->id == $file->user_id): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['contracts.file.delete', $contract->id, $file->id]]); ?>

                                                    <a href="#!"
                                                        class="mx-3 btn btn-sm  align-items-center show_confirm "data-bs-toggle="tooltip"
                                                        title="<?php echo e(__('Delete')); ?>">
                                                        <i class="ti ti-trash text-white"></i>
                                                    </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div id="comments">
                        <div class="row pt-2">
                            <div class="col-12">
                                <div id="comment">
                                    <div class="card">
                                        <div class="card-header">
                                            <?php if(isset($plansettings['enable_chatgpt']) && $plansettings['enable_chatgpt'] == 'on'): ?>
                                                <div class="float-end">
                                                    <a href="#" data-size="md" class="btn btn-sm btn-primary"
                                                        data-ajax-popup-over="true" data-size="md"
                                                        data-title="<?php echo e(__('Generate content with AI')); ?>"
                                                        data-url="<?php echo e(route('generate', ['contract comment'])); ?>"
                                                        data-toggle="tooltip" title="<?php echo e(__('Generate')); ?>">
                                                        <i class="fas fa-robot"></span><span
                                                                class="robot"><?php echo e(__('Generate With AI')); ?></span></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <h5><?php echo e(__('Comments')); ?></h5>
                                        </div>
                                        <div class="card-footer">
                                            
                                            <div class="col-12 d-flex">
                                                <div class="form-group mb-0 form-send w-100">
                                                    <form method="post" class="card-comment-box" id="form-comment"
                                                        data-action="<?php echo e(route('comment.store', [$contract->id])); ?>">
                                                        <textarea rows="1" class="form-control pc-tinymce" name="comment" data-toggle="autosize"
                                                            placeholder="Add a comment..." spellcheck="false"></textarea>
                                                        <grammarly-extension data-grammarly-shadow-root="true"
                                                            style="position: absolute; top: 0px; left: 0px; pointer-events: none; z-index: 1;"
                                                            class="cGcvT"></grammarly-extension>
                                                        <grammarly-extension data-grammarly-shadow-root="true"
                                                            style="mix-blend-mode: darken; position: absolute; top: 0px; left: 0px; pointer-events: none; z-index: 1;"
                                                            class="cGcvT"></grammarly-extension>
                                                    </form>
                                                </div>
                                                <?php if(\Auth::user()->type = 'owner'): ?>
                                                    <button id="comment_submit" class="btn btn-send"><i
                                                            class="f-16 text-primary ti ti-brand-telegram">
                                                        </i>
                                                    </button>
                                                <?php elseif(\Auth::user()->can('Manage Contract') && $contract->status == 'accept'): ?>
                                                    <button id="comment_submit" class="btn btn-send"><i
                                                            class="f-16 text-primary ti ti-brand-telegram">
                                                        </i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                            <div class="">
                                                <div class="list-group list-group-flush mb-0" id="comments">
                                                    <?php $__currentLoopData = $contract->comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="list-group-item px-0">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <?php
                                                                        $user = \App\Models\User::find($comment->user_id);
                                                                        $profile = \App\Models\Utility::get_file('upload/profile/');
                                                                    ?>

                                                                    <a href="<?php echo e(!empty($user->avatar) ? $profile . '/' . $user->avatar : $profile . '/avatar.png'); ?>"
                                                                        target="_blank"
                                                                        class="avatar avatar-sm rounded-circle">
                                                                        <img class="rounded-circle" width="50"
                                                                            height="50"
                                                                            src="<?php echo e(!empty($user->avatar) ? $profile . '/' . $user->avatar : $profile . '/avatar.png'); ?>">
                                                                    </a>
                                                                </div>
                                                                <div class="col ml-n2">
                                                                    <p
                                                                        class="d-block h6 text-sm font-weight-light mb-0 text-break">
                                                                        <?php echo e($comment->comment); ?></p>
                                                                    <small
                                                                        class="d-block"><?php echo e($comment->created_at->diffForHumans()); ?></small>
                                                                </div>

                                                                <div class="col-auto">
                                                                    <?php if(($contract->status == 'accept' && \Auth::user()->type == 'owner') || \Auth::user()->id == $comment->user_id): ?>
                                                                        <div
                                                                            class="col-auto p-0 mx-3 ms-2 action-btn bg-danger">
                                                                            <?php echo Form::open(['method' => 'GET', 'route' => ['comment.destroy', $comment->id]]); ?>

                                                                            <a href="#!"
                                                                                class="btn btn-sm d-inline-flex align-items-center show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="<?php echo e(__('Delete')); ?>">
                                                                                <span class="text-white"> <i
                                                                                        class="ti ti-trash"></i></span>
                                                                            </a>
                                                                            <?php echo Form::close(); ?>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="notes">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <?php if(isset($plansettings['enable_chatgpt']) && $plansettings['enable_chatgpt'] == 'on'): ?>
                                                <div class="float-end">
                                                    <a href="#" data-size="md"
                                                        class="btn btn-primary btn-icon btn-sm"
                                                        data-ajax-popup-over="true" id="grammarCheck"
                                                        data-url="<?php echo e(route('grammar', ['grammar'])); ?>"
                                                        data-bs-placement="top"
                                                        data-title="<?php echo e(__('Grammar check with AI')); ?>">
                                                        <i class="ti ti-rotate"></i>
                                                        <span><?php echo e(__('Grammar check with AI')); ?></span>
                                                    </a>
                                                    <a href="#" data-size="md" class="btn btn-sm btn-primary"
                                                        data-ajax-popup-over="true" data-size="md"
                                                        data-title="<?php echo e(__('Generate content with AI')); ?>"
                                                        data-url="<?php echo e(route('generate', ['contract notes'])); ?>"
                                                        data-toggle="tooltip" title="<?php echo e(__('Generate')); ?>">
                                                        <i class="fas fa-robot"></span><span
                                                                class="robot"><?php echo e(__('Generate With AI')); ?></span></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <h5><?php echo e(__('Notes')); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <?php echo e(Form::open(['route' => ['contracts.note.store', $contract->id]])); ?>

                                            <div class="form-group">
                                                <textarea class="tox-target pc-tinymce grammer_textarea" style="width:100%" name="note" id="summernote"></textarea>
                                            </div>
                                            <?php if(\Auth::user()->type == 'owner'): ?>
                                                <div class="col-md-12 text-end mb-0">
                                                    <?php echo e(Form::submit(__('Add'), ['class' => 'btn  btn-primary'])); ?>

                                                </div>
                                            <?php elseif(\Auth::user()->can('Manage Contract') && $contract->status == 'accept'): ?>
                                                <div class="col-md-12 text-end mb-0">
                                                    <?php echo e(Form::submit(__('Add'), ['class' => 'btn  btn-primary'])); ?>

                                                </div>
                                            <?php endif; ?>
                                            <?php echo e(Form::close()); ?>


                                            <div class="">
                                                <div class="list-group list-group-flush mb-0" id="comments">
                                                    <?php $__currentLoopData = $contract->note; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="list-group-item ">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto grammer_textarea">
                                                                    <?php
                                                                        $user = \App\Models\User::find($note->user_id);
                                                                        $profiles = \App\Models\Utility::get_file('upload/profile/');
                                                                    ?>

                                                                    <a href="<?php echo e(!empty($user->avatar) ? $profiles . '/' . $user->avatar : $profiles . '/avatar.png'); ?>"
                                                                        target="_blank"
                                                                        class="avatar avatar-sm rounded-circle">
                                                                        <img class="rounded-circle" width="50"
                                                                            height="50"
                                                                            src="<?php echo e(!empty($user->avatar) ? $profiles . '/' . $user->avatar : $profiles . '/avatar.png'); ?>"
                                                                            title="<?php echo e($contract->client->name); ?>">
                                                                    </a>
                                                                </div>
                                                                <div class="col ml-n2">
                                                                    <p
                                                                        class="d-block h6 text-sm font-weight-light mb-0 text-break">
                                                                        <?php echo e($note->note); ?></p>
                                                                    <small
                                                                        class="d-block"><?php echo e($note->created_at->diffForHumans()); ?></small>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <?php if((\Auth::user()->type == 'owner' && \Auth::user()->can('Manage Contract')) || \Auth::user()->id == $note->user_id): ?>
                                                                        <div
                                                                            class="col-auto p-0 ms-2 action-btn bg-danger">
                                                                            <?php echo Form::open(['method' => 'GET', 'route' => ['contracts.note.destroy', $note->id]]); ?>

                                                                            <a href="#!"
                                                                                class="btn btn-sm d-inline-flex align-items-center show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="<?php echo e(__('Delete')); ?>">
                                                                                <span class="text-white"> <i
                                                                                        class="ti ti-trash"></i></span>
                                                                            </a>
                                                                            <?php echo Form::close(); ?>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/contracts/show.blade.php ENDPATH**/ ?>