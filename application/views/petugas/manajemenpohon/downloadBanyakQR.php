<!-- breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('petugas/manajemenpohon'); ?>">Manajemen Pohon</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
</nav>


<form method="post">
    <label for="firstList">Awal : </label>
    <select name="first_list" id="firstList">
        <?php foreach ($pohon as $key => $value) : ?>
            <option value="<?= $value['no_pohon'] ?>"><?= $value['no_pohon'] ?></option>
        <?php endforeach ?>
    </select>
    <label for="lastList">Akhir : </label>
    <select name="last_list" id="lastList">
        <?php foreach ($pohon as $key => $value) : ?>
            <option value="<?= $value['no_pohon'] ?>"><?= $value['no_pohon'] ?></option>
        <?php endforeach ?>
    </select>
    <button type="submit">Generate Banyak QR</button>
</form>
<button onclick="multiplePrint()">Print Banyak QR</button>

<div>
    <table>
        <thead>
            <tr>
                <th>No POhon</th>
                <th>QR-Code</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ranged_data as $key => $value) : ?>
                <tr>
                    <td><?= $value['no_pohon'] ?></td>
                    <td>
                        <div class="qrcode-bulk" id="<?= $value['no_pohon'] ?>">

                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="<?= base_url('assets/js/qrcode.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/html2canvas.min.js'); ?>"></script>
<script>
    let data_pohon = <?php echo json_encode($ranged_data); ?>;
    let jumlah_data = data_pohon.length;

    for (let i = 0; i < jumlah_data; i++) {
        let no_pohon = data_pohon[i].no_pohon;
        const generatedQR = new QRCode(document.getElementById(no_pohon), {
            text: no_pohon,
        });
        generatedQR.makeCode(no_pohon);
    }

    function multiplePrint() {
        let qrcode = document.getElementsByClassName('qrcode-bulk');
        console.log(qrcode);
        html2canvas(document.querySelector(".qrcode-bulk")).then(canvas => {

            document.body.appendChild(canvas);
            // canvas.toBlob(function(blob) {
            //     saveAs(blob, id);
            // });

            printJS({
                printable: canvas.toDataURL(),
                type: 'image',
                header: 'PrintJS Images Test', // Optional
                showModal: true, // Optional
                modalMessage: 'Printing Images...', // Optional
                style: 'img { max-width: 400px;}' // Optional
            })
        });
    }
</script>