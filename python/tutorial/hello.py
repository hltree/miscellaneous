
class Hello():
    def __init__(self, name):
        if name:
            print('Hello! ' + name + '!');
        else:
            print('Not name...');

Hello('kiona');

class init():
    def __init__(self, *args, **kwargs):
        super(CLASS_NAME, self).__init__(*args, **kwargs)
