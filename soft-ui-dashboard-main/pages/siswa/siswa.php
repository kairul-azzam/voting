<!--
=========================================================
* Soft UI Dashboard 3 - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
include "../header/sidebar.php";
include "../header/config.php";


$halaman = basename($_SERVER['PHP_SELF']);
// server dan php self digunakan untuk mengambil nama file yang sedang diakses
//basename digunakan untuk mengambil nama file dari sebuah path

?>


<script src="https://kit.fontawesome.com/ef1f748698.js" crossorigin="anonymous"></script>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4 p-3">
        <h6>data siswa</h6>
        <div class="card-header pb-0 d-flex gap-3">
          
          <a href="tambahsiswa.php" class="btn btn-primary">tambah data</a>
          <a href="importsiswa.php" class="btn btn-primary">import data</a>
          <form action="export_pdfsiswa.php" method="POST" target="_blank">
            <input type="hidden" name="chart_image" id="chart_image">
            <button type="submit" onclick="exportPDF()" class="btn btn-danger">
              Export PDF
            </button>
          </form>
          <a href="../../../siswa.csv" class="btn btn-warning mb-3 download">
            download template excel
          </a>
          <a href="#" id="btn-delete-all" data-href="deleteall.php?confirm=yes" class="btn btn-danger mb-3" style="margin-left: auto;">
            delete all
          </a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">kelas</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">jurusan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">alamat</th>

                </tr>
              </thead>
              <tbody>

                <tr>
                  <?php
                  $no = 1;
                  $query = mysqli_query($koneksi, "SELECT * FROM tblsiswa");
                  foreach ($query as $data):
                  ?>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <h6 class="mb-0 text-sm"><?= $no++; ?></h6>
                        </div>
                      </div>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../../assets/img/<?= $data['foto'] ?>" class="avatar avatar-sm me-3" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $data['nama'] ?></h6>
                          <p class="text-xs text-secondary mb-0"><?= $data['email'] ?></p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success"><?= $data['kelas'] ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= $data['jurusan'] ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= $data['alamat'] ?></span>
                    </td>

                    <td class="align-middle">
                      <a href="editsiswa.php?id=<?= $data['id_siswa'] ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
                      </a>
                    </td>
                    <td class="align-middle">
                      <a href="#" class="text-light p-2 rounded bg-danger" onclick="deletesiswa(<?= $data['id_siswa'] ?>)" data-toggle="tooltip" data-original-title="Edit user">
                        <i class="fa-solid fa-trash-can" style="color: #FFFF;"></i>
                      </a>
                    </td>
                </tr>
                <tr>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</main>
<div class="fixed-plugin">
  <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
    <i class="fa fa-cog py-2"> </i>
  </a>
  <div class="card shadow-lg ">
    <div class="card-header pb-0 pt-3 ">
      <div class="float-start">
        <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
        <p>See our dashboard options.</p>
      </div>
      <div class="float-end mt-4">
        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
          <i class="fa fa-close"></i>
        </button>
      </div>
      <!-- End Toggle Button -->
    </div>
    <hr class="horizontal dark my-1">
    <div class="card-body pt-sm-3 pt-0">
      <!-- Sidebar Backgrounds -->
      <div>
        <h6 class="mb-0">Sidebar Colors</h6>
      </div>
      <a href="javascript:void(0)" class="switch-trigger background-color">
        <div class="badge-colors my-2 text-start">
          <span class="badge filter bg-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
        </div>
      </a>
      <!-- Sidenav Type -->
      <div class="mt-3">
        <h6 class="mb-0">Sidenav Type</h6>
        <p class="text-sm">Choose between 2 different sidenav types.</p>
      </div>
      <div class="d-flex">
        <button class="btn btn-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
        <button class="btn btn-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
      </div>
      <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
      <!-- Navbar Fixed -->
      <div class="mt-3">
        <h6 class="mb-0">Navbar Fixed</h6>
      </div>
      <div class="form-check form-switch ps-0">
        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
      </div>
      <hr class="horizontal dark my-sm-4">
      <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard">Free Download</a>
      <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
      <div class="w-100 text-center">
        <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
        <h6 class="mt-3">Thank you for sharing!</h6>
        <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
          <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
          <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
        </a>
      </div>
    </div>
  </div>
</div>
<!--   Core JS Files   -->
<script src="../../assets/js/core/popper.min.js"></script>
<script src="../../assets/js/core/bootstrap.min.js"></script>
<script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>

<script>
  function deletesiswa(id_siswa) {
    Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: "Data yang dihapus tidak dapat dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "delete_siswa.php?id=" + id_siswa;
        swal.fire(
          'Dihapus!',
          'Data siswa telah dihapus.',
          'success'
        )

      } else {
        swal.fire(
          'Batal',
          'Data siswa tidak dihapus.',
          'error'
        )
      }
    });
  }
</script>
<!-- SweetAlert2 for delete-all confirmation -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('btn-delete-all');
    if (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var href = btn.getAttribute('data-href');
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: "Semua data siswa akan dihapus dan tidak dapat dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus Semua',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            // redirect to server-side delete handler
            window.location.href = href;
          }
        });
      });
    }
  });
</script>
</body>

</html>