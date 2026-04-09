<?php
include "../header/config.php";
include "../header/sidebar.php";
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>import data admin</h6>
                </div>
                <div class="d-flex">
                    <div class="card-body">
                        <form action="import_admin.php" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-3 p-3">
                            <div class="mb-3">
                                <label for="file_excel" class="form-label">Pilih file Excel (.xlsx)</label>
                                <input type="file" class="form-control" name="file_excel" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                </div>
            </div>
        </div>
    </div>        
</div>