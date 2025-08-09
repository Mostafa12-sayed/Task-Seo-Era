var pusher = new Pusher(PUSHER_APP_KEY, {
    cluster: PUSHER_APP_CLUSTER,
});

var notificationsCountElem = $(".notif-count");
var notificationsCount = parseInt(notificationsCountElem.text());
Pusher.logToConsole = true;

// Subscribe to send-sign-event
var channel = pusher.subscribe("admin-notifications");
channel.bind("post-created", function (data) {
    // if (data.userId == CURRENT_USER_ID) {
    //     playNotificationSound();
        Swal.fire(
            "New Post Created By " + data.username,
            "tilte: " + data.title
        );

        updateNotificationCount();
    // }
});

function updateNotificationCount() {
    notificationsCount++;
    notificationsCountElem.text(notificationsCount);
}
