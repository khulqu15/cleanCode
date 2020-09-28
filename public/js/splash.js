$(document).ready(function() {
    let start = sessionStorage.getItem('start');
    console.log(start);
    if(start === undefined || start === null ) {
        sessionStorage.setItem('start', false);
        let start = sessionStorage.getItem('start');
    } 
    if(start !== 'true') {
        console.log('tampil_splash')
        sessionStorage.setItem('start', true);
        $('.splash_screen').show();
        $('body').addClass('overflow-hidden');
        setInterval(function() {
            $('.splash_screen').fadeOut(400);
            $('body').removeClass('overflow-hidden');
        }, 9500)
    } else {
        console.log('sembunyi_splash')
        $('.splash_screen').addClass('d-none').hide();
        $('body').removeClass('overflow-hidden');
    }
});