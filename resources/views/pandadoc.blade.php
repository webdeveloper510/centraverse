<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PandaDoc JavaScript SDK</title>
    <script src="https://pd-js-sdk.s3.amazonaws.com/0.2.20/pandadoc-js-sdk.min.js"></script>
    <link rel="stylesheet" href="https://pd-js-sdk.s3.amazonaws.com/0.2.20/pandadoc-js-sdk.css" />
    <style>
    .pandadoc iframe {
        width: 100%;
        height: 600px;
    }
    </style>
</head>

<body>

    <div id="pandadoc-sdk" class="pandadoc"></div>

     <script>
    var editor = new PandaDoc.DocEditor();
    editor.show({
        el: '#pandadoc-sdk',
        data: {
            metadata: {
                abc: 'asasdad'
            }
        },
        cssClass: 'style-me',
        events: {
            onInit: function() {},
            onDocumentCreated: function() {},
            onDocumentSent: function() {},
            onClose: function() {}
        }
    });
    </script> 
</body>

</html>