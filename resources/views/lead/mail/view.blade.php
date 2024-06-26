@php
$proposalUrl = route('lead.signedproposal',urlencode(encrypt($lead->id)));
$logo=\App\Models\Utility::get_file('uploads/logo/');
$package = json_decode($lead->func_package,true);
$barpcks = json_decode($lead->bar_package,true);

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
        background-color: #f8f8f8;
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    p {
        margin-bottom: 20px;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .footer {
        margin-top: 20px;
        text-align: center;
        color: #666;
    }
    </style>
</head>

<body>
    <p>Dear {{ ucfirst($lead->name) }}</p>
    <div class="container">
        <h1>Proposal Details</h1>

        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Event Type</td>
                    <td>{{ $lead->type ?? '--' }}</td>
                </tr>
                <tr>
                    <td>No. of Guests</td>
                    <td>{{ $lead->guest_count ?? '--' }}</td>
                </tr>
                <tr>
                    <td>Venue</td>
                    <td>{{ $lead->venue_selection ?? '--' }}</td>
                </tr>
                <tr>
                    <td>Function</td>
                    <td>{{ $lead->function ?? '--' }}</td>
                </tr>
                <tr>
                    <td>Food Package</td>
                    <td>
                        @if(isset($package) && !empty($package))
                        @foreach ($package as $key => $value)
                        {{ implode(',', $value) }}
                        @endforeach
                        @else
                        --
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Bar</td>
                    <td>{{ $lead->bar ?? '--' }}</td>
                </tr>
                @if($lead->bar == 'Package Choice')
                <tr>
                    <td>Bar Package</td>
                    <td>
                        @if(isset($barpcks) && !empty($barpcks))
                        @foreach($barpcks as $key => $barpck)
                        $bar[]= $barpck;

                        @endforeach
                        $barpckge = implode(',',$bar);
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <p>{{ $content }}</p>

        <p>Click the link below to see the Lead details/proposal with estimated billing:</p>
        <p><a href="{{ $proposalUrl }}?prop={{$propid}}">{{ $proposalUrl }}</a></p>

        <p>Thank you for your time and collaboration.</p>
        <p><strong>With regards,</strong></p>
        <p><b>The Bond 1786</b></p>
        <div class="logo">
            <img src="{{ $logo.'logo-light.png' }}" alt="{{ config('app.name', 'The Bond 1786') }}" height="50">
        </div>
        <span style="font-size:x-small;">Supported by The Sector Eight</span>
    </div>

    <div class="footer">
        <p>This email was generated automatically. Please do not reply.</p>
    </div>
</body>

</html>