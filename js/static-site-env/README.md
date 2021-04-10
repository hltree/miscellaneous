# Static Site Env

## About

Static site environment

## Requirements

Node v13.5<br />
yarn v1.17.3

## Installation

```
$ yarn install

or

$ npm install
```

## Usage

run dev-server

```
$ yarn start

or

$ npm run start
```

build

```
$ yarn build

or

$ npm run build
```

## Documentation

CSS設計には[flocss](https://github.com/hiloki/flocss)を採用。
<br />
<br />
CSSの命名規則は{flocss接頭辞 + キャメルケース}とする。
<br />
ex: c-spnavi
<br />
<br />
JSに利用するクラスの命名は{js-$fooo}とする。また、このクラスに基本的にスタイルは当てない。

