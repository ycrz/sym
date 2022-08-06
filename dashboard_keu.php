<?php 
	if (!isset($head)) {
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

<?php 
	$form = ['fm-x2'];
	for ($i=0; $i < count($form); $i++) { 
		$res = queryBack("SELECT * FROM form_attendee WHERE fm='$form[$i]' order by name");
?>
<div class="container tp-m-tp-30">
	<div class="row">
		<div class="col-12">
			<h3>Data Transaksi</h3>
			<table id="tbl" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:1%">No</th>
                        <th>Nama Lengkap</th>
                        <th>Nomor Transaksi</th>
                        <th>Nomor Virtual</th>
                        <th>Bank</th>
                        <th>Total</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
            </table>
		</div>
	</div>
</div>
<?php 
	}
?>

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
            url: 'core/getTRX_keu',
            data: {fid:true},
            dataSrc: ""
        },
        columns: [
        	{
                data: 'no'
            },
            {
                data: 'name'
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