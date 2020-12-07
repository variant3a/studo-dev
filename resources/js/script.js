const { functionsIn, isSet } = require("lodash")

const PrimaryColor = '#ee6e73'

$(function(){
    M.AutoInit()
    $('.modal').modal()
    $('#term-of-service').on('click', () => {
        $('#register-button').toggleClass('disabled')
    })
    $('.sidenav').sidenav()
    $('input#user_id, input#name').characterCounter()
    $('.dropdown-trigger').dropdown({
        constrainWidth: false,
        coverTrigger: false,
    })
    $('.tooltipped').tooltip()
    $('#edit-profile').hide()
    $('#edit-button').on('click', () => {
        $('#edit-profile').toggle()
    })
    $('#cancel-edit').on('click', () => {
        $('#edit-profile').toggle()
    })
    $('#del-button-activate').on('click', () => {
        $('#confirm-del').toggleClass('disabled')
    })
    $('select#minutes, select#subjects, select#select-subject-category').formSelect({
        constrainWidth: true
    })

    const timer = new ProgressBar.Circle('#timer-1', {
        color: PrimaryColor,
        trailColor: '#eee',
        strokeWidth: 5,
        duration: 100,
        easing: 'easeOutCubic',
        text: {
            value: minutes
        },
    })
    $('a.disable').on('click', () => {
        return false
    })

    isTableEmpty()
    function isTableEmpty() {
        if($('tr.records').length) {
            $('table#histories tr:first').css('visibility', 'visible')
            $('p.no-recs').text('')
        }else{
            $('table#histories tr:first').css('visibility', 'collapse')
            $('p.no-recs').text('記録はありません')
        }
    }

    $('#timer-start-button').text('スタート')
    $('#timer-end-button').text('終了')
    $('#timer-end-button').addClass('disabled')
    let pauseTime = 0
    let interval
    $('#timer-start-button').on('click', () => {
        if($('select#minutes').val() == null) {
            M.toast({html: '時間を選択してください'})
            return false
        }
        let minutes = 1 / ($('#minutes').val() * 60) + pauseTime
        $('#timer-start-button').toggleClass('started')
        if($('#timer-end-button').hasClass('disabled')) $('#timer-end-button').toggleClass('disabled')
        if(!$('.select-dropdown').prop('disabled')) $('.select-dropdown').prop('disabled', true)
        $('.sidenav-fixed li a').css('pointer-events', 'none').css('color', 'lightgray')
        $('a.disabled').on('click', () => {
            console.log('link pressed')
            return false
        })
        if(pauseTime == 0) {
            const date = new Date()
            startedAt = Math.floor(date.getTime() / 1000)
            console.log(startedAt)
            subject = $('select#subjects').val()
            console.log(subject)
        }

        if($('#timer-start-button').hasClass('started')) {
            function onTimerStarted() {
                timer.animate(minutes)
                minutes += 1 / ($('#minutes').val() * 60)
                console.log(minutes)
                pauseTime = minutes   
                if(timer.value() >= 1) {
                    onTimeIsUp()
                    M.toast({html: 'タイマーが終了しました'})
                }
            }

            console.log('start')
            $('#timer-start-button').text('ストップ')
            onTimerStarted() //require once
            interval = setInterval(onTimerStarted, 1000)
        }else{
            console.log('stop')
            $('#timer-start-button').text('再開')
            clearInterval(interval)
        }

    })
    function onTimeIsUp() {
        console.log('clear')
        $('#timer-start-button').text('スタート')
        if($('#timer-start-button').hasClass('started')) $('#timer-start-button').toggleClass('started')
        if(!$('#timer-end-button').hasClass('disabled')) $('#timer-end-button').toggleClass('disabled')
        $('.sidenav-fixed li a').css('pointer-events', 'auto').css('color', 'black')
        if($('.select-dropdown').prop('disabled')) $('.select-dropdown').prop('disabled', false)

        const date = new Date()
        endedAt = Math.floor(date.getTime() / 1000)
        console.log(endedAt)

        pauseTime = 0
        clearInterval(interval)
        timer.animate(2, {
            duration: 1500,
            easing: 'easeInOutCubic'
        }, () => {
            timer.set(0)
        })
        //ajax
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/timer',
            type: 'POST',
            data: {
                'started_at': startedAt,
                'ended_at': endedAt,
                'subject_name': subject
            },
            async: false
        })
        .done((data, timer, response) => {
            M.toast({html: '記録を保存しました'})
            const startTime = moment(startedAt * 1000).format("MM-DD HH:mm")
            const endTime = endedAt - startedAt
            const responseId = response.responseJSON.id
            $('table#histories tr:first').after('<tr class="records" data-id="' + responseId + '"><td>' + startTime + '</td><td>' + subject + '</td><td>' + sec2time(endTime) + '</td><td><button type="submit" class="waves-effect waves-light btn-flat"><i class="material-icons">delete</i></button></td></tr>')
            isTableEmpty()
        })
        .fail((data) => {
            M.toast({html: 'エラーが発生しました'})
        })

    }
    $('#timer-end-button').on('click', () => {
        onTimeIsUp()
    })
    $('button#rec-del-btn').on('click', () => {
        const recordId = $('button#rec-del-btn').val()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/timer',
            type: 'POST',
            data: {
                '_method': 'DELETE',
                'id': recordId
            }
        })
        .done((data) => {
            M.toast({html: '削除しました'})
            $('button#rec-del-btn').parents('td').parents('tr[data-id="' + recordId + '"]').remove()
            isTableEmpty()
        })
        .fail((data) => {
            M.toast({html: 'エラーが発生しました'})
        })
    })

    function sec2time(timeInSeconds) {
        var pad = function(num, size) { return ('000' + num).slice(size * -1); }
        time = parseFloat(timeInSeconds).toFixed(3)
        hours = Math.floor(time / 60 / 60)
        minutes = Math.floor(time / 60) % 60
        seconds = Math.floor(time - minutes * 60)
    
        return pad(hours, 2) + ':' + pad(minutes, 2) + ':' + pad(seconds, 2);
    }
})