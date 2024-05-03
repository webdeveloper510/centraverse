importScripts('https://www.gstatic.com/firebasejs/10.11.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.11.1/firebase-messaging-compat.js');

try {
    firebase.initializeApp({
        apiKey: "AIzaSyB3y7uzZSAP39LOIvZwOjJOdFD2myDnvQk",
      authDomain: "notify-71d80.firebaseapp.com",
      projectId: "notify-71d80",
      storageBucket: "notify-71d80.appspot.com",
      messagingSenderId: "684664764020",
      appId: "1:684664764020:web:71f82128ffc0e20e3fc321",
      measurementId: "G-FTD60E8WG9"
    });

    const messaging = firebase.messaging();
    console.log('hy');
    // Add Firebase messaging event listeners
    messaging.onBackgroundMessage((payload) => {
        console.log('Received background message:', payload);

        const notificationTitle = payload.notification.title;
        const notificationOptions = {
            body: payload.notification.body,
            icon: '/assets/icon/notification-icon.png'
        };

        self.registration.showNotification(notificationTitle, notificationOptions);
    });


} catch (error) {
    console.error('Error initializing Firebase:', error);
}