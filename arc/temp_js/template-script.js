function goToPage(string){
    window.open(string,"_self");
}
function goToNewPage(string){
    window.open(string,"_blank");
}
const noneAjax = (data={},url) => {
    $('#tp-loader').fadeIn(500);
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        cache: false,
        success: function(get){
            $('#tp-loader').fadeOut(500);
        },error: function(get){
            $('#tp-loader').fadeOut(500);
        }
    });
}
const simpleAjax = (data={},url) => {
    Swal.fire({ icon: "info", title: "Mohon Menunggu", text: "segera akan diproses." });
    $('#tp-loader').fadeIn(500);
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        cache: false,
        success: function(get){
            Swal.fire({ icon: "success", title: "Sukses", text: "Data Tersimpan." });
            $('#tp-loader').fadeOut(500);
        },error: function(get){
            Swal.fire({ icon: "error", title: "Gagal", text: "Cek Kembali Internet Anda." });
            $('#tp-loader').fadeOut(500);
        }
    });
}
const reloadAjax = (data={},url) => {
    Swal.fire({ icon: "info", title: "Mohon Menunggu", text: "segera akan diproses." });
    $('#tp-loader').fadeIn(500);
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        cache: false,
        success: function(get){
            Swal.fire({ icon: "success", title: "Sukses", text: "Mohon menunggu reload." });
            location.reload();
        },error: function(get){
            Swal.fire({ icon: "error", title: "Gagal", text: "Cek Kembali Internet Anda." });
            $('#tp-loader').fadeOut(500);
        }
    });
}
const returnAjax = (data={},url) => {
    Swal.fire({ icon: "info", title: "Mohon Menunggu", text: "segera akan diproses." });
    $('#tp-loader').fadeIn(500);
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        cache: false,
        success: function(get){
            flagger(get);
            $('#tp-loader').fadeOut(500);
        },error: function(get){
            Swal.fire({ icon: "error", title: "Gagal", text: "Cek Kembali Internet Anda." });
            $('#tp-loader').fadeOut(500);
        }
    });
}
$(function() {
    $('.input_no_space').on('keypress', function(e) {
        if (e.which == 32){
            $(this).val($.trim($(this).val()));
            $(this).val($(this).val().replaceAll(/\s/g,''));
            Swal.fire({ icon: 'info', title: 'aksi tidak diperbolehkan', text: 'dilarang menggunakan spasi' });
        }
    });

    $('.number_strict').keyup(function() {
        let value = $(this).val();
        if(!$.isNumeric(value)){
            let res = value.substring(0, value.length-1);
            $(this).val(0);
            Swal.fire({ icon: 'info', title: 'aksi tidak diperbolehkan', text: 'dilarang menggunakan selain angka' });
        }else{
            let substring = value.substring(0,1);
            if (substring==0) {
                $(this).val(value.substring(1, value.length));
            }
        }
    });

    $('.value_strict').keyup(function() {
        let value = $(this).val();
        if(!$.isNumeric(value)){
            let res = value.substring(0, value.length-1);
            $(this).val(0);
        }else{
            let substring = value.substring(0,1);
            if (substring==0) {
                $(this).val(value.substring(1, value.length));
            }
            if ($(this).val() > 100) {
                $(this).val(100);
            }
        }
    });
});
const fixedEncodeURIComponent = (str) => {
    return encodeURIComponent(str).replace(/[!'()*]/g, function(c) {
        return '%' + c.charCodeAt(0).toString(16);
    });
}

const htmlEntities = (str) => {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

const getBlob = (event) => {
    $('#tp-loader').fadeIn(500);
    if (event.files.length > 0) {
        let requirement = ['png','jpeg','jpg'];
        let theFileName = event.files[0].name;
        let fileExt = theFileName.substring(theFileName.lastIndexOf('.')+1, theFileName.length).toLowerCase();
        if (!requirement.includes(fileExt)) {
            Swal.fire({ icon: "info", title: "Ekstensi File Salah", text: "eksensi file haruslah berupa :  .png, .jpg, .jpeg" });
            event.value="";
            return;
        }
        
        let reader = new FileReader();
        reader.readAsDataURL(event.files[0]);
        reader.onload = function(e) {
            $('#tp-loader').fadeIn(500);
            
            let blob = e.target.result;
            let image = new Image();
            image.src = blob;
            image.onload = function() {
                compression(blob, image.width, image.height);
            };
        }
    }else{
        Swal.fire("Belum Unggah Gambar", "mohon cek kembali", "info");
        $('#tp-loader').fadeOut(500);
    }
}

const compression = (blob, width, height) => {
    let cW = 400;
    let getPrecision = (cW/width)*100;
    let cH = height*getPrecision/100;
    
    const img = new Image();
    img.src = blob;
    img.onload = function() {
        const elem = document.createElement('canvas');
        elem.width = cW;
        elem.height = cH;
        const ctx = elem.getContext('2d');
        ctx.drawImage(img, 0, 0, cW, cH);

        const blobPP = ctx.canvas.toDataURL("image/png");
        $('#tp-loader').fadeOut(500);
        localFlagger(blobPP);
    }
}


const getBlob_special = (event,flag=0) => {
    if (event.files.length > 0) {
        let requirement = ['png','jpeg','jpg'];
        let theFileName = event.files[0].name;
        let fileExt = theFileName.substring(theFileName.lastIndexOf('.')+1, theFileName.length).toLowerCase();
        if (!requirement.includes(fileExt)) {
            Swal.fire({ icon: "info", title: "Ekstensi File Salah", text: "eksensi file haruslah berupa :  .png, .jpg, .jpeg" });
            event.value="";
            return;
        }
        
        let reader = new FileReader();
        reader.readAsDataURL(event.files[0]);
        reader.onload = function(e) {
            $('#tp-loader').fadeIn(500);
            
            let blob = e.target.result;
            let image = new Image();
            image.src = blob;
            image.onload = function() {
                compression_special(blob, image.width, image.height,flag);
            };
        }
    }
}

const compression_special = (blob, width, height,flag) => {
    let cW = 800;
    let getPrecision = (cW/width)*100;
    let cH = height*getPrecision/100;
    
    const img = new Image();
    img.src = blob;
    img.onload = function() {
        const elem = document.createElement('canvas');
        elem.width = cW;
        elem.height = cH;
        const ctx = elem.getContext('2d');
        ctx.drawImage(img, 0, 0, cW, cH);

        const blobPP = ctx.canvas.toDataURL("image/png");
        $('#tp-loader').fadeOut(500);
        localFlagger(blobPP,flag);
    }
}

const loader_go = () => {
    $('#tp-loader').fadeIn(500);
}

const excelion = (arr,name) => {
    var d = new Date();
    var date = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
     
    var dateStr = "." + date + "." + month + "." + year;

    var wb = XLSX.utils.book_new();
    var ws = XLSX.utils.json_to_sheet(arr,{skipHeader: 1});
    XLSX.utils.book_append_sheet(wb, ws, dateStr);
    XLSX.writeFile(wb, name+".xlsx");
}

let formatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
});

$(function() {
    let x = document.getElementsByClassName('format_price');
    for (var i = 0; i < x.length; i++) {
        x[i].innerHTML = formatter.format(x[i].innerHTML);
    }
});