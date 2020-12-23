const { indexOf } = require("lodash")

const PrimaryColor = '#66bb6a'
hljs.initHighlightingOnLoad()

$(() => {
    M.AutoInit()

    /*------------------------------------------------*/
    /*--------------------register--------------------*/
    /*------------------------------------------------*/

    $('#term-of-service').on('click', () => {
        $('#register-button').toggleClass('disabled')
    })
    $('input#user_id, input#name').characterCounter()

    /*--------------------------------------------*/
    /*--------------------home--------------------*/
    /*--------------------------------------------*/

    $('.dropdown-trigger').dropdown({
        constrainWidth: false,
        coverTrigger: false,
    })

    /*-----------------------------------------------*/
    /*--------------------profile--------------------*/
    /*-----------------------------------------------*/

    $('#edit-profile').hide()
    $('#edit-button, #cancel-edit').on('click', () => {
        $('#edit-profile').stop(true, false).slideToggle(250)
    })
    $('#del-button-activate').on('click', () => {
        $('#confirm-del').toggleClass('disabled')
    })

    /*---------------------------------------------*/
    /*--------------------timer--------------------*/
    /*---------------------------------------------*/

    $('select#minutes, select#subjects, select#select-subject-category').formSelect({
        constrainWidth: true
    })

    try {
        timer = new ProgressBar.Circle('#timer-1', {
            color: PrimaryColor,
            trailColor: '#eee',
            strokeWidth: 5,
            duration: 100,
            easing: 'easeOutCubic',
            text: {
                value: '',
                className: 'timer-count',
                style: {
                    color: PrimaryColor,
                    position: 'absolute',
                    left: '50%',
                    top: '50%',
                    padding: 0,
                    margin: 0,
                    'font-size': '2.4rem',
                    transform: {
                        prefix: true,
                        value: 'translate(-50%, -50%)'
                    }
                }
            }
        })    
    } catch (e) {
        console.log(e)
    }
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
        if(!$('a#add-subject').prop('disabled')) $('a#add-subject').prop('disabled', true)
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
            secs = ($('#minutes').val() * 60) - 0
        }

        if($('#timer-start-button').hasClass('started')) {
            function onTimerStarted() {
                timer.animate(minutes)
                timer.setText(sec2time(secs))
                minutes += 1 / ($('#minutes').val() * 60)
                secs -= 1
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
        if($('a#add-subject').prop('disabled')) $('#add-subject').prop('disabled', false)
        timer.setText('')

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
            const startTime = moment(startedAt * 1000).format("MM/DD HH:mm")
            const endTime = endedAt - startedAt
            const responseId = response.responseJSON.id
            if(subject == '') subject = '空欄'
            if(subject == 'Assembly Language') subject = 'アセンブリ言語'
            if(subject == 'FORTLAN') subject = 'フォートラン'
            $('table#histories tr:first').after('<tr class="records" data-id="' + responseId + '"><td>' + startTime + '</td><td>' + subject + '</td><td>' + sec2time(endTime) + '</td><td><button type="submit" class="waves-effect waves-red btn-flat rec-del-btn" value="' + responseId + '"><i class="material-icons">delete</i></button></td></tr>')
            isTableEmpty()
        })
        .fail((data) => {
            M.toast({html: 'エラーが発生しました'})
        })

    }
    $('#timer-end-button').on('click', () => {
        onTimeIsUp()
    })
    $(document).on('click', 'button.rec-del-btn', () => {
        const recordId = $('button.rec-del-btn').val()
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
            $('button.rec-del-btn').parents('td').parents('tr[data-id="' + recordId + '"]').remove()
            isTableEmpty()
        })
        .fail((data) => {
            M.toast({html: 'エラーが発生しました'})
        })
    })

    function sec2time(timeInSeconds) {
        var pad = function(num, size) { return ('000' + num).slice(size * -1) }
        time = parseFloat(timeInSeconds).toFixed(3)
        hours = Math.floor(time / 60 / 60)
        minutes = Math.floor(time / 60) % 60
        seconds = Math.floor(time - minutes * 60)
    
        return pad(hours, 2) + ':' + pad(minutes, 2) + ':' + pad(seconds, 2)
    }

    /*-----------------------------------------------*/
    /*--------------------notepad--------------------*/
    /*-----------------------------------------------*/

    $('.card#add-note-card').hide()
    let isAddClicked = 0
    $('a#add-note-btn i').css('transition', 'transform 0.25s')
    $('a#add-note-btn').on('click', () => {
        $('.card#add-note-card').stop(true, false).slideToggle(250)
        if(isAddClicked == 0) {
            $('a#add-note-btn').addClass('red')
            $('a#add-note-btn i').css('transform', 'rotate(135deg)')
            isAddClicked = 1
        } else {
            $('a#add-note-btn').removeClass('red')
            $('a#add-note-btn i').css('transform', 'rotate(0deg)')
            isAddClicked = 0
        }
    })
    $('#notepad-content').on('input', () => {
        $(this).val().replace(/\[/g, '<span style="color: #26c6da">[</span>')
        $(this).val().replace(/\]/g, '<span style="color: #26c6da">]</span>')
    })
    let isEditClicked = 0
    $('a#edit-note-btn i').css('transition', 'transform 0.5s')
    $('a#edit-note-btn').on('click', () => {
        $('.card#edit-note-card').stop(true, false).slideToggle(250)
        $('#no-notes-text').hide()
        if(isEditClicked == 0) {
            $('a#edit-note-btn i').css('transform', 'rotate(360deg)')
            isEditClicked = 1
        } else {
            $('a#edit-note-btn i').css('transform', 'rotate(0deg)')
            isEditClicked = 0
        }
    })
    if($('#no-notes-text').length != 0) {
        $('.tap-target[data-target="add-note-btn"]').tapTarget('open')
    }

    $('button#edit-note-btn').on('click', () => {
        //$('div.marked-body').prop('contenteditable', true)
    })

    /*--------------------------------------------*/
    /*--------------------quiz--------------------*/
    /*--------------------------------------------*/

    $('.tabs').tabs({
        swipeable: false
    })

    $('.my-question, .global-question').map((i, value) => {
        $(value).after('<div>' + text2quiz($(value).data('value')) + '</div>')
    })
    
    $('.hidden-answer-text').map((i, value) => {
        $(value).text($(value).text().replace(/./g, '？'))
    })

    function text2quiz(text) {
        const sbrkt = text.search(/\[/)
        const ebrkt = text.search(/\]/)
        const head = (text.match(/\[/g) || []).length
        const tail = (text.match(/\]/g) || []).length
        console.log(sbrkt+':'+ebrkt+':'+head+':'+tail)
        if(sbrkt < ebrkt && head == tail) {
            text = text.replace(/\[/g, '<span class="hidden-answer-text">')
            text = text.replace(/\]/g, '</span>')
        } else {
            text = text.replace(/[\[\]]/g, '')
        }
        return text
    }

    if($('#no-quizzes-text').length != 0) {
        $('.tap-target[data-target="add-quiz-btn"]').tapTarget('open')
    }

    function escape_html(string) {
        if(typeof string !== 'string') return string
        string = string.replace('&', '&amp;')
            .replace("'", '&#x27;')
            .replace('`', '&#x60;')
            .replace('"', '&quot;')
            .replace('<', '&lt;')
            .replace('>', '&gt;')
        return string
    }

    /*---------------------------------------------*/
    /*--------------------other--------------------*/
    /*---------------------------------------------*/

})