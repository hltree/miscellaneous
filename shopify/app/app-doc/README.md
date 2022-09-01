```
$ docker run --name test_shopify_app -p 3000:80 -v ${PWD}:/var/www/html -d php:8.0-apache
```
で動かせ！！

```
$ docker run --rm -p 4040:4040 --link test_shopify_app -e NGROK_PORT="test_shopify_app" -e NGROK_AUTH="27m02PDatn2fLXwW0vmQvSdzL8m_6r1XEavqunxdcGDR9dLUt" wernight/ngrok
```
で、こう！