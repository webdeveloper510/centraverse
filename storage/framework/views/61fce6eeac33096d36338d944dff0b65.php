
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal</title>
</head>

<body>
    Dear <?php echo e($lead->name); ?>,<br>

    <table class="table table-responsive">
        <thead>
            <th colspan="4"></th>

        </thead>
        <tbody>
        <tr>
                <td>Event Type</td>
                <td><?php echo e($lead->type ?? '--'); ?></td>
            </tr>
            <tr>
                <td>No. of Guests </td>
                <td><?php echo e($lead->guest_count ?? '--'); ?></td>
            </tr>
            <tr>
                <td>Venue</td>
                <td><?php echo e($lead->venue ?? '--'); ?></td>
            </tr>
            <tr>
                <td>Function</td>
                <td><?php echo e($lead->function ?? '--'); ?></td>
            </tr>
            <tr>
                <td>Package</td>
                <td>
                    <?php $package = json_decode($lead->func_package,true);
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
    <?php  echo "<pre>";print_r($proposals); ?>
  
    <p> Please find the below attachment : </p>
    Thank you for your time and collaboration.
    With regards

</body>

</html><?php /**PATH /home/crmcentraverse/public_html/resources/views/lead/mail/proposal_response.blade.php ENDPATH**/ ?>