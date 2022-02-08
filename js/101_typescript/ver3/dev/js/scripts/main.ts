import BrowserDetect from "./modules/BrowserDetect";
import SmoothScroll from "./modules/SmoothScroll";
import SpNavi from "./modules/SpNavi";
import ToggleToTop from "./modules/ToggleToTop";
import SetLinkClasses from "./modules/SetLinkClasses";
import MatchMedia from "./modules/MatchMedia";

/**
 * ブラウザ判定用のクラスを設定する
 */
new BrowserDetect();

/**
 * 外部リンクに自動_blank付与
 */
new SetLinkClasses();

/**
 * 画面幅判定
 */
//必要に応じてパラメータをコンストラクタに渡すと、キー指定でメディアクエリにマッチしているかを判定できる
//初期値
// {
//   sm : 640,
//   md : 768,
//   lg : 1024,
//   xl : 1280
// }
const mm = new MatchMedia();
// console.log(mm.is('sm'));
// console.log(mm.is('md'));
// console.log(mm.is('lg'));
// console.log(mm.is('xl'));

/**
 * totopボタンをフッター直前で止める
 */
new ToggleToTop();

/**
 * spナビ
 */
new SpNavi();
/**
 * スムーススクロール
 */
new SmoothScroll();

/**
 * 投稿を取得してひょうじするやつ
 */
const postWrapper = document.querySelector('.posts')
if (null !== postWrapper) {
	fetch('https://s1.demo.opensourcecms.com/wordpress/wp-json/wp/v2/posts')
		.then((response) => {
			return response.json()
		})
		.then((jsonData) => {
			jsonData.forEach((post) => {
				const title = document.createElement('summary')
				title.textContent = post.title.rendered
				title.classList.add('title')

				const content = document.createElement('div')
				content.textContent = striptags(post.content.rendered).slice(0, 100) + '...'
				content.classList.add('content')

				if (title && content) {
					const details = document.createElement('details')
					details.classList.add('post')
					details.append(title, content)
					title.addEventListener('click', () => {
						title.classList.add('show')
					})
					postWrapper.append(details)
				}
			})
		})
}


import striptags from "striptags";
import validUrl from 'valid-url'

interface Params {
	url: string,
	wrapperElementName: string
}

class PostListError extends Error {}

class PostList {
	private callBack: Function | null = null
	private url: string | null = null
	private wrapperElement: HTMLElement | null

	constructor(params: Params, callBack: null | Function = null) {
		this.url = params.url
		this.wrapperElement = document.querySelector<HTMLElement>(params.wrapperElementName)
		this.callBack = <Function>callBack

		this.checkUrl()
	}

	checkUrl() {
		if (!validUrl.isUri(this.url)) {
			throw new PostListError()
		}
	}

	getCallBack(): Function | null {
		return this.callBack
	}

	getUrl(): string | null {
		return this.url
	}

	getWrapperElement(): HTMLElement | null {
		return this.wrapperElement
	}
}

const ClassPostList = new PostList({
	url: 'aaa',
	wrapperElementName: 'eee'
})


if (module.hot) {
	module.hot.accept();
}
