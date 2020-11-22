# 簡易メモ

range(n, max, range)
```
>>> for x in range(1, 10, 2):
...     print(x)
...
1
3
5
7
9
```

list

```
>>> for x in list([1, 3, 5]):
...     print(x)
...
1
3
5

>>> for x in list(range(2)):
...     print(x)
...
0
1
```

タプルとリスト
```
タプル
>>> t = 1, 2, 3
リスト
>>> a = [1, 2, 3]
```

タプルは変更不能で、リストは変更可能という違いがある。
