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
<p>{{$content}}</p>
<b>Click the link below to access the proposal form:</b><br>
<p>{{$proposalUrl}}</p>

Thank you for your time and collaboration.<br>
With regards
</body>
</html>