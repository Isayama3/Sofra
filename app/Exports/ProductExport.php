<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    protected $model;
    public function __construct()
    {
        $this->model = new Product();
    }
    public function headings():array
    {
        return [
            'name',
            'price',
            'offer_price',
            'time',
            'description',
            'pic',
            'category',
            'restaurant'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->model->getProducts());
    }
}
