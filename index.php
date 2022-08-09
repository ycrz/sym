<?php 
	if (isset($_SESSION['sk'])) {
		echo "<script type='text/javascript'>
                window.location.replace(\"dashboard\");
            </script>";
        exit();
	}
?>

<link href="js/datatable/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="js/datatable/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="js/datatable/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="js/datatable/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="js/datatable/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
						<label for="tx_number" class="form-label tp-fs-bold">Gender (*)</label>
						<div class="form-check">
							<input class="form-check-input gender" value="1" type="radio" name="gender" id="rad-off" checked>
							<label class="form-check-label" for="rad-off">
								Pria
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input gender" value="2" type="radio" name="gender" id="rad-on">
							<label class="form-check-label" for="rad-on">
								Wanita
							</label>
						</div>
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
							<input class="form-check-input class_sym" value="0" type="radio" name="class_sym" id="rad0">
							<label class="form-check-label" for="rad1">
								Belum pernah ikut Kelas SYM
							</label>
						</div>
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
						<label for="tx_number" class="form-label tp-fs-bold">Bahasa Roh (*)</label>
						<div class="form-check">
							<input class="form-check-input how_sym" value="0" type="radio" name="how_sym" id="rad-off" checked>
							<label class="form-check-label" for="rad-off">
								Sudah bisa berbahasa Roh
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input how_sym" value="1" type="radio" name="how_sym" id="rad-on" checked>
							<label class="form-check-label" for="rad-on">
								Belum bisa berbahasa Roh
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
							<li>Dengan mengisi formulir diatas, saya menyatakan bisa mengikuti acara secara offline</li>
							<li>Peserta adalah yang berumur 15 tahun ke-atas</li>
							<li>Biaya adalah Rp. 600,000.- per orang [hanya biaya hotel 3 hari 2 malam, belum termasuk transport pribadi]</li>
							<li>Yang tidak bisa mengisi form diatas, harap hubungi ibu Cyntia</li>
							<li>Yang dicetak dengan menggunakan (*) adalah wajib</li>
							<li>Waktu 7-9 Oktober 2022 di Blessing Hill Trawas</li>
						</ol>
					</small>
				</section>
				<section id="form" class="tp-dsp-none">
					<hr>
					<h1>Bagian B - Tabungan-Ku</h1>
					<small>Anda dapat melakukan pembayaran retreat secara berkala. Mulai dari <b>Rp. 200.000</b>perbulan dicicil 3x, atau melakukan pembayaran secara penuh sebesar <b>Rp. 600.000</b></small>
					<h3>Metode Virtual Account (cek otomatis)</h3>
					<form method="POST" action="core/payment_integration">
						<input type="text" name="services" class="tp-dsp-none" value="21">
						<input type="text" name="fid" class="tp-dsp-none" id="fid">
						<input type="text" name="name" class="tp-dsp-none" id="name">
	                    <label class="sr-only" for="depo">Rupiah</label>
	                    <div class="input-group mb-2">
	                        <div class="input-group-prepend">
	                            <div class="input-group-text">Rp.</div>
	                        </div>
	                        <input min="200000" value="200000" type="input" class="form-control ret_strict" name="amount" placeholder="minimal 200.000" required>
	                    </div>
	                    <div class="custom-control custom-radio">
	                        <input type="radio" class="custom-control-input" id="customControlValidation2" value="BNI" name="radio-stacked" required checked>
	                        <label class="custom-control-label" for="customControlValidation2">VIRTUAL ACCOUNT : BNI</label>
	                    </div>
	                    <div class="custom-control custom-radio">
	                        <input type="radio" class="custom-control-input" id="customControlValidation3" value="BRI" name="radio-stacked" required>
	                        <label class="custom-control-label" for="customControlValidation3">VIRTUAL ACCOUNT : BRI</label>
	                    </div>
	                    <div class="custom-control custom-radio">
	                        <input type="radio" class="custom-control-input" id="customControlValidation4" value="MANDIRI" name="radio-stacked" required>
	                        <label class="custom-control-label" for="customControlValidation4">VIRTUAL ACCOUNT : MANDIRI</label>
	                    </div>
	                    <div class="custom-control custom-radio">
	                        <input type="radio" class="custom-control-input" id="customControlValidation5" value="PERMATA" name="radio-stacked" required>
	                        <label class="custom-control-label" for="customControlValidation5">VIRTUAL ACCOUNT : PERMATA</label>
	                    </div>
	                    <?php 
	                        $_SESSION['tcpl'] = 'belum terpakai';
	                        $_SESSION['tcpl_trx'] = '';
	                        $_SESSION['tcpl_name'] = '';
	                        $_SESSION['tcpl_bank'] = '';
	                        $_SESSION['tcpl_va'] = '';
	                    ?>
	                    <button type="submit" onclick="loader()" name="tcpl" class="btn btn-primary"><i class="fa-duotone fa-money-bill-1-wave"></i> Bayar</button>
	                </form>
	                <h3 class="tp-m-tp-20">Anda juga dapat mentransferkan ke rekening BCA kami (transfer dan cek manual)</h3>
	                <b>Cara Transfer ke-rekening BCA</b>
					<ol>
						<li>
							Nomor Rekening 6801358311 a/n Purwani Astuti OR Tina
						</li>
						<li>
							Untuk bayar <b>lunas</b> sejumlah 600,000 maka harus ditambah 1 rupiah menjadi <b>600,001</b>
						</li>
						<li>
							Untuk bayar <b>cicilan</b> 3x sejumlah @200,000 maka harus ditambah 2 rupiah menjadi <b>200,002</b>
						</li>
						<li>
							Berita transfer harus memuat <b>SBY - NAMA LENGKAP</b>
						</li>
						<li>
							Konfirmasi ke nomor berikut <a href="wa.me/628170107088">08170107088 (Tina)</a>
						</li>
					</ol>
	                <hr>
					<h3>Data Transaksi Anda</h3>
					<table id="tbl" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:1%">No</th>
                                <th>Nomor Transaksi</th>
                                <th>Nomor Virtual</th>
                                <th>Bank</th>
                                <th>Total</th>
                                <th>Status Pembayaran</th>
                            </tr>
                        </thead>
                    </table>
				</section>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	let max = 600000;
	$('.ret_strict').keyup(function() {
	    let value = $(this).val();
	    if(!$.isNumeric(value)){
	        let res = value.substring(0, value.length-1);
	        $(this).val(200000);
	    }else{
	        let substring = value.substring(0,1);
	        if (substring==0) {
	            $(this).val(value.substring(1, value.length));
	        }
	        if ($(this).val() < 200000) {
	            $(this).val(200000);
	        }else if ($(this).val() > max) {
	            $(this).val(max);
	        }
	    }
	});

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
		$('.gender').prop('disabled', status);
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
		let gender = $('input[name="gender"]:checked').val();
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
					returnAjax({tx_name,tx_number,tx_city,tx_address,date,month,year,class_sym,how_sym,fm,gender},'core/insert_fm.php');
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
				$('#fid').val(json.fid);
				$('#name').val(json.name);
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
				$('#fid').val(json.tmp[1][0]['id']);
				$('#name').val(json.tmp[1][0]['name']);
				$('#tx_name').val(json.tmp[1][0]['name'])
				$('#tx_number').val(json.tmp[1][0]['phone'])
				$('#tx_city').val(json.tmp[1][0]['city'])
				$('#tx_address').val(json.tmp[1][0]['address'])
				$("#date").val(json.tmp[1][0]['date_birth']).change();
				$("#month").val(json.tmp[1][0]['month_birth']).change();
				$("#year").val(json.tmp[1][0]['year_birth']).change();

				$("input[name=class_sym][value='"+json.tmp[1][0]['sym_class']+"']").prop("checked", true);
				$("input[name=how_sym][value='"+json.tmp[1][0]['method']+"']").prop("checked", true);
				$("input[name=gender][value='"+json.tmp[1][0]['gender']+"']").prop("checked", true);

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
        		let table = $('#tbl').DataTable();
        		table.ajax.url("core/getTRX?nid="+fid).load();
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




<script src="js/datatable/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="js/datatable/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="js/datatable/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="js/datatable/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="js/datatable/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="js/datatable/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="js/datatable/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="js/datatable/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="js/datatable/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="js/datatable/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="js/datatable/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="js/datatable/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

<script type="text/javascript">
	$('#tbl').DataTable({
        ajax: {
            url: 'core/getTRX',
            data: {fid},
            dataSrc: ""
        },
        columns: [
        	{
                data: 'no'
            },
            {
                data: 'trx'
            },
            {
                data: 'va'
            },
            {
                data: 'bank'
            },
            {
                data: 'total'
            },
            {
                data: 'status'
            },
        ]
    });
</script>