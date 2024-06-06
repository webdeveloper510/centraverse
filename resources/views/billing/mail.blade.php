@php
$url = route('billing.payview',urlencode(encrypt($meeting->id)));
$logo=\App\Models\Utility::get_file('uploads/logo/');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
Dear {{ $meeting->name }},<br>

<b>Click the link below to pay:</b><br>
<p>{{$url}}</p>


 <p>Thank you for your time and collaboration.</p>
        <p><strong>With regards,</strong></p>
        <div class="logo">
        <img src="{{$logo.'logo-light.png'}}" alt="{{ config('app.name', 'The Bond 1786') }}"
                        class="logo logo-lg nav-sidebar-logo" height="50" />
                        <span style="font-size:x-small;color: #aab0b6;"">Supported by The Sector Eight</span>
        </div>
</body>
</html>