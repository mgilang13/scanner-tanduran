<!-- breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('purchasing/managemenbarang'); ?>">Manajemen Pohon</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
</nav>
<!-- jika ada pesan gagal -->
<?php if (!empty($gagal)) :  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $gagal ?>
    </div>

    <script>
        $(".alert").alert();
    </script>
<?php endif; ?>

<!-- Card Tambah Data  -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Pohon</h6>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>No Pohon</label>
                    <input type="text" class="form-control" id="no_pohon" name="no_pohon" placeholder="no_pohon" value="<?= $datapohon['no_pohon']; ?>" readonly>
                </div>
                <div class="col-md-6 form-group">
                    <label>Jenis Pohon</label>
                    <input type="text" class="form-control" id="jenis_pohon" name="jenis_pohon" placeholder="Jenis Pohon" value="<?= $datapohon['jenis_pohon']; ?>">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 md-2 form-group">
                    <label>Tinggi Pohon</label>
                    <input type="text" class="form-control" id="tinggi_pohon" name="tinggi_pohon" placeholder="Tinggi Pohon" value="<?= $datapohon['tinggi_pohon']; ?>">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 md-2 form-group">
                    <label>Diameter Pohon</label>
                    <input type="text" class="form-control" id="diameter" name="diameter" placeholder="Diameter Pohon" value="<?= $datapohon['diameter']; ?>">
                    
                </div>
                
                <input type="text" class="form-control" id="id_pohon" name="id_pohon" value="<?= $datapohon['id_pohon']; ?>" hidden>
                <div class="col-sm-12 col-md-6 col-lg-6 md-2 form-group">
                    <label>Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" placeholder="Masukkan catatan.."><?= $datapohon['catatan']; ?></textarea>
                </div>
            </div>
    </div>
    <div class="card-footer text-md-right">
        <a href="<?= base_url('petugas/manajemenpohon'); ?>" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Ubah</button>
    </div>
    </form>
</div>