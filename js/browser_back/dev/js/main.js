const cookies = document.cookie,
    cookies_array = cookies.split(';');
if(cookies_array) {
    let split = new Array(),
        judge = false,
        result = new Array();
    for(let i=0; i<cookies_array.length; i++) {
        split = cookies_array[i].split('=');
        split[0] = split[0].replace(/\s+/g, '');
        split[1] = split[1].replace(/\s+/g, '');
        result[split[0]] = split[1];

        if(split[0] == 'cookie_rwt') {
            judge = true;
        }
    }
    if(judge == true) {
        $(window).scrollTop(result['cookie_rwt']);
    }
}

$(window).on('beforeunload', function(){
    let wt = $(window).scrollTop();
    document.cookie = 'cookie_rwt=' + wt + '; path=/;';
});