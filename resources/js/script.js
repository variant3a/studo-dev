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
        duration: 250,
        easing: 'easeOutCubic',
        text: {
            //value: 
        },
    });
    $('a.disable').on('click', () => {
        return false;
    })

    $('#timer-start-button').text('スタート');
    $('#timer-end-button').text('終了');
    $('#timer-end-button').addClass('disabled');
    let pauseTime = 0;
    let interval;
    $('#timer-start-button').on('click', () => {
        let minutes = 1 / ($('#minutes').val() * 60) + pauseTime;
        $('#timer-start-button').toggleClass('started');
        if($('#timer-end-button').hasClass('disabled')) {
            $('#timer-end-button').toggleClass('disabled');
        }

        if($('#timer-start-button').hasClass('started')) {
            function onTimerStarted() {
                timer.animate(minutes);
                minutes += 1 / ($('#minutes').val() * 60);
                console.log(minutes);
                pauseTime = minutes;   
                if(timer.value() >= 1) {
                    onTimeIsUp();
                    M.toast({html: 'タイマーが終了しました'});
                }
            }

            console.log('start');
            $('#timer-start-button').text('ストップ');
            onTimerStarted(); //require once
            interval = setInterval(onTimerStarted, 1000);
            $('.sidenav-fixed li a').addClass('disable');
        }else{
            console.log('stop');
            $('#timer-start-button').text('再開');
            clearInterval(interval);
        }

    });
    function onTimeIsUp() {
        console.log('clear');
        $('#timer-start-button').text('スタート');
        $('#timer-start-button').toggleClass('started');
        if(!$('#timer-end-button').hasClass('disabled')) {
            $('#timer-end-button').toggleClass('disabled');
        }
        pauseTime = 0;
        clearInterval(interval);
        M.toast({html: '記録を保存しました'});
        timer.animate(2, {
            duration: 1500,
            easing: 'easeInOutCubic'
        }, () => {
            timer.set(0);
        });
        $('.sidenav-fixed li a').removeClass('disable');
        }
    $('#timer-end-button').on('click', () => {
        onTimeIsUp();
    })

});