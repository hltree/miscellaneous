// moduleの読み込みはindexのほうで

const error = $('.error-kun'),
    inner = $('.inner'),
    half_margin_x = (inner.width() - error.width()) / 2,
    half_margin_y = (inner.height() - error.height()) / 2;

if($('body').hasClass('mode-rotate')) {
    TweenMax.staggerTo(error, .1, {rotation:360, repeat: -1});

    const move_error = () => {
        let x = Math.floor(((Math.random() * 2) - 1) * half_margin_x),
            y = Math.floor(((Math.random() * 2) - 1) * half_margin_y);
        TweenMax.to(error, 1, {x:x, y:y, onComplete: () => {
                move_error();
            }});
    };

    move_error();
}