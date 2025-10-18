<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\{User, Transaction, Walkin, ReturnExchange};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdministratorController extends Controller
{
    public function index()
    {
        $users = User::role('customer')->get();

        return view("admin.index", compact(
            "users",
        ));
    }
}
