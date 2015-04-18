/**
 * Created by dovius on 4/18/15.
 */


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

