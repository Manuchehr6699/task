"use strict";
/*=====        Book_Order_Functions   =======*/
function showOrder(order) {
    $('#order .modal-body').html(order);
    $('#order').modal();
}

function getOrders(){

    $.ajax({
        url: '/library/order/show',
        type: 'GET',
        success: function (res) {
            if (!res) {
                alert('Error!');
            }
            showOrder(res);
        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
}

$('#order .modal-body').on('click', '.del-item', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '/library/order/del-item',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) {
                alert('Error!');
            }
            showOrder(res);
        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
});

function clearOrder() {
    var tbl = document.getElementById('tbl_orders');
    var uid = $(tbl).data('text');
    $.ajax({
        url: '/library/order/clear-orders',
        data: {uid: uid},
        type: 'GET',
        success: function (res) {
            if (!res) {
                alert('Error!');
            }
            showOrder(res);
        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
}


$('.add-to-cart').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');

    $.ajax({
        url: '/library/order/add',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) {
                alert('This Book Not Found From DataBase!');
            }
            //console.log(res);
            showOrder(res);
        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
});


/*--------------- Book_Like_Functions ---------------------*/

function showLikes(like) {
    $('#likes .modal-body').html(like);
    $('#likes').modal();
}

$('.add-to-like').on('click', function (e) {
    e.preventDefault();
    var elem = $(this);
    var id = elem.data('id');
    var count_like_elem = $("#likecount"+id);


    $.ajax({
        url: '/library/like/add-like',
        data: {id: id},
        type: 'GET',
        success: function(res) {
            var data = JSON.parse(res);
            //alert(data);
            if(data['res_code'] == null) {
                alert('This Book Not Found From DataBase!');
                return false
            }else if(data['res_code'] == 1){
                elem.addClass('like');
                count_like_elem.text(data['like_count']);
                setTimeout(function(){
                    count_like_elem.text('');
                }, 2000);

            }else{
                elem.removeClass('like');
                count_like_elem.text(data['like_count']);
                setTimeout(function(){
                    count_like_elem.text('');
                }, 2000);
            }

        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
});

function clearLike() {

    $.ajax({
        url: '/library/like/clear-likes',
        type: 'GET',
        success: function (res) {
            if (!res) {
                alert('Error!');
            }
            showLikes(res);
             $('.add-to-like').removeClass('like');
             $('.add-to-like-ebook').removeClass('like');
        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
}

function getLikes(){

    $.ajax({
        url: '/library/like/show-likes',
        // data: {id: id, uid: uid},
        type: 'GET',
        success: function (res) {
            if (!res) {
                alert('Error!');
            }
            showLikes(res);
        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
}

$('#likes .modal-body').on('click', '.del-item', function () {
    var id = $(this).data('id');
    var elem = $('.add-to-like');
    var id_heart = elem.data('id');
    $.ajax({
        url: '/library/like/del-item-like',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) {
                alert('Error!');
            }
            //elem.removeClass('like');
            showLikes(res);
        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
});


//////////////////////////////////////////////////////////////////////////////////


function showBookDetails(res) {
    $('#details .modal-body').html(res);
    $('#details').modal();
}

    $('.title_book').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/library/book/modal-detail',
            data: {id: id},
            type: 'GET',
            success: function (res) {
                if (!res) {
                    alert('Error!');
                }
                showBookDetails(res);
            },
            error: function () {
                alert('Error!');
            }
        });
        return false;
   });

$('.title_ebook').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/elibrary/ebook/modal-detail',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) {
                alert('Error!');
            }
            showBookDetails(res);
        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
});


$('.add-to-like-ebook').on('click', function (e) {
    e.preventDefault();
    var elem = $(this);
    var id = elem.data('id');
    var count_like_elem = $("#likecount"+id);

    $.ajax({
        url: '/elibrary/like/add-like',
        data: {id: id},
        type: 'GET',
        success: function(res) {
            var data = JSON.parse(res);
            //alert(data);
            if(data['res_code'] == null) {
                alert('This Book Not Found From DataBase!');
                return false
            }else if(data['res_code'] == 1){
                elem.addClass('like');
                count_like_elem.text(data['like_count']);
                setTimeout(function(){
                    count_like_elem.text('');
                }, 2000);

            }else{
                elem.removeClass('like');
                count_like_elem.text(data['like_count']);
                setTimeout(function(){
                    count_like_elem.text('');
                }, 2000);
            }

        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
});

$('#likes .modal-body').on('click', '.del-item-ebook-like', function () {
    var id = $(this).data('id');
    var elem = $('.add-to-like');
    var id_heart = elem.data('id');
    $.ajax({
        url: '/elibrary/like/del-item-like',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) {
                alert('Error!');
            }
            elem.removeClass('like');
            showLikes(res);
        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
});

