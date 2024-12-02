@extends('Auth\master')
@section('isi')

<div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Report Recruitment</h5>
              <div class="card">
                <div class="card-body">
                     
                <form action="{{ route('report.recruitment.filter') }}" method="GET">
                    <!-- Input Periode Tanggal -->
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Periode Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">Periode Tanggal Selesai</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                        </div>
                    </div>

                    <!-- Input Status -->
                    <div class="mb-3">
                    <div class="col-md-12">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                   </div>

                    <!-- Tombol Submit -->
                    <div class="mb-3">
                      <div class = "row">
                        
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger">  Search Data</button>
                        </div>
                       
                    </div>
                    </div>

                </form>
                <hr>

                <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>No.</th>
                        <th>Status</th>
                        <th>Tanggal Create</th>
                        <th>Tanggal Inactive</th>
                        <th>Posisi</th>
                        <th>Bagian - Divisi</th>
                        <th>Lokasi</th>
                        <th>Total Applyments</th>
                    </tr>
                </thead>
                <tbody>
                
                    @foreach ($recruitments as $recruitment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <!-- <td>{{ $recruitment->slug }}</td> -->

                            @if ($recruitment->slug == "Approval")
                                    <td><span class="badge bg-success text-white">{{ $recruitment->slug }}</span></td>
                                @elseif ($recruitment->slug == "Reject")
                                    <td><span class="badge bg-danger text-white">{{ $recruitment->slug }}</span></td>
                                    @elseif ($recruitment->slug == "Disable")
                                    <td><span class="badge bg-primary text-white">{{ $recruitment->slug }}</span></td>
                                    @elseif ($recruitment->slug == "Pending")
                                    <td><span class="badge bg-warning text-white">{{ $recruitment->slug }}</span></td>
                                @else
                                    <td>{{ $recruitment->slug }}</td>
                                @endif

                            <td><small>{{ $recruitment->created_date }}</small></td>
                            <td><small>{{ $recruitment->inactive_at }}</small></td>
                            <td class = "text-info">{{ $recruitment->title }}</td>
                            <td class = "text-info">{{ $recruitment->subtitle }}</td>
                            
                            <td>{{ $recruitment->lokasi }}<br>
                            <strong>{{ $recruitment->jenis_kerja }}</strong></td>
                            <td>{{ $recruitment->total_applyments }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>

                  </div>
              </div>
            </div>
</div>
      
@endsection