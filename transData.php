<?php
use Illuminate\Support\Collection;

require __DIR__ . '/vendor/autoload.php';

error_reporting(~E_NOTICE);

$transData = [
    [
        'company' => 1,
        'class'   => 2,
        'type'    => 3,
    ],
    [
        'company' => 3,
        'class'   => 2,
        'type'    => 4,
    ],
    [
        'company' => 1,
        'class'   => 3,
        'type'    => 3,
    ],
    [
        'company' => 1,
        'class'   => 2,
        'type'    => 4,
    ],
    [
        'company' => 3,
        'class'   => 4,
        'type'    => 4,
    ],
];

$company = [
    ['id' => 1, 'name' => '科科', 'name_en' => 'kerker'],
    ['id' => 2, 'name' => 'htㄈ', 'name_en' => 'htc'],
    ['id' => 3, 'name' => '哈哈', 'name_en' => 'haha'],
    ['id' => 4, 'name' => '錢尼', 'name_en' => 'sony'],
];

$class = [
    ['id' => 1, 'name' => '類別1', 'name_en' => 'class1'],
    ['id' => 2, 'name' => '類別2', 'name_en' => 'class2'],
    ['id' => 3, 'name' => '類別3', 'name_en' => 'class3'],
    ['id' => 4, 'name' => '類別4', 'name_en' => 'class4'],
];

$type = [
    ['id' => 1, 'name' => '類型1', 'name_en' => 'type1'],
    ['id' => 2, 'name' => '類型2', 'name_en' => 'type2'],
    ['id' => 3, 'name' => '類型3', 'name_en' => 'type3'],
    ['id' => 4, 'name' => '類型4', 'name_en' => 'type4'],
];

$transCollection = new Collection($transData);

$companyCollection = (new Collection($company))->filter(function ($company) use ($transCollection) {
    return $transCollection->contains(function ($item) use ($company) {
        return $item['company'] == $company['id'];
    });
});

// 這個方法應該寫成一個 class method
function filteredById($metaKey, $meta, $trans) {
    $metaCollection = ($meta instanceof Collection ) ? $meta : new Collection($meta);
    $transCollection = ($trans instanceof Collection ) ? $trans : new Collection($trans);

    return $metaCollection
        ->filter(function ($resource) use ($transCollection, $metaKey) {
            return
                $transCollection->contains(function ($transItem) use ($resource, $metaKey) {
                    return $transItem[$metaKey] == $resource['id'];
                });
        })
        ->toArray();
}

$companyRet1 = $companyCollection->toArray();
$companyRet2 = filteredById('company', $company, $transData);

var_dump($companyRet1);
var_dump($companyRet2);
var_dump($companyRet1 == $companyRet2); // true

$resources = [
    'company' => $company,
    'class'   => $class,
    'type'    => $type,
];

$finalResult = (new Collection($resources))->map(function($meta, $metaKey) use ($transData) {
    return filteredById($metaKey, $meta, $transData);
})->toArray();

print_r($finalResult);