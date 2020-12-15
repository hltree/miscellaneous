const block = $('.block');

block.each(function () {
    let top = Math.floor(Math.random() * 100),
        left = Math.floor(Math.random() * 100);

    $(this).css({
        'position': 'absolute',
        'left': left + '%',
        'top': top + '%'
    });

    if ($(this).hasClass('js-radial-gradient')) {
        $(this).css('background', 'radial-gradient(circle at center, red 0, blue, green 100%)');

        let x = 0,
            trans_color = () => {
                TweenMax.to($(this), .1, {
                    css: {'background': 'radial-gradient(circle at center, red ' + x + '%, blue, green 100%)'},
                    onComplete: () => {
                        if (x == 100) {
                            x = 0;
                        }
                        x++;
                        trans_color();
                    }
                });
            };
        trans_color();
    } else if ($(this).hasClass('js-rotate')) {
        TweenMax.to($(this), 2, {rotation: 360, ease: Power0.easeNone, repeat: -1});
    } else if ($(this).hasClass('js-scale')) {
        TweenMax.to($(this), 2, {
            scale: 1.5, repeat: -1
        });
    }
});