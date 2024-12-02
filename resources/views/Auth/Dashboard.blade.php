@extends('Auth\master')

@section('isi')
<div class="row">
          <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Recruitment Overview</h5>
                  </div>
                  <div>
                    <select class="form-select">
                      <option value="1">March 2024</option>
                      <option value="2">April 2024</option>
                      <option value="3">May 2024</option>
                      <option value="4">June 2024</option>
                    </select>
                  </div>
                </div>
                <div id="chart"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12">
              
                <div class="card overflow-hidden">
                  <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Yearly Breakup</h5>
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h4 class="fw-semibold mb-3"> Applyment : {{ $countCurrentYear }}</h4>
                        <div class="d-flex align-items-center mb-3">
                          <span
                            class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                            <i class="ti ti-arrow-up-left text-success"></i>
                          </span>
                          <p class="text-dark me-1 fs-3 mb-0">+ {{ $percentageChange }} %</p>
                          <p class="fs-3 mb-0">last year</p>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="me-4">
                            <span class="round-8 bg-light-danger me-2">{{ $countPreviousYear }}</span>
                            <span class="fs-2">Last year</span>
                          </div>
                          <div>
                            <span class="round-8 bg-light-primary  me-2 ">{{ $countCurrentYear }}</span>
                            <span class="fs-2">This year</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-center">
                          <div id="breakup"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
     
                <div class="card">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                        <h4 class="fw-semibold mb-3">Applyment : {{ $countCurrentMonth }}</h4>
                        <div class="d-flex align-items-center pb-1">
                          <span
                            class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                            <i class="ti ti-arrow-up-left text-danger"></i>
                          </span>
                          <p class="text-dark me-1 fs-3 mb-0">+ {{ $percentageChange2 }} %</p>
                          <p class="fs-3 mb-0">Last Month</p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-user fs-6"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="earning"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Applyment</h5>
                   <div class ="row">
                      <div class ="col-md-9">
                      </div>
                      <div class="col-md-3 d-flex justify-content-end">
                      <a href="{{route('applyment')}}" class="btn btn-danger">Lihat Semua Data</a>
                     </div>
                   </div>
                   <hr>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Id</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Name</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Address</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Identity</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Status</h6>
                        </th>

                        
                      </tr>
                    </thead>
                    <tbody>

                      
                    @forelse ($applyments as $index => $item)

                            <tr>
                                
                              <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ intval($index) + 1 }}.</h6></td>
                              <td class="border-bottom-0">
                                  <h6 class="fw-semibold mb-1">{{ $item->nama }}</h6>
                                  <span class="fw-normal">{{ $item->posisi_title }}</span>                          
                              </td>
                              <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $item->alamat_domisili }}</p>
                              </td>
                              <td class="border-bottom-0">
                                <h6 class="fw-normal mb-0">{{ $item->phone }} <br> {{ $item->email }}</h6>
                              </td>

                              <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                  <span class="badge bg-primary rounded-3 fw-semibold">{{ $item->status_apply }}</span>
                                </div>
                              </td>
                             
                            </tr> 
                            
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                                </tr>
                            
                            @endforelse  
                    </tbody>
                  </table>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection 