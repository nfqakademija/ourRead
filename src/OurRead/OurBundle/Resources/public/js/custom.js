/**
 * Created by povilas on 5/3/15.
 */

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

$('#form-add-book').submit(function() {
    return confirm("Click OK if you are sure you want to add this book");
});

