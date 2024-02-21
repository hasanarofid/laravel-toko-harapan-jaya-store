<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_Masuk;
use App\Product_Keluar;
use Carbon\Carbon;

class LaporanController extends Controller
{
    //index 
    public function index(){
        $invoice_data = Product_Masuk::all();
        $invoice_data2 = Product_Keluar::all();
        return view('laporan.index', compact('invoice_data','invoice_data2'));
    }

    public function getFilteredData(Request $request)
{
    $tanggal = $request->input('tanggal');
    // $filteredData = Product_Masuk::whereYear('tanggal', Carbon::createFromFormat('Y-m', $tanggal)->year)
    //                              ->whereMonth('tanggal', Carbon::createFromFormat('Y-m', $tanggal)->month)
    //                              ->get();

    $query = Product_Masuk::query();
       
    if ($request->tanggal) {
        $tanggal = $request->input('tanggal');
        $startDate = Carbon::createFromFormat('Y-m', $tanggal)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $tanggal)->endOfMonth();
      
        $query->whereBetween('tanggal', [$startDate, $endDate]);
    }

    $filteredData = $query->get();

    $html = '';
    $no = 1;
    foreach ($filteredData as $data) {
        $html .= '<tr>';
        $html .= '<td>'. $no++ .'</td>';
        $html .= '<td>'. $data->product->nama .'</td>';
        $html .= '<td>'. $data->supplier->nama .'</td>';
        $html .= '<td>'. $data->qty .'</td>';
        $html .= '<td>'. $data->tanggal .'</td>';
        $html .= '<td><a href="'. route('exportPDF.productMasuk', ['id' => $data->id]) .'" class="btn btn-sm btn-danger">Export PDF</a></td>';
        $html .= '</tr>';
    }

    return $html;
}

public function getFilteredData2(Request $request)
{
    $query = Product_Keluar::query();
       
    if ($request->tanggal) {
        $tanggal = $request->input('tanggal');
        $startDate = Carbon::createFromFormat('Y-m', $tanggal)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $tanggal)->endOfMonth();
      
        $query->whereBetween('tanggal', [$startDate, $endDate]);
    }

    $filteredData = $query->get();
    // dd($filteredData);

    $html = '';
    $no = 1;
    foreach ($filteredData as $data) {
        $html .= '<tr>';
        $html .= '<td>'. $no++ .'</td>';
        $html .= '<td>'. $data->product->nama .'</td>';
        $html .= '<td>'. $data->customer->nama .'</td>';
        $html .= '<td>'. $data->qty .'</td>';
        $html .= '<td>'. $data->tanggal .'</td>';
        $html .= '<td><a href="'. route('exportPDF.productMasuk', ['id' => $data->id]) .'" class="btn btn-sm btn-danger">Export PDF</a></td>';
        $html .= '</tr>';
    }

    return $html;
}
}
