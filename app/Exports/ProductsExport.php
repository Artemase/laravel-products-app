<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    protected $limit;

    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    public function collection()
    {
        return Product::with('category')
            ->take($this->limit)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category' => $product->category->name,
                    'price' => $product->price,
                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Category', 'Price'];
    }
}