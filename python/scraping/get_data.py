import urllib.request, urllib.error
from bs4 import BeautifulSoup

import config
url = config.init()

html = urllib.request.urlopen(url)
soup = BeautifulSoup(html, 'html.parser')

div = soup.find_all('div')

array = []

for tag in div:
    try:
        id = tag.get('id')
        if id == 'kenkyu_box':
            img = tag.find('img')
            array.append(img['src'])
    except:
        pass

for val in array:
    val = val + '\n'
    file = open('./result.txt', 'a')
    file.write(val)
    file.close