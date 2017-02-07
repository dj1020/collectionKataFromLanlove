# 將得到的資料跟內部定義比對，去生成篩選資料的 menu

* 一個有趣的 Collection 小練習題~ 謝謝 Jenny Chang
* source: <https://gist.github.com/lanlove/8d063292278a4c075c66b859d6c48ca3>

### 使用方式：

* `git clone git@github.com:dj1020/collectionKataFromLanlove.git`
* `cd collectionKataFromLanlove`
* `composer install` 為了要有 Collection 類別可以用
* `php transData.php` 可以看到結果

---

### 原始資料：

* 得到的資料

```php
    $transData = array(
        array(
            'company' => 1,
            'class' => 2,
            'type' => 3
        ),
        array(
            'company' => 3,
            'class' => 2,
            'type' => 4
        ),
        array(
            'company' => 1,
                'class' => 3,
                'type' => 3
        ),
        array(
            'company' => 1,
            'class' => 2,
            'type' => 4
        ),
        array(
            'company' => 3,
            'class' => 4,
            'type' => 4
        )
    )
```

* MetaData

```php
$company = array(
        array('id' => 1, 'name' => '科科', 'name_en' => 'kerker'),
        array('id' => 2, 'name' => 'htㄈ', 'name_en' => 'htc'),
        array('id' => 3, 'name' => '哈哈', 'name_en' => 'haha'),
        array('id' => 4, 'name' => '錢尼', 'name_en' => 'sony'),
);

$class = array(
        array('id' => 1, 'name' => '類別1', 'name_en' => 'class1'),
        array('id' => 2, 'name' => '類別2', 'name_en' => 'class2'),
        array('id' => 3, 'name' => '類別3', 'name_en' => 'class3'),
        array('id' => 4, 'name' => '類別4', 'name_en' => 'class4')
);

$type = array(
        array('id' => 1, 'name' => '類型1', 'name_en' => 'type1'),
        array('id' => 2, 'name' => '類型2', 'name_en' => 'type2'),
        array('id' => 3, 'name' => '類型3', 'name_en' => 'type3'),
        array('id' => 4, 'name' => '類型4', 'name_en' => 'type4')
);
```

---

### 預期結果：

```php
$result = array(
    'company' => array(
        array('id' => 1, 'name' => '科科', 'name_en' => 'kerker'),
        array('id' => 3, 'name' => '哈哈', 'name_en' => 'haha')
    ),
    'class' => array(
        array('id' => 2, 'name' => '類別2', 'name_en' => 'class2'),
        array('id' => 3, 'name' => '類別3', 'name_en' => 'class3'),
        array('id' => 4, 'name' => '類別4', 'name_en' => 'class4')
    ),
    'type' => array(
        array('id' => 3, 'name' => '類型3', 'name_en' => 'type3'),
        array('id' => 4, 'name' => '類型4', 'name_en' => 'type4')
    ),
)
```
