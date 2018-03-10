<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DorponAssociateController extends Controller
{
    public function view(){
        return view('admin.helper.dorponAssociate');
    }
}
