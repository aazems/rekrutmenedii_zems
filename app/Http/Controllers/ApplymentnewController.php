<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applyment;
use App\Models\user;
use App\Models\Rekrut;
use Illuminate\Support\Facades\Auth; // Ditambahkan
use Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApplymentnewController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return redirect("login")->withSuccess('Oops! You do not have access');
        }
        
        $applyments = Applyment::all();
        $id =  auth()->user()->id;
        $profile = User::find($id);
        $countapplyments = Applyment::where('status_apply', 'incoming')->count();
        return view('Applyments.create', compact('applyments','profile','countapplyments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_apply' => 'required|date',
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'alamat_ktp' => 'required|string',
            'alamat_domisili' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'file_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'file_cv' => 'required|file|mimes:pdf',
            'file_lamaran' => 'required|file|mimes:pdf',
            'deskripsi_lamaran' => 'nullable|string',
            'posisi_apply' => 'required|string',
        ]);

        $applyment = new Applyment($request->all());

        $namafile = $request->nama;

        // Handle file uploads
        if ($request->hasFile('file_ktp')) {

            $ktpFileName = $namafile. '_ktp.' . $request->file('file_ktp')->getClientOriginalExtension();
            $request->file('file_ktp')->move(public_path('images/uploads'), $ktpFileName);
            $applyment->file_ktp = 'images/uploads/' . $ktpFileName;
        }
        
        if ($request->hasFile('file_cv')) {
            $cvFileName = $namafile . '_cv.' . $request->file('file_cv')->getClientOriginalExtension();
            $request->file('file_cv')->move(public_path('images/uploads'), $cvFileName);
            $applyment->file_cv = 'images/uploads/' . $cvFileName;
        }
        
        if ($request->hasFile('file_lamaran')) {
            $lamaranFileName = $namafile . '_lamaran.' . $request->file('file_lamaran')->getClientOriginalExtension();
            $request->file('file_lamaran')->move(public_path('images/uploads'), $lamaranFileName);
            $applyment->file_lamaran = 'images/uploads/' . $lamaranFileName;
        }
        
        $applyment->posisi_apply = 4 ;
        $applyment->created_by = auth()->user()->name ?? 'System';
        $applyment->save();

        return redirect()->route('applyment')->with('success', 'Applyment created successfully.');
    }



}
