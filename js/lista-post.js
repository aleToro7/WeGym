function eventiListaPost(){
    waitForEl(".commento-icon", function() {
        $(".commento-icon").click(function(){
            sessionStorage.setItem('idPost', $(".commento-icon").attr('id'));
            $("#load").empty();
            $("#load").load('./commenti-post.php', eventiCommenti());
        });
    });
}