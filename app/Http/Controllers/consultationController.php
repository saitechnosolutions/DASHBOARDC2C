<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\consultantDataTable;
use App\Models\Consultant;
use Illuminate\Support\Facades\DB;

class consultationController extends Controller
{
    //
    public function index(consultantDataTable $dataTable)
{
    return $dataTable->render('pages.color_consultant');
}
public function getCategories() {
    return datatables()->eloquent( Consultant::query() )->toJson();
}
}