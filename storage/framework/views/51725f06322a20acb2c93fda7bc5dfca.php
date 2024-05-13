<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PandaDoc JavaScript SDK</title>
    <script src="https://pd-js-sdk.s3.amazonaws.com/0.2.20/pandadoc-js-sdk.min.js"></script>
    <link rel="stylesheet" href="https://pd-js-sdk.s3.amazonaws.com/0.2.20/pandadoc-js-sdk.css" />
    <style>
    .pandadoc iframe {
        width: 900px;
        height: 700px;
    }
    </style>
</head>
<?php

?>
<body>
    <iframe src="https://app.pandadoc.com/s/<?php echo e($res['id']); ?>/"></iframe>

    <!-- <div id="pandadoc-sdk" class="pandadoc"></div> -->

    <!-- <script>
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
    </script> -->

</body>

</html><?php /**PATH /home/crmcentraverse/public_html/resources/views/pandadoc.blade.php ENDPATH**/ ?>