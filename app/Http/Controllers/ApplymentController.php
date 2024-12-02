<?php

namespace App\Http\Controllers;

use App\Models\Applyment;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ApplymentController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            return redirect("login")->withSuccess('Oops! You do not have access');
        }
        
        $applyments = DB::table('applyments')
        ->join('rekrutmen', 'applyments.posisi_apply', '=', 'rekrutmen.id')
        ->select('applyments.*', 'rekrutmen.title as posisi_title')
        ->get();

        $id =  auth()->user()->id;
        $profile = User::find($id);
        $countapplyments = Applyment::where('status_apply', 'incoming')->count();
            
        return view('applyments.index', compact('applyments','profile','countapplyments'));
    }

    public function create()
    {
        $id =  auth()->user()->id;
        $profile = User::find($id);
        return view('applyments.create',compact('profile'));
    }
    
    public function show($id)
{
    // $applyment = Applyment::find($id);
    $applyment = DB::table('applyments')
    ->join('rekrutmen', 'applyments.posisi_apply', '=', 'rekrutmen.id')
    ->select('applyments.*', 'rekrutmen.title as posisi_title')
    ->where('applyments.id', $id)
    ->first();
 
    if (!$applyment) {
        return response()->json(['error' => 'Data not found'], 404);
    }
    
    
    return response()->json($applyment);
}


public function proses(Request $request, $id)
{
    $applyment = Applyment::find($id);

    if (!$applyment) {
        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.']);
    }

    $applyment->status_apply = $request->status_apply;
    $applyment->save();

    return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
}


public function reject(Request $request, $id)
{
    $applyment = Applyment::find($id);

    // Validasi apakah data ditemukan dan status memungkinkan untuk di-reject
    if (!$applyment) {
        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.']);
    }

    if ($applyment->status_apply === 'Processed') {
        return response()->json(['success' => false, 'message' => 'Data dengan status "Processed" tidak dapat di-reject.']);
    }

    // Perbarui status ke Rejected
    $applyment->status_apply = 'Rejected';
    $applyment->save();

    return response()->json(['success' => true, 'message' => 'Data berhasil di-reject.']);
}

    
   
}
