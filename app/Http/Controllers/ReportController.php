<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Applyment;
use App\Models\user;
use App\Models\Rekrut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function ReportRekrutmen()
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
        
        $tgl_awal = "2024-01-01";
        $tgl_akhir = "2024-12-31";
       
        $recruitments = Rekrut::select(
            'rekrutmen.created_at as created_date',
            'rekrutmen.inactive_at',
            'rekrutmen.title',
            'rekrutmen.subtitle',
            'rekrutmen.slug',
            'rekrutmen.lokasi',
            'rekrutmen.jenis_kerja'
        )
        ->whereBetween('rekrutmen.created_at', [$tgl_awal, $tgl_akhir])
        ->withCount([
            'applyments as total_applyments' => function ($query) {
                $query->selectRaw('COUNT(*)');
            }
        ])
        ->get();


        return view('Report\Reportrekrutmen', compact('applyments','profile','countapplyments','recruitments'));
    }

    public function filterRecruitment(Request $request)
    {

        if (!Auth::check()) {
            return redirect("login")->withSuccess('Oops! You do not have access');
        }

        
        // Validasi Input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
        ]);

        // Query ke tabel rekrutment
        $recruitments = Rekrut::select(
                'rekrutmen.created_at as created_date',
                'rekrutmen.inactive_at',
                'rekrutmen.title',
                'rekrutmen.subtitle',
                'rekrutmen.slug',
                'rekrutmen.lokasi',
                'rekrutmen.jenis_kerja'
            )
            ->whereBetween('rekrutmen.created_at', [$request->start_date, $request->end_date])
            ->where('rekrutmen.slug', $request->status)
            ->withCount([
                'applyments as total_applyments' => function ($query) {
                    $query->selectRaw('COUNT(*)');
                }
            ])
            ->get();

        // Return hasil ke view
        // return view('report_recruitment', compact('recruitments'));


        $applyments = DB::table('applyments')
        ->join('rekrutmen', 'applyments.posisi_apply', '=', 'rekrutmen.id')
        ->select('applyments.*', 'rekrutmen.title as posisi_title')
        ->get();

        $id =  auth()->user()->id;
        $profile = User::find($id);
        $countapplyments = Applyment::where('status_apply', 'incoming')->count();

        return view('Report\Reportrekrutmen', compact('applyments','profile','countapplyments','recruitments'));
    }

    public function ReportApply()
    {

        if (!Auth::check()) {
            return redirect("login")->withSuccess('Oops! You do not have access');
        }

        $applyments = Applyment::select(
            'applyments.id',
            'rekrutmen.title as posisi_apply',
            'applyments.tanggal_apply',
            'applyments.nama',
            'applyments.email',
            'applyments.phone',
            'applyments.status_apply'
        )
        ->join('rekrutmen', 'applyments.posisi_apply', '=', 'rekrutmen.id')
        ->orderBy('applyments.id', 'asc') // Untuk mengurutkan berdasarkan ID
        ->get();
    
        $id =  auth()->user()->id;
        $profile = User::find($id);
        $countapplyments = Applyment::where('status_apply', 'incoming')->count();
        
        $tgl_awal = "2024-01-01";
        $tgl_akhir = "2024-12-31";
       
        $recruitments = Rekrut::select(
            'rekrutmen.created_at as created_date',
            'rekrutmen.inactive_at',
            'rekrutmen.title',
            'rekrutmen.subtitle',
            'rekrutmen.slug',
            'rekrutmen.lokasi',
            'rekrutmen.jenis_kerja'
        )
        ->whereBetween('rekrutmen.created_at', [$tgl_awal, $tgl_akhir])
        ->withCount([
            'applyments as total_applyments' => function ($query) {
                $query->selectRaw('COUNT(*)');
            }
        ])
        ->get();

        $positions = Rekrut::select('id', 'title')->get();

        return view('Report\ReportApplymen', compact('applyments','profile','countapplyments','recruitments','positions'));
    }



    public function showFilterForm()
    {

        if (!Auth::check()) {
            return redirect("login")->withSuccess('Oops! You do not have access');
        }
        
        $applyments = Applyment::select(
            'applyments.id',
            'rekrutmen.title as posisi_apply',
            'applyments.tanggal_apply',
            'applyments.nama',
            'applyments.email',
            'applyments.phone',
            'applyments.status_apply'
        )
        ->join('rekrutmen', 'applyments.posisi_apply', '=', 'rekrutmen.id')
        ->orderBy('applyments.id', 'asc') // Untuk mengurutkan berdasarkan ID
        ->get();
    

        $id =  auth()->user()->id;
        $profile = User::find($id);
        $countapplyments = Applyment::where('status_apply', 'incoming')->count();

        // Ambil data posisi dari tabel rekrutmen
        $positions = Rekrut::select('id', 'title')->get();


        return view('Report\Reportapplymen', compact('applyments','profile','countapplyments','positions'));

    }

    public function filterApplyments(Request $request)
    {

        if (!Auth::check()) {
            return redirect("login")->withSuccess('Oops! You do not have access');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Filter applyments berdasarkan tanggal dan posisi
        $applyments = Applyment::select(
            'applyments.id',
            'rekrutmen.title as posisi_apply',
            'applyments.tanggal_apply',
            'applyments.nama',
            'applyments.email',
            'applyments.phone',
            'applyments.status_apply'
        )
        ->join('rekrutmen', 'applyments.posisi_apply', '=', 'rekrutmen.id');
    
        // Filter berdasarkan tanggal (start_date dan end_date)
        if ($request->start_date && $request->end_date) {
            $applyments->whereBetween('applyments.tanggal_apply', [$request->start_date, $request->end_date]);
        }
    
        // Filter berdasarkan posisi_apply jika ada
        if ($request->posisi_apply) {
            $applyments->where('applyments.posisi_apply', $request->posisi_apply);
        }
    
        // Dapatkan data dengan pengurutan berdasarkan ID
        $applyments = $applyments->orderBy('applyments.id', 'asc')->get();

        $positions = Rekrut::select('id', 'title')->get();
        $id =  auth()->user()->id;
        $profile = User::find($id);
        $countapplyments = Applyment::where('status_apply', 'incoming')->count();


        return view('Report\Reportapplymen', compact('applyments','profile','countapplyments','positions'));
    }

}