<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

</head>

<body>
	<div class="container">
		<h3>Scanner Tanduran v1.0</h3>
		<div class="col-8">

			<table class="table">
				<thead>
					<tr>
						<th scope="col">UID</th>
						<th scope="col">Nama Pohon</th>
						<th scope="col">Kode Pohon</th>
						<th scope="col">Aksi</th>
						<th scope="col">Hasil</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($dataPohon as $pohon) { ?>
						<tr>
							<td><?= $pohon->id; ?></td>
							<td><?= $pohon->nama_pohon ?></td>
							<td><?= $pohon->kode_pohon ?></td>
							<td>
								<button class="btn btn-primary btn-sm" onclick="generateQRCode(this)" data-id="<?= $pohon->id; ?>">Generate QR Code</button>
							</td>
							<td>
								<div class="col-1" id="generated-qrcode">

								</div>
								<a id="download-qr" hidden>Download</a>
							</td>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<button type="button" class="btn btn-primary" id="play" data-bs-toggle="modal" data-bs-target="#scanModal">
			Scan
		</button>
		<!-- Modal -->
		<div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="Scan" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Scan QR Code Pohon</h5>
						<button type="button" class="btn-close" id="stop" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="center">
							<div class="well" style="position: relative;display: inline-block;">
								<canvas width="320" height="240" id="webcodecam-canvas"></canvas>
								<div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
								<div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
								<div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
								<div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
							</div>
							<div class="well" style="width: 100%;">
								<label id="zoom-value" width="100">Zoom: 2</label>
								<input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20">
							</div>
						</div>
						<h4>Scanned result</h4>
						<p id="scanned-QR"></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" id="pinned" data-bs-dismiss="modal">Pin It!</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="<?= base_url('assets/js/qrcodelib.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/webcodecamjs.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/main.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?= base_url('assets/js/qrcode.js'); ?>"></script>

<script>
	function generateQRCode(event) {
		let id = event.getAttribute('data-id');
		const generatedQR = new QRCode(document.getElementById("generated-qrcode"), {
			text: id
		});

		generatedQR.makeCode(id);

		setTimeout(() => {
			let qelem = document.querySelector('#generated-qrcode img')
			let dlink = document.querySelector('#download-qr')
			let qr = qelem.getAttribute('src');
			dlink.setAttribute('href', qr);
			dlink.setAttribute('download', id);
			dlink.removeAttribute('hidden');
		}, 500);

		// const btnDownload = document.createElement("a");
		// btnDownload.innerHTML = "Download";
		// btnDownload.classList.add("btn");
		// btnDownload.classList.add("btn-sm");
		// btnDownload.classList.add("btn-success");
		// btnDownload.classList.add("btn-download");
		// btnDownload.download = qrImage;

		// document.getElementById("generated-qrcode").appendChild(btnDownload);
	}
</script>

</html>