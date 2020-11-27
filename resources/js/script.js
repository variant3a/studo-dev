const { functionsIn } = require("lodash");

const PrimaryColor = '#ee6e73';

$(function(){
    M.AutoInit();
    $('.modal').modal();
    $('#term-of-service').on('click', () => {
        $('#register-button').toggleClass('disabled');
    })
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
        duration: 1000,
        easing: 'linear',
        text: {
            //value: 
        },
    });

    $('#timer-start-button').text('スタート');
    $('#timer-end-button').text('終了');
    $('#timer-end-button').addClass('disabled');
    let pauseTime = 0;
    $('#timer-start-button').on('click', () => {
        $('#timer-start-button').toggleClass('counting');
        if($('#timer-start-button').hasClass('counting')) {
            console.log('#timer-start-button has pressed. status: begun');
            setInterval(onTimerStarted(), 1000);
        }else{
            console.log('#timer-start-button has pressed. status: paused');
            onTimerPaused();
        }
    });
    $('#timer-end-button').on('click', () => {
        $('#timer-start-button').text('スタート');
        $('#timer-end-button').toggleClass('disabled');
        pauseTimer();
        resetTimer();
    })

    function onTimerStarted() {
        isStarted = 1;
        timer.animate(minutes);
        minutes += minutes;
        console.log(minutes);
    }

    function onTimerPaused() {
        pauseTime = minutes;
        clearInterval(onTimerStarted());
        console.log(pauseTime);
    }

});