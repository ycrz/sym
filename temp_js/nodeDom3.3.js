const chatMessages = document.getElementById('chat-messages');

const notify_dom = (msg) => {
	let div = `<div class="float-left tp-fs-7 tp-ta-ct w-100">${msg.text}</div>`;
	chatMessages.innerHTML += div;
}

let generated=0;
const chat_dom_me = (msg,ch_id,reply_ch_id=null,reply_owner=null,reply_container=null) => {
	generated++;
	let today = new Date();
	let hour = today.getHours();
	if (hour.toString().length == 1) {
		hour = '0'+hour;
	}
	let min = today.getMinutes();
	if (min.toString().length == 1) {
		min = '0'+min;
	}
	let amOrPm = (today.getHours() < 12) ? "AM" : "PM";
	let time = hour + ":" + min + ' ' + amOrPm;
	let reply = '';
	if (reply_ch_id != null) {
		reply = `<div class="replying-message tp-m-tp-5 tp-lh-10 tp-csr-st-pointer" onclick="gotoreply('ch_${reply_ch_id}')">
                    <div><small><b>${reply_owner}</b></small></div>
                    <div>${reply_container}</div>
                </div>`;
	}
                
	let div = `<div class="float-right col-12" id="ch_${ch_id}">
		            <div class="message-data tp-ta-rg tp-m-bt-10">
		                <span class="message-data-name tp-fs-rs-8 tp-fs-bold name_${ch_id}">saya</span> <i class="fa fa-circle 12 tp-fs-7 all_flag flag_${uid}"></i>
		                <span class="message-data-time tp-fs-rs-8">${time}</span> 
		                <i class="far fa-trash-alt tp-fs-7 tp-fc-redChili tp-csr-st-pointer" onclick="retract(${ch_id})"></i>
		            </div>
		            <div class="message other-message float-right me-message tp-fs-rs-10">
	            		${reply}
                        <div class="tp-ws-pw innermessage" onclick="reply(this,${ch_id})" id="v_${generated}"></div>
                    </div>
		        </div>`;
	chatMessages.innerHTML += div;
	$(`#v_${generated}`).html(msg).text();
	appendActivation(flagUniques);
	reinstallemoji('#v_'+generated);
}

