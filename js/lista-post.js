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

        $(".like-icon").click(function(){
            $(this).toggleClass("like-icon liked-icon");
            $(this).toggleClass("bi-heart bi-heart-fill");
            let idPost = $(this).attr("id").split("-")[1];
            $.ajax({
                type:'POST',
                url:'../like.php',
                data: 'mettiLike=' + idPost,
                success: function(data){
                    if(data != ""){
                        //errore
                    }
                }
            });
        });

        $(".liked-icon").click(function(){
            $(this).toggleClass("liked-icon like-icon");
            $(this).toggleClass("bi-heart-fill bi-heart");
            let idPost = $(this).attr("id").split("-")[1];
            $.ajax({
                type:'POST',
                url:'../like.php',
                data: 'togliLike=' + idPost,
                success: function(data){
                    if(data != ""){
                        //errore
                    }
                }
            });
        });
    });

    
}