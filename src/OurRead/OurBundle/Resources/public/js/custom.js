/**
 * Created by povilas on 5/3/15.
 */
$(document).ready(function() {
    $('.create-order').click(function(e) {

        e.preventDefault();
        $.confirm({
            confirmButton: 'Yes',
            cancelButton: 'No!',
            title: 'Hello reader!',
            content: 'Are you sure you want to order this book?',
            cancelButtonClass: 'btn-danger',
            confirmButtonClass: 'btn-success',
            autoClose: 'cancel|10000',
            animationBounce: 2.5,
            confirm: function(){
                var id = $('#book-page-id').val();
                $.post( '/order/'+id)
                    .success(function () {
                        $.confirm({
                            title: 'Book order was successful!',
                            content: 'Now you will be redirected to Homepage',
                            cancelButton: false,
                            confirmButton: 'OK',
                            confirmButtonClass: 'btn-success',
                            autoClose: 'confirm|10000',
                            closeIcon: false,
                            confirm: function(){
                                window.location = '/';
                            }
                        })
                    })
                    .fail(function () {
                        $.confirm({
                            icon: 'fa fa-warning',
                            title: 'Warning!',
                            content: 'Something goes wrong. Try again later',
                            cancelButton: false,
                            confirmButton: 'OK',
                            confirmButtonClass: 'btn-danger',
                            autoClose: 'confirm|10000',
                            animationBounce: 2.5,
                            closeIcon: false,
                            confirm: function(){
                                window.location = '/';
                            }
                        })
                    });
            },
            cancel: function(){
            }
        });
    });
    $('.extend-order').click(function(e) {

        e.preventDefault();
        $.confirm({
            confirmButton: 'Ok',
            cancelButton: 'No thanks',
            title: 'Hello reader!',
            content: 'You can extend you return datetime by 14 days',
            cancelButtonClass: 'btn-danger',
            confirmButtonClass: 'btn-success',
            autoClose: 'cancel|10000',
            animationBounce: 2.5,
            confirm: function(){
                var id = $('#book-page-id').val();
                $.post( '/extend/'+id)
                    .success(function () {
                        $.confirm({
                            title: "Book's order return time was extended successfully!",
                            content: 'Now you will be redirected to Homepage',
                            cancelButton: false,
                            confirmButton: 'OK',
                            confirmButtonClass: 'btn-success',
                            autoClose: 'confirm|10000',
                            closeIcon: false,
                            confirm: function(){
                                window.location = '/';
                            }
                        })
                    })
                    .fail(function () {
                        $.confirm({
                            icon: 'fa fa-warning',
                            title: 'Warning!',
                            content: 'Something goes wrong. Try again later',
                            cancelButton: 'Stay on this page',
                            confirmButton: 'OK',
                            confirmButtonClass: 'btn-danger',
                            autoClose: 'confirm|10000',
                            animationBounce: 2.5,
                            closeIcon: false,
                            confirm: function(){
                                window.location = '/';
                            },
                            cancel: function(){
                            }
                        })
                    });
            },
            cancel: function(){
            }
        });
    });
    $('.reserve-book').click(function(e) {

        e.preventDefault();
        $.confirm({
            confirmButton: 'Yes',
            cancelButton: 'No!',
            title: 'Hello reader!',
            content: 'Are you sure you want to reserve this book?',
            cancelButtonClass: 'btn-info',
            confirmButtonClass: 'btn-success',
            autoClose: 'cancel|10000',
            animationBounce: 2.5,
            confirm: function(){
                var id = $('#book-page-id').val();
                $.post( '/reserve/'+id)
                    .success(function () {
                        $.confirm({
                            title: "Book's reservation was extended successfully!",
                            content: 'When book will be available we will email you',
                            confirmButton: 'OK',
                            confirm: function(){
                                window.location = '/';
                            },
                            cancel: function(){
                            }

                        })
                    })
                    .fail(function () {
                        $.confirm({
                            icon: 'fa fa-warning',
                            title: 'Warning!',
                            content: 'Something goes wrong. Try again later',
                            cancelButton: 'Stay on this page',
                            confirmButton: 'OK',
                            confirmButtonClass: 'btn-danger',
                            autoClose: 'confirm|10000',
                            animationBounce: 2.5,
                            closeIcon: false,
                            confirm: function(){
                                window.location = '/';
                            },
                            cancel: function(){
                            }
                        })
                    });
            },
            cancel: function(){
            }
        });
    });
    $('.return-book').click(function(e) {

        e.preventDefault();
        $.confirm({
            confirmButton: 'Yes',
            cancelButton: 'No!',
            title: 'Hello reader!',
            content: 'Are you sure you want to return this book?',
            cancelButtonClass: 'btn-info',
            confirmButtonClass: 'btn-success',
            autoClose: 'cancel|10000',
            animationBounce: 2.5,
            confirm: function(){
                var id = $('#book-page-id').val();
                $.post( '/return/'+id)
                    .success(function () {
                        $.confirm({
                            title: "Book was returned successfully!",
                            content: 'Thanks for reading it!',
                            confirmButton: 'OK',
                            confirm: function(){
                                window.location = '/';
                            },
                            cancel: function(){
                            }

                        })
                    })
                    .fail(function () {
                        $.confirm({
                            icon: 'fa fa-warning',
                            title: 'Warning!',
                            content: 'Something goes wrong. Try again later',
                            cancelButton: 'Stay on this page',
                            confirmButton: 'OK',
                            confirmButtonClass: 'btn-danger',
                            autoClose: 'confirm|10000',
                            animationBounce: 2.5,
                            closeIcon: false,
                            confirm: function(){
                                window.location = '/';
                            },
                            cancel: function(){
                            }
                        })
                    });
            },
            cancel: function(){
            }
        });
    });
    $('.cancel-reservation').click(function(e) {

        e.preventDefault();
        $.confirm({
            confirmButton: 'Yes',
            cancelButton: 'No!',
            title: 'Hello reader!',
            content: 'Are you sure you want to cancel reservation?',
            cancelButtonClass: 'btn-info',
            confirmButtonClass: 'btn-success',
            autoClose: 'cancel|10000',
            animationBounce: 2.5,
            confirm: function(){
                var id = $('#book-page-id').val();
                $.post( '/cancel/'+id)
                    .success(function () {
                        $.confirm({
                            title: 'Book order was successful!',
                            content: 'Now you will be redirected to Homepage',
                            cancelButton: false,
                            confirmButton: 'OK',
                            confirmButtonClass: 'btn-success',
                            autoClose: 'confirm|10000',
                            closeIcon: false,
                            confirm: function(){
                                window.location = '/';
                            }
                        })
                    })
                    .fail(function () {
                        $.confirm({
                            icon: 'fa fa-warning',
                            title: 'Warning!',
                            content: 'Something goes wrong. Try again later',
                            cancelButton: false,
                            confirmButton: 'OK',
                            confirmButtonClass: 'btn-danger',
                            autoClose: 'confirm|10000',
                            animationBounce: 2.5,
                            closeIcon: false,
                            confirm: function(){
                                window.location = '/';
                            }
                        })
                    });
            },
            cancel: function(){
            }
        });
    });

    $('.cancel-and-order').click(function(e) {

        e.preventDefault();
        $.confirm({
            confirmButton: 'OK',
            cancelButton: 'No!',
            title: 'Hello reader!',
            content: 'If you click "OK" you will cancel your reservation and order this book',
            cancelButtonClass: 'btn-info',
            confirmButtonClass: 'btn-success',
            autoClose: 'cancel|10000',
            animationBounce: 2.5,
            confirm: function(){
                var id = $('#book-page-id').val();
                $.post( '/cancelAndOrder/'+id)
                    .success(function () {
                        $.confirm({
                            title: "Reservation was canceled successfully!",
                            content: 'Thanks for reading it!',
                            confirmButton: 'OK',
                            confirm: function(){
                                window.location = '/';
                            },
                            cancel: function(){
                            }

                        })
                    })
                    .fail(function () {
                        $.confirm({
                            icon: 'fa fa-warning',
                            title: 'Warning!',
                            content: 'Something goes wrong. Try again later',
                            cancelButton: 'Stay on this page',
                            confirmButton: 'HomePage',
                            confirmButtonClass: 'btn-success',
                            autoClose: 'confirm|10000',
                            animationBounce: 2.5,
                            closeIcon: false,
                            confirm: function(){
                                window.location = '/';
                            },
                            cancel: function(){
                            }
                        })
                    });
            },
            cancel: function(){
            }
        });
    });
});

$('#form-isbn').submit(function() {
    $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#fff'
    } });

});
$(document).ready(function() {
    var imgBookCover = $('#add-book-cover');
    if(imgBookCover.attr('src') != '')
    {
        imgBookCover.show('slow');
        $('#book_type_bookCoverByUser').removeAttr('required');

    } else {
        $('#book_type_bookCoverByUser').prop('required',true);
        $('#add-book-cover').hide();
    }
});


$('.slide-image').show('slow');
$('#form-add-book').submit(function() {
    return confirm("Click OK if you are sure you want to add this book");
});
$('.delete-action').click(function(e) {
    e.preventDefault();
    $.confirm({
        confirmButton: 'Yes',
        cancelButton: 'No!',
        icon: 'fa fa-warning',
        title: 'Warning!',
        content: 'Are you sure you want to delete this book?!',
        cancelButtonClass: 'btn-info',
        confirmButtonClass: 'btn-danger',
        animation: 'bottom',
        autoClose: 'cancel|10000',
        confirm: function(){
            window.location = $(this).attr('href');
        },
        cancel: function(){
        }
    });
});


$('#reg-info').ready(function() {

    if ($('#reg-info').html().trim()) {
        $('#reg-title').text('Sign-up');
    }
    else
    {
        $('#reg-title').text('Sign-up');
        $("#reg-info").hide();
    }
});