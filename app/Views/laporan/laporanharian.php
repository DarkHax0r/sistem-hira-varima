<?= $this->extend('admin/sidebar') ?>
<?= $this->section('main'); ?>


<section class="section">
    <div class="row">
        <div class="col-lg-12">
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

<?= $this->endSection(); ?>

<!-- Tambahkan inisialisasi DataTables di bagian bawah halaman -->
<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#table1').DataTable({
            searching: true // Aktifkan fitur pencarian
        });
    });
</script>
<script src="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css"></script>
<?= $this->endSection(); ?>