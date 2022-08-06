<?php 
	mustProfiling();
	$head = 1;
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
	if ($_SESSION['sk'][3] == 1) {
		include_once 'dashboard_admin.php';
	}else if ($_SESSION['sk'][3] == 2) {
		include_once 'dashboard_keu.php';
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