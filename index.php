<?php 
	if (isset($_SESSION['sk'])) {
		echo "<script type='text/javascript'>
                window.location.replace(\"dashboard\");
            </script>";
        exit();
	}
?>

<style type="text/css">
	#background {
		background-image: url("img/bc-t.jpeg");
		background-color: #cccccc;
		height: 100px;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>

<nav class="navbar bg-dark" style="background-color:#410f63 !important">
	<div class="container">
		<a class="navbar-brand tp-fc-white tp-p-all-10 bebas" href="#">
			<img src="img/wh_logo.png" alt="" width="60" class="d-inline-block align-text-top">
			<span class="tp-p-lf-15 tp-vc-absolute">SINGA YEHUDA MENGAUM</span>
		</a>
		<button class="btn btn-primary tp-rnd-20" data-bs-toggle="modal" data-bs-target="#loginModal">Login <i class="fa-solid fa-arrow-right-to-bracket"></i></button>
	</div>
</nav>
<form action="core/signin.php" method="POST">
	<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Masuk <i class="fa-solid fa-arrow-right-to-bracket"></i></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label for="lg_identity" class="form-label tp-fs-bold">Email</label>
						<input required type="text" class="form-control" id="lg_identity" name="lg_identity" placeholder="misal : kcz@gmail.com">
					</div>
					<div class="mb-3">
						<label for="lg_password" class="form-label tp-fs-bold">Kata Sandi</label>
						<input required type="password" class="form-control" id="lg_password" name="lg_password" placeholder="Silahkan isi Password Anda">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name="submit_si">Login <i class="fa-solid fa-arrow-right-to-bracket"></i></button>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="container-fluid" id="background">
	<div class="row">
		<div class="col-10 offset-1 tp-fc-white" style="height: 100px;">
			<div class="tp-vc-relative">
				<div class="tp-fs-rs-30">Online Form</div>
				<div class="tp-fc-light-grey">Kami menanti jawaban anda.</div>
			</div>
		</div>
	</div>
</div>
<button class="tp-rnd-20 btn btn-success tp-fs-rs-8" style="width:200px; position: fixed; bottom: 10px; right: 10px;z-index: 10;" onclick="goToPage('https://wa.me/6285814862369')">
	<i class="fa-brands fa-whatsapp"></i> Whatsapp Technical Support
</button>
<div class="container">
	<div class="row h-100">
		<div class="col-12 my-auto">
			<div class="card mt-5 mb-5 pt-5 pb-5 p-3" style="background-color:rgba(255, 255, 255, 0.9);">
				<b class="tp-fs-rs-20">RetRet Pasukan SYM</b>
				<hr>
				<section id="welcome" class="tp-ta-ct">
					<h3>Silahkan Masukan Nomor HP dan Tanggal Lahir Anda</h3>
					<div class="mb-3">
						<label for="lg-number" class="form-label tp-fs-bold">Nomor HP (*)</label>
						<input required type="number" class="form-control" id="lg-number" name="lg-number" placeholder="misal : 085812345678">
					</div>
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="mb-3">
								<label for="lg-date" class="form-label tp-fs-bold">Tanggal Lahir (*)</label>
								<select class="form-select" id="lg-date" aria-label="Default select example" required>
								<?php 
									for ($i=0; $i < 31; $i++) { 
								?>
										<option value="<?php echo ($i+1) ?>"><?php echo ($i+1) ?></option>
								<?php
									}
								?>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="mb-3">
								<label for="lg-month" class="form-label tp-fs-bold">Bulan Lahir (*)</label>
								<select class="form-select" id="lg-month" aria-label="Default select example" required>
								<?php 
									$blArr = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
									for ($i=0; $i < count($blArr); $i++) { 
								?>
										<option value="<?php echo ($i+1) ?>"><?php echo ($blArr[$i]) ?></option>
								<?php
									}
								?>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="mb-3">
								<label for="lg-year" class="form-label tp-fs-bold">Tahun Lahir (*)</label>
								<select class="form-select" id="lg-year" aria-label="Default select example" required>
								<?php 
									for ($i=1940; $i < 2015; $i++) { 
								?>
										<option value="<?php echo ($i+1) ?>"><?php echo ($i+1) ?></option>
								<?php
									}
								?>
								</select>
							</div>
						</div>
						<div class="tp-ta-ct">
							<button class="btn btn-success" onclick="logincont()" style="width:150px">Lanjutkan <i class="fa-duotone fa-arrow-right-to-bracket"></i></button>
						</div>
					</div>
				</section>
				<section id="register" class="tp-dsp-none">
					<h1>Bagian A</h1>
					<button class="btn btn-primary mb-2" onclick="back()">Kembali ke menu awal <i class="fa-duotone fa-rotate-left"></i></button>
					<input type="text" value="fm-x2" class="tp-dsp-none" name="fm" id="fm">
					<div class="mb-3">
						<label for="tx_name" class="form-label tp-fs-bold">Nama Lengkap (*)</label>
						<input required type="text" class="form-control" id="tx_name" name="tx_name" placeholder="misal : Andi Kusumo">
					</div>
					<div class="mb-3">
						<label for="tx_number" class="form-label tp-fs-bold">Nomor HP (*)</label>
						<input required type="number" class="form-control" id="tx_number" name="tx_number" placeholder="misal : 085812345678">
						<small><b>1 nomor hp hanya bisa untuk mendaftarkan 1 orang.</b></small>
					</div>
					<div class="mb-3">
						<label for="tx_number" class="form-label tp-fs-bold">Kota Domisili (*)</label>
						<input required type="text" class="form-control" id="tx_city" name="tx_city" placeholder="misal : Jakarta Pusat">
					</div>
					<div class="mb-3">
						<label for="tx_number" class="form-label tp-fs-bold">Alamat Tinggal</label>
						<input type="text" class="form-control" id="tx_address" name="tx_address" placeholder="misal : Jalan Bala Keselamatan nomor 1">
					</div>
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="mb-3">
								<label for="date" class="form-label tp-fs-bold">Tanggal Lahir (*)</label>
								<select class="form-select" id="date" aria-label="Default select example" required>
								<?php 
									for ($i=0; $i < 31; $i++) { 
								?>
										<option value="<?php echo ($i+1) ?>"><?php echo ($i+1) ?></option>
								<?php
									}
								?>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="mb-3">
								<label for="month" class="form-label tp-fs-bold">Bulan Lahir (*)</label>
								<select class="form-select" id="month" aria-label="Default select example" required>
								<?php 
									$blArr = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
									for ($i=0; $i < count($blArr); $i++) { 
								?>
										<option value="<?php echo ($i+1) ?>"><?php echo ($blArr[$i]) ?></option>
								<?php
									}
								?>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="mb-3">
								<label for="year" class="form-label tp-fs-bold">Tahun Lahir (*)</label>
								<select class="form-select" id="year" aria-label="Default select example" required>
								<?php 
									for ($i=1940; $i < 2015; $i++) { 
								?>
										<option value="<?php echo ($i+1) ?>"><?php echo ($i+1) ?></option>
								<?php
									}
								?>
								</select>
							</div>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label tp-fs-bold">Kelas SYM yang Anda Ikuti (*)</label>
						<div class="form-check">
							<input class="form-check-input class_sym" value="1" type="radio" name="class_sym" id="rad1">
							<label class="form-check-label" for="rad1">
								SYM Angkatan 1
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input class_sym" value="2" type="radio" name="class_sym" id="rad2">
							<label class="form-check-label" for="rad2">
								SYM Angkatan 2
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input class_sym" value="3" type="radio" name="class_sym" id="rad3">
							<label class="form-check-label" for="rad3">
								SYM Angkatan 3
							</label>
						</div>
					</div>
					<div class="mb-3">
						<label for="tx_number" class="form-label tp-fs-bold">Pernyataan Keikutsertaan (*)</label>
						<div class="form-check">
							<input class="form-check-input how_sym" value="0" type="radio" name="how_sym" id="rad-off" checked>
							<label class="form-check-label" for="rad-off">
								Saya bersedia mengikuti ret-ret di Surabaya pada tanggal 7-9 Oktober 2022
							</label>
						</div>
					</div>
					<div class="tp-ta-rg">
						<button class="btn btn-success" id="cont" onclick="cont()" style="width:150px">Simpan <i class="fa-solid fa-angles-right"></i></button>
					</div>
					<hr>
					<small>
						<b>Catatan</b>
						<ol>
							<li>Biaya adalah Rp. 600,000.-</li>
							<li>Yang tidak bisa mengisi form diatas, harap hubungi ibu Cyntia</li>
							<li>Yang dicetak dengan menggunakan (*) adalah wajib</li>
							<li>Waktu 7-9 Oktober 2022 di Surabaya</li>
						</ol>
					</small>
				</section>
				<section id="form" class="tp-dsp-none">
					<hr>
					<h1>Bagian B - Tabungan-Ku</h1>
					<h4>Terimakasih telah mendaftar! Fitur menabung akan segera kami sampaikan.</h4>
				</section>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	let fid = 0;
	let enc = 0;
	const register = ()=>{
		$('#welcome').addClass('tp-dsp-none');
		$('#register').removeClass('tp-dsp-none');
		$('#form').addClass('tp-dsp-none');
		$('#cont').removeClass('tp-dsp-none');
	}
	const back = ()=>{
		location.reload();
		// $('#welcome').removeClass('tp-dsp-none');
		// $('#register').addClass('tp-dsp-none');
		// $('#form').addClass('tp-dsp-none');
	}
	const checked = (status) => {
		$('#tx_name').prop('readonly', status);
		$('#tx_number').prop('readonly', status);
		$('#tx_city').prop('readonly', status);
		$('#tx_address').prop('readonly', status);
		$('#date').prop('disabled', status);
		$('#month').prop('disabled', status);
		$('#year').prop('disabled', status);
		$('.class_sym').prop('disabled', status);
		$('.how_sym').prop('disabled', status);
	}
	const cont = ()=>{
		let tx_name = $('#tx_name').val().trim();
		let tx_number = $('#tx_number').val().trim();
		let tx_city = $('#tx_city').val().trim();
		let tx_address = $('#tx_address').val().trim();
		let date = $('#date').val();
		let month = $('#month').val();
		let year = $('#year').val();
		let class_sym = $('input[name="class_sym"]:checked').val();
		let how_sym = $('input[name="how_sym"]:checked').val();
		let fm = $('#fm').val();

		let err = 0;
		if (tx_name.length < 3) {
			Swal.fire('Nama belum diIsi','Silahkan mengisi nama lengkap anda.','error')
			err++;
		}else if (tx_number.length < 8) {
			Swal.fire('Nomor HP belum diIsi','Silahkan mengisi nomor hp anda.','error')
			err++;
		}else if (tx_city.length < 3) {
			Swal.fire('Kota belum diIsi','Silahkan mengisi nama kota.','error')
			err++;
		}

		if (err < 1) {
			Swal.fire({
				icon: 'warning',
				title: 'Apakah anda ingin menyimpan data?',
				text: 'Setelah ini, data anda akan disimpan untuk mengisi formulir lanjutan.',
				showCancelButton: true,
				confirmButtonText: 'Simpan',
				cancelButtonText: `Batalkan`,
			}).then((result) => {
				if (result.isConfirmed) {
					returnAjax({tx_name,tx_number,tx_city,tx_address,date,month,year,class_sym,how_sym,fm},'core/insert_fm.php');
				}
			})
		}
	}

	const flagger = (data) => {
		let json = JSON.parse(data);
		if (json.flag == 'insert_fm') {
			if (json.tmp == 0) {
				$('#welcome').addClass('tp-dsp-none');
				$('#register').removeClass('tp-dsp-none');
				$('#form').removeClass('tp-dsp-none');
				Swal.fire('Silahkan lanjutkan pengisian','Anda dapat mengisi tahapan berikutnya','success')
				fid = json.fid;
				checked(true);
				enc = json.enc;
			}else{
				Swal.fire('Data pernah terdaftar','Silahkan tekan tombol kembali dan tekan tombol biru (tombol pernah mengisi formulir). Silahkan cek kembali atau hubungi Whatsapp 0858-1486-2369 untuk bantuan teknis.','warning')
			}
		}else if (json.flag == 'usn'){
			$('#tp-loader').fadeOut(500);
		}else if (json.flag == 'login'){
			if(json.tmp[0] == 1){
				fid = json.tmp[1][0]['id'];
				$('#tx_name').val(json.tmp[1][0]['name'])
				$('#tx_number').val(json.tmp[1][0]['phone'])
				$('#tx_city').val(json.tmp[1][0]['city'])
				$('#tx_address').val(json.tmp[1][0]['address'])
				$("#date").val(json.tmp[1][0]['date_birth']).change();
				$("#month").val(json.tmp[1][0]['month_birth']).change();
				$("#year").val(json.tmp[1][0]['year_birth']).change();

				$("input[name=class_sym][value='"+json.tmp[1][0]['sym_class']+"']").prop("checked", true);
				$("input[name=how_sym][value='"+json.tmp[1][0]['method']+"']").prop("checked", true);

				checked(true);
				register();
				$('#cont').addClass('tp-dsp-none');
				$('#form').removeClass('tp-dsp-none');

				for (var i = 0; i < json.detail[0]; i++) {
					if (json.detail[1][i]['sd_id'] == '0') {
						$('#saveother').val(json.detail[1][i]['other']);
					}
					$('.fxc_'+json.detail[1][i]['sd_id']).prop('checked',true)
				}

				Swal.fire('Login Sukses','Anda dapat melanjutkan isian formulir bagian B','success')

				enc = json.enc;
			}else{
				checked(false);
				$('#tx_number').val($('#lg-number').val());
				$('#date').val($('#lg-date').val()).change();
				$('#month').val($('#lg-month').val()).change();
				$('#year').val($('#lg-year').val()).change();
				register();
				Swal.fire('Silahkan lengkapi formulir berikut','Bila anda mengalami kesulitan, silahkan tekan tombol whatsapp di kanan bawah.','success')
			}
		}
	}

	const logincont = () =>{
		let fm = $('#fm').val();
		let lg_number = $('#lg-number').val();
		let lg_date = $('#lg-date').val();
		let lg_month = $('#lg-month').val();
		let lg_year = $('#lg-year').val();
		
		let err = 0;
		if (lg_number.trim() == '') {
			Swal.fire('Nomor HP belum diisi','Silahkan mengisi nomor hp anda.','error')
			err++;
		}
		if (err < 1) {
			returnAjax({fm,lg_number,lg_date,lg_month,lg_year},'core/login_fm.php');
		}
	}

	const saveOther = () => {
		let text = $('#saveother').val();
		simpleAjax({text,fid},'core/other_fm.php');
	}
</script>