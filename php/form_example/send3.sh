#!/bin/zsh

sha=`echo -n password | shasum -a 256 | awk '{print $1}'`
curl -F "mail=fakemail"  -F "password=password" -F "guard=${sha}" localhost:9000/send2.php
