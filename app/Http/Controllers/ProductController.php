<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class ProductController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Product();
    }
    public function exportExcel()
    {
        return Excel::download(new ProductExport, 'productsList.xlsx');
    }

    public function exportCsv()
    {
        return Excel::download(new ProductExport, 'productsList.csv');
    }

    public function generatePdf()
	{
		$data = $this->model->first() ;
		$pdf = PDF::loadView('pdf.product', ['data'=>$data]);
		return $pdf->stream('products.pdf');
	}

    public function importExcel(Request $request)
    {
        Excel::import(new ProductImport(), $request->file('productsList'));

        return redirect('/')->with('success', 'All good!');
    }

//    public function importCsv()
//    {
//        return Excel::download(new ProductExport, 'productsList.csv');
//    }
}
