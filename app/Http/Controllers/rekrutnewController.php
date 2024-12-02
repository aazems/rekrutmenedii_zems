<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ditambahkan
use Session;
use App\Models\User;
use App\Models\Rekrut;
use App\Models\applyments;
use Illuminate\Support\Facades\Storage;

class rekrutnewController extends Controller
{
    public function hasilRekrutmen()
    {
        if (Auth::check()) {
            // Ambil ID terakhir dari tabel rekrutmen
            $lastRekrut = Rekrut::latest('id')->first(); // Ambil data terakhir berdasarkan ID
            $id = $lastRekrut ? $lastRekrut->id : null; // Cek apakah ada data
            
            if ($id) {
                $rekrut = Rekrut::find($id); // Ambil data berdasarkan ID
            
                if (Auth::check()) {
                    $rekrutmen = Rekrut::all()->map(function ($item) {
                        $item->content = strip_tags($item->content); // Bersihkan HTML dari content
                        $item->content_en = strip_tags($item->content_en); // Bersihkan HTML dari content_en
                        return $item;
                    });
                      

                    $id =  auth()->user()->id;
                    $profile = User::find($id);
                    
                    $countapplyments = Applyment::where('status_apply', 'incoming')->count();
                   return view('rekrutmen', compact('rekrut', 'rekrutmen','profile','countapplyments'));
                }
            }
    
            return redirect()->back()->withError('Data Rekrutmen tidak ditemukan.');
        }
    
        return redirect("login")->withSuccess('Oops! You do not have access');
    }

}
