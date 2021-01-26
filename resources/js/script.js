const PrimaryColor = '#66bb6a'
hljs.initHighlightingOnLoad()

$(() => {

    /*---------------------------------------------------*/
    /*--------------------materialize--------------------*/
    /*---------------------------------------------------*/


    M.AutoInit()

    $('input#user_id, input#name, input#password, input#password-confirm, input#add-subject-text, textarea#quiz-content, input#contact-title, textarea#contact-content').characterCounter()
    $('.dropdown-trigger').dropdown({
        constrainWidth: false,
        coverTrigger: false,
    })
    $('select').formSelect({
        dropdownOptions: {
            constrainWidth: false,
            coverTrigger: false,
        }
    })

    /*------------------------------------------------*/
    /*--------------------register--------------------*/
    /*------------------------------------------------*/

    $('#term-of-service').on('click', () => {
        $('#register-button').toggleClass('disabled')
    })

    /*-------------------------------------------------*/
    /*--------------------studo top--------------------*/
    /*-------------------------------------------------*/


    /*--------------------------------------------*/
    /*--------------------home--------------------*/
    /*--------------------------------------------*/


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
            trailColor: '#eeeeee',
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
        setTimeout(() => {
            $('.tap-target[data-target="add-note-btn"]').tapTarget('close')
        }, 3000)
    }
    $('textarea').on('keydown', (event) => {
        if (event.key == 'Tab' && !event.ctrlKey && !event.altKey && !event.shiftKey) {
            event.preventDefault()
            document.execCommand('insertText', false, '    ')
        }
    })

    /*--------------------------------------------*/
    /*--------------------quiz--------------------*/
    /*--------------------------------------------*/

    $('.tabs').tabs({
        swipeable: false
    })
    $('.my-question, .global-question').map((i, value) => {
        $(value).after('<div class="index">' + text2quiz($(value).data('value')) + '</div>')
    })
    $('.index .hidden-answer-text').map((i, value) => {
        $(value).text('Question')
    })
    $('.question').map((i, value) => {
        $(value).after('<div class="details">' + text2quiz($(value).data('value')) + '</div>')
    })
    let answersArray = []
    $('.details .hidden-answer-text').map((i, value) => {
        answersArray.push(escapeHtml($(value).text()))
        $('#answer-list').append('<div>Q.' + (i + 1) + ' = ' + escapeHtml($(value).text()) + '</div>')
        $(value).text('Q.' + (i + 1))
    })
    $('.hidden-answer-text').css('color', PrimaryColor)
    $('#show-answer-btn').toggleClass('hide-answer')
    $('#answer-container').hide()
    if($('#answer-container').data('count') != 0) {
        $('#show-answer-btn').on('click', () => {
            $('#answer-container').stop(true, false).slideToggle(250)
        })
    } else {
        $('#show-answer-btn').addClass('disabled').text('正解はありません')
        $('#answer-quiz-btn').addClass('disabled')
        $('#answer-input-container').hide()
    }

    function text2quiz(text) {
        text = nl2br(escapeHtml(text))
        const sbrkt = text.search(/\[/)
        const ebrkt = text.search(/\]/)
        const head = (text.match(/\[/g) || []).length
        const tail = (text.match(/\]/g) || []).length
        if(sbrkt < ebrkt && head == tail) {
            text = text.replace(/\[/g, '[<span class="hidden-answer-text">')
            text = text.replace(/\]/g, '</span>]')
        } else {
            text = text.replace(/[\[\]]/g, '')
        }
        return text
    }

    if($('#no-quizzes-text').length != 0) {
        $('.tap-target[data-target="add-quiz-btn"]').tapTarget('open')
        setTimeout(() => {
            $('.tap-target[data-target="add-quiz-btn"]').tapTarget('close')
        }, 3000)
    }

    for(let i = 0, d = $('#answer-container').data('count'); i < d ;i++) {
        $('#answer-input').append('<div class="col s12 m6"><div class="input-field"><input class="answer-input" id="answer-input-' + (i + 1) + '" type="text" autocomplete="off"><label ="answer-input-' + (i + 1) + '">Q.' + (i + 1) + '</label></div></div>')
    }
    $('#answer-result').hide()
    let collectOrFail = []
    $('#answer-quiz-btn').on('click', () => {
        let isAnswerInputEmpty

        $('.answer-input').map((i, value) => {
            if($('#answer-input-' + (i + 1)).val() == '') {
                M.toast({html: 'Q.' + (i + 1) + 'の項目が未入力です'})
                isAnswerInputEmpty = true
            }
            if(escapeHtml($('#answer-input-' + (i + 1)).val()) == answersArray[i]) {
                collectOrFail[i] = true
            } else {
                collectOrFail[i] = false
            }
        })
        $('.answer-input').map((i, value) => {
            if(collectOrFail[i]) {
                $('#exp-of-question').append('<div class="col s12"><h6 class="green-text">Q.' + (i + 1) + ': 正解!</h6><p>Q.' + (i + 1) + 'の答えは' + answersArray[i] + 'でした。</p></div>')
            } else {
                $('#exp-of-question').append('<div class="col s12"><h6 class="red-text">Q.' + (i + 1) + ': 不正解</h6><p>もう一度挑戦してみよう。</p></div>')
            }
        })
        $('#exp-of-question').append('<div class="col s12"><p><a href=""><i class="material-icons left">refresh</i>もう一度やってみる</a></p></div>')
        $('#answer-input-container').stop(true, false).slideUp(250)
        $('#answer-result').stop(true, false).slideDown(250)
        $('#show-answer-btn').addClass('disabled')
        $('#answer-quiz-btn').addClass('disabled')
        const final_result = collectOrFail.every((val, index, array) => {
            return (val)
        })
        console.log(final_result)
        const quiz_id = $('.quiz-id').val()
        if (!isAnswerInputEmpty) {
            $.ajax ({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/user/quiz/' + quiz_id + '/details',
                type: 'POST',
                data: {
                    'final_result': final_result
                }
            })
            .done((data, responce) => {
                console.log(data)
                M.toast({html: '回答を保存しました'})
            })
            .fail((data) => {
                M.toast({html: 'エラーが発生しました'})
            })
        }
    })

    $('.filter-card').hide()

    function toggleFilterCard() {
        $('.filter-card').stop(true, false).slideToggle(250)
    }

    function escapeHtml(string) {
        if(typeof string !== 'string') return string
        string = string.replace('&', '&amp;')
            .replace(/'/g, '&#x27;')
            .replace(/`/g, '&#x60;')
            .replace(/"/g, '&quot;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
        return string
    }

    function nl2br(str) {
        str = str.replace(/\r\n/g, "<br>")
            .replace(/(\n|\r)/g, "<br>")
        return str
    }

    /*---------------------------------------------*/
    /*--------------------other--------------------*/
    /*---------------------------------------------*/

    function copyToClipboard(target) {
        const text = $(target)
        navigator.clipboard.writeText(text)
        .then(() => {
            M.toast({html: 'クリップボードにURLをコピーしました'})
        })
        .catch(err => {
            M.toast({html: '問題が発生しました。URLをコピーできませんでした'})
        })
    }
})