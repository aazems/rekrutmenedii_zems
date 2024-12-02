@extends('auth\master')

@section('isi')
<div class="card">
    <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Create Applyment</h5>
              <div class="card">
                <div class="card-body">
                     
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('applyments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <div class = "row">
            <div class = "col-md-6">
            <label for="tanggal_apply" class="form-label">Tanggal Apply</label>
            <input type="date" class="form-control" name="tanggal_apply" id="tanggal_apply" required>
            </div>
             </div>
        </div>

        <div class="mb-3">
        <div class = "row">
                <div class = "col-md-6">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" name="nik" id="nik" required>
            </div>
            <div class = "col-md-6">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" required>
            </div>
             
        </div>
        </div>

        <div class="mb-3">
            <div class = "row">
            <div class = "col-md-6">
                <label for="alamat_ktp" class="form-label">Alamat KTP</label>
                <textarea class="form-control" name="alamat_ktp" id="alamat_ktp" required></textarea>
            </div>

            <div class = "col-md-6">
                <label for="alamat_domisili" class="form-label">Alamat Domisili</label>
                <textarea class="form-control" name="alamat_domisili" id="alamat_domisili" required></textarea>
           </div>
            </div>
        </div>


        <div class="mb-3">
            <div class = "row">
            <div class = "col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" required>
            </div>
            <div class = "col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
            </div>
            </div>
        </div>


        <div class="mb-3">
            <div class = "row">
            <div class = "col-md-6">
            <label for="file_ktp" class="form-label">File KTP</label>
            <input type="file" class="form-control" name="file_ktp" id="file_ktp" required>
            </div>
            </div>
        </div>

        <div class="mb-3">
            <div class = "row">
            <div class = "col-md-6">
            <label for="file_cv" class="form-label">File CV</label>
            <input type="file" class="form-control" name="file_cv" id="file_cv" required>
            </div>
            </div>
        </div>

        <div class="mb-3">
            <div class = "row">
            <div class = "col-md-6">
            <label for="file_lamaran" class="form-label">File Lamaran</label>
            <input type="file" class="form-control" name="file_lamaran" id="file_lamaran" required>
            </div>
            </div>
        </div>

        <div class="mb-3">
        <div class = "row">
        <div class = "col-md-8">
            <label for="deskripsi_lamaran" class="form-label">Deskripsi Lamaran</label>
            <textarea class="form-control" name="deskripsi_lamaran" id="deskripsi_lamaran" rows = '8'></textarea>
            </div>
            </div>
        </div>

        <div class="mb-3">
        <div class = "row">
        <div class = "col-md-6">
            <label for="posisi_apply" class="form-label">Posisi Apply</label>
            <input type="text" class="form-control" name="posisi_apply" id="posisi_apply" required>
        </div>
        </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


                </div>
              </div>
     </div>
</div>
@endsection
