<?php   
$logo=\App\Models\Utility::get_file('uploads/logo/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agreement</title>
</head>

<body>
    Dear <?php echo e($meeting->name); ?>,<br>

    <p>Event has been booked for the <?php echo e($meeting->start_date); ?> .<br>
    <b>Following are the details of the event </b>-
</p>
    <table class="table table-bordered">
        <thead>
            <th colspan="4"></th>
        </thead>
        <tbody>
        <tr>
                <td>Event Type</td>
                <td><?php echo e($meeting->type ?? '--'); ?></td>
            </tr>
            <tr>
                <td>No. of Guests </td>
                <td><?php echo e($meeting->guest_count ?? '--'); ?></td>
            </tr>
            <tr>
                <td>Venue</td>
                <td><?php echo e($meeting->venue_selection ?? '--'); ?></td>
            </tr>
            <tr>
                <td>Function</td>
                <td><?php echo e($meeting->function ?? '--'); ?></td>
            </tr>
            <tr>
                <td>Package</td>
                <td>
                    <?php $package = json_decode($meeting->func_package,true);
                        if(isset($package) && !empty($package)){
                        foreach ($package as $key => $value) {
                            echo implode(',',$value);
                        } 
                    }else{
                        echo '--';
                    }
                ?>
                </td>
            </tr>
           
        </tbody>

    </table>
  
    <b>Thank you for your time and collaboration.</b><br>
    <b>With regards</b><br>
    <b>The Bond 1786</b><br>
    <img src="<?php echo e($logo.'3_logo-light.png'); ?>" alt="<?php echo e(config('app.name', 'The Bond 1786')); ?>"
                        class="logo logo-lg nav-sidebar-logo" height="50" />

</body>

</html><?php /**PATH /home/crmcentraverse/public_html/resources/views/meeting/agreement/signed_mail.blade.php ENDPATH**/ ?>