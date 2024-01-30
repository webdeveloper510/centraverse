@php
$proposalUrl = route('lead.signedproposal',urlencode(encrypt($lead->id)));
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal</title>
</head>
<body>
Dear {{ $lead->name }},<br>

We're excited to invite you to fill out our proposal form. Your input is valuable to us.<br>

<b>Click the link below to access the proposal form:</b><br>
<p>{{$proposalUrl}}</p>

Thank you for your time and collaboration.<br>
Best regards,
</body>
</html>