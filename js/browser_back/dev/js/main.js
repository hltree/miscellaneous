const retentionWP_cookie = document.cookie.indexOf('cookie_rwt');
if(retentionWP_cookie) {
    $(window).scrollTop(retentionWP_cookie);
}

$(window).on('beforeunload', function(){
    let wt = $(window).scrollTop();
    document.cookie = 'cookie_rwt=' + wt + '; path=/;';
});