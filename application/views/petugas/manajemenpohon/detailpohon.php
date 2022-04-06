<!-- breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('petugas/manajemenpohon'); ?>">Manajemen Pohon</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
</nav>


<!-- Card  -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Pohon <?= $pohon['no_pohon']; ?> </h6>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>No Pohon</label>
                    <input type="text" class="form-control" id="no_pohon" value="<?= $pohon['no_pohon']; ?>" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label>Jenis Pohon</label>
                    <input type="text" class="form-control" value="<?= $pohon['jenis_pohon']; ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label>Tinggi Pohon</label>
                    <input type="text" class="form-control" value="<?= $pohon['tinggi_pohon']; ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label>Diameter</label>
                    <input type="text" class="form-control" value="<?= $pohon['diameter']; ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label>Catatan</label>
                    <textarea class="form-control" readonly=""><?= $pohon['catatan']; ?></textarea>
                </div>

            </div>
            <div class="card-footer text-md-right">
                <a href="<?= base_url('petugas/manajemenpohon'); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
<div class="card shadow col-4" id="qr-code">
    <div class="card-header text-center">
        <h1 class="font-weight-bold">
            DRADI-2022
        </h1>
    </div>
    <div class="card-body mx-auto">
        <h5 class="font-weight-bold text-center"><?= $pohon['no_pohon'] ?></h5>
        <div id="generated-qrcode"></div>
    </div>
</div>
<div class="card col-4 shadow">
    <div class="card-body">
        <a id="download-qr" onclick="downloadQR()" class="btn btn-success btn-lg col">Download QR</a>
    </div>
</div>
<img src="" alt="" id="papan-nama">


<script type="text/javascript" src="<?= base_url('assets/js/qrcode.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/html2canvas.min.js'); ?>"></script>
<script>
    let id = document.getElementById('no_pohon').value;
    const generatedQR = new QRCode(document.getElementById("generated-qrcode"), {
        text: id
    });
    generatedQR.makeCode(id);

    function downloadQR() {
        html2canvas(document.querySelector("#qr-code")).then(canvas => {
            document.body.appendChild(canvas);
            // canvas.toBlob(function(blob) {
            //     saveAs(blob, id);
            // });
        });


    }
</script>