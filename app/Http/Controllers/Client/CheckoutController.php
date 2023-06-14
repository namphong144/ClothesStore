<?php

namespace App\Http\Controllers\Client;

use session;
use Carbon\Carbon;
use App\Models\Size;
use App\Models\Order;
use App\Models\Store;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderDetail;
use Darryldecode\Cart\Cart;
use App\Models\Product_Size;
use Illuminate\Http\Request;
use App\Models\ProductComment;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    //

}