const chat_dom_fr = (msg) => {
	generated++;
	let time = msg.time;
	let namefix = getnamefix(msg.username.split('-')[0]);
	let reply = '';
	if (msg.reply_ch_id != undefined) {
		reply = `<div class="replying-message-other tp-m-tp-5 tp-lh-10 tp-csr-st-pointer" onclick="gotoreply('ch_${msg.reply_ch_id}')">
                    <div><small><b>${msg.reply_owner}</b></small></div>
                    <div>${msg.reply_container}</div>
                </div>`;
	}

	let div = `<div class="float-left col-12" id="ch_${msg.id}">  
		            <div class="message-data tp-m-bt-10">
		                <i class="fa fa-circle 14 tp-fs-7 all_flag flag_`+msg.username.split('-')[0]+`"></i> <span class="message-data-name tp-fs-rs-8 tp-fs-bold name_${msg.id}">`+namefix+`</span>
		                <span class="message-data-time tp-fs-rs-8 tp-fs-uppercase">${msg.time}</span>
		            </div>
		            <div class="message float-left my-message tp-fs-rs-10">
		            	${reply}
                        <div class="tp-ws-pw innermessage" onclick="reply(this,${msg.id})" id="v_${generated}"></div>
                    </div>
		        </div>`;
	if (msg.username != uidNODE) {
		chatMessages.innerHTML += div;
		$(`#v_${generated}`).html(msg.text).text();
		reinstallemoji('#v_'+generated);
	}
	appendActivation(flagUniques);
}
const sendMessage = () => {
	let msg = (document.getElementById('msg').value);
	if (msg.trim() != '') {
		$('#tp-loader').fadeIn(500);
		$.ajax({
		    type: "POST",
		    url: "core/node_send_message.php",
		    data: {chat:msg,rid:rid},
		    cache: false,
		    success: function(get){
				socket.emit('chatMessage',[msg,JSON.parse(get).id]);
				document.getElementById('msg').value = '';
				$('.emoji-wysiwyg-editor').html("");
				chat_dom_me(msg,JSON.parse(get).id);
		        $('#tp-loader').fadeOut(500);
		    },error: function(get){
		        Swal.fire({ icon: "error", title: "internet", text: "Cek Koneksi Internet Anda" });
		        $('#tp-loader').fadeOut(500);
		    }
		});
	}
}
// picture only
const zoomer = (phc) =>{
	var img = $(phc).attr("src");
    img_zoom(img);
}
const pic_dom_me = (msg,ch_id) =>{
	var today = new Date();
	var hour = today.getHours();
	if (hour.toString().length == 1) {
		hour = '0'+hour;
	}
	var min = today.getMinutes();
	if (min.toString().length == 1) {
		min = '0'+min;
	}
	var amOrPm = (today.getHours() < 12) ? "AM" : "PM";
	var time = hour + ":" + min + ' ' + amOrPm;
	var div = `
		<div class="float-right col-10 col-sm-7" id="ch_${ch_id}">
	        <div class="message-data tp-ta-rg tp-m-bt-10">
	            <span class="message-data-name tp-fs-rs-8 tp-fs-bold name_${ch_id}">saya</span> <i class="fa fa-circle 12 tp-fs-7 all_flag flag_`+uid+`"></i>
	            <span class="message-data-time tp-fs-rs-8">`+time+`</span>
                <i class="far fa-trash-alt tp-fs-7 tp-fc-redChili tp-csr-st-pointer" onclick="retract(${ch_id})"></i>
	        </div>
	        <div class="message me-message other-message float-right tp-fs-rs-10">
	            <img src="`+msg+`" class="tp-csr-st-pointer tp-rnd-10" onclick="zoomer(this)" width="100px">
	        </div>
	    </div>`;
    chatMessages.innerHTML += div;
	scroll();
    appendActivation(flagUniques);
}

const pic_dom_fr = (msg) => {
	var time = msg.time;
	let namefix = getnamefix(msg.username.split('-')[0]);
	var div = `
		<div class="float-left col-10 col-sm-7" id="ch_${msg.id}">
		    <div class="message-data tp-m-bt-10">
		        <i class="fa fa-circle 14 tp-fs-7 all_flag flag_`+msg.username.split('-')[0]+`"></i> <span class="message-data-name tp-fs-rs-8 tp-fs-bold name_${ch_id}">`+namefix+`</span>
		        <span class="message-data-time tp-fs-rs-8">`+msg.time+`</span>
		    </div>
		    <div class="message my-message float-left tp-fs-rs-10 tp-m-lf-5">
		        <img src="`+msg.text.split('<-img->')[1]+`" class="tp-csr-st-pointer tp-rnd-10" onclick="zoomer(this)" width="100px">
		    </div>
		</div>`;
	if (msg.username != uidNODE) {
		chatMessages.innerHTML += div;
	}
	scroll();
    appendActivation(flagUniques);
}
const upQPic = (event) => {
    if (event.files[0] != undefined) {
        var dt = new Date();
        var ts = dt.getTime();
        var fName = uid+'_'+rid+'_'+ts;

        blobConvert(event,fName);
    }
}
const sendImgClipboard = () => {
	let blob = $('#clip-board-image-raw').val();
	let w = $('#clip-board-image').width();
	let h = $('#clip-board-image').height();

	var dt = new Date();
    var ts = dt.getTime();
	var fName = uid+'_'+rid+'_'+ts;

	compressBlob(blob, w, h, fName);

	$('#mdl-image-clipboard').modal('hide');
}
const blobConvert = (event,fName)  => {
    var reader = new FileReader();
    reader.readAsDataURL(event.files[0]);
    reader.onload = function(e) {
        var blob = e.target.result;
        var image = new Image();
        image.src = blob;
        image.onload = function() {
            compressBlob(blob, image.width, image.height, fName);
        };
    }
}
const compressBlob = (blob, width, height, fName) => {
    var cW = 400;
    var getPrecision = (cW/width)*100;
    var cH = height*getPrecision/100;
    
    const img = new Image();
    img.src = blob;
    img.onload = function() {
        const elem = document.createElement('canvas');
        elem.width = cW;
        elem.height = cH;
        const ctx = elem.getContext('2d');
        ctx.drawImage(img, 0, 0, cW, cH);

        const blobPP = ctx.canvas.toDataURL("image/png");
        saveBlob(blobPP,fName);
    }
}
const saveBlob = (blobParam,fName) => {
    $('#tp-loader').fadeIn(500);
    $.ajax({
        type: "POST",
        url: "core/node_send_image.php",
        data: {imageData:[blobParam],fileName:fName,rid:rid},
        cache: false,
        success: function(get){
            var x = JSON.parse(get).tmp;

            // Emiting a message to server
            socket.emit('chatMessage',['<-img->'+x,JSON.parse(get).id]);

            // Send to Me
            pic_dom_me(x,JSON.parse(get).id);

            $('#tp-loader').fadeOut(500);
        },error: function(get){
            Swal.fire({ icon: "error", title: "internet", text: "Cek Koneksi Internet Anda" });
            $('#tp-loader').fadeOut(500);
        }
    });
}
// picture only

