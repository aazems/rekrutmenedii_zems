<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applyment;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
   
    public function dashboard()
    {
        if(Auth::check()){

            $id =  auth()->user()->id;
            $profile = User::find($id);
            
   
            $applyments = DB::table('applyments')
            ->join('rekrutmen', 'applyments.posisi_apply', '=', 'rekrutmen.id')
            ->select('applyments.*', 'rekrutmen.title as posisi_title')
            ->where('status_apply', 'incoming')
            ->get();
              
            
            $currentYear = Carbon::now()->year;
            $previousYear = Carbon::now()->subYear()->year;

            $countCurrentYear = Applyment::whereYear('tanggal_apply', $currentYear)->count();
            $countPreviousYear = Applyment::whereYear('tanggal_apply', $previousYear)->count();

            if ($countPreviousYear > 0) {
                $percentageChange = (($countCurrentYear - $countPreviousYear) / $countPreviousYear) * 100;
            } else {
                $percentageChange = $countCurrentYear > 0 ? 100 : 0; // Jika tahun sebelumnya 0, maka dianggap 100% jika ada nilai tahun ini
            }
             

            $currentMonth = Carbon::now()->month;
            $previousMonth = Carbon::now()->subMonth()->month;

            $countCurrentMonth = Applyment::whereMonth('tanggal_apply', $currentMonth)->count();
            $countPreviousMonth = Applyment::whereMonth('tanggal_apply', $previousMonth)->count();

            if ($countPreviousMonth > 0) {
                $percentageChange2 = (($countCurrentMonth - $countPreviousMonth) / $countPreviousMonth) * 100;
            } else {
                $percentageChange2 = $countCurrentMonth > 0 ? 100 : 0; // Jika tahun sebelumnya 0, maka dianggap 100% jika ada nilai tahun ini
            }

            $countapplyments = Applyment::where('status_apply', 'incoming')->count();
            return view('auth\dashboard', compact('profile','applyments','countapplyments','countCurrentYear','countPreviousYear','percentageChange','countCurrentMonth','countPreviousMonth','percentageChange2'));
      
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

}

