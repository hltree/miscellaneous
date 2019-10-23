import urllib.request, urllib.error
from bs4 import BeautifulSoup

import config
url = config.init()

html = urllib.request.urlopen(url)
soup = BeautifulSoup(html, 'html.parser')

print(html)