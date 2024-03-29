<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Purchase;
use App\Models\Users;
use App\Notifications\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Collection;
use PDF;

class PurchaseController extends Controller
{
    public function create()
    {
        $departments = Department::all();
        return view("purchase.create_purchase", ['departments' => $departments]);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'description' => ['required',],
            'specification' => ['required'],
            'project_name' => ['required'],
            'quantity' => ['required'],
            'department_id' => ['required'],
            'estimated_cost' => ['required'],
        ])->validate();
        Purchase::create([
            'description' => $request->input('description'),
            'specification' => $request->input('specification'),
            'project_name' => $request->project_name,
            'quantity' => $request->quantity,
            'user_id' => auth()->user()->id,
            'department_id' => $request['department_id'],
            'estimated_cost' => $request['estimated_cost']
        ]);
        $users = Users::where('department_id', '=', $request['department_id'])->get();
        $hrUsers = Users::where('department_id', '=', 7)->get();
        $propertyUsers=Users::where('department_id', '=', 8)->get();
        $message = "New Purchase Request is added by " . auth()->user()->name;
        foreach ($users as $notifiedUser) {
            if ($notifiedUser->hasRole('Head')) {
                $notifiedUser->notify(new PurchaseRequest($message));
            }
        }
        foreach ($hrUsers as $notifiedUser) {
            if ($notifiedUser->hasRole('Head')) {
                $notifiedUser->notify(new PurchaseRequest($message));
            }
        }
        foreach ($propertyUsers as $notifiedUser) {
            if ($notifiedUser->hasRole('Head')) {
                $notifiedUser->notify(new PurchaseRequest($message));
            }
        }

        return redirect()->route('purchase.list')->with('success', 'Purchase request is created successfully');
    }
    public function allPurchaseRequest()
    {
        $purchases = Purchase::where('user_id', auth()->user()->id)->paginate(10);
        $userPurchases = auth()->user()->purchase->count();
        $userPurchaseApproved = auth()->user()->purchase->where('authorized', '=', Purchase::APPROVED)->where('approved_by_department', '=', Purchase::APPROVED)->count();
        $userPurchaseRejected = auth()->user()->purchase->where('approved_by_department', '=', Purchase::REJECTED)->count();
        return view('purchase.all_purchase', compact('purchases', 'userPurchases', 'userPurchaseApproved', 'userPurchaseRejected'));
    }
    public function allPurchaseAdmin()
    {
        //
        $purchases = Purchase::paginate(10);
        $userPurchases = $purchases->count();
        $userPurchaseApproved = $purchases->where('approved_by_department', Purchase::APPROVED)->where('authorized', '=', Purchase::APPROVED)->count();
        $userPurchaseRejected = $purchases->where(
            ['approved_by_department', '=', Purchase::REJECTED],
            ['authorized', '=', Purchase::REJECTED],
        )->count();
        return view('purchase.all_purchase', compact('purchases', 'userPurchases', 'userPurchaseApproved', 'userPurchaseRejected'));
    }
    public function editPurchase($id)
    {
        $purchase = Purchase::findOrFail($id);
        $departments = Department::all();
        if ($purchase->user()->first()->id == auth()->user()->id) {
            return view('purchase.edit_purchase', ['departments' => $departments, 'purchase' => $purchase]);
        }
        return redirect()->route('purchase.list')->with('error', 'unauthorize action you can\'t edit the purchase');
    }
    public function updatePurchase(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->description = $request->input('description');
        $purchase->specification = $request->input('specification');
        $purchase->project_name = $request->project_name;
        $purchase->quantity = $request->quantity;
        $purchase->department_id = $request['department_id'];
        $purchase->save();
        return redirect()->route('purchase.list')->with('success', 'Purchase request is updated successfully');
    }
    public function deletePurchase($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        if ($purchase) {
            return redirect()->route('purchase.list')->with('success', 'Purchase request is deleted successfully');
        }
        return redirect()->route('purchase.list')->with('error', 'unauthorize action you can\'t delete the purchase');
    }
    public function approvePage()
    {
        $department_id = auth()->user()->department_id;
        $allPurchase = Purchase::where('department_id', '=', $department_id)->get();
        $userPurchases = $allPurchase->count();
        $userPurchaseApproved = $allPurchase->where('approved_by_department', Purchase::APPROVED)->count();
        $userPurchaseRejected = $allPurchase->where('approved_by_department', Purchase::REJECTED)->count();
        $purchases = Purchase::where('department_id', '=', $department_id)->paginate(10);

        return view('purchase.all_purchase', compact('purchases', 'userPurchases', 'userPurchaseApproved', 'userPurchaseRejected'));
    }
    public function authorizePage()
    {
        $purchases = Purchase::paginate(10);
        $userPurchases = $purchases->count();
        $userPurchaseApproved = $purchases->where('authorized', Purchase::APPROVED)->count();
        $userPurchaseRejected = $purchases->where('authorized', Purchase::REJECTED)->count();


        return view('purchase.all_purchase', compact('purchases', 'userPurchases', 'userPurchaseApproved', 'userPurchaseRejected'));
    }
    public function approve(Request $request, $id)
    {
        $checked = $request->approve;
        $purchase = Purchase::findOrFAil($id);
        if ($checked != null) {
            if ($purchase->department_id == auth()->user()->department_id) {
                $purchase->approved_by_department = $checked[0];
                $approvedOrRejected = $checked[0] == 1 ? 'approved' : 'rejected';
                $purchase->approve_by_department_id = auth()->user()->id;
                $purchase->save();
                $requestedUser = $purchase->user;
                $message = 'Your Purchase request is ' . $approvedOrRejected;
                $requestedUser->notify(new PurchaseRequest($message));
                return redirect()->route('approve.page.purchase')->with('success', 'Purchase request is ' . $approvedOrRejected . ' successfully');
            }

            return redirect()->back()->with('error', 'unauthorize action you can\'t approve or reject the purchase');
        }
        return redirect()->back()->with('error', 'Select the check box');
    }
    public function authorizePurchase(Request $request, $id)
    {
        $checked = $request->authorize;
        $purchase = Purchase::findOrFAil($id);
        if ($checked != null && $purchase->approve_by_department_id!= auth()->user()->id) {
            $purchase->authorized = $checked[0];
            $approvedOrRejected = $checked[0] == 1 ? 'authorized' : 'rejected';
            $purchase->authorized_id = auth()->user()->id;
            $purchase->save();
            $requestedUser = $purchase->user;
            $message = 'Your Purchase request is ' . $approvedOrRejected;
            $requestedUser->notify(new PurchaseRequest($message));
            return redirect()->route('authorize.page.purchase')->with('success', 'Purchase request is ' . $approvedOrRejected . ' successfully');
        }

        return redirect()->back()->with('error', 'Select the check box');
    }
    public function detail($id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('purchase.detail_purchase', compact('purchase'));
    }
    public function storePage()
    {
        $purchases = Purchase::paginate(10);

        $userPurchases = $purchases->count();
        $userPurchaseApproved = $purchases->where('approved_by_store', '=', Purchase::APPROVED)->count();
        $userPurchaseRejected = $purchases->where('approved_by_store', '=', Purchase::REJECTED)->count();

        return view('purchase.store_list', compact('purchases', 'userPurchases', 'userPurchaseApproved', 'userPurchaseRejected'));
    }
    public function storeList()
    {
        $purchases = Purchase::where([
            ['approved_by_department', Purchase::APPROVED],
            ['authorized', Purchase::APPROVED],
            ['approved_by_store', Purchase::REJECTED]
        ])->paginate(10);
        $totalPurchases = $purchases->count();
        return view('purchase.store_purchase_list', compact('purchases', 'totalPurchases',));
    }
    public function storeApprove(Request $request, $id)
    {
        $checked = $request->storeApprove;
        $purchase = Purchase::findOrFAil($id);
        if ($checked != null) {
            $purchase->approved_by_store = $checked[0];
            $approvedOrRejected = $checked[0] == 1 ? 'approved' : 'rejected';
            if(auth()->user()->department_id==8){
                $purchase->approve_by_store_id = auth()->user()->id;
                $purchase->save();
                $requestedUser = $purchase->user;
                $message = 'Your Purchase request is ' . $approvedOrRejected;
                $requestedUser->notify(new PurchaseRequest($message));
                return redirect()->route('authorize.page.purchase')->with('success', 'Purchase request is ' . $approvedOrRejected . ' successfully by '.auth()->user()->name);
            }

           return redirect()->back()->with('error', 'unauthorize action you can\'t approve or reject the purchase');
        }
        return redirect()->back()->with('error', 'unauthorize action you can\'t approve or reject the purchase');
    }
    public function exportPDF(Request $request)
    {
        $checked = $request->exports;
        $purchases = [];
        if ($checked != null) {
            foreach ($checked as $id) {
                array_push($purchases, Purchase::where('id', '=', $id)->get()->first());
            }
            $pdf = PDF::loadView('pdf.purchase_invoice', ['purchases' => $purchases])->setPaper('a4', 'landscape');
            set_time_limit(300);
            // download PDF file with download method
            return $pdf->stream('pdf_file.pdf');
            // return view('pdf.purchase_invoice');
        }
        return redirect()->back()->with('error', 'unauthorize action you can\'t approve or reject the purchase');
    }
    public function markNotification($id)
    {

        auth()->user()
            ->unreadNotifications
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->markAsRead();

        return redirect()->back();
    }
    public function isPurchased(Request $request,$id){
        $checked = $request->storeApprove;
        $purchase = Purchase::findOrFail($id);

        if ($checked != null) {
            $approvedOrRejected = $checked[0] == 1 ? 'completed and purchased' : 'not purchased ';
            if(auth()->user()->department_id==8) {
                $purchase->is_purchased = $checked[0] == 1 ? 1:0;
                $purchase->save();
                $requestedUser = $purchase->user;
                $message = 'Your Purchase request is ' . $approvedOrRejected;
                $requestedUser->notify(new PurchaseRequest($message));
                return redirect()->route('authorize.page.purchase')->with('success', 'Purchase request is ' . $approvedOrRejected . ' successfully'. auth()->user()->name);
            }
            return redirect()->back()->with('error', 'unauthorize action you can\'t approve or reject the purchase');
        }
        return redirect()->back()->with('error', 'Select the check box');
    }
}
