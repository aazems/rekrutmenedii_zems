@extends('Auth\master')
@section('isi')


<div class="card">
    <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">My Profile</h5>
              <div class="card">
                <div class="card-body">
               
              
                     <div class ="row">

                        <div class="col-md-4 d-flex flex-column align-items-center">
                        <form method="POST" action="{{route('user.updateProfile') }}" enctype="multipart/form-data">
                        @csrf

                            <p class="text-center">Photo Profile</p>
                            <div class="mb-3">
                                <img src="{{ $profile->profile_picture ? asset('images/profile/'.$profile->profile_picture) : asset('images/profile/user.png') }}" 
                                    alt="Profile Picture" 
                                    class="img-thumbnail" 
                                    style="width: 250px; height: 250px; object-fit: cover;">
                            </div>


                            <div class="mb-3">
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                            </div>


                            <div class="mb-3 w-100">
                            <button type="submit" class="btn btn-primary w-100">Change Photo</button>
                               
                            </div>
                            </form>
                        </div>

                        <!-- kolom 2  -->

                        <div class ="col-md-8">
                            <form method="POST" action="{{route('user.updatedataProfile') }}">
                                @csrf

                            <div class="mb-3">
                                    <label for="textInput" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                        value="{{ old('name', $profile->name ?? '') }}">
                                    
                            </div>

                            <div class="mb-3">
                                    <label for="dateInput" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                    value="{{ old('email', $profile->email ?? '') }}" disabled>
                                    <div id="judulemail" class="form-text"> <i class="text-danger">Sorry you cant change your email with this methode</i></div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                    <label for="jenis_kerja" class="form-label">Role</label>
                                    <select class="form-select" id="role" name="role">
                                        <option selected>Pilih Role user</option>
                                        <option value="Administration" {{ old('role', $profile->role ?? '') == 'Administration' ? 'selected' : '' }}>Administration</option>
                                        <option value="Super Admin" {{ old('role', $profile->role ?? '') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                        
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                    <label for="jenis_kerja" class="form-label">Divisi</label>
                                    <select class="form-select" id="divisi" name="divisi">
                                        <option selected>Pilih Divisi</option>
                                        <option value="Corporate Secretariat" {{ old('divisi', $profile->divisi ?? '') == 'Corporate Secretariat' ? 'selected' : '' }}>Corporate Secretariat</option>
                                        <option value="Human Resource" {{ old('divisi', $profile->divisi ?? '') == 'Human Resource' ? 'selected' : '' }}>Human Resource</option>
                                        
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                    <label for="textInput" class="form-label">status</label>
                                    <input type="text" class="form-control" id="status" name="status" 
                                    value="{{ old('status', $profile->status ?? '') }}" disabled>
                                    </div>
                                </div>
                            </div>
                            
                                <hr>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-7"></div>
                                    <div class="col-md-5">
                                        <button type="submit" class="btn btn-success">Save Change</button>
                                        <button type="Cancel" class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                 

 
                     </div>
              
                </div>
             </div>
    </div>
</div>

@endsection
