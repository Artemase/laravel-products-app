<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use Illuminate\Routing\Controller;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function export(Request $request)
    {
        $limit = $request->input('limit', 10000);
        return Excel::download(new ProductsExport($limit), 'products.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return redirect()->route('home')->with('success', 'Products imported successfully.');
    }
}