<div class="modal fade" id="mdl_img_zoom" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document"  style="min-width: 90vw;min-height: 90vh">
        <div class="modal-content">
            <div class="modal-header tp-fs-bold">
                <button type="button" class="close mdl_btn_cls" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                </button>
                Perbesaran Gambar <button class="btn btn-primary" onclick="rotateimgzoom()"><i class="fas fa-retweet tp-csr-st-pointer"></i></button>
            </div>
            <div class="modal-body">
                <div class="tp-ta-ct">
                    <img src="" id="pic_lookup" width="50%" alt="">
                </div>
                <div class="tp-m-tp-20 tp-fs-rs-10 tp-ta-ct tp-fs-bold">
                    perbesaran
                    <input type="range" min="1" max="100" value="50" class="slider" id="myRange" onchange="zoomtake(this)">
                </div>
            </div>
        </div>
    </div>
</div>

</section>
</body>
<!-- local script -->
<!-- <script src="owlcarousel/owl.carousel.js"></script> -->
<script src="temp_js/autosize.js"></script>

<script src='temp_js/template-script.js'></script>

<script type="text/javascript">
	autosize(document.querySelectorAll('textarea'));
    $('#tp-loader').fadeOut(500);
</script>

<?php 
	include_once 'lib/notification.php';
?>