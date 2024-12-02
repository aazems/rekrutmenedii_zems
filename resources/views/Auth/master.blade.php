<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Admin Karir - EDII</title>

  <link rel="shortcut icon" type="image/png" href="images/logos/hr.jpg" />
  <link rel="stylesheet" href="css/styles.min.css" />




  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <script src="js/bootstrap-select.min.js"></script> -->
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/m9p8474tex0nofv17x2l5mcesiaqwfqegoaseltw21xh581n/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="" class="text-nowrap logo-img">
            <img src="images/hrd.png" width="200"  alt="logo Edii" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('home')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Menu</span>
            </li>
          

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('rekrutmen')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Rekrutmen</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('applyment')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-folder"></i>
                </span>
                <span class="hide-menu">Applyment</span>
                <span class="badge text-bg-secondary">
                     <small> {{ $countapplyments}} new </small>
                </span>
              </a>
            </li>

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Report</span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('report_recruitment')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-folder"></i>
                </span>
                <span class="hide-menu">Report Recruitment</span>
              </a>
            </li>
            <!-- report.applyment -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('report_applyment')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-files"></i>
                </span>
                <span class="hide-menu">Report Applyment</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Tasklist </span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div> 
              </a>
              <!-- <h5>Hi, {{ auth()->user()->name }}</h5> -->
            </li>

            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)">
                
                <h5>Hi, {{ auth()->user()->name }}</h5>
              </a>
              
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">

          

            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <!-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> -->
              
              @session('success')
            <div class="alert alert-success alert-sm" role="alert"> 
              {{ $value }}
            </div>
             @endsession

              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <!-- <img src="images/profile/user.png" alt="" width="35" height="35" class="rounded-circle"> -->
                  <img src="{{ auth()->user()->profile_picture ? asset('images/profile/'.$profile->profile_picture) : asset('images/profile/user.png') }}" alt="" width="35" height="35" class="rounded-circle border">

                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="{{route('profile')}}" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="{{route('password')}}" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-lock fs-6"></i>
                      <p class="mb-0 fs-3">Change Password</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>


                <a class="btn btn-outline-primary mx-3 mt-2 d-block" href="{{ route('logout') }}" 
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();>
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
                    @csrf
                </form>

                    Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        
        @yield('isi')
        
       
        
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4"><small>Design and Developed by <strong>PT EDI Indonesia 2024</strong><small></p>
        </div>
      </div>
    </div>
  </div>
  <script src="libs/jquery/dist/jquery.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/sidebarmenu.js"></script>
  <script src="js/app.min.js"></script>
  <script src="libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="libs/simplebar/dist/simplebar.js"></script>
  <script src="js/dashboard.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <script>
    tinymce.init({
        selector: '#editor',
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic underline strikethrough | ' +
                 'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | ' +
                 'link image media | forecolor backcolor removeformat | ' +
                 'insertdatetime charmap table | fullscreen preview code | help',
        menubar: 'file edit view insert format tools table help',
    });

   
    tinymce.init({
        selector: '#modal-editor',
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic underline strikethrough | ' +
                 'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | ' +
                 'link image media | forecolor backcolor removeformat | ' +
                 'insertdatetime charmap table | fullscreen preview code | help',
        menubar: 'file edit view insert format tools table help',
    });
    
    function previewImage(event) {
        const input = event.target;
        const previewImage = document.getElementById("previewImage");
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = "block";
            };
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewImage.style.display = "none";
        }
    }

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('imagePreview'); // Sesuaikan dengan elemen target Anda
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>


