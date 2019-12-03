import flask_login
from flask import Flask, render_template, request, redirect, url_for

app = Flask(__name__)
app.secret_key = 'CQ9fKR7U3HJ6YR99ZDDru72RVudpsy'  # 適当

login_manager = flask_login.LoginManager()
login_manager.init_app(app)

users = {
    'admin@admin.jp': {
        'secure'
    }
}


class User(flask_login.UserMixin):
    pass


@login_manager.user_loader
def user_loader(email):
    if email not in users:
        return

    user = User()
    user.id = email
    return user


@login_manager.request_loader
def request_loader(request):
    email = request.form.get('email')
    if email not in users:
        return

    user = User()
    user.id = email

    # DO NOT ever store passwords in plaintext and always compare password
    # hashes using constant-time comparison!

    user.is_authenticated = request.form['password'] == users[email]['password']

    return user


default = {
    'build_route': '/static/build',
    'site_info': {
        "title": "岳会"
    }
}


@app.route('/login', methods=['GET', 'POST'])
def login():
    tag = 'login'

    if request.method == 'GET':
        return render_template('login.html', default=default, tag=tag)


    email = request.form['email']

    if email in users:
        if request.form['password'] in users[email]:
            user = User()
            user.id = email
            flask_login.login_user(user)
            return redirect(url_for('protected'))
        else:
            return render_template('login.html', default=default, tag=tag)
    else:
        return render_template('login.html', default=default, tag=tag)



@app.route('/protected')
@flask_login.login_required
def protected():
    tag = 'protected'

    login_user = flask_login.current_user.id
    #return 'Logged in as ' + flask_login.current_user.id

    return render_template('protected.html', default=default, tag=tag, login_user=login_user)
@login_manager.unauthorized_handler
def unauthorized_handler():
    return redirect('/')



@app.route('/')
def index():
    tag = 'home'
    news_list = [
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '●●山に冬季登山します！'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '遭難しました'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '●●県にあるボルダリングジムを調査！'
        }
    ]

    return render_template('index.html', default=default, tag=tag, news_list=news_list)


@app.route('/news')
def news():
    under = '/'
    tag = 'news'
    news_list = [
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '●●山に冬季登山します！'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '遭難しました'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '●●県にあるボルダリングジムを調査！'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '●●山に冬季登山します！'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '遭難しました'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '●●県にあるボルダリングジムを調査！'
        }
    ]

    return render_template('news.html', default=default, tag=tag, under=under, news_list=news_list)


@app.route('/report')
def report():
    under = '/'
    tag = 'report'
    news_list = [
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '●●山に冬季登山します！'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '遭難しました'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '●●県にあるボルダリングジムを調査！'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '●●山に冬季登山します！'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '遭難しました'
        },
        {
            'cat': 'お知らせ',
            'date': '2019.00.00',
            'title': '●●県にあるボルダリングジムを調査！'
        }
    ]

    return render_template('report.html', default=default, tag=tag, under=under, news_list=news_list)


if __name__ == '__main__':
    app.debug = True
    # キャリアテザリング
    # app.run(host='172.20.10.3' , port=8080)
    # ローカル
    app.run(host='127.0.0.1', port=8080)
