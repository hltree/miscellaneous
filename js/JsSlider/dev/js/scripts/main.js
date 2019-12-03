import Entry from "entry";
import JsSlider from "modules/JsSlider";

if (module.hot) {
  module.hot.accept();
}

const param = {
	'speed': 1,
	'time': 4000,
	'type': 'slide' // slide or fade
};

const js_slider = new JsSlider(param);
js_slider.exec();