<script>
    $(document).ready(function() {
        $('#applymentsTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" // Bahasa Indonesia
            },
            "scrollX": true, // Scroll horizontal
            "scrollCollapse": true, // Scroll aktif hanya jika data lebih panjang
            "paging": true, // Aktifkan paginasi
            "info": true, // Tampilkan informasi jumlah data
            "searching": true, // Aktifkan pencarian
            "ordering": true, // Aktifkan pengurutan
            "columnDefs": [
                { "width": "5%", "targets": 0 }, // Lebar kolom pertama
                { "width": "10%", "targets": 1 }, // Lebar kolom kedua
                { "width": "20%", "targets": 2 }, // Lebar kolom ketiga
            ],
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#rekrutTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" // Bahasa Indonesia
            },
            "scrollX": true, // Scroll horizontal
            "scrollCollapse": true, // Scroll aktif hanya jika data lebih panjang
            "paging": true, // Aktifkan paginasi
            "info": true, // Tampilkan informasi jumlah data
            "searching": true, // Aktifkan pencarian
            "ordering": true, // Aktifkan pengurutan
            "columnDefs": [
                { "width": "5%", "targets": 0 }, // Lebar kolom pertama
                { "width": "10%", "targets": 1 }, // Lebar kolom kedua
                { "width": "20%", "targets": 2 }, // Lebar kolom ketiga
            ],
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Tombol yang memicu modal data dari db
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const subtitle = button.getAttribute('data-subtitle');
            const lokasi = button.getAttribute('data-lokasi');
            const jenisKerja = button.getAttribute('data-jenis_kerja');
            const inactiveAt = button.getAttribute('data-inactive_at');
            const content = button.getAttribute('data-content');
            const linked_url = button.getAttribute('data-linked_url');
            const jobstreet_url = button.getAttribute('data-jobstreet_url');
            const glint_url = button.getAttribute('data-glint_url');

            // Set nilai input di modal
            editModal.querySelector('#modal_id').value = id;
            editModal.querySelector('#modal_title').value = title;
            editModal.querySelector('#modal_subtitle').value = subtitle;
            editModal.querySelector('#modal_lokasi').value = lokasi;
            editModal.querySelector('#modal_jenis_kerja').value = jenisKerja;
            editModal.querySelector('#modal_inactive_at').value = inactiveAt;
            editModal.querySelector('#modal_editor').value = content;
            editModal.querySelector('#modal_linked_url').value = linked_url;
            editModal.querySelector('#modal_jobstreet_url').value = jobstreet_url;
            editModal.querySelector('#modal_glint_url').value = glint_url;
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.view-btn').on('click', function () {
            var id = $(this).data('id'); // Get the ID from the button

            // Perform an AJAX request to get the data
            $.ajax({
                url: '/applyments/' + id, // Endpoint to get the applyment data
                method: 'GET',
                success: function (data) {
                    // Populate modal fields with response data
                    $('#viewNik').text(data.nik);
                    $('#viewNama').text(data.nama);
                    $('#viewEmail').text(data.email);
                    $('#viewAlamatKtp').text(data.alamat_ktp);
                    $('#viewAlamatDomisili').text(data.alamat_domisili);
                    $('#viewPhone').text(data.phone);
                    $('#viewPosisiApply').text(data.posisi_title);
                    $('#viewStatusApply').text(data.status_apply);
                    $('#viewLamaran').text(data.deskripsi_lamaran);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    });
</script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    let selectedId = null; // Variabel untuk menyimpan ID yang dipilih

    // Tangkap semua tombol "Proses"
    document.querySelectorAll('.btn-success').forEach(button => {
        // Hapus semua event listener sebelumnya sebelum menambahkan yang baru
        button.removeEventListener('click', onProcessClick);

        // Tambahkan event listener dengan fungsi handler
        button.addEventListener('click', onProcessClick);
    });

    // Fungsi handler untuk tombol "Proses"
    function onProcessClick() {
        selectedId = this.getAttribute('data-id'); // Ambil ID dari data-id tombol

        // Tampilkan konfirmasi dengan SweetAlert
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan diproses!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proses!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika Yes diklik, kirim request ke server
                fetch(`/applyment/${selectedId}/proses`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Pastikan CSRF token disertakan
                    },
                    body: JSON.stringify({
                        status_apply: 'Processed' // Nilai status baru
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Berhasil!',
                            'Data berhasil diperbarui.',
                            'success'
                        ).then(() => {
                            location.reload(); // Refresh halaman setelah sukses
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat memproses data.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat memproses data.',
                        'error'
                    );
                });
            }
        });
    }
});


document.addEventListener('DOMContentLoaded', function () {
    // Tangkap semua tombol "Reject"
    document.querySelectorAll('.reject-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah default action dari tombol

            const applymentId = this.getAttribute('data-id'); // ID dari data
            const currentStatus = this.getAttribute('data-status'); // Status saat ini

            // Periksa status
            if (currentStatus === 'Processed') {
                // Jika status sudah Processed, tampilkan pesan error
                Swal.fire({
                    title: 'Tidak Bisa Ditolak',
                    text: 'Data dengan status "Processed" tidak dapat di-reject.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return; // Hentikan eksekusi
            }

            // Konfirmasi perubahan status
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data akan diubah menjadi "Rejected".',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Reject!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim request ke server untuk mengubah status
                    fetch(`/applyment/${applymentId}/reject`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Pastikan CSRF token disertakan
                        },
                        body: JSON.stringify({
                            status_apply: 'Rejected' // Nilai status baru
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Berhasil!',
                                'Data berhasil di-reject.',
                                'success'
                            ).then(() => {
                                location.reload(); // Refresh halaman setelah sukses
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat memproses data.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat memproses data.',
                            'error'
                        );
                    });
                }
            });
        });
    });
});


</script>


<!-- print  -->



</body>

</html>