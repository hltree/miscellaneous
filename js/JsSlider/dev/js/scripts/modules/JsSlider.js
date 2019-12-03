/*
* JsSlider
* Needle: JQuery
*/

export default class JsSlider {
	constructor ({
					 speed = 1,
					 time = 4000,
					 type = 'slide'
				 }){
		this.speed = speed;
		this.time = time;
		this.type = type;
	}
	exec() {
		const speed = this.speed,
			time = this.time,
			type = this.type,
			slider = $('.js-Slider');

		define_slider(type);



		function define_slider(type) {
			if(slider.length > 0) {
				$(slider).each(function () {
					let _this = $(this),
						slide_data = {
							'slider': $(_this),
							'slider_inner': $(_this).find('.js-Slider-inner'),
							'slide_wrap': $(_this).find('.js-Slider-wrap'),
							'slides': $(_this).find('.js-Slider-slide'),
							'prev': $(_this).find('.js-Slider-btn._prev'),
							'next': $(_this).find('.js-Slider-btn._next')
						},
						size = get_slide_size(slide_data);
					set_slider_property(slide_data, size);
					move_slide(slide_data, size, type);
				});
			}
		}

		function get_slide_size(slide_data) {
			let slides_array = [],
				slides_height = [],
				slides_width = [];
			$(slide_data['slides']).each(function(){
				slides_height.push($(this).outerHeight());
				slides_width.push($(this).outerWidth());
			});

			slides_array.push(slides_height);
			slides_array.push(slides_width);
			return slides_array;
		}

		function move_slide(slide_data, size, type) {
			let length = size[1].length,
				transNum = 0,
				i = 0,
				width = 0;

			size[1].forEach(function(v){
				width += v;
			});

			move_on();

			function move_on() {
				let parent_w = $(slide_data['slider_inner']).width(),
					loop = setTimeout(move_on, time);

				if(i != 0) {
					transNum = transNum - size[1][i];
				}
				if(parent_w > width + transNum) {
					clearTimeout(loop);
					return move_slide(slide_data, size);
				}

				slide_data['slides'].removeClass('_is-active');
				slide_data['slides'].eq(i).addClass('_is-active');
				slide_data['slide_wrap'].css('transform', 'translateX(' + transNum + 'px)');

				$(slide_data['prev']).on('click', function(){
					if(i == 0) {
						i = length;
						transNum = transNum - size[1][i];
					}else{
						i--;
						transNum = transNum - size[1][i];
					}
					slide_data['slides'].removeClass('_is-active');
					slide_data['slides'].eq(i).addClass('_is-active');
					slide_data['slide_wrap'].css('transform', 'translateX(' + transNum + 'px)');
				});

				i++;
				if(i <= length) {
					return loop;
				}else{
					clearTimeout(loop);
					return move_slide(slide_data, size, type);
				}
			}
		}

		function set_slider_property(slide_data, size) {
			let height = 0,
				width = 0,
				i = 0,
				length = size[1].length;

			while(i < length) {
				if(height < size[0][i]) {
					height = size[0][i];
				}
				width = width + size[1][i];
				i++;
			}

			$(slide_data['slider']).css({
				'position': 'relative'
			});
			$(slide_data['slider_inner']).css({
				'height': height,
				'overflow': 'hidden',
				'position': 'relative'
			});
			$(slide_data['slide_wrap']).css({
				'height': '100%',
				'display': 'flex',
				'flex-wrap': 'wrap',
				'left': 0,
				'position': 'absolute',
				'top': 0,
				'transition-duration': speed + 's',
				'width': width
			});
		}
	}
}
