<?php

namespace App\Http\Controllers;

use App\Models\FileArchive;
use App\Models\Purchase;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $purchases = Purchase::paginate(10);
        $archives = FileArchive::paginate(10);
        $pending = $purchases->where('authorized', Purchase::PENDING)->count();
        $approved = $purchases->where('authorized', Purchase::APPROVED)->count();
        $rejected = $purchases->where('approved_by_department', Purchase::REJECTED)->count();
        $userArchive = auth()->user()->purchase->count();
        $userArchiveApproved = auth()->user()->purchase->where('authorized', '=', Purchase::APPROVED)->where('approved_by_department', '=', Purchase::APPROVED)->count();
        $userArchiveRejected = auth()->user()->purchase->where('approved_by_department', '=', Purchase::REJECTED)->count();

        return view('admin.index', compact('purchases','userArchive', 'userArchiveApproved', 'userArchiveRejected', 'pending', 'approved', 'rejected', 'archives'));
    }
}
