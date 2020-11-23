$(function(){
    $('.modal').modal();
    $('.sidenav').sidenav();
    $('input#user_id, input#name').characterCounter();
    $('.dropdown-trigger').dropdown({
        constrainWidth: false,
        coverTrigger: false,
    });
    $('.tooltipped').tooltip();
    /*
    ProgressBar.Circle($('#timer-1'), {
        color: '#555',
        trailColor: '#eee',
        strokeWidth: 10,
        duration: 2500,
        easing: 'easeInOut'
    });
    */
    $('#edit-profile').hide();
    $('#edit-button').on('click', () => {
        $('#edit-profile').toggle();
    });
    $('#cancel-edit').on('click', () => {
        $('#edit-profile').toggle();
    });

});