// retract
const retract = (phc) => {
    $('#tp-loader').fadeIn(500);
	$.ajax({
        type: "POST",
        url: "core/node_retract_message.php",
        data: {phc:phc,rid:rid},
        cache: false,
        success: function(get){
        	let x = JSON.parse(get);
        	if (x.mss!='success') {
        		Swal.fire({ icon: "error", title: "error", text: x.mss });
        	}else{
        		retractDOM(phc);
        		socket.emit('retract',phc);
        	}
            $('#tp-loader').fadeOut(500);
        },error: function(get){
            Swal.fire({ icon: "error", title: "internet", text: "Cek Koneksi Internet Anda" });
            $('#tp-loader').fadeOut(500);
        }
    });
}
const retractDOM = (phc) => {
	$('#ch_'+phc+'>.message-data>.fa-trash-alt').remove();
	$('#ch_'+phc+'>.message').html(`retracted`);
	$('#ch_'+phc+'>.message').removeClass('tp-fs-rs-10');
	$('#ch_'+phc+'>.message').addClass('tp-fs-rs-8');
	$('#ch_'+phc+'>.message').addClass('tp-fs-italic');
	$('#ch_'+phc+'>.message').addClass('tp-fc-dark-blue');
}
// retract


// away
let onfocus=0;
const checkPageFocusYT = () => {
	// console.log('cek fokus')
    if (document.hasFocus()) {
        if (onfocus!=1) {
            onfocus=1;
            socket.emit('away',[onfocus,rid]);
        }
    }else {
        if (onfocus!=0) {
            onfocus=0;
            socket.emit('away',[onfocus,rid]);
        }
    }
}

// Check page focus every 5000 milliseconds
setInterval(checkPageFocusYT, 5000);

// away


$( document ).ready(function() {
    scroll();
	setTimeout(function(){ reinstallemoji('all'); }, 1000)
});
const scroll = () => {
	let checkStatus = document.getElementById("autoscrollmessage").checked;
	if (checkStatus==true) {
		let height = chatMessages.scrollHeight;
		chatMessages.scrollTop = 100;

		$('#overflow_div_scroll').animate({
	        scrollTop:height
	    }, '100');
	}
}
const reinstallemoji = (target) => {
	if (target=='all') {
		$('.innermessage').each(function(i,target){
			reinstallemojiTarget(target);
		});
	}else{
		reinstallemojiTarget(target);
	}
}
const reinstallemojiTarget = (target) => {
	let mss = $(target).html();
	if (mss!=undefined && mss.substring(0,4)!='<img') {
		$(target).html('');
		window.emojiPicker.appendUnicodeAsImageToElement($(target),mss);
		mss = $(target).html();
		$(target).html(mss.replace(/&amp;nbsp;/gi, ''));
		mss = $(target).html();
		$(target).html(mss);
	}
}