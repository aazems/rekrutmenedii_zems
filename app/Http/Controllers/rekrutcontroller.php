<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ditambahkan
use Session;
use App\Models\User;
use App\Models\Rekrut;
use App\Models\Applyment;
use Illuminate\Support\Facades\Storage;

class RekrutController extends Controller // Pastikan huruf kapital sesuai konvensi penulisan kelas
{

    
    public function edit($id)
    {
    // Cek apakah pengguna sudah login
    if (!Auth::check()) {
        return redirect("login")->withSuccess('Oops! You do not have access');
    }

    $rekrut = Rekrut::find($id);

    if (!$rekrut) {
        return redirect()->back()->withError('Data Rekrutmen tidak ditemukan.');
    }

    $rekrutmen = Rekrut::all()->map(function ($item) {
        $item->content = strip_tags($item->content);
        $item->content_en = strip_tags($item->content_en);
        return $item;
    });

    $profile = auth()->user();
    // dd($rekrut, $rekrutmen, $profile);
    $countapplyments = Applyment::where('status_apply', 'incoming')->count();
    return view('rekrutmen', compact('rekrut', 'rekrutmen', 'profile','countapplyments'));
    }

    public function update(Request $request)
    {
    $rekrut = Rekrut::find($request->modal_id);
    $rekrut->update([
        'title' => $request->modal_title,
        'subtitle' => $request->modal_subtitle,
        'subtitle_en' => $request->modal_subtitle,
        'content' => $request->modal_editor,
        'content_en' => $request->modal_editor,
        'lokasi' => $request->modal_lokasi,
        'jenis_kerja' => $request->modal_jenis_kerja,
        'inactive_at' => $request->modal_inactive_at,
        'linked_url' => $request->modal_linked_url,
        'jobstreet_url' => $request->modal_jobstreet_url,
        'glint_url' => $request->modal_glint_url,

    ]);

        if ($rekrut->wasChanged()) {
            return redirect()->back()->with('success', 'Data Rekrutmen berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada perubahan pada data.');
        }

    }


    public function simpanrekrut(Request $request)
    {

      
        $request->validate([
            'title' => 'required|string|max:255',
            'formfileimg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192 ', // Validasi sesuai nama input
        ]);
    
        $imagePath = null;
        $imageName = null;
    
        if ($request->hasFile('formfileimg')) {
            $imageName = time().'.'.$request->file('formfileimg')->extension(); // Membuat nama file unik
            $request->file('formfileimg')->move(public_path('images'), $imageName); // Memindahkan file ke folder public/images
            $imagePath = 'images/'.$imageName; // Menyimpan path file
        }
    
        $rekrutmen = Rekrut::create([
            'title' => $request->title,
            'title_en' => $request->title,
            'subtitle' => $request->subtitle,
            'subtitle_en' => $request->subtitle,
            'content' => $request->editor,
            'content_en' => $request->editor,
            'image' => $imagePath, // Menggunakan path yang benar
           'inactive_at' => $request->inactive_at ? date('Y-m-d', strtotime($request->inactive_at)) : null,
            'redirect_link' => $request->redirect_link,
            'lokasi' => $request->lokasi,
            'jenis_kerja' => $request->jenis_kerja,
            'linked_url' => $request->linked_url,
            'jobstreet_url' => $request->jobstreet_url,
            'glint_url' => $request->glint_url,
            'slug' =>"Pending",

        ]);
   
         
        return redirect()->route('hasilrekrutmen')->withSuccess('Your data has been saved successfully.');
    }
    
 
    
    // Delete
    public function destroy($id)
    {
        $rekrut = Rekrut::find($id);
        if ($rekrut) {
            $rekrut->delete();
            return redirect()->route('rekrutmen')->withSuccess('Data berhasil dihapus.');
        }
        return redirect()->route('rekrutmen')->withError('Data tidak ditemukan.');
    }


    public function Rekrutmencreate()
    {
        if (Auth::check()) {
            $rekrutmen = Rekrut::all()->map(function ($item) {
                $item->content = strip_tags($item->content); // Bersihkan HTML dari content
                $item->content_en = strip_tags($item->content_en); // Bersihkan HTML dari content_en
                return $item;
            });
             
            $id =  auth()->user()->id;
            $profile = User::find($id);
            $countapplyments = Applyment::where('status_apply', 'incoming')->count();
            // return view('rekrutmen', compact('rekrutmen'));
            return view('rekrutmencreate', compact('profile', 'rekrutmen','countapplyments'));
        }
    
        return redirect("login")->withSuccess('Oops! You do not have access');
    }

// public function applyments()
// {
//     return $this->hasMany(Applyment::class, 'posisi_apply', 'id');
// }

}
