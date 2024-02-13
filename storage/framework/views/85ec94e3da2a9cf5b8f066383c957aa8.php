<div class="dash-container">
    <div class="dash-content">
        <div class="page-header p-4">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-1">
                        <nav class="navbar navbar-default no-margin">
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="active">
                                        <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2" style=" background: #e8ecf3;"> <span class="navbar-toggler-icon"></span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-11">
                        <div class="page-header-title" style="margin-top: 15px;position: relative;left: -45px;top: -6px;">
                            <h4 class="m-b-10"><?php echo $__env->yieldContent('title'); ?></h4>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <ul class="breadcrumb">
                            <?php echo $__env->yieldContent('breadcrumb'); ?>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="col-12 text-end mt-3">
                            <?php echo $__env->yieldContent('action-btn'); ?>
                        </div>
                        <!-- <div class="col-12">
                            <?php echo $__env->yieldContent('filter'); ?>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>
<?php $__env->startPush('script-page'); ?>
<script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        $("#menu-toggle-2").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled-2");
            $('#menu ul').hide();
        });

        function initMenu() {
            $('#menu ul').hide();
            $('#menu ul').children('.current').parent().show();
            //$('#menu ul:first').show();
            $('#menu li a').click(
                function() {
                    var checkElement = $(this).next();
                    if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                        return false;
                    }
                    if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                        $('#menu ul:visible').slideUp('normal');
                        checkElement.slideDown('normal');
                        return false;
                    }
                }
            );
        }
        $(document).ready(function() {
            initMenu();
        });
</script>
<?php $__env->stopPush(); ?>
<style>
    /* #optionsContainer {
        display: none;
        margin-top: 10px;
    } */

    button {
        background-color: #007bff;
        color: #fff;
        padding: 8px 16px;
        margin-right: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }


    /* #optionsContainer {
        display: block;
        margin-left: 474px;
        margin-top: -16px;
        padding: 10px;
    } */

    /* .cmplt {
        margin-left: 480px;
        margin-top: -206px;
        cursor: pointer;
    } */

    #toggleDiv {
        cursor: pointer;
    }

    .totallead {
        cursor: pointer;
    }

    /* .upcmg {
        margin-left: 150px;
        margin-top: -201px;
        cursor: pointer;
    } */

    #popup-form {
        display: none;
        /*position: fixed; */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        border-radius: 2px;
        width: 600px;
    }

    button:hover {
        background-color: #0056b3;
    }

    #overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }


    .blocked-by-tooltip {
        position: absolute;
        background-color: #145388;
        color: #fff;
        padding: 10px;
        border-radius: 8px;
        z-index: 2000;
        margin-top: -28px;
        margin-left: -94px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, transform 0.2s ease;
        background: linear-gradient(45deg, #145388, #145388);
    }

    .blocked-by-tooltip:hover {
        background-color: #145388;
        transform: scale(1.05);
    }


    /* CHECKBOX 1 COMPLETED */
    .checkbox {
        width: -1px;
        height: 20px;
        float: left;
        margin-right: 10px;
        margin-left: 25px;
        margin-bottom: 14px;
        position: relative;
    }

    .checkbox:after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: red;
        top: 0px;
        left: -22px;
    }

    /* CHECKBOX 1 UPCOMING */
    .checkbox1 {
        height: 20px;
        float: left;
        margin-right: 10px;
        margin-bottom: 14px;
        position: relative;
    }

    .checkbox1:after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: green;
        top: 0px;
        left: -22px;
    }

    /* CHECKBOX 1 BLOCKED */

    .checkbox2 {
        height: 20px;
        float: left;
        margin-right: 10px;
        margin-bottom: 14px;
        position: relative;
    }

    .checkbox2:after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: Gray;
        top: 0px;
        left: -22px;
    }

    p.close-popup {
        margin-bottom: 0 !important;
    }
</style>

<style>
    .nav-pills>li>a {
        border-radius: 0;
    }

    #wrapper {
        padding-left: 0;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
        overflow: hidden;
    }

    #wrapper.toggled {
        padding-left: 250px;
        overflow: hidden;
    }

    #sidebar-wrapper {
        z-index: 1000;
        position: absolute;
        left: 250px;
        width: 0;
        height: 100%;
        margin-left: -250px;
        overflow-y: auto;
        background: #fff;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 250px;
    }

    #page-content-wrapper {
        position: absolute;
        padding: 15px;
        width: 100%;
        overflow-x: hidden;
    }


    #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 0px;
    }

    .fixed-brand {
        width: auto;
    }

    /* Sidebar Styles */

    .sidebar-nav {
        position: absolute;
        top: 0;
        width: 250px;
        margin: 0;
        padding: 0;
        list-style: none;
        margin-top: 2px;
    }

    .sidebar-nav li {
        text-indent: 15px;
        line-height: 40px;
    }

    .sidebar-nav li a {
        display: block;
        text-decoration: none;
        color: #999999;
    }

    .sidebar-nav li a:hover {
        text-decoration: none;
        color: #fff;
        background: rgba(255, 255, 255, 0.2);
        border-left: red 2px solid;
    }

    .sidebar-nav li a:active,
    .sidebar-nav li a:focus {
        text-decoration: none;
    }

    .sidebar-nav>.sidebar-brand {
        height: 65px;
        font-size: 18px;
        line-height: 60px;
    }

    .sidebar-nav>.sidebar-brand a {
        color: #999999;
    }

    .sidebar-nav>.sidebar-brand a:hover {
        color: #fff;
        background: none;
    }

    .no-margin {
        margin: 0;
    }

    @media (min-width: 768px) {
        #wrapper {
            padding-left: 250px;
        }

        .fixed-brand {
            width: 250px;
        }

        #wrapper.toggled {
            padding-left: 0;
        }

        #sidebar-wrapper {
            width: 250px;
        }

        #wrapper.toggled #sidebar-wrapper {
            width: 250px;
        }

        #wrapper.toggled-2 #sidebar-wrapper {
            width: 65px;
        }

        /* #wrapper.toggled-2 #sidebar-wrapper:hover {
        width: 250px;
    } */
        /* div.row>div {
            position: relative;
            display: flex;
        } */

        .p-4 {
            padding: 0 1.5rem !important;
        }

        #page-content-wrapper {
            padding: 20px;
            position: relative;
           -webkit-transition: all 0.5s ease;
             -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        #wrapper.toggled #page-content-wrapper {
            position: relative;
            margin-right: 0;
            padding-left: 250px;
        }

        #wrapper.toggled-2 #page-content-wrapper {
            position: relative;
            margin-right: 0;
            margin-left: -200px;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
            width: auto;
        }
    }
</style><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/partials/admin/content.blade.php ENDPATH**/ ?>