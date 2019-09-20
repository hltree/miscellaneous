# freString

## About

パスくわせたら単語の出現頻度出してくれるだけ

## Requirement

Pipenv v2018.11.26
python v3.6.7

## SetUp

```
$ pipenv install
```

## Usage

```
// read file
$ pipenv run rf ${target_file}
$ pipenv run rd ${dir}${target_file}

ex:

$ pipenv run rf ./index.html
$ pipenv run rd ./dir/*.html
```