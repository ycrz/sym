<?php 
	mustProfiling();
?>

<nav class="navbar bg-dark" style="background-color:#410f63 !important">
	<div class="container">
		<a class="navbar-brand tp-fc-white tp-p-all-10 bebas" href="#">
			<img src="img/wh_logo.png" alt="" width="60" class="d-inline-block align-text-top">
			<span class="tp-p-lf-15 tp-vc-absolute">SINGA YEHUDA MENGAUM</span>
		</a>
		<span class="tp-fc-white">Selamat datang, <b><?php echo $_SESSION['sk'][2] ?></b></span>
	</div>
</nav>
<nav class="navbar bg-dark" style="background-color:#f0f0f0 !important">
	<div class="container">
      	<ul class="navbar-nav menu-end mb-2 mb-lg-0">
			<li class="nav-item">
				<button class="btn btn-warning tp-rnd-20" onclick="signout()">signout <i class="fa-duotone fa-right-from-bracket"></i></button>
		    </li>
	    </ul>
    </div>
</nav>
<?php 
	$form = ['fm-x2'];
	for ($i=0; $i < count($form); $i++) { 
		$res = queryBack("SELECT * FROM form_attendee WHERE fm='$form[$i]' order by name");
?>
<div class="container tp-m-tp-30">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">List pendaftaran formulir <i><?php echo $form[$i] ?></i> yang masuk (<?php echo $res[0] ?>)</h5>
					<form class="tp-m-bt-10" action="core/whatsapp.php" method="POST">
						<div class="form-group">
							<input class="tp-dsp-none" name="fid" type="text" value="<?php echo $form[$i] ?>">
							<label for="exampleInputEmail1">Kirim Pesan Whatsapp</label>
							<textarea class="form-control" rows="3" required name="text"></textarea>
						</div>
						<button type="submit"  onclick="fade()" class="btn btn-success tp-rnd-20"><i class="fa-brands fa-whatsapp"></i> Kirim Sekarang ke Whatsapp</button>
					</form>

					<div class="col-12 card tp-bt-cs-blue">
						<div class="row">
							<div class="col-12">
								<table class="table table-striped table-dark">
									<thead>
										<tr>
											<td class="tp-bc-white tp-fc-black" colspan="3"><span class="tp-fs-bold tp-fs-italic">Statistik</span></td>
										</tr>
										<tr>
											<th>Total Pendaftar</th>
											<td>23</td>
											<td>Peserta</td>
										</tr>
										<tr>
											<td class="tp-bc-white tp-fc-black" colspan="3"><span class="tp-fs-bold tp-fs-italic">Berdasarkan Gender</span></td>
										</tr>
										<?php 
											$resStat = queryBack("SELECT mg.name,count(*) as summary FROM form_attendee fa JOIN mst_gender mg on mg.id=fa.gender WHERE fm='".$form[$i]."' GROUP BY mg.name");
											for ($j=0; $j < $resStat[0]; $j++) { 
										?>
												<tr>
													<th><?php echo $resStat[1][$j]['name'] ?></th>
													<td><?php echo $resStat[1][$j]['summary'] ?></td>
													<td>Peserta</td>
												</tr>
										<?php
											}
										?>
										<tr>
											<td class="tp-bc-white tp-fc-black" colspan="3"><span class="tp-fs-bold tp-fs-italic">Kelas SYM</span></td>
										</tr>
										<?php 
											$resStat = queryBack("SELECT ms.name,count(*) as summary FROM form_attendee fa JOIN mst_sym ms on ms.id=fa.sym_class WHERE fm='".$form[$i]."' GROUP BY ms.name");
											for ($j=0; $j < $resStat[0]; $j++) { 
										?>
												<tr>
													<th><?php echo $resStat[1][$j]['name'] ?></th>
													<td><?php echo $resStat[1][$j]['summary'] ?></td>
													<td>Peserta</td>
												</tr>
										<?php
											}
										?>
										<tr>
											<td class="tp-bc-white tp-fc-black" colspan="3"><span class="tp-fs-bold tp-fs-italic">Bahasa Roh</span></td>
										</tr>
										<?php 
											$resStat = queryBack("SELECT mbr.name,count(*) as summary FROM form_attendee fa JOIN mst_bahasa_roh mbr on mbr.id=fa.method WHERE fm='".$form[$i]."' GROUP BY mbr.name");
											for ($j=0; $j < $resStat[0]; $j++) { 
										?>
												<tr>
													<th><?php echo $resStat[1][$j]['name'] ?></th>
													<td><?php echo $resStat[1][$j]['summary'] ?></td>
													<td>Peserta</td>
												</tr>
										<?php
											}
										?>
										<tr>
											<td class="tp-bc-white tp-fc-black" colspan="3"><span class="tp-fs-bold tp-fs-italic">Domisili</span></td>
										</tr>
										
										<?php 
											$resStat = queryBack("SELECT city,count(*) AS summary FROM form_attendee WHERE fm='".$form[$i]."' GROUP BY city ORDER BY city");
											for ($j=0; $j < $resStat[0]; $j++) { 
										?>
												<tr>
													<th><?php echo $resStat[1][$j]['city'] ?></th>
													<td><?php echo $resStat[1][$j]['summary'] ?></td>
													<td>Peserta</td>
												</tr>
										<?php
											}
										?>
									</thead>
								</table>
							</div>
						</div> 
					</div>
					<?php 
						for ($j=0; $j < $res[0]; $j++) { 
							$fixClassSYM = $res[1][$j]['sym_class'];
							if ($res[1][$j]['sym_class'] == 0) {
								$fixClassSYM = 'Belum pernah mengikuti kelas SYM';
							}else{
								$fixClassSYM = '<b>SYM Angkatan '.$fixClassSYM.'</b>';
							}

							$fixHOW = '';
					?>
					<div class="col-12 card tp-bt-cs-blue">
						<div class="row">
							<div class="col-1">
								#<?php echo ($j+1) ?>
							</div>
							<div class="col-11">
								Nama Lengkap : <?php echo $res[1][$j]['name'] ?><br>
								No HP : <?php echo $res[1][$j]['phone'] ?><br>
								Whatsapp : <a href="https://wa.me/<?php echo whatsappSanity($res[1][$j]['phone']) ?>">klik disini</a><br>
								Kota : <?php echo $res[1][$j]['city'] ?><br>
								Alamat : <?php echo $res[1][$j]['address'] ?><br>
								DOB : <?php echo $res[1][$j]['date_birth'] ?>/<?php echo $res[1][$j]['month_birth'] ?>/<?php echo $res[1][$j]['year_birth'] ?><br>
								<hr class="tp-hr">
								Kelas SYM yang diikuti : <?php echo $fixClassSYM ?> <br>
								
								<?php if ($form[$i] == 'fm-x1'): ?>
									<div>
										<button class="btn btn-danger tp-rnd-20" onclick="goToPage('exporter/exporter.php?p=<?php echo encrypt_decrypt_ori('encrypt',$res[1][$j]['id']) ?>')"><i class="fa-duotone fa-file-pdf"></i> Export PDF</button>
									</div>
									<?php 
										if ($res[1][$j]['method'] == 0) {
											$fixHOW = 'Offline';
										}else{
											$fixHOW = 'Online';
										}
									?>
									Cara Ikut Pentahiran : <?php echo $fixHOW ?>
								<?php endif ?>

								<?php if ($form[$i] == 'fm-x2'): ?>
									<?php 
										if ($res[1][$j]['method'] == 0) {
											$fixHOW = 'Sudah Bisa';
										}else{
											$fixHOW = 'Belum Bisa';
										}
									?>
									Bahasa Roh : <?php echo $fixHOW ?> <br>

									<?php 
										if ($res[1][$j]['gender'] == 1) {
											$gender = 'Pria';
										}else if ($res[1][$j]['gender'] == 2) {
											$gender = 'Wanita';
										}else{
											$gender = 'Tidak disebutkan';
										}
									?>
									Gender : <?php echo $gender ?>
								<?php endif ?>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	}
?>
<script type="text/javascript">
	const signout = () => {
		reloadAjax({},'core/signout');
	}
	const fade = () => {
    	$('#tp-loader').fadeIn(500);
	}
</script>