<?php 
    if (!isset($_SESSION['sk'][4])) {
        echo "<script type='text/javascript'>
                window.location.replace('core/signout');
                </script>";
        exit;
    }
?>


<div id="st_role" class="tp-dsp-none"><?php echo $_SESSION['sk'][4] ?></div>

<nav class="navbar-light fixed-top" style="border-bottom: solid 3px #a0a0a0" id="nav_inet">
	<span class="ph-vs navbar navbar-expand-s tp-n-p">
		<div class="navbar-brand tp-p-all-5 tp-n-m">
			<table class="table tp-n-m tp-n-p tp-bg-transparent">
	            <thead>
	                <tr>
	                    <td class="tp-vc-middle tp-bd-none tp-lh-10 tp-csr-st-pointer" style="width:1%; padding-bottom: 5px" onclick="goToPage('dashboard')">
	                    	<table class="table tp-n-m tp-n-p tp-bg-transparent">
	                    		<thead>
	                    			<tr>
	                    				<td class="tp-vc-middle tp-bd-none tp-n-p tp-lh-10" style="width:1%;">
	                    					<div class="tp-fs-rs-10 tp-fs-bold<?php echo $darkmodeColor; ?>"><?php echo htmloutput($rowsk['name']) ?></div>
	                    				</td>
	                    			</tr>
	                    			<tr>
	                    				<td class="tp-vc-middle tp-bd-none tp-n-p tp-lh-10" style="width:1%;">
	                    					<div class="tp-fs-rs-10<?php echo $darkmodeColor; ?>">by Sekolak.com</div>
	                    				</td>
	                    			</tr>
	                    			<tr>
	                    				<td class="tp-vc-middle tp-bd-none tp-lh-10 tp-fs-rs-8 tp-fs-bold tp-fc-dark-blue tp-fs-uppercase" style="width:1%; border-top: 2px solid #000 !important; padding: 10px 0px 0px 0px" id="pager">
	                    					<div class="tp-fs-rs-10">by Sekolak.com</div>
	                    				</td>
	                    			</tr>
	                    		</thead>
	                    	</table>
	                    </td>
	                </tr>
	            </thead>
	        </table>
		</div>
		<?php 
			$sqlAnnouncement = "SELECT cv.* FROM announcement cv WHERE cv.status=1 AND cv.coverage LIKE '%".'"'.$uid.'"'."%' AND (SELECT count(*) AS counter FROM announcement_read ar WHERE cv.id = ar.announcement_id AND ar.profiling_id = '$uid') < 1";
			$resultAnnouncement = mysqli_query($conn,$sqlAnnouncement);
			$resultCheckAnnouncement = mysqli_num_rows($resultAnnouncement);

			$horz = '';
			if ($resultCheckAnnouncement > 0) {
				$horz = 'horz-move';
			}
		?>
		<span class="ml-auto tp-fs-rs-15 tp-csr-st-pointer" data-tooltip="tooltip" title="Pengumuman"><span data-toggle="modal" data-target="#mdl_notify"><i class="far fa-bell
			<?php echo $horz ?>" id="announcement_pr"></i></span></span>
		
		<button class="navbar-toggler collapsed resizeRight" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onclick="clck()">
	        <span class="icon-bar top-bar"></span>
	        <span class="icon-bar middle-bar"></span>
	        <span class="icon-bar bottom-bar"></span>               
	    </button>

		<div class="collapse navbar-collapse overflow-y-auto" style="max-height: 85vh" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto tp-ta-rg tp-p-lr-20">
	            <li class="nav-item tp-fs-uppercase">
	                <a class="nav-link" href="dashboard"><i class="fas fa-home"></i> Dashboard</a>
	            </li>
<?php 
	if ($_SESSION['sk'][4] == 'ADMINISTRATOR') {
	echo "
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link tp-csr-st-pointer' onclick='goToPage(".'"school"'.")'><i class='fas fa-school'></i> Profil Sekolah</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='profiling'><i class='fas fa-user-friends'></i> Data Pengguna</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='class'><i class='fas fa-door-open'></i> Data Kelas</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='course'><i class='fas fa-folder-open'></i> Data Pelajaran</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='announcement'><i class='far fa-newspaper'></i> Pengumuman</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='class'><i class='fas fa-business-time'></i> Penjadwalan</a>
		</li>
	";
	}
?>

<?php 
	if ($_SESSION['sk'][4] == 'GURU') {
	echo "
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='myclass'><i class='fas fa-door-open'></i> Kelas Saya</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='a_report_tc'><i class='fab fa-firstdraft'></i> Kehadiran Siswa</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='a_m_report'><i class='fab fa-firstdraft'></i> Rekap Bulanan Absensi</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='mystudent_proof'><i class='fas fa-concierge-bell'></i> Permintaan Absen</a>
		</li>
	";
	}
?>

<?php 
	if ($_SESSION['sk'][4] == 'MURID') {
	echo "
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='myclass'><i class='fas fa-door-open'></i> Kelas Saya</a>
		</li>
	";
	}
