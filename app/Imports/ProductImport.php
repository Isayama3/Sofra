<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel,WithHeadingRow
{
    protected $model;
    public function __construct()
    {
        $this->model = new Product();
    }

    public function model(array $row)
    {
        return new Product([
            'name'          => $row['name'],
            'price'         => $row['price'],
            'offer_price'   => $row['offer_price'],
            'time'          => $row['time'],
            'description'   => $row['description'],
            'pic'           => $row['pic'],
            'category_id'   => $row['category'],
            'restaurant_id' => $row['restaurant'],
        ]);
    }
}
