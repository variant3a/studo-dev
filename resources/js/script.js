$(function(){
    $('.modal').modal();
    $('.sidenav').sidenav();
    $('.dropdown-trigger').dropdown({
        constrainWidth: false,
        coverTrigger: false,
    });

    let timer = new Chart($('#timer'), {
        type: 'doughnut',
        data: {
            datasets: {
                data: 15,
            },
        },
        options: '',
    });

});