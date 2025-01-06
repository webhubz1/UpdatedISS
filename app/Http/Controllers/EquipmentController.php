<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function equipments(){
        return view('CET.inventory.equipment.equipment-dashboard');
    }
}
