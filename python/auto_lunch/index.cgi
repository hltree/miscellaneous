#!/home/oikaze-test-sv2/.pyenv/versions/flask_peewee_3.6.4/bin/python

import cgitb
cgitb.enable()


from wsgiref.handlers import CGIHandler
from app import app

#cd ./get_data
#scrapy crawl get_data_spider -t json --nolog -o -> "./data.json"
#cd ../


CGIHandler().run(app)