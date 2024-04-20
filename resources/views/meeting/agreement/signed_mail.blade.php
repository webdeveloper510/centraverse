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
    Dear {{ $meeting->name }},<br>

    <p>Event has been booked for the {{$meeting->start_date}} .<br>
    <b>Following are the details of the event </b>-
</p>
    <table class="table table-bordered">
        <thead>
            <th colspan="4"></th>
        </thead>
        <tbody>
        <tr>
                <td>Event Type</td>
                <td>{{$meeting->type ?? '--'}}</td>
            </tr>
            <tr>
                <td>No. of Guests </td>
                <td>{{$meeting->guest_count ?? '--'}}</td>
            </tr>
            <tr>
                <td>Venue</td>
                <td>{{$meeting->venue_selection ?? '--'}}</td>
            </tr>
            <tr>
                <td>Function</td>
                <td>{{$meeting->function ?? '--'}}</td>
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
    <img src="{{$logo.'3_logo-light.png'}}" alt="{{ config('app.name', 'The Bond 1786') }}"
                        class="logo logo-lg nav-sidebar-logo" height="50" />

</body>

</html>