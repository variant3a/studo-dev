const { functionsIn } = require("lodash");

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
        duration: 1000,
        easing: 'linear',
        text: {
            //value: 
        },
    });

    $('#timer-start-button').text('スタート');
    $('#timer-end-button').text('終了');
    $('#timer-end-button').addClass('disabled');
    let i = 0;
    $('#timer-start-button').on('click', () => {
        $('#timer-start-button').toggleClass('counting');
        if($('#timer-start-button').hasClass('counting')) {
            if(i === 0) startTimer();
            if(i === 1) resumeTimer();
        }else{
            pauseTimer();
        }
    });
    $('#timer-end-button').on('click', () => {
        $('#timer-start-button').text('スタート');
        $('#timer-end-button').toggleClass('disabled');
        pauseTimer();
        resetTimer();
    })

    function minToSec(inPause) {
        const Sec = 1 / ($('#minutes').val() * 60);
    }

    function startTimer() {
        var timer1;
        const minToSec = 1 / ($('#minutes').val() * 60);
        i = 1;
        timer.animate(minToSec);
    }

    function pauseTimer() {
        let addOnSec = minToSec;

    }

    function resumeTimer() {

    }

    function resetTimer() {
        
    }
});