<?php   
$logo=\App\Models\Utility::get_file('uploads/logo/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal</title>
</head>

<body>
    Dear {{ $lead->name }},<br>

    <p>Lead details are as follows : </p>
    <table class="table table-bordered" style="border:1px solid black;">
        <thead>
            <th colspan="4"></th>
        </thead>
        <tbody>
        <tr>
                <td>Event Type</td>
                <td>{{$lead->type ?? '--'}}</td>
            </tr>
            <tr>
                <td>No. of Guests </td>
                <td>{{$lead->guest_count ?? '--'}}</td>
            </tr>
            <tr>
                <td>Venue</td>
                <td>{{$lead->venue ?? '--'}}</td>
            </tr>
            <tr>
                <td>Function</td>
                <td>{{$lead->function ?? '--'}}</td>
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
  
    <b>Thank you for your time and collaboration.</b><br>
    <b>With regards</b>
    <b>The Bond 1786</b>
    <img src="{{$logo.'3_logo-light.png'}}" alt="{{ config('app.name', 'The Bond 1786') }}"
                        class="logo logo-lg nav-sidebar-logo" height="50" />

</body>

</html>