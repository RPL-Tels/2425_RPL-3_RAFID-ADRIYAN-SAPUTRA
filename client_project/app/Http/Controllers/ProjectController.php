<?php

namespace App\Http\Controllers;


use App\Models\invoice;
use App\Models\notifications;
use App\Models\project_items;
use App\Models\ProjectData;
use App\Models\projectDetail;
use App\Models\projecthistoryModel;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function view(Request $request) {
        $user = Auth::user()->user_id;
        $status = $request->input('status');
        $category = $request->query('category');
        if($category) {
           if($category === 'Due contract') {
            $project = projectDetail::whereIn('category', ['Due contract', 'Payment overdue'])->where('client_id', $user)->paginate(4);
           } else {
            $project = projectDetail::where('category', $category)->where('client_id', $user)->paginate(4);
           }
        } else {
            $project = projectDetail::where('client_id', $user)->paginate(4);
        }
        if($status) {
            if($status === 'All') {
                $project = projectDetail::where('client_id', $user)->paginate(4);
            } elseif($status === 'Due contract') {
                $project = projectDetail::whereIn('category', ['Due contract', 'Payment overdue'])->where('client_id', $user)->paginate(4);
            } else {
                $project = projectDetail::where('category', $status)->where('client_id', $user)->paginate(4);
            }
        }
        
        return view('user.project', compact('project'));
    }

    public function view2() {
        $user = Auth::user()->user_id;
        $project = projectDetail::where('client_id', $user)->paginate(4);
        return view('user.data_project', data: compact('project'));
    }

    public function projectDataSearch(Request $request) {
        $query = $request->get('query');
        $user = Auth::user()->user_id;
        $project = projectDetail::query();
        if($query) {
            $project = $project->where('client_id', $user)
                         ->where(function($q) use ($query){
                            $q->where('project_name', 'LIKE', "%{$query}%")
                              ->orWhere('client_id', $query);
                         });
        } else {
            $project = $project->where('client_id', $user);
        }
    
        $project = $project->paginate(4);
        return view('user.data_project_search', compact('project'));
    }

    public function projectSearch(Request $request) {
        $query = $request->get('query');
        $user = Auth::user()->user_id;
        $project = projectDetail::query();
       
        $project = $project->where('client_id', $user);     
        if ($query) {
            $project = $project->where(function($q) use ($query) {
                // Cek apakah input berupa tanggal
                try {
                    $formattedDate = Carbon::parse($query)->format('Y-m-d');
                    $q->orWhere('due_contract', 'LIKE', "%{$formattedDate}%");
                } catch (\Exception $e) {
                    // Jika bukan tanggal, skip dan cari dengan kolom lainnya
                }

                // Kondisi pencarian lainnya
                $q->orWhere('project_name', 'LIKE', "%{$query}%")
                ->orWhere('category', 'LIKE', "%{$query}%");
            });
        }
        $project = $project->paginate(4);
        return view('user.project_search', compact('project'));
    }

    public function views($project_id) {
        $model = ProjectData::where('project_id',$project_id)
                 ->firstOrFail();
        $url = asset('storage/'.$model->file_path);
        return view('3dviewer', ['id'=>$project_id, 'modelUrl' => $url]);
    }
    public function views2($items_id) {
        $model = project_items::where('items_id',$items_id)
                 ->firstOrFail();
        $url = asset('storage/'.$model->file_path);
        return view('3dviewer', ['id'=>$items_id, 'modelUrl' => $url]);
    }

    public function getClient($user_id) {
        $client = User::where('user_id',$user_id)->first(); // Ambil data klien berdasarkan ID
        if ($client) {
            return response()->json([
                'name' => $client->name, // Pastikan kolom ini sesuai dengan database Anda
            ]);
        }

        return response()->json([
            'error' => 'Client not found.',
        ], 404);
    }

    public function projeckFromView(Request $request) {
        $user = User::where('role', 'user')->get();
        // Jika permintaan adalah AJAX (autocomplete)
        if ($request->ajax() && $request->has('query')) {
                $search = $request->get('query');
                $data = User::where('user_id', 'like', "%{$search}%")->where('role', 'user')->take(10)->get();

                return response()->json($data);
        }
        return view('admin.project_form', compact('user'));
    }

    public function projectFormStore(Request $request) {
        $request->validate([
            'project_name' => 'required|string|min:4|unique:project_details',
            'client_name' => 'required|string',
            'client_id' => 'required|string',
            'description' => 'required|string|min:5',
            'start' => 'required',
            'due_contract' => 'required',
            'tumbnail' => 'required|file',
        ]);

        $file_name = time(). '.' .$request->tumbnail->getClientOriginalExtension();
        $path = 'thumbnail/'.$file_name;
        $request->tumbnail->storeAs('public/thumbnail', $file_name);
        $name_project = 'P-'. strtoupper(Str::random(4));
        projectDetail::create([
            'project_id' => $name_project,
            'project_name' => $request->project_name,
            'client_id' => $request->client_id,
            'client_name' => $request->client_name,
            'tumbnail' => $path,
            'description' => $request->description,
            'start' => $request->start,
            'due_contract' => $request->due_contract,
            'category' => 'Pending'
        ]);
        return redirect(route('admin.project'));
    }

    public function getProject($project_id) {
        $project = projectDetail::where('project_id', $project_id)->first(); // Ambil data klien berdasarkan ID
        if ($project) {
            return response()->json([
                'name' => $project->project_name, // Pastikan kolom ini sesuai dengan database Anda
                'name2' => $project->client_id,
            ]);
        }
    }

    public function projectDetail($project_id) {
        $data = projectDetail::where('project_id', $project_id)->firstOrFail();
        $has = invoice::where('project_id', $project_id)->get();
        $totprog = project_items::where('project_id', $project_id)->sum('progres');
        $totitem = project_items::where('project_id', $project_id)->count();
        $percent = $totitem > 0 ? ($totprog / $totitem) : 0;
        $items = project_items::where('project_id', $project_id)->paginate('2');
        $history = projecthistoryModel::latest('created_at')->where('project_id', $project_id)->get();
        $url = null;
        if($items->isNotEmpty()) {
            $url = asset('storage/' . $items->first()->file_path);
        }
        return view('project_detail', ['data' => $data, 'modelUrl' => $url, 'items' => $items, 'percent' => $percent, 'has' => $has, 'history' => $history]);
    }

    public function projectDelete($project_id) {
        $projectDetail = projectDetail::where('project_id', $project_id)->first();
        if($projectDetail) {
            if($projectDetail->tumbnail && File::exists(storage_path('app/public/' . $projectDetail->tumbnail))) {
                File::delete(storage_path('app/public/' . $projectDetail->tumbnail));
            }
            $projectDetail->delete();
            $projectData = ProjectData::where('project_id', $project_id)->get();
            foreach($projectData as $data) {
                if($data->file_path && File::exists(storage_path('app/public/'.$data->file_path))) {
                    File::delete(storage_path('app/public/'.$data->file_path));
                }
                $data->delete();
            }
            $items = project_items::where('project_id', $project_id)->get();
            foreach($items as $item) {
                if($item->file_path && File::exists(storage_path('app/public/'.$item->file_path))) {
                    File::delete(storage_path('app/public/'.$item->file_path));
                }
                $item->delete();
            }
            $history = projecthistoryModel::where('project_id', $project_id)->get();
            foreach($history as $his) {
                $his->delete();
            }
            return redirect(route('admin.project'));
        }
        return response()->json(['message' => 'project not found']);
    }

    public function projectUpdate($project_id) {
        $data = projectDetail::where('project_id', $project_id)->firstOrFail();
        return view('admin.project_form_update', compact('data'));
    }

    public function projectUpdateStore(Request $request, $project_id) {
        $request->validate([
            'project_name' => 'required|min:3|string',
            'category' => 'required',
            'description' => 'nullable|min:5|string',
            'start' => 'required',
            'due_contract' => 'required',
            'tumbnail' => 'nullable|mimes:jpeg,png,jpg|max:50048'
        ]);
        $prokject = projectDetail::where('project_id', $project_id)->firstOrFail();
        if($request->hasFile('tumbnail')) {
            if($prokject->tumbnail && Storage::exists(('public/'.$prokject->tumbnail))) {
                Storage::delete(('public/'.$prokject->tumbnail));
            }
            $file_name = time(). '.' .$request->tumbnail->getClientOriginalExtension();
            $path = 'thumbnail/'.$file_name;
            $request->tumbnail->storeAs('public/thumbnail', $file_name);
        } else {
            $path = $prokject->tumbnail;
        }

        $prokject->update([
            'project_name' => $request->project_name,
            'category' => $request->category,
            'description' => $request->description ?: $prokject->description,
            'start' => $request->start,
            'due_contract' => $request->due_contract,
            'tumbnail' =>$path,
        ]);
        $by = Auth::user()->name;
        $totprog = project_items::where('project_id', $project_id)->sum('progres');
        $totitem = project_items::where('project_id', $project_id)->count();
        $percent = $totitem > 0 ? ($totprog / $totitem) : 0;
        projecthistoryModel::create([
            'project_id' => $project_id,
            'by' => $by,
            'name' => $request->project_name,
            'progress' => $percent,
            'status' => $request->category,
            'description' => $request->description ?: $prokject->description,
        ]);
        if($request->category === 'Pending') {
            notifications::create([
                'user_id' => $prokject->client_id,
                'second_id' => $prokject->project_id,
                'title' => 'The project pending',
                'description' => 'Dear Costumer your project '.$prokject->project_name.' ('.$prokject->project_id.') bee pending for period time, please wait for next information.',
                'type' => 'project',
                'type2' => 'pending',
                'read' => 'no',
            ]);
        } elseif($request->category === 'In progress') {
            notifications::create([
                'user_id' => $prokject->client_id,
                'second_id' => $prokject->project_id,
                'title' => 'The project in progress',
                'description' => 'Dear Costumer your project '.$prokject->project_name.' ('.$prokject->project_id.') is in process, thank you for your trust in ordering your project from us.',
                'type' => 'project',
                'type2' => 'In progress',
                'read' => 'no',
            ]);
        } elseif($request->category === 'Due contract') {
            notifications::create([
                'user_id' => $prokject->client_id,
                'second_id' => $prokject->project_id,
                'title' => 'The project overdue',
                'description' => 'Dear Costumer your project '.$prokject->project_name.' ('.$prokject->project_id.') has passed the deadline, we apologize for our delay in completing the project, we will be responsible for futher discussion.',
                'type' => 'project',
                'type2' => 'Due contract',
                'read' => 'no',
            ]);
        }
        return redirect(route('view.project.detail', $prokject->project_id));
    }

    public function adminProject(Request $request) {
        $user = Auth::user()->user_id;
        $status = $request->input('status');
        $category = $request->query('category');
        if($category) {
           if($category === 'Due contract') {
            $project = projectDetail::whereIn('category', ['Due contract', 'Payment overdue'])->paginate(4);
           } else {
            $project = projectDetail::where('category', $category)->paginate(4);
           }
        } else {
            $project = projectDetail::paginate(4);
        }
        if($status) {
            if($status === 'All') {
                $project = projectDetail::paginate(4);
            } elseif($status === 'Due contract') {
                $project = projectDetail::whereIn('category', ['Due contract', 'Payment overdue'])->paginate(4);
            } else {
                $project = projectDetail::where('category', $status)->paginate(4);
            }
        }
        return view('admin.project', compact('project', 'status'));
    }
 
    public function adminDataProject() {
        $project = projectDetail::paginate(4);
        return view('admin.data_project', data: compact('project'));
    }

    public function adminProjectSearch(Request $request) {
        $query = $request->get('query');
        $project = projectDetail::query();

        if($query) {
            $project = $project->where(function($q) use ($query){
                            try {
                                $formatedDate = Carbon::parse($query)->format('Y-m-d');
                                $q->orWhere('due_contract', 'LIKE', "%{$formatedDate}%");
                            } catch(\Exception $e) {
                                $q->where('project_name', 'LIKE', "%{$query}%")
                                ->orWhere('client_id', 'LIKE', "%{$query}%")
                                ->orWhere('client_name', 'LIKE', "%{$query}%")
                                ->orWhere('category', 'LIKE', "%{$query}%");
                            }
                        });
        }
        $project = $project->paginate(4);
        return view('admin.projectSearch', compact('project'));
    }

    public function adminProjectDataSearch(Request $request) {
        $query = $request->get('query');
        $project = projectDetail::query();
        if($query) {
            $project = $project->where(function($q) use ($query){
                            $q->where('project_name', 'LIKE', "%{$query}%")
                              ->orWhere('client_id', 'LIKE',"%{$query}%");
                        });
        } 
        $project = $project->paginate(4);
        return view('admin.data_project_search', compact('project'));   
    }

    public function items_store(Request $request, $project_id) {
        $request->validate([
            'items_name' => 'required|string',
            'price' => 'required|string',
            'quantity' => 'required|integer',
            'amount' => 'required',
        ]);
        $cleanAmount = preg_replace('/[^\d]/', '', $request->amount);
        $cleanPrice = preg_replace('/[^\d]/', '', $request->price);
        for ($i = 0; $i<$request->quantity; $i++) {
            $items_id = 'I-'. now()->format('YmdHis'). '-' . $i;
            $name = $request->items_name . '-' . $i;
            $calculatedAmount = $request->quantity > 1 ? $cleanAmount / $request->quantity : $cleanAmount;
            project_items::create([
                'project_id' => $project_id,
                'items_id' => $items_id,
                'items_name' => $name,
                'progres' => 0,
                'stage' => 'Project not started yet',
                'category' => 'Pending',
                'price' => $cleanPrice,
                'file_path' => '',
                'subtotal' => $calculatedAmount,
            ]);
        };

        return redirect(route('view.project.detail', $project_id));
    }
    public function items_delete($items_id) {
        $items = project_items::where('items_id', $items_id)->first();
        if($items){
            if($items->file_path && File::exists(storage_path('app/public/'.$items->file_path))) {
                File::delete(storage_path('app/public/'.$items->file_path));
            }
            $items->delete();
            return redirect(route('admin.project'));
        }
        return response()->json(['message' => 'project not found']);
    }
    public function items_update($items_id) {
        $items = project_items::where('items_id', $items_id)->firstOrFail();
        $check = invoice::where('project_id', $items->project_id)->first();
        if(!$check) {
            return redirect()->back();
        }
        if($check->status != "paid") {
            return redirect()->back();
        }
        if($items->category == "Complete") {
            return redirect()->back();
        }
        return view('admin.items_update', compact('items'));
    }

    public function items_update_store(Request $request, $items_id) {
        $request->validate([
            'items_name' => 'required|string|min:5',
            'progres' => 'nullable|integer|min:0|max:100',
            'category' => 'nullable|string',
            'stage' => 'nullable|string|min:5',
            'tumbnail' => 'nullable|File|max:212000',
        ]);
        $items = project_items::where('items_id', $items_id)->first();
        if($request->hasFile('tumbnail')) {
            if($items->file_path && Storage::exists(('public/'.$items->file_path))) {
                Storage::delete(('public/'.$items->file_path));
            }
            $file_name = time(). '.' .$request->tumbnail->getClientOriginalExtension();
            $path = 'models/'.$file_name;
            $request->tumbnail->storeAs('public/models', $file_name);
            if($request->progres == 100) {
                $items->update([
                    'items_name' => $request->items_name,
                    'progres' => $request->progres ?: $items->progres,
                    'category' => "Complete",
                    'stage' => $request->stage ?: $items->stage,
                    'file_path' => $path,
                ]);
            } else if($request->category == "Complete"){
                $items->update([
                    'items_name' => $request->items_name,
                    'progres' => 100,
                    'category' => "Complete",
                    'stage' => $request->stage ?: $items->stage,
                    'file_path' => $path,
                ]);
            } else {
                $items->update([
                    'items_name' => $request->items_name,
                    'progres' => $request->progres ?: $items->progres,
                    'category' => $request->category ?: 'In progress',
                    'stage' => $request->stage ?: $items->stage,
                    'file_path' => $path,
                ]);
            }
        } else {
            if($request->progres == 100) {
                $items->update([
                    'items_name' => $request->items_name,
                    'progres' => $request->progres ?: $items->progres,
                    'category' => "Complete",
                    'stage' => $request->stage ?: $items->stage,
                ]);
            } else if($request->category == "Complete"){
                $items->update([
                    'items_name' => $request->items_name,
                    'progres' => 100,
                    'category' => "Complete",
                    'stage' => $request->stage ?: $items->stage,
                ]);
            } else {
                $items->update([
                    'items_name' => $request->items_name,
                    'progres' => $request->progres ?: $items->progres,
                    'category' => $request->category ?: 'In progress',
                    'stage' => $request->stage ?: $items->stage,
                ]);
            }
        }
        $project = projectDetail::where('project_id', $items->project_id)->first();
        $id = $project->project_id;
        $totprog = project_items::where('project_id', $id)->sum('progres');
        $totitem = project_items::where('project_id', $id)->count();
        $percent = $totitem > 0 ? ($totprog / $totitem) : 0;
        if(number_format($percent) == 100) {
            projectDetail::where('project_id', $id)->update([
                'category' => 'Complete',
            ]);
            notifications::create([
                'user_id' => $project->client_id,
                'second_id' => $project->project_id,
                'title' => 'The project has been completed',
                'description' => 'Dear Costumer your project '.$project->project_name.' ('.$project->project_id.') has been 100% completed, thank you for ordering a project with us.',
                'type' => 'project',
                'type2' => 'Complete',
                'read' => 'no',
            ]);
        } else {
            projectDetail::where('project_id', $id)->update([
                'category' => 'In progress',
            ]);
        }
        $by = Auth::user()->name;
        projecthistoryModel::create([
            'project_id' => $id,
            'items_id' => $items_id,
            'name' => $request->items_name,
            'by' => $by,
            'description' => $request->stage ?: $items->stage,
            'progress' => $request->progres ?: $items->progres,
            'status' => $request->category,
        ]);
        return redirect(route('view.project.detail', $items->project_id))->with('succes', 'data stored');
    }

    public function updateDataView($project_id) {
        $name = projectDetail::where('project_id', $project_id)->firstOrFail();
        $data = ProjectDetail::where('project_id', $project_id)->firstOrFail();
        $items = project_items::where('project_id', $project_id)->get();
        return view('admin.uploadData', compact('data', 'name', 'items'));
    }

    public function getItems($items_id) {
        $a = project_items::where('items_id', $items_id)->first();
        if($a){
            return response()->json([
                'name' => $a->items_name
            ]);
        }
        return response()->json(['name' => null], 404);
    }

    public function download($data_id) {
        $file = ProjectData::where('data_id', $data_id)->first();
        if(!$file) {
            return back()->with('error', 'Project data not found.');
        } if(!$file->file_path) {
            return back()->with('error', 'File not found.');
        }
        $filepath = public_path('storage/'. $file->file_path);
        if(!file_exists($filepath)) {
            return back()->with('error', 'File not found in directory.');
        }
        $extension = pathinfo($file->file_path, PATHINFO_EXTENSION);
        $customName = $file->costume_name . '.' . $extension;
        return response()->download($filepath, $customName);
    }

    public function download_list(Request $request, $project_id) {
        $project = projectDetail::where('project_id', $project_id)->firstOrFail();
        $emp = ProjectData::where('project_id', $project_id)->get();
        $items = project_items::where('project_id', $project_id)->with('data')->get();
        return view('view_download', compact('project', 'items', 'emp'));
    }

    public function store(Request $request) {
        $request->validate([
            'costume_name' => 'required|string|min:4',
            'items_id' => 'required|string',
            'items_name' => 'required|string',
            'project_id' => 'required|string',
            'user_id' => 'required|string',
            'project_name' => 'required|string|min:4',
            'file' => 'file|required',
        ]);
        $file_name = time(). '.' .$request->file->getClientOriginalExtension();
        $data_is = 'D-'. strtoupper(Str::random(8));
        $path = 'downloaded/'.$file_name;
        $request->file->storeAs('public/downloaded', $file_name);
        ProjectData::create([
            'data_id' => $data_is,
            'project_id' => $request->project_id,
            'items_id' => $request->items_id,
            'user_id' => $request->user_id,
            'items_name' => $request->items_name,
            'project_name' => $request->project_name,
            'costume_name' => $request->costume_name,
            'extension' => $request->file->getClientOriginalExtension(),
            'size' => $request->file->getSize(),
            'file_name' => $file_name,
            'file_path' => $path,
        ]);
        return redirect(route('admin.data.project'))->with('succes', 'data stored');
    }

    public function dataDelete($data_id) {
        $items = ProjectData::where('data_id', $data_id)->first();
        if($items){
            if($items->file_path && File::exists(storage_path('app/public/'.$items->file_path))) {
                File::delete(storage_path('app/public/'.$items->file_path));
            }
            $items->delete();
            return redirect()->back();
        }
        return response()->json(['message' => 'project not found']);
    }
    
}