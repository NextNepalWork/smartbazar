<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function tax_report(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.report.tax_report');

        }
        if ($request->isMethod('post')) {

        }
        return false;
    }
}
