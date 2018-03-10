<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use willvincent\Rateable\Rateable;
use App\Shop;
class Product extends Model
{


    use SearchableTrait;
    use Rateable;

    protected $fillable = [
        'mainCatId','secondCatId','thirdCatId','fourthCatId', 'ownerId','productName',
        'productCode','discount', 'oldPrice', 'newPrice','sizeId','tagsId','priColorId',
        'secColorId','productVideo','materialsIds','shortDes','details','giftTypeId','status',
    ];

    protected $searchable = [
        'columns' => [
            'products.productName' => 10,
            'products.shortDes' => 10,
            'products.details' => 10,
            'products.productCode' => 3,
//            'shops.shopName' => 10,

        ],
//        'joins' => [
//            'products' => ['products.ownerId','shops.id'],
//        ],
    ];

//    public function shop()
//    {
//        return $this->hasOne(Shop::class);
//    }
}
