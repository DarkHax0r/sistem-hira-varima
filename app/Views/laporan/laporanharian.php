<?= $this->extend('admin/sidebar') ?>
<?= $this->section('main'); ?>


<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#importexcel">Import Excel</button>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Tanggal</th>
                                <th>Pendapatan</th>
                                <th>Modal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>cek</td>
                                <td>cek</td>
                                <td>cek</td>
                            </tr>
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
                <form id="formTambah">
                    <!-- Input field -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="pendapatan" class="form-label">Pendapatan</label>
                        <input type="text" class="form-control" id="pendapatan" name="pendapatan">
                    </div>
                    <div class="mb-3">
                        <label for="modal" class="form-label">Modal</label>
                        <input type="modal" class="form-control" id="modal" name="modal">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="simpanData">Simpan</button>
            </div>
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
                <form id="formTambah">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Import File</label>
                        <input type="file" class="form-control" id="excel" name="excel">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="simpanData">Simpan</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css"></script>
<script>
    $(document).ready(function() {
        $('#table1').DataTable({
            searching: true
        });

        $('button[data-bs-target="#tambahModal"]').click(function() {
            $('#tambahModal').modal('show');
        });

        $('#simpanData').click(function() {


            // Ambil nilai dari form
            var tanggal = $('#tanggal').val();

            $('#tambahModal').modal('hide');
        });
    });
</script>
<?= $this->endSection(); ?>