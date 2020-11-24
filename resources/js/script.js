const PrimaryColor = '#ee6e73';

$(function(){
    M.AutoInit();
    $('.modal').modal();
    $('.sidenav').sidenav();
    $('input#user_id, input#name').characterCounter();
    $('.dropdown-trigger').dropdown({
        constrainWidth: false,
        coverTrigger: false,
    });
    $('.tooltipped').tooltip();
    $('#edit-profile').hide();
    $('#edit-button').on('click', () => {
        $('#edit-profile').toggle();
    });
    $('#cancel-edit').on('click', () => {
        $('#edit-profile').toggle();
    });
    $('#del-button-activate').on('click', () => {
        $('#confirm-del').toggleClass('disabled');
    });

    const timer = new ProgressBar.Circle('#timer-1', {
        color: PrimaryColor,
        trailColor: '#eee',
        strokeWidth: 10,
        duration: 2500,
        easing: 'easeInOut'
    });
    timer.animate(1);

});