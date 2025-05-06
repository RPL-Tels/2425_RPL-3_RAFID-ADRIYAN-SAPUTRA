<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\payment;
use App\Models\projectDetail;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected function showUserDashboard()
    {
        $invoice = invoice::where('clients_id', Auth::user()->user_id)->latest('created_at')->take(5)->with(['user', 'project'])->get();  
        $paid = invoice::where('status', 'paid')->where('clients_id', Auth::user()->user_id)->count();
        $pending = invoice::where('status', 'pending')->where('clients_id', Auth::user()->user_id)->count();
        $overdue = invoice::where('status', 'overdue')->where('clients_id', Auth::user()->user_id)->count();
        $totalProject = projectDetail::where('client_id', Auth::user()->user_id)->count();
        $complete = projectDetail::where('category', 'Complete')->where('client_id', Auth::user()->user_id)->count();
        $notPaid = invoice::whereIn('status', ['overdue', 'pending'])->where('clients_id', Auth::user()->user_id)->sum('total_amount');
        $amount = invoice::where('clients_id', Auth::user()->user_id)->where('status', 'paid')->sum('total_amount');
        $projectPending = projectDetail::where('category', 'Pending')->where('client_id', Auth::user()->user_id)->count();
        $projectComplete = projectDetail::where('category', 'Complete')->where('client_id', Auth::user()->user_id)->count();
        $projectInProgress = projectDetail::where('category', 'In progress')->where('client_id', Auth::user()->user_id)->count();
        $projectOverdue = projectDetail::whereIn('category', ['Due contract', 'Payment overdue'])->where('client_id', Auth::user()->user_id)->count();
        $project = projectDetail::latest('created_at')->where('client_id', Auth::user()->user_id)->take(5)->with('user')->get();
        return view('user.dashboard', compact('paid', 'invoice', 'pending', 'overdue','totalProject', 'complete',
            'notPaid', 'amount', 'projectPending', 'projectComplete', 'projectInProgress', 'projectOverdue', 'project'
        ));
    }
    protected function showAdminDashboard(Request $request)
    {
        $invoice = invoice::latest('created_at')->take(5)->with(['user', 'project'])->get();  
        $paid = invoice::where('status', 'paid')->count();
        $pending = invoice::where('status', 'pending')->count();
        $overdue = invoice::where('status', 'overdue')->count();
        $totalProject = projectDetail::all()->count();
        $complete = projectDetail::where('category', 'Complete')->count();
        $client = User::where('role', 'user')->count();
        $amount = payment::all()->sum('amount');
        $projectPending = projectDetail::where('category', 'Pending')->count();
        $projectComplete = projectDetail::where('category', 'Complete')->count();
        $projectInProgress = projectDetail::where('category', 'In progress')->count();
        $projectOverdue = projectDetail::whereIn('category', ['Due contract', 'Payment overdue'])->count();
        $project = projectDetail::latest('created_at')->take(5)->with('user')->get();
        return view('admin.dashboard', compact('paid', 'invoice', 'pending', 'overdue','totalProject', 'complete',
            'client', 'amount', 'projectPending', 'projectComplete', 'projectInProgress', 'projectOverdue', 'project'
        ));
    }

}
