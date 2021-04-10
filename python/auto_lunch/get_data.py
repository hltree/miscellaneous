from urllib.request import urlopen
from bs4 import BeautifulSoup
import os

def resultData(select):


    if select == '和食':
        url = 'https://r.gnavi.co.jp/area/aream3416/japanese/lunch/'
    elif select == '洋食':
        url = 'https://r.gnavi.co.jp/area/aream3416/continental/lunch/'
    elif select == '中華':
        url = 'https://r.gnavi.co.jp/area/aream3416/chinese/lunch/'



    target = urlopen(url)
    bs = BeautifulSoup(target.read(), 'html.parser')

    items = bs.find_all(class_='result-cassette__item')


    data = []

    for item in items:
        add_data = {}

        item_name = item.find(class_='result-cassette__box-title').get_text()
        item_url = item.find(class_='result-cassette__box-title').get('href')

        add_data['name'] = item_name
        add_data['url'] = item_url
        data.append(add_data)


    return data