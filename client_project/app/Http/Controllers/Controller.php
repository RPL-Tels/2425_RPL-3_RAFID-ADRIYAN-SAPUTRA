<?php

namespace App\Http\Controllers;

use App\Models\notifications;
use App\Models\project_items;
use App\Models\projectDetail;
use App\Models\projecthistoryModel;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function viewlogin() {
        return view('auth.login');
    }
    public function viewregister() {
        return view('auth.register');
    }
    public function viewsettings() {
        $user = auth()->user();
        return view('settings.profile', compact('user'));
    }
    public function viewsetnot() {
        return view('settings.notifications');
    }
    public function viewsecur() {
        return view('settings.security');
    }
    public function viewinvo() {
        return view('settings.invoices');
    }

    public function report(Request $request, $project_id) {
        $project = projectDetail::where('project_id', $project_id)->first();
        $chartImage = $request->input('chartImage');
        $items = project_items::where('project_id', $project_id)->get();
        $history = projecthistoryModel::latest('created_at')->where('project_id', $project_id)->where('created_at', '>=', Carbon::now()->subDays(30))->get();
        $totprog = project_items::where('project_id', $project_id)->sum('progres');
        $totitem = project_items::where('project_id', $project_id)->count();
        $image = base64_encode(file_get_contents(public_path('img/Untitled-2.png')));
        $src = 'data:img/png;base64,' . $image;
        $percent = $totitem > 0 ? ($totprog / $totitem) : 0;
        $html = View::make('projectReport', compact('project', 'chartImage', 'items', 'percent', 'history','src'))->render();
        $mpdf = new Mpdf([
            'format' => 'A4',
        ]); 
        $mpdf->WriteHTML($html,);
        return response($mpdf->Output('report.pdf', 'I'), 200, [
            'content-Type' => 'application/pdf',
        ]);
    }

    public function Profile($user_id){
        $data = User::where('user_id', $user_id)->firstOrFail();
        return view('user_profile', compact('data'));
    }

    public function test() {
        return view('test');
    }

    public function viewNotif() {
        $user = Auth::user()->user_id;
        $notif = notifications::latest('created_at')->where('user_id', $user)->with('project')->get();
        notifications::where('user_id', $user)->where('read', 'no')->update(['read' => 'yes']);
        return view('notification', compact('notif'));
    }

    public function delete($id) {
        notifications::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Notification deleted');
    }
}
