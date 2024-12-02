@extends('Auth\master')
@section('isi')
        
    
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">List Data Recruitment</h5>
              <div class="card">
                <div class="card-body">
                <a href="{{ route('create.rekrutmen') }}" class="btn btn-primary mb-3">Create New Recruitment</a>
                <br>
                <table class="table table-bordered table-striped nowrap" id="rekrutTable" >
                     <thead>
                     <tr>
                        <th>No.</th>
                        <th>Status</th>
                        <th>Lowongan</th>
                        <th>Lokasi</th>
                        <th>Inactive At</th>
                        <th>Deskripsi</th>
                        <th>Linked Url</th>
                        <th>Jobstreet Url</th>
                        <th>Glint Url</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($rekrutmen as $index => $item)
                        
                            <tr>
                                <td>{{ intval($index) + 1 }}.</td>

                                @if ($item->slug == "Approval")
                                    <td><span class="badge bg-success text-white">{{ $item->slug }}</span></td>
                                @elseif ($item->slug == "Reject")
                                    <td><span class="badge bg-danger text-white">{{ $item->slug }}</span></td>
                                    @elseif ($item->slug == "Disable")
                                    <td><span class="badge bg-primary text-white">{{ $item->slug }}</span></td>
                                    @elseif ($item->slug == "Pending")
                                    <td><span class="badge bg-warning text-white">{{ $item->slug }}</span></td>
                                @else
                                    <td>{{ $item->slug }}</td>
                                @endif

                                <td>{{ $item->title }} <br><strong class = "text-danger"> {{ $item->subtitle }}</strong></td>
                                <td>{{ $item->lokasi }} <br><strong class = "text-info"> {{ $item->jenis_kerja }} </strong></td>
                                <td><small>{{ $item->inactive_at ? \Carbon\Carbon::parse($item->inactive_at)->format('Y-m-d') : '-' }}</small></td>

                                <!-- <td>{{ $item->content }}</td> -->
                                <td style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" 
                                  title="{{ $item->content }}">
                                  {{ $item->content }}
                              </td>

                                
                                
                             
                                <td>{{ $item->linked_url }}</td>
                                <td>{{ $item->jobstreet_url }}</td>
                                <td>{{ $item->glint_url }}</td>

                                <td>
                                    <!-- Tombol Edit -->
                                    <!-- <a href="{{ route('edit.rekrutmen', $item->id) }}" class="btn btn-sm btn-primary"> <i class="ti ti-pencil"></i>Edit </a> -->
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" 
                                        data-id="{{ $item->id }}" 
                                        data-title="{{ $item->title }}" 
                                        data-subtitle="{{ $item->subtitle }}" 
                                        data-content="{{ $item->content }}" 
                                        data-lokasi="{{ $item->lokasi }}" 
                                        data-jenis_kerja="{{ $item->jenis_kerja }}" 
                                        data-inactive_at="{{ $item->inactive_at ? \Carbon\Carbon::parse($item->inactive_at)->format('Y-m-d') : '-'  }}"
                                        data-linked_url="{{ $item->linked_url }}"
                                        data-jobstreet_url="{{ $item->jobstreet_url }}"
                                        data-glint_url="{{ $item->glint_url }}">
                                        Edit
                                    </button>

                                    
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('delete.rekrutmen', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">  Hapus</button>
                                    </form>
                                </td>
                              
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data rekrutmen</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>


            </div>
            </div>

          

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('update.rekrutmen') }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Rekrutmen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="modal_id" id="modal_id">
                    <div class="mb-3">
                        <label for="modal-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="modal_title" name="modal_title" required>
                    </div>
                    <div class="mb-3">
                        <div class ="row">
                            <div class ="col-md-6">
                            <label for="modal-subtitle" class="form-label">Bagian - Divisi</label>
                            <input type="text" class="form-control" id="modal_subtitle" name="modal_subtitle">
                            </div>

                            <div class ="col-md-6">
                            <label for="modal-lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="modal_lokasi" name="modal_lokasi">
                            </div>
                        </div>
                    </div>
            
                    <div class="mb-3">
                        <div class = "row">
                        <div class ="col-md-6">
                            <label for="modal-jenis-kerja" class="form-label">Jenis Kerja</label>
                            <select class="form-select" id="modal_jenis_kerja" name="modal_jenis_kerja" required>
                                <option value="Fulltime">Fulltime</option>
                                <option value="Parttime">Parttime</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>
                        <div class ="col-md-6">
                            <label for="modal_inactive_at" class="form-label">Tanggal Akhir Tayang</label>
                            <input type="date" class="form-control" id="modal_inactive_at" name="modal_inactive_at">
                        </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="modal_editor" class="form-label">Konten</label>
                        <textarea id="modal_editor" name="modal_editor" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="modal-linked" class="form-label">linked url</label>
                        <input type="text" class="form-control" id="modal_linked_url" name="modal_linked_url">
                    </div>

                    <div class="mb-3">
                        <label for="modal-jobstreet" class="form-label">Jobstreet url</label>
                        <input type="text" class="form-control" id="modal_jobstreet_url" name="modal_jobstreet_url">
                    </div>

                    <div class="mb-3">
                        <label for="modal_linked_url" class="form-label">Glint url</label>
                        <input type="text" class="form-control" id="modal_glint_url" name="modal_glint_url">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

    @endsection










