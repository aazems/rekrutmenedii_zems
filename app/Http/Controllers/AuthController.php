<?php
  
namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use Session;
use App\Models\User;
use App\Models\rekrut;
use App\Models\Applyment;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
// use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration(): View
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request): RedirectResponse
    {

       
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        


        $credentials = $request->only('email', 'password');
 

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have successfully loggedin');
        }
  
        return redirect("login")->withError('Opps! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request): RedirectResponse
    {  
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',

        //     'password' => 'required|min:6',
        // ]);
           
        // $data = $request->all();
        // $user = $this->create($data);
            
        // Auth::login($user); 

        // return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|ends_with:@edi-indonesia.co.id|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.ends_with' => 'Email harus menggunakan domain @edi-indonesia.co.id.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    
        // Redirect ke halaman sukses atau login
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function dashboard()
    {
        if(Auth::check()){

            $id =  auth()->user()->id;
            $profile = User::find($id);
            
            
            return view('auth\dashboard', compact('profile'));
      
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
    
    public function Rekrutmen()
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
            return view('rekrutmen', compact('profile', 'rekrutmen','countapplyments'));
        }
    
        return redirect("login")->withSuccess('Oops! You do not have access');
    }



    public function profile()
    {
        if(Auth::check()){
            
            $id =  auth()->user()->id;
            $profile = User::find($id);
            
            $countapplyments = Applyment::where('status_apply', 'incoming')->count();
            return view('Profile',compact('profile','countapplyments'));
      
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    
    public function updateprofile(Request $request)
{
    $user = Auth::user(); // Mendapatkan user yang sedang login

    // Validasi gambar
    $request->validate([
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);


    $imagePath = null;
    $imageName = null;

    if ($request->hasFile('profile_picture')) {
        $imageName = time().'.'.$request->file('profile_picture')->extension(); // Membuat nama file unik
        $request->file('profile_picture')->move(public_path('images/profile'), $imageName); // Memindahkan file ke folder public/images
        $imagePath = 'images/profile/'.$imageName; // Menyimpan path file
        $user->profile_picture = $imageName;
    }

    // if ($request->hasFile('profile_picture')) {
    //     // Upload file
    //     $file = $request->file('profile_picture');
    //     $fileName = time() . '.' . $file->getClientOriginalExtension();
    //     $file->move(public_path('profile_pictures'), $fileName);

    //     // Simpan path di database
       
    // }

    $user->save();

    return redirect()->back()->with('success', 'Photo Profile updated successfully.');
  }



public function updatedataProfile(Request $request)
{
    // Validasi input
    $request->validate([
        'username' => 'required|string|max:255',
        'role' => 'required|string|in:Administration,Super Admin', // Sesuaikan dengan opsi yang ada
        'divisi' => 'required|string|in:Corporate Secretariat,Human Resource', // Sesuaikan dengan opsi yang ada
    ]);

    // Ambil data pengguna yang sedang login
    $user = Auth::user();

    if ($user) {
        // Update hanya kolom yang diizinkan
        $user->update([
            'name' => $request->input('username'),
            'role' => $request->input('role'),
            'divisi' => $request->input('divisi'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data Profile has been changes.');
    }

    return redirect("login")->withSuccess('Opps! You do not have access');
    }
     

    public function password()
    {
        if(Auth::check()){
            
            $id =  auth()->user()->id;
            $profile = User::find($id);
            
            $countapplyments = Applyment::where('status_apply', 'incoming')->count();
            return view('Changepass',compact('profile','countapplyments'));
      
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function changePassword(Request $request)
{
    // Validasi input
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = Auth::user();

    // Periksa apakah password lama cocok
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Password lama tidak sesuai.');
    }

    // Update password
    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    return back()->with('success', 'Password berhasil diubah.');
}



}