?>

<?php 
	if ($_SESSION['sk'][4] == 'BIRO ABSENSI') {
	echo "
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='mystudent_proof'><i class='fas fa-concierge-bell'></i> Permintaan Absen</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='a_report'><i class='fab fa-firstdraft'></i> Laporan Absensi</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='a_m_report'><i class='far fa-calendar-alt'></i> Laporan Bulanan</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='a_permittance'><i class='fas fa-sign-in-alt'></i> Masuk Terlambat</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='a_retreating'><i class='fas fa-sign-out-alt'></i> Pulang Cepat</a>
		</li>
	";
	}
?>

<?php 
	if ($_SESSION['sk'][4] == 'KEPALA SEKOLAH') {
	echo "
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='hmreport'><i class='fab fa-firstdraft'></i> Laporan Kepala Sekolah</a>
		</li>
		<li class='nav-item tp-fs-uppercase'>
		    <a class='nav-link' href='kbm_monitoring'>
		    	<i class='fab fa-odnoklassniki'></i>
				<i class='fab fa-odnoklassniki tp-fs-rs-15'></i>
				<i class='fab fa-odnoklassniki'></i>
    			Control Room
			</a>
		</li>
	";
	}
?>

<?php 
	if ($_SESSION['sk'][4] == 'KARYAWAN') {
	echo "
		<li class='nav-item tp-fs-uppercase'>
			    <a class='nav-link' href='e_absen'><i class='fas fa-fingerprint'></i> e-ABSEN</a>
			</li>
	";
	}
?>

<?php 
	if ($_SESSION['sk'][4] == 'MURID' || $_SESSION['sk'][4] == 'GURU') {
		echo "
			<li class='nav-item tp-fs-uppercase'>
			    <a class='nav-link' href='myexam'><i class='fas fa-clipboard-list'></i> MY EXAM</a>
			</li>
			<li class='nav-item tp-fs-uppercase'>
			    <a class='nav-link' href='mytask'><i class='fas fa-thumbtack'></i> MY TASK</a>
			</li>
			<li class='nav-item tp-fs-uppercase'>
			    <a class='nav-link' href='mycourse'><i class='fas fa-book'></i> MY COURSE</a>
			</li>
			<li class='nav-item tp-fs-uppercase'>
			    <a class='nav-link' href='e_absen'><i class='fas fa-fingerprint'></i> e-ABSEN</a>
			</li>
		";
	}
	// <li class='nav-item tp-fs-uppercase'>
	// 		    <a class='nav-link' href='youtube'><i class='fab fa-youtube'></i> Youtube</a>
	// 		</li>
?>
				<li class='nav-item tp-fs-uppercase'>
					<a class='nav-link' href='myprofile'><i class='fas fa-user-shield'></i> Profil Saya</a>
				</li>
	            <li class="nav-item tp-fs-uppercase">
	                <a class="nav-link" href="core/signout"><i class="fas fa-power-off"></i> LogOut</a>
	            </li>
<?php 
	if ($_SESSION['sk'][4] == 'MURID' || $_SESSION['sk'][4] == 'GURU') {
		echo "
			<li class='nav-item tp-fs-uppercase'>
			    <a class='nav-link' href='edutoon'><i class='fas fa-tv'></i> <b>Tutorial Aplikasi</b></a>
			</li>
		";
	}
?>
	        </ul>
		</div>
	</span>
</nav>

<div class="modal fade" id="mdl_notify" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-bell"></i> Seluruh Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                	<div class="col-12">
                		<table class="table tp-n-m">
                            <thead>
                                <tr>
                                    <th class="tp-vc-middle tp-lh-10" colspan="2">Pengumuman</th>
                                    <th class="tp-vc-middle tp-lh-10">Baca</th>
                                </tr>
                            </thead>
                            <tbody id="announcement_adder">
<?php 
	$sql = "SELECT an.*,DATE_FORMAT(DATE_ADD(an.timestamp,INTERVAL 7 HOUR),'%d %b %Y %H:%i:%s') AS time,
			(SELECT count(*) FROM announcement_read ar WHERE an.id = ar.announcement_id AND ar.profiling_id = '$uid') AS counter
			FROM announcement an
			WHERE an.coverage LIKE '%".'"'.$uid.'"'."%' and an.status=1
			ORDER BY timestamp DESC limit 0,10";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);

    // $perpage = 10;
    // $first = ((int)$pging-1)*$perpage;
