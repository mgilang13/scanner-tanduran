<!-- breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('petugas/manajemenpohon'); ?>">Manajemen Pohon</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
</nav>

<!-- jika ada pesan gagal -->
<?php if ($gagal) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $gagal ?>
    </div>

    <script>
        $(".alert").alert();
    </script>
<?php endif ?>

<!-- Card Tambah Data  -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pohon</h6>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>No Pohon</label>
                    <input type="text" class="form-control" id="no_pohon" name="no_pohon" value="<?= $no_pohon; ?>" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label>Jenis Pohon</label>
                    <input type="text" class="form-control" id="jenis_pohon" name="jenis_pohon" placeholder="Jenis Pohon">
                </div>

                <div class="form-group col-md-6">
                    <label>Tinggi Pohon</label>
                    <input type="text" class="form-control" id="tinggi_pohon" name="tinggi_pohon" placeholder="Tinggi Pohon dalam CM">
                    <!-- <select class="custom-select" name="id_kategori">
                        <option value="">--Pilih Kategori--</option>
                        <?php foreach ($kategori as $value) : ?>
                            <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select> -->
                </div>
                <div class="form-group col-md-6">
                    <label>Diameter Pohon</label>
                    <input type="text" class="form-control" id="diameter" name="diameter" placeholder="Diameter Pohon dalam CM">
                    <!-- <select class="custom-select" name="id_supplier">
                        <option value="">--Pilih Supplier--</option>
                        <?php foreach ($supplier as $value) : ?>
                            <option value="<?= $value['id_supplier']; ?>"><?= $value['nama_supplier']; ?></option>
                        <?php endforeach; ?>
                    </select> -->
                </div>
                <!-- inputan hidden -->
                <!-- <input type="text" class="form-control" id="stock_toko" name="stock_toko" value="0" hidden>
                <input type="text" class="form-control" id="stock_gudang" name="stock_gudang" value="0" hidden> -->
                <div class="col-sm-12 col-md-6 col-lg-6 md-2">
                    <label>Catatan</label>
                    <textarea placeholder="Masukkan catatan.." class="form-control" id="catatan" name="catatan"></textarea>
                </div>
            </div>
    </div>
    <div class="card-footer text-md-right">
        <a href="<?= base_url('petugas/manajemenpohon'); ?>" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    </form>
</div>