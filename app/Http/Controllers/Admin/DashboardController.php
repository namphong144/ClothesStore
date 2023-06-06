<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use File;

class DashboardController extends Controller
{
    //
    public function index()
{
    return view('admin.dashboard');
}

}