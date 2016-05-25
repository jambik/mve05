<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;

class FuelTicketController extends BackendController
{
    public function showForm()
    {
        return view('admin.fuel_tickets.form');
    }
}
