@extends('auth\master')

@section('isi')

        <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">New Recruitment</h5>
              <div class="card">
                <div class="card-body">

                    <a href="{{ route('newapplyment') }}" class="btn btn-primary mb-3">Add New Applyment</a>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered table-striped nowrap" id="applymentsTable">
                        <thead>
                            <tr>
                                <th>id</th>
                                
                                <th>Asign by</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Tanggal Apply</th>
                                <th>Lamaran</th>
                                <th>Actions</th>
                                <th>File KTP</th>
                                <th>File CV</th>
                                <th>File Lamaran</th>
                                <th>Print Doc</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applyments as $applyment)
                            <tr>
                                <td>{{ $applyment->id }}</td>
                               

                                <td><strong class="text-dark">{{ $applyment->nama }} </strong><br><strong class="text-danger"> {{ $applyment->posisi_title}}</strong></td>
                                <td>{{ $applyment->email }}</td>
                                <td>{{ $applyment->phone }}</td>
                                @if ($applyment->status_apply == "Pending")
                                <td><span class ="badge bg-info text-white">{{ $applyment->status_apply }}</span></td>
                                @elseif ($applyment->status_apply == "Incoming")
                                <td><span class ="badge bg-danger text-white">{{ $applyment->status_apply }}</span></td>
                                @elseif ($applyment->status_apply == "Processed")
                                <td><span class ="badge bg-success text-white">{{ $applyment->status_apply }}</span></td>
                                @elseif ($applyment->status_apply == "Rejected")
                                <td><span class ="badge bg-dark text-white">{{ $applyment->status_apply }}</span></td>

                                @endif
                                <td>{{ $applyment->tanggal_apply }}</td>
                                <td style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $applyment->deskripsi_lamaran }}">{{ $applyment->deskripsi_lamaran }}</td>
                               
                                <td>
                                <a href="#" class="btn btn-sm btn-warning view-btn" data-id="{{ $applyment->id }}" data-bs-toggle="modal" data-bs-target="#viewModal">View</a>
                                <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal" 
                                data-id="{{ $applyment->id }}">Proses</a>
                                <a href="#" class="btn btn-sm btn-danger reject-btn" 
                                data-id="{{ $applyment->id }}" 
                                data-status="{{ $applyment->status_apply }}">
                                Reject
                                </a>

                                </td>
                                 
                                <td>
                                    @if ($applyment->file_ktp)
                                        <a href="{{ asset($applyment->file_ktp) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            Buka KTP
                                        </a>
                                    @else
                                        <span class="text-danger">Belum upload</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($applyment->file_cv)
                                        <a href="{{ asset($applyment->file_cv) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            Buka CV
                                        </a>
                                    @else
                                        <span class="text-danger">Belum upload</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($applyment->file_lamaran)
                                        <a href="{{ asset($applyment->file_lamaran) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            Buka Lamaran
                                        </a>
                                    @else
                                        <span class="text-danger">Belum upload</span>
                                    @endif
                                </td>

                                <td>
                                <button 
                                  class="btn btn-sm printButton" 
                                    data-id="{{ $applyment->id }}"><i class="ti ti-printer"></i>Print</button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal for Viewing Applyment -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Detail Applyment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Dynamic Content -->
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th class = "text-dark" style="width: 25%;">NIK</th>
              <td style="width: 75%;" id="viewNik"></td>
            </tr>
            <tr>
              <th class = "text-dark" style="width: 25%;">Nama</th>
              <td style="width: 75%;" id="viewNama"></td>
            </tr>
            <tr>
              <th class = "text-dark" style="width: 25%;">Email</th>
              <td style="width: 75%;" id="viewEmail"></td>
            </tr>
            <tr>
              <th class = "text-dark" style="width: 25%;">Alamat KTP</th>
              <td style="width: 75%;" id="viewAlamatKtp"></td>
            </tr>
            <tr>
              <th class = "text-dark" style="width: 25%;">Alamat Domisili</th>
              <td style="width: 75%;" id="viewAlamatDomisili"></td>
            </tr>
            <tr>
              <th class = "text-dark" style="width: 25%;" >Phone</th>
              <td style="width: 75%;" id="viewPhone"></td>
            </tr>
            <tr>
              <th class = "text-dark" style="width: 25%;">Posisi Apply</th>
              <td style="width: 75%;" id="viewPosisiApply"></td>
            </tr>
            <tr>
              <th class = "text-dark" style="width: 25%;">Status Apply</th>
              <td style="width: 75%;" id="viewStatusApply"></td>
            </tr>
            <tr>
              <th class = "text-dark" style="width: 25%;">Deskripsi Lamaran</th>
              <td style="width: 75%;" id="viewLamaran"></td>
            </tr>

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi -->
<!-- <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Proses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin memproses data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="confirmYesButton">Yes</button>
            </div>
        </div>
    </div>
</div> -->

@endsection


