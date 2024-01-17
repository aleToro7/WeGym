function eventiListaPost(){
    waitForEl("#last", function() {
        $(".commento-icon").click(function(){
            sessionStorage.setItem('idPost', $(this).attr('id'));
            sessionStorage.setItem('ownerPost', $("#usrname").html());
            $.ajax({
                type:'POST',
                url:'../posts.php',
                data: 'loadCommentsOf=' + $(this).attr('id')
            });
            $("#load").empty();
            $("#load").load('./commenti-post.php', eventiCommenti());
        });

        $('[id*="like-"]').click(function(){
            let idPost = $(this).attr("id").split("-")[1];
            let ownerPost = $("#usrname").html();
            if($(this).hasClass('like-icon')) {
                $.ajax({
                    type:'POST',
                    url:'../like.php',
                    data: {mettiLike: idPost, ownerPostLike: ownerPost},
                    success: function(data){
                        if(data != ""){
                            //errore
                        }
                    }
                });
            }else {
                $.ajax({
                    type:'POST',
                    url:'../like.php',
                    data: {togliLike: idPost, ownerPostLiked: ownerPost},
                    success: function(data){
                        if(data != ""){
                            //errore
                        }
                    }
                });
            }
            $(this).toggleClass("like-icon liked-icon");
            $(this).toggleClass("bi-heart bi-heart-fill");
        });
    });
}