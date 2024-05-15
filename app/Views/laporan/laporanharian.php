<?= $this->extend('admin/sidebar') ?>
<?= $this->section('main'); ?>

<head>

</head>
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Kelola Laporan</h3>

        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan Harian</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#importexcel">Import Excel</button>
            <div class="card">
                <div class="card-body">
                    <?php if (session()->has('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session('success') ?>
                        </div>
                    <?php endif; ?>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Tanggal</th>
                                <th style="text-align: center;">Pendapatan</th>
                                <th style="text-align: center;">Modal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($parfum as $item) : ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no++ ?></td>
                                    <td style="text-align: center;"><?= $item['tanggal'] ?></td>
                                    <td style="text-align: center;"><?= $item['pendapatan'] ?></td>
                                    <td style="text-align: center;"><?= $item['modal'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk input data -->
                <form action="<?= base_url('Laporan/addData') ?>" method="POST">
                    <!-- Input field -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="pendapatan" class="form-label">Pendapatan</label>
                        <input type="number" min="0" class="form-control" id="pendapatan" name="pendapatan">
                    </div>
                    <div class="mb-3">
                        <label for="modal" class="form-label">Modal</label>
                        <input type="number" min="0" class="form-control" id="modal" name="modal">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="importexcel" tabindex="-1" aria-labelledby="importexcel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importexcel">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Laporan/importData') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Import File</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".xls,.xlsx,.csv" placeholder="Masukan File disini" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Import File</label>
                        <a href="#" class="btn btn-success" id="export-file">Export File</a>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    new DataTable('#table1');
</script>

<?= $this->endSection(); ?>