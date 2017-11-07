function like(id) {
    $.post('/site/likes?id='+id, {loadMore:true}).done(function(data){
        $('#likeButton_'+id).toggleClass('liked');
        var count = parseInt($('#count_'+id).html());
        if ( $('#likeButton_'+id).hasClass("liked") ) {
            $('#count_'+id).html(count+1);
        } else {
            $('#count_'+id).html(count-1);
        }
    }).fail(function () {
        console.log('Server error');
    });
}
