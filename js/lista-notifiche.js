function eventiNotifiche(){
    waitForEl("#loadNotifications", function() {
        $(document).ready(function () {
            loadNewNotifications();
        });
    });
}