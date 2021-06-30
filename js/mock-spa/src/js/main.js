const switchTemplateEl = document.getElementsByClassName('js-switch-template-button')
const switchTemplateContent = document.getElementsByClassName('js-switch-template-content')
const templateDataName = 'onclick-switch-template-name';

const dataHasSwitchElement = document.querySelectorAll('[data-' + templateDataName + ']')

function rejectBrowserBack() {
  location.replace(this.replaceUrl)
}

if (
  0 < switchTemplateEl.length &&
  0 < dataHasSwitchElement.length &&
  0 < switchTemplateContent.length
) {

  switchTemplateEl[0].addEventListener('click', function () {
    const splitPathUrl = location.pathname.split('/')
    const thisData = this.getAttribute('data-' + templateDataName)

    window.removeEventListener('popstate', rejectBrowserBack)
    window.addEventListener('popstate', {
      replaceUrl: location.pathname,
      handleEvent: rejectBrowserBack
    })

    // 末尾スラッシュ対策
    if (
      splitPathUrl[splitPathUrl.length - 1] === undefined ||
      splitPathUrl[splitPathUrl.length - 1] === 0 ||
      splitPathUrl[splitPathUrl.length - 1] === null ||
      splitPathUrl[splitPathUrl.length - 1] === ''
    ) {
      splitPathUrl.pop();
    }
    splitPathUrl[splitPathUrl.length - 1] = thisData

    const historyChangeUrl = splitPathUrl.join('/')
    history.pushState(null, null, historyChangeUrl)

    for (var i = 0; i < switchTemplateContent.length; i++) {
      thisData === switchTemplateContent[i].getAttribute('data-' + templateDataName) ? switchTemplateContent[i].classList.remove('none') : switchTemplateContent[i].classList.add('none')
    }
  })
}
