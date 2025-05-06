<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\invoice_item;
use App\Models\notifications;
use App\Models\payment;
use App\Models\project_items;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\projectDetail;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log;
use Mpdf\Mpdf;
use View;

class InvoiceController extends Controller
{
    public function viewInvoice(Request $request) {
        // Ambil input filter
        $status = $request->input('status');
        $timePeriod = $request->input('time_period', 'every_time'); // Default: Every Time

        // Tentukan batas waktu
        $startDate = null;
        $endDate = Carbon::now();
        switch ($timePeriod) {
            case 'last_week':
                $startDate = Carbon::now()->subWeek()->startOfWeek();
                $endDate = Carbon::now()->subWeek()->endOfWeek();
                break;
            case 'last_month':
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
                break;
            case 'last_year':
                $startDate = Carbon::now()->subYear()->startOfYear();
                $endDate = Carbon::now()->subYear()->endOfYear();
                break;
            case 'this_week':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case 'this_month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            case 'this_year':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            default:
                $startDate = null;
                $endDate = null;
                break;
        }

        // Query dasar untuk filter periode waktu
        $baseQuery = DB::table('invoices');
        if ($startDate && $endDate) {
            $baseQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        if(Auth::user()->role === 'admin') {
            // Hitung total dan jumlah per status
            $totalInvoice = $baseQuery->count();
            $totalAmount = $baseQuery->sum('total_amount');

            // Salinan query untuk setiap status
            $overdueInvoices = (clone $baseQuery)->where('status', 'overdue')->count();
            $pendingInvoices = (clone $baseQuery)->where('status', 'pending')->count();
            $paidInvoices = (clone $baseQuery)->where('status', 'paid')->count();
            $paidAmount = (clone $baseQuery)->where('status', 'paid')->sum('total_amount');
            $unpaidInvoices = (clone $baseQuery)->whereIn('status', ['pending', 'overdue'])->count();
            $pendingAmount = (clone $baseQuery)->whereIn('status', ['pending', 'overdue'])->sum('total_amount');

            // Hitung persentase
            $paid = $totalInvoice > 0 ? ($paidInvoices / $totalInvoice) * 100 : 0;
            $pending = $totalInvoice > 0 ? ($pendingInvoices / $totalInvoice) * 100 : 0;
            $overdue = $totalInvoice > 0 ? ($overdueInvoices / $totalInvoice) * 100 : 0;

            // Filter data invoice berdasarkan status (jika dipilih)
            $dataQuery = invoice::with(['user', 'project']);
            if ($status) {
                $dataQuery->where('status', $status);
            }
            if ($startDate && $endDate) {
                $dataQuery->whereBetween('created_at', [$startDate, $endDate]);
            }

            // Pagination data
            $data = $dataQuery->paginate(5);
        } else {
            // Hitung total dan jumlah per status
            $totalInvoice = $baseQuery->where('clients_id', Auth::user()->user_id)->count();
            $totalAmount = $baseQuery->where('clients_id', Auth::user()->user_id)->sum('total_amount');

            // Salinan query untuk setiap status
            $overdueInvoices = (clone $baseQuery)->where('status', 'overdue')->where('clients_id', Auth::user()->user_id)->count();
            $pendingInvoices = (clone $baseQuery)->where('status', 'pending')->where('clients_id', Auth::user()->user_id)->count();
            $paidInvoices = (clone $baseQuery)->where('status', 'paid')->where('clients_id', Auth::user()->user_id)->count();
            $paidAmount = (clone $baseQuery)->where('status', 'paid')->where('clients_id', Auth::user()->user_id)->sum('total_amount');
            $unpaidInvoices = (clone $baseQuery)->whereIn('status', ['pending', 'overdue'])->where('clients_id', Auth::user()->user_id)->count();
            $pendingAmount = (clone $baseQuery)->whereIn('status', ['pending', 'overdue'])->where('clients_id', Auth::user()->user_id)->sum('total_amount');

            // Hitung persentase
            $paid = $totalInvoice > 0 ? ($paidInvoices / $totalInvoice) * 100 : 0;
            $pending = $totalInvoice > 0 ? ($pendingInvoices / $totalInvoice) * 100 : 0;
            $overdue = $totalInvoice > 0 ? ($overdueInvoices / $totalInvoice) * 100 : 0;

            // Filter data invoice berdasarkan status (jika dipilih)
            $dataQuery = invoice::with(['user', 'project'])->where('clients_id', Auth::user()->user_id);
            if ($status) {
                $dataQuery->where('status', $status);
            }
            if ($startDate && $endDate) {
                $dataQuery->whereBetween('created_at', [$startDate, $endDate]);
            }

            // Pagination data
            $data = $dataQuery->paginate(5);
        }
        return view('invoice', compact(
            'data', 'totalInvoice', 'totalAmount', 
            'paidInvoices', 'paidAmount', 'unpaidInvoices', 
            'pendingAmount', 'overdueInvoices', 'pendingInvoices', 
            'status', 'paid', 'pending', 
            'overdue', 'timePeriod'
        ));
    }
    public function create() {
        $user = User::all();
        $usedProjectId = invoice::pluck('project_id')->toArray();
        $project = projectDetail::whereNotIn('project_id', $usedProjectId)->get();
        return view('admin.create_invoice', compact('user','project'));   
    }
    public function getClient($user_id) {
        $user = User::where('user_id', $user_id)->first(); // Ambil data klien berdasarkan ID
        if ($user) {
            return response()->json([
                'name' => $user->name, // Pastikan kolom ini sesuai dengan database Anda
                'email' => $user->email,
                'company' => $user->company,
                'addres' => $user->addres,
                'number' => $user->number
            ]);
        }
    }
    public function getProject($project_id) {
        try {
            $project = projectDetail::where('project_id', $project_id)->first();
            if ($project) {
                $items = DB::table('project_items')
                    ->select('items_name', DB::raw('COUNT(*) as quantity'), 'price')
                    ->where('project_id', $project_id)
                    ->groupBy('items_name', 'price')
                    ->get();
                return response()->json([
                    'clientId' => $project->client_id,
                    'projectId' => $project->project_id,
                    'items' => $items,
                ]);
            } else {
                return response()->json(['error' => 'Project not found'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching project: '.$e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    
    public function store(Request $request) {
        $request->validate([
            'project_id' => 'required|string',
            'user_id' => 'required|string',
            'due_date' => 'required|date',
        ]);
        $items = project_items::where('project_id', $request->project_id)->get();
        $amount = $items->sum('subtotal');
        $created_by = Auth::user()->user_id;
        $invoice_number = 'INV-'.strtoupper(Str::random(5));
        invoice::create([
            'invoice_number' => $invoice_number,
            'created_by' => $created_by,
            'clients_id' => $request->user_id,
            'project_id' => $request->project_id,
            'total_amount' => $amount,
            'status' => 'pending',
            'due_date' => $request->due_date
        ]);
        notifications::create([
           'user_id' => $request->user_id,
           'second_id' => $invoice_number,
           'third_id' => $request->project_id,
           'title' => 'Waiting for payment',
           'description' => 'The invoice for your order with invoice number '.$invoice_number.' is now available. Please review the payment details and complete the payment before the due date to avoid any delays in processing your order.',
           'type' => 'invoice',
           'type2' => 'In progress',
           'read' => 'no'
        ]);
        return redirect(route('admin.invoice'));
    }
    public function invoiceDetail($invoice_number) {
        $invoice = invoice::where('invoice_number', $invoice_number)->firstOrFail();
        $payments = payment::where('invoice_id', $invoice_number)->first();
        $items = DB::table('project_items')
        ->select('items_name', DB::raw('COUNT(*) as quantity'), 'price')
        ->where('project_id', $invoice->project_id)
        ->groupBy('items_name', 'price')
        ->get();
        $user = User::where('user_id', $invoice->clients_id)->firstOrFail();
        $created_by = User::where('user_id', $invoice->created_by)->firstOrFail();
        $image = base64_encode(file_get_contents(public_path('img/Untitled-2.png')));
        $src = 'data:img/png;base64,' . $image;
        $html = View::make('invoice_detail', compact('invoice', 'items', 'user', 'created_by', 'src','payments'))->render();
        $mpdf = new Mpdf();
        $mpdf->SetHTMLFooter('
            <div style="text-align: center; font-size: 12px; border-top: 1px solid #ddd; padding-top: 10px;">
                © 2024 Nazaru Company. All rights reserved.
            </div>
        ');
        $mpdf->WriteHTML($html,);
        return response($mpdf->Output('report.pdf', 'I'), 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }
    public function reports(Request $request){
        $timePeriod = $request->input('time_period', 'every_time');

        $startDate = null;
        $endDate = Carbon::now();
        switch($timePeriod) {
            case 'last_week' :
                $startDate = Carbon::now()->subWeek()->startOfWeek();
                $endDate = Carbon::now()->subWeek()->endOfWeek();
                break;
            case 'last_month' :
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
                break;
            case 'last_year' :
                $startDate = Carbon::now()->subYear()->startOfYear();
                $endDate = Carbon::now()->subYear()->endOfYear();
                break;
            case 'this_week' :
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case 'this_month' :
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
               break;
            case 'this_year' :
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            default:
                $startDate = null;
                $endDate = null;
                break;
        }

        $query = DB::table('invoices');
        if($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        if(Auth::user()->role === 'admin') {
            $invoice = $query->get();
            $totalInvoice = $invoice->count();
            $totalAmount = $invoice->sum('total_amount');
            $paidInvoice = $invoice->where('status', 'paid')->count();
            $paidAmount = $invoice->where('status', 'paid')->sum('total_amount');
            $overdueInvoice = $invoice->where('status', 'overdue')->count();
            $overdueAmount = $invoice->where('status', 'overdue')->sum('total_amount');
            $pendingInvoice = $invoice->where('status', 'pending')->count();
            $pendingAmount = $invoice->where('status', 'pending')->sum('total_amount');
            $unpaidAmount = $invoice->whereIn('status', ['pending', 'overdue'])->sum('total_amount');
            $unpaidInvoice = $invoice->whereIn('status', ['pending', 'overdue'])->count();
            $dataQuery = invoice::with(['user', 'project']);
            
            $paid = $totalInvoice > 0 ? ($paidInvoice / $totalInvoice) * 100 : 0;
            $pending = $totalInvoice > 0 ? ($pendingInvoice / $totalInvoice) * 100 : 0;
            $overdue = $totalInvoice > 0 ? ($overdueInvoice / $totalInvoice) * 100 : 0;

            if ($startDate && $endDate) {
                $dataQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
            $data = $dataQuery->get();
        } else {
            $invoice = $query->where('clients_id', Auth::user()->user_id)->get();
            $totalInvoice = $invoice->where('clients_id', Auth::user()->user_id)->count();
            $totalAmount = $invoice->where('clients_id', Auth::user()->user_id)->sum('total_amount');
            $paidInvoice = $invoice->where('status', 'paid')->where('clients_id', Auth::user()->user_id)->count();
            $paidAmount = $invoice->where('status', 'paid')->where('clients_id', Auth::user()->user_id)->sum('total_amount');
            $overdueInvoice = $invoice->where('status', 'overdue')->where('clients_id', Auth::user()->user_id)->count();
            $overdueAmount = $invoice->where('status', 'overdue')->where('clients_id', Auth::user()->user_id)->sum('total_amount');
            $pendingInvoice = $invoice->where('status', 'pending')->where('clients_id', Auth::user()->user_id)->count();
            $pendingAmount = $invoice->where('status', 'pending')->where('clients_id', Auth::user()->user_id)->sum('total_amount');
            $unpaidAmount = $invoice->whereIn('status', ['pending', 'overdue'])->where('clients_id', Auth::user()->user_id)->sum('total_amount');
            $unpaidInvoice = $invoice->whereIn('status', ['pending', 'overdue'])->where('clients_id', Auth::user()->user_id)->count();
            $dataQuery = invoice::with(['user', 'project'])->where('clients_id', Auth::user()->user_id);
            
            $paid = $totalInvoice > 0 ? ($paidInvoice / $totalInvoice) * 100 : 0;
            $pending = $totalInvoice > 0 ? ($pendingInvoice / $totalInvoice) * 100 : 0;
            $overdue = $totalInvoice > 0 ? ($overdueInvoice / $totalInvoice) * 100 : 0;

            if ($startDate && $endDate) {
                $dataQuery->whereBetween('created_at', [$startDate, $endDate])->where('clients_id', Auth::user()->user_id);
            }
            $data = $dataQuery->get();
        }
        $chartImage = $request->input('chartImage');
        $html = View::make('invoice_report', compact(
            'invoice', 'totalInvoice', 'totalAmount', 'paidInvoice', 'paidAmount',
            'overdueInvoice', 'pendingInvoice', 'unpaidAmount', 'unpaidInvoice', 'data', 'paid', 'pending', 'overdue',
            'chartImage', 'timePeriod', 'overdueAmount','pendingAmount'
        ))->render();
        $mpdf = new Mpdf();
        $mpdf->SetHTMLFooter('
            <div style="text-align: center; font-size: 12px; border-top: 1px solid #ddd; padding-top: 10px;">
                © 2024 Nazaru Company. All rights reserved.
            </div>
        ');
        $mpdf->WriteHTML($html,);
        return response($mpdf->Output('report.pdf', 'I'), 200, [
            'Content-Type' => 'application/pdf'
        ]);
    }
    public function invoiceDelete($invoice_number) {
        $invoice = invoice::where('invoice_number', $invoice_number)->firstOrFail();
        $payment = payment::where('invoice_id', $invoice_number);
        if($payment) {
            $payment->delete();
        }
        $invoice->delete();
        return redirect(route('admin.invoice'));
    }
    public function viewPaid($invoice_number) {
        $data = invoice::where('invoice_number', $invoice_number)->firstOrFail();
        return view('admin.mark_paid', compact('data'));
    }
    public function mark(Request $request, $invoice_number) {
        $request->validate([
            'amount' => 'required|string',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
        ]);
        $cleanAmount = preg_replace('/[^\d]/', '', $request->amount);
        $invoice = invoice::where('invoice_number', $invoice_number)->firstOrFail();
        if($invoice->status === 'overdue') {
            return back()->withErrors(['status' => 'This invoice is overdue and cannot be paid']);
        }
        if($cleanAmount != $invoice->total_amount) {
            return back()->withErrors(['amount' => 'The payment amount must match the total amount.']);
        }
        payment::create([
            'invoice_id' => $invoice_number,
            'amount' => $cleanAmount,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
        ]);
        notifications::create([
            'user_id' => $invoice->clients_id,
            'second_id' => $invoice_number,
            'third_id' => $invoice->project_id,
            'title' => 'Payment confirmation',
            'description' => 'This is to confirm that we have received your payment for invoice '.$invoice_number.'. Thank you for your prompt payment. Your order is now being processed accordingly. Please don’t hesitate to contact us if you require further assistance or documentation.',
            'type' => 'invoice',
            'type2' => 'Complete',
            'read' => 'no'
        ]);
        $invoice->update(['status' => 'paid']);
        $project = projectDetail::where('project_id', $invoice->project_id);
        $project->update(['category' => 'In progress']);
        return redirect(route('admin.invoice'))->with('success', 'Invoice marked as paid successfully!');
    }

    public function invoiceSearch(Request $request) {
        // Ambil input filter
        $status = $request->input('status');
        $timePeriod = $request->input('time_period', 'every_time'); // Default: Every Time
        $query = $request->get('query');

        // Tentukan batas waktu
        $startDate = null;
        $endDate = Carbon::now();
        switch ($timePeriod) {
            case 'last_week':
                $startDate = Carbon::now()->subWeek()->startOfWeek();
                $endDate = Carbon::now()->subWeek()->endOfWeek();
                break;
            case 'last_month':
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
                break;
            case 'last_year':
                $startDate = Carbon::now()->subYear()->startOfYear();
                $endDate = Carbon::now()->subYear()->endOfYear();
                break;
            case 'this_week':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case 'this_month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            case 'this_year':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            default:
                $startDate = null;
                $endDate = null;
                break;
        }

        // Query dasar untuk filter periode waktu
        $baseQuery = DB::table('invoices');
        if ($startDate && $endDate) {
            $baseQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        if(Auth::user()->role === 'admin') {
            if ($query) {
                $baseQuery->where(function ($q) use ($query) {
                    try {
                        $formatedDate = Carbon::parse($query)->format('Y-m-d');
                        $q->orWhere('due_date', 'LIKE', "%$formatedDate%")
                        ->orWhere('created_at', 'LIKE', "%$formatedDate%");
                    } catch(\Exception $e) {
                        $q->orWhere('invoice_number', 'LIKE', "%$query%");
                    }
                });
            }
            // Hitung total dan jumlah per status
            $totalInvoice = $baseQuery->count();
            $totalAmount = $baseQuery->sum('total_amount');

            // Salinan query untuk setiap status
            $overdueInvoices = (clone $baseQuery)->where('status', 'overdue')->count();
            $pendingInvoices = (clone $baseQuery)->where('status', 'pending')->count();
            $paidInvoices = (clone $baseQuery)->where('status', 'paid')->count();
            $paidAmount = (clone $baseQuery)->where('status', 'paid')->sum('total_amount');
            $unpaidInvoices = (clone $baseQuery)->whereIn('status', ['pending', 'overdue'])->count();
            $pendingAmount = (clone $baseQuery)->whereIn('status', ['pending', 'overdue'])->sum('total_amount');

            // Hitung persentase
            $paid = $totalInvoice > 0 ? ($paidInvoices / $totalInvoice) * 100 : 0;
            $pending = $totalInvoice > 0 ? ($pendingInvoices / $totalInvoice) * 100 : 0;
            $overdue = $totalInvoice > 0 ? ($overdueInvoices / $totalInvoice) * 100 : 0;

            // Filter data invoice berdasarkan status (jika dipilih)
            $dataQuery = invoice::with(['user', 'project']);
            if ($status) {
                $dataQuery->where('status', $status);
            }
            if ($startDate && $endDate) {
                $dataQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
            if ($query) {
                $dataQuery->where(function ($q) use ($query) {
                    try {
                        $formatedDate = Carbon::parse($query)->format('Y-m-d');
                        $q->orWhere('due_date', 'LIKE', "%$formatedDate%")
                        ->orWhere('created_at', 'LIKE', "%$formatedDate%");
                    } catch(\Exception $e) {
                        $q->orWhere('invoice_number', 'LIKE', "%$query%");
                    }
                });
            }
            // Pagination data
            $data = $dataQuery->paginate(5);
        } else {
            if ($query) {
                $baseQuery->where('clients_id', Auth::user()->user_id)->where(function ($q) use ($query) {
                    try {
                        $formatedDate = Carbon::parse($query)->format('Y-m-d');
                        $q->orWhere('due_date', 'LIKE', "%$formatedDate%")
                        ->orWhere('created_at', 'LIKE', "%$formatedDate%");
                    } catch(\Exception $e) {
                        $q->orWhere('invoice_number', 'LIKE', "%$query%");
                    }
                });
            }
            // Hitung total dan jumlah per status
            $totalInvoice = $baseQuery->where('clients_id', Auth::user()->user_id)->count();
            $totalAmount = $baseQuery->where('clients_id', Auth::user()->user_id)->sum('total_amount');

            // Salinan query untuk setiap status
            $overdueInvoices = (clone $baseQuery)->where('status', 'overdue')->where('clients_id', Auth::user()->user_id)->count();
            $pendingInvoices = (clone $baseQuery)->where('status', 'pending')->where('clients_id', Auth::user()->user_id)->count();
            $paidInvoices = (clone $baseQuery)->where('status', 'paid')->where('clients_id', Auth::user()->user_id)->count();
            $paidAmount = (clone $baseQuery)->where('status', 'paid')->where('clients_id', Auth::user()->user_id)->sum('total_amount');
            $unpaidInvoices = (clone $baseQuery)->whereIn('status', ['pending', 'overdue'])->where('clients_id', Auth::user()->user_id)->count();
            $pendingAmount = (clone $baseQuery)->whereIn('status', ['pending', 'overdue'])->where('clients_id', Auth::user()->user_id)->sum('total_amount');

            // Hitung persentase
            $paid = $totalInvoice > 0 ? ($paidInvoices / $totalInvoice) * 100 : 0;
            $pending = $totalInvoice > 0 ? ($pendingInvoices / $totalInvoice) * 100 : 0;
            $overdue = $totalInvoice > 0 ? ($overdueInvoices / $totalInvoice) * 100 : 0;

            // Filter data invoice berdasarkan status (jika dipilih)
            $dataQuery = invoice::with(['user', 'project'])->where('clients_id', Auth::user()->user_id);
            if ($status) {
                $dataQuery->where('status', $status);
            }
            if ($startDate && $endDate) {
                $dataQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
            if ($query) {
                $dataQuery->where('clients_id', Auth::user()->user_id)->where(function ($q) use ($query) {
                    try {
                        $formatedDate = Carbon::parse($query)->format('Y-m-d');
                        $q->orWhere('due_date', 'LIKE', "%$formatedDate%")
                        ->orWhere('created_at', 'LIKE', "%$formatedDate%");
                    } catch(\Exception $e) {
                        $q->orWhere('invoice_number', 'LIKE', "%$query%");
                    }
                });
            }

            // Pagination data
            $data = $dataQuery->paginate(5);
        }
        return view('invoice_search', compact(
            'data', 'totalInvoice', 'totalAmount', 
            'paidInvoices', 'paidAmount', 'unpaidInvoices', 
            'pendingAmount', 'overdueInvoices', 'pendingInvoices', 
            'status', 'paid', 'pending', 
            'overdue', 'timePeriod'
        ));
    }
}