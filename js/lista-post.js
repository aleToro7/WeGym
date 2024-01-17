function eventiListaPost(){
    waitForEl("#last", function() {
        $(".commento-icon").click(function(){
            sessionStorage.setItem('idPost', $(this).attr('id'));
            $.ajax({
                type:'POST',
                url:'../posts.php',
                data: 'loadCommentsOf=' + $(this).attr('id')
            });
            $("#load").empty();
            $("#load").load('./commenti-post.php', eventiCommenti());
        });
    });

    
}