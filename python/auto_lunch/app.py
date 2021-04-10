import random
from flask import Flask, render_template, request, redirect

app = Flask(__name__)

default = {
    'assets_path': '/templates/assets',
    'site_info': {
        'title': '自動ランチ選択'
    }
}


import get_data



@app.route('/')
def index():
    select_data = [
        {
            'name': '和食'
        },
        {
            'name': '洋食'
        },
        {
            'name': '中華'
        }
    ]

    return render_template('index.html', default=default, select_data=select_data)


@app.route('/result', methods=["GET", "POST"])
def result():
    select_data = request.form['select']


    result_data = get_data.resultData(select_data)


    result_data = random.choice(result_data)

    if request.method == 'GET':
        return redirect('/')
    else:
        return render_template('result.html', default=default, result_data=result_data)


if __name__ == '__main__':
    app.debug = True
    app.run()
