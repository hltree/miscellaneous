#!/bin/zsh

curl -F 'mail=fakemail'  -F 'password=password' localhost:9000/send.php