?>
<?php if ($resultCheck < 1) { ?>
<tr>
    <td class="tp-vc-middle tp-lh-10 tp-ta-ct" colspan="3">== Belum ada Notifikasi Tersedia ==</td>
</tr>
<?php } else if ($resultCheck > 0) {
        while($row=mysqli_fetch_assoc($result)){
            $len = strlen($row['text']);
            $text = substr($row['text'],0,30);
            if ($len > 30) {
                $text .= '...';
            }
            $status_open = '<b>BELUM DIBACA</b>';
            if ($row['counter'] > 0) {
                $status_open = 'TELAH DIBACA';
            }
            echo '
            <tr>
                <td class="tp-vc-middle tp-lh-10 tp-n-p-bt" colspan="2">
                	'.htmloutput($text).'
                	<span class="tp-dsp-none" id="itx_'.$row['id'].'">'.htmloutput($row['text']).'</span>
            	</td>
                <td class="tp-vc-middle tp-lh-10 tp-n-p-bt">
        			<button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Lihat Teks Pengumuman" onclick="preview_notification('.$row['id'].')">
        				<i class="far fa-eye"></i>
        			</button>
        		</td>
            </tr>
            <tr>
                <td class="tp-vc-middle tp-lh-10 tp-fs-rs-10 tp-bd-none tp-n-p-tp" colspan="3">
                	<b id="itd_'.$row['id'].'">'.$row['time'].'</b> - 
                	<span><i id="status_open_'.$row['id'].'">'.$status_open.'</i></span>
            	</td>
            </tr>';
        }
    }
?>
                        	</tbody>
                    	</table>
                	</div>
                </div>
            </div>
            <div class="modal-footer tp-ta-ct tp-jc-ct">
<?php 
	$sql = "SELECT * FROM announcement WHERE status=1 AND coverage LIKE '%".'"'.$uid.'"'."%' ORDER BY timestamp DESC";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 10) {
		echo '<button class="btn btn-primary tp-rnd-10 w-100" onclick="loadMoreAnnouncment()" id="btn_more_announcement"> Muat Lebih Banyak <i class="fas fa-sync"></i></button>';
	}
?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl_detailing_notify" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-bell"></i> Pengumuman <span id="announcement_date_detail"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                	<div class="col-12">
                		<div class="tp-ws-pw" id="announcement_text_detail"></div>
            		</div>
        		</div>
    		</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var x = <?php echo $resultCheckAnnouncement ?>;
	var c = 1;

	function preview_notification(id){
		$('#mdl_notify').modal('hide');
		$('#mdl_detailing_notify').modal('show');
		$('#announcement_date_detail').html($('#itd_'+id).html());
		$('#announcement_text_detail').html($('#itx_'+id).html());

		if ($('#status_open_'+id).html() == '<b>BELUM DIBACA</b>') {
			x -= 1;
			if (x==0) {
				$('#announcement_pr').removeClass('horz-move');
			}
		}
		
		$('#status_open_'+id).html('TELAH DIBACA');

		sendStatusR(id);
	}

	function sendStatusR(id){
		$.ajax({
            type: "POST",
            url: "core/announcement_read.php",
            data: {id:id},
            cache: false
        });
	}

	function loadMoreAnnouncment(){
		c++;
		$.ajax({
            type: "POST",
            url: "core/announcement_paging.php",
            data: {paging:c},
            cache: false,
            success: function(get){
            	var tmp = JSON.parse(get).tmp;
            	if (tmp.length != 10) {
            		$('#btn_more_announcement').fadeOut();
            	}
            	for (var i = 0; i < tmp.length; i++) {
					var len = tmp[i][2].length;
		            var text = tmp[i][2].substr(0,30);
		            if (len > 30) {
		                var text = text+'...';
		            }
		            var status_open = '<b>BELUM DIBACA</b>';
		            if (tmp[i][0] > 0) {
		                status_open = 'TELAH DIBACA';
		            }

            		var x = `
            			<tr>
			                <td class="tp-vc-middle tp-lh-10 tp-n-p-bt" colspan="2">
			                	`+htmlEntities(text)+`
			                	<span class="tp-dsp-none" id="itx_`+tmp[i][1]+`">`+tmp[i][2]+`</span>
			            	</td>
			                <td class="tp-vc-middle tp-lh-10 tp-n-p-bt">
			        			<button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Lihat Teks Pengumuman" onclick="preview_notification(`+tmp[i][1]+`)">
			        				<i class="far fa-eye"></i>
			        			</button>
			        		</td>
			            </tr>
			            <tr>
			                <td class="tp-vc-middle tp-lh-10 tp-fs-rs-10 tp-bd-none tp-n-p-tp" colspan="3">
			                	<b id="itd_`+tmp[i][1]+`">`+tmp[i][3]+`</b> - 
			                	<span><i id="status_open_`+tmp[i][1]+`">`+status_open+`</i></span>
			            	</td>
			            </tr>
            		`;

            		$('#announcement_adder').append(x);
            	}
            }
        });
	}
</script>

<!-- <script src="temp_js/fingerprint.js"></script>
<script type="text/javascript">
    var fp = new Fingerprint2()
    fp.get(function(result, components) {
        $.ajax({
            type: "POST",
            url: "core/a_fsc_check.php",
            data: {fp:result},
            cache: false,
            success: function(get){
            	var parse = JSON.parse(get).tmp;
                if (parse == 'kick') {
                	window.location.replace("core/signout");
                }
            }
        });
    });
</script> -->