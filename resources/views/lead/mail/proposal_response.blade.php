
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal</title>
</head>

<body>
    Dear {{ $lead->name }},<br>

    <table class="table table-responsive">
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
  
    Thank you for your time and collaboration.
    With regards

</body>

</html>