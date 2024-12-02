@extends('Auth\master')
@section('isi')

<div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Report Applyment</h5>
              <div class="card">
                <div class="card-body">
                      
                 
                <!-- {{ route('applyments.filter') }} -->

                <form method="POST" action="{{ route('applyments.filter') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Tanggal Awal</label>
                            <input type="date" id="start_date" name="start_date" class="form-control"  value="{{ old('start_date') }}" required>
                            
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" id="end_date" name="end_date" class="form-control"  value="{{ old('end_date') }}" required   >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="posisi_apply" class="form-label">Posisi</label>
                            <select id="posisi_apply" name="posisi_apply" class="form-select">
                                <option value="">Semua Posisi</option>
                                @foreach ($positions as $position)
                                    <option 
                                        value="{{ $position->id }}" 
                                        {{ old('posisi_apply') == $position->id ? 'selected' : '' }}>
                                        {{ $position->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>

                <hr>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Posisi Apply</th>
                            <th>Tanggal Apply</th>
                            <th>Nama</th>
                            <th>Phone</th>
                            <th>Status Apply</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applyments as $index => $applyment)
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Nomor urut -->
                                <td><strong>{{ $applyment->posisi_apply }}</strong></td> <!-- Nama posisi dari tabel rekrutmen -->
                                <td><small>{{ $applyment->tanggal_apply }}</small></td> <!-- Tanggal apply -->
                                <td class="text-info"><strong>{{ $applyment->nama }}</strong><br> <!-- Nama pelamar -->
                                {{ $applyment->email }}</td> <!-- Email pelamar -->
                                <td class="text-info">{{ $applyment->phone }}</td> <!-- Nomor telepon -->
                                <!-- <td>{{ $applyment->status_apply }}</td> -->

                                @if ($applyment->status_apply == "Pending")
                                <td><span class ="badge bg-info text-white">{{ $applyment->status_apply }}</span></td>
                                @elseif ($applyment->status_apply == "Incoming")
                                <td><span class ="badge bg-danger text-white">{{ $applyment->status_apply }}</span></td>
                                @elseif ($applyment->status_apply == "Processed")
                                <td><span class ="badge bg-success text-white">{{ $applyment->status_apply }}</span></td>
                                @elseif ($applyment->status_apply == "Rejected")
                                <td><span class ="badge bg-dark text-white">{{ $applyment->status_apply }}</span></td>

                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>



                 </div>
              </div>
            </div>
</div>

@endsection