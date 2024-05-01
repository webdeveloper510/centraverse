<!-- resources/views/retrieve-device-token.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Device Token</title>
</head>

<body>
    <h1>Retrieve Device Token</h1>
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <!-- Include Firebase JavaScript SDK -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

    <!-- Firebase initialization script -->
    <script>
    var firebaseConfig = {
        // Your Firebase project configuration
        apiKey: "AIzaSyB3y7uzZSAP39LOIvZwOjJOdFD2myDnvQk",
        authDomain: "notify-71d80.firebaseapp.com",
        projectId: "notify-71d80",
        storageBucket: "notify-71d80.appspot.com",
        messagingSenderId: "684664764020",
        appId: "1:684664764020:web:71f82128ffc0e20e3fc321",
        measurementId: "G-FTD60E8WG9"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    // Retrieve device token
    const messaging = firebase.messaging();
    messaging.getToken({
        vapidKey: 'YOUR_VAPID_KEY'
    }).then(currentToken => {
        if (currentToken) {
            // Use the token (e.g., send it to your server)
            console.log('Device token:', currentToken);
        } else {
            console.error('No device token available');
        }
    }).catch(error => {
        console.error('Error retrieving device token:', error);
    });
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/retrieve-device-token.blade.php ENDPATH**/ ?>