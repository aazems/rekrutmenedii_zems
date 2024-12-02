@extends('Auth\master')
@section('isi')
   

<div class="card">
    <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Create New Recruitment</h5>
              <div class="card">
                <div class="card-body">
                <form method="post" action="{{route('simpanrekrut')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="col-md-3">
                            <label for="dateInput" class="form-label">Tgl Terakhir tayang</label>
                            <input type="date" class="form-control" id="inactive_at" name="inactive_at" 
                            value="{{ old('inactive_at', isset($rekrut->inactive_at) ? \Carbon\Carbon::parse($rekrut->inactive_at)->format('Y-m-d') : '') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                    value="{{ old('title', $rekrut->title ?? '') }}">
                                <div id="judul" class="form-text">Masukkan judul utama rekrutmen.</div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="subtitle" class="form-label">Bagian</label>
                                        <input type="text" class="form-control" id="subtitle" name="subtitle" 
                                            value="{{ old('subtitle', $rekrut->subtitle ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lokasi" class="form-label">Lokasi</label>
                                        <input type="text" class="form-control" id="lokasi" name="lokasi" 
                                            value="{{ old('lokasi', $rekrut->lokasi ?? '') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                            <div class="row">
                            <div class="col-md-6">
                                <label for="jenis_kerja" class="form-label">Kategori</label>
                                <select class="form-select" id="jenis_kerja" name="jenis_kerja">
                                    <option selected>Pilih Kategori Pekerjaan</option>
                                    <option value="Fulltime" {{ old('jenis_kerja', $rekrut->jenis_kerja ?? '') == 'Fulltime' ? 'selected' : '' }}>Full time</option>
                                    <option value="Parttime" {{ old('jenis_kerja', $rekrut->jenis_kerja ?? '') == 'Parttime' ? 'selected' : '' }}>Part time</option>
                                    <option value="Intership" {{ old('jenis_kerja', $rekrut->jenis_kerja ?? '') == 'Intership' ? 'selected' : '' }}>Internship</option>
                                </select>
                              </div>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="editor" class="form-label">Konten</label>
                        <textarea id="editor" name="editor" class="form-control" rows="5">{{ old('editor', $rekrut->content ?? '') }}</textarea>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="editor2" class="form-label">Konten in English</label>
                        <textarea id="editor2" name="editor2" class="form-control" rows="5">{{ old('editor2', $rekrut->content_en ?? '') }}</textarea>
                    </div> -->

                    <div class="mb-3">
                        <label for="linked_url" class="form-label">LinkedIn URL</label>
                        <input type="text" class="form-control" id="linked_url" name="linked_url" value="{{ old('linked_url', $rekrut->linked_url ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="jobstreet_url" class="form-label">JobStreet URL</label>
                        <input type="text" class="form-control" id="jobstreet_url" name="jobstreet_url" value="{{ old('jobstreet_url', $rekrut->jobstreet_url ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="glint_url" class="form-label">Glint URL</label>
                        <input type="text" class="form-control" id="glint_url" name="glint_url" value="{{ old('glint_url', $rekrut->glint_url ?? '') }}">
                    </div>



                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="formfileimg" class="form-label">Upload Image Background</label>
                                <input class="form-control" type="file" id="formfileimg" name="formfileimg" accept="image/*" onchange="previewImage(event)">
                                @if(isset($rekrut->image))
                                    <p class="mt-2">Gambar saat ini: <a href="{{ asset($rekrut->image) }}" target="_blank">Lihat Gambar</a></p>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="redirect_link" class="form-label">Redirect Link</label>
                                <input type="text" class="form-control" id="redirect_link" name="redirect_link" 
                                    value="{{ old('redirect_link', $rekrut->redirect_link ?? '-') }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div id="previewContainer" class="mt-3">
                            <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; display: none;" class="img-thumbnail">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                            <a href="{{ route('hasilrekrutmen') }}" class="btn btn-warning">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit Data</button>
                            </div>
                        </div>
                    </div>
                </form>



                </div>
               </div>
    </div>
</div>

@endsection