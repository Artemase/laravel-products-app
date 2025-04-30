<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $category = Category::firstOrCreate(['name' => $row['category']]);

        return new Product([
            'name' => $row['name'],
            'category_id' => $category->id,
            'price' => $row['price'],
        ]);
    }
}