@extends('Auth\master')
@section('isi')



<div class="card">
    <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Change Password</h5>
              <div class="card">
                <div class="card-body">
                     <div class ="row">
                     <div class="col-md-8">
                     <form method="POST" action="{{ route('user.changePassword') }}">
                        @csrf
           
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Old Password</label>
                            <input 
                                type="password" 
                                name="current_password" 
                                id="current_password" 
                                class="form-control @error('current_password') is-invalid @enderror" 
                                required>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input 
                                type="password" 
                                name="new_password" 
                                id="new_password" 
                                class="form-control @error('new_password') is-invalid @enderror" 
                                required>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirmatiom New Password</label>
                            <input 
                                type="password" 
                                name="new_password_confirmation" 
                                id="new_password_confirmation" 
                                class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                                required>
                            @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                    </div>

                     <div class = "col-md-4 d-flex flex-column align-items-center">
                        <div class = "row">
                        <div class="mb-3">
                        <img src=" {{ asset('images/profile/password.png') }}" 
                                    alt="Profile Picture Bg" 
                                    class="img-thumbnail" 
                                    style="width: 250px; height: 250px; object-fit: cover; border: none;">
                        </div>
                        </div>
                     </div>

                    </div>
                </div>
              </div>
    </div>
</div> 

@endsection