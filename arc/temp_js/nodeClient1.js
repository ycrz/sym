const uidNODE = uid+'-'+uname;
const { username, room } = {username:uidNODE,room:rid};
socket.emit('joinRoom', {username, room});

let nodeReady=0;
$( document ).ready(function() {
    $('#tp-loader').fadeIn(500);
    Swal.fire({ icon: 'info', title: 'Mohon Menunggu', text: 'kami sedang mempersiapkan pengalaman ber-kbm anda =)' });
});

socket.on( 'notify', function( msg ) {
	scroll();
	if (nodeReady==0) { 
		nodeReady=1;
		Toast.fire({icon: 'info',title: 'forum selesai disiapkan'})
	}

	if (msg.text == 'Selamat Datang ke Forum') {
		notify_dom(msg);
	}else{
		let idUser = msg.text.split(" ")[1].split(",")[0];
        let mulai = msg.text.indexOf(",");
        msg.text = "== "+getnamefix(idUser)+msg.text.substring(mulai,msg.text.length);

        // hati2 bila error
        if (msg.text == "== "+getnamefix(uid)+", meninggalkan Live Chat ==") {
        	location.reload();
        }
        notify_dom(msg);
	}

	$('#tp-loader').fadeOut(500);
});

let flagUniques=[];
let totaluser=0;
socket.on( 'roomUsers', function ({room,users}){
	$('.flag_activate').html('<span class="tp-fc-redChili tp-fs-bold">TIDAK AKTIF</span>');
	flagUniques=[];
	for (let i = 0; i < users.length; i++) {
		let htmlPrint='';
		if (users[i].status==1) {
			htmlPrint = '<span class="tp-fc-light-green tp-fs-bold">AKTIF</span>'
		}else{
			htmlPrint = '<span class="tp-fc-yolk tp-fs-bold">TIDAK FOKUS</span>'
		}
		document.getElementById('flag_'+users[i].username.split('-')[0]+'_'+rid).innerHTML=htmlPrint;
		if (!flagUniques.includes(users[i].username.split('-')[0])) {
			flagUniques.push([users[i].username.split('-')[0],users[i].status]);
		}
	}

	if (totaluser < users.length) {
		Toast.fire({icon: 'info',title: 'seseorang bergabung ke dalam chat'})
		audioPLB = new Audio('lib/5c4ed6350c7df.mp3');
	    audioPLB.play();
	    audioPLB.volume = 1.0;
	}else if (totaluser > users.length) {
		Toast.fire({icon: 'info',title: 'seseorang meninggalkan chat'})
	}
	totaluser = users.length;
	appendActivation(flagUniques);

	$('#online_counter').html(users.length);
	scroll();
});
const appendActivation = (flagUniques) =>{
	$('.all_flag').css('color', '#B22234');
	for (var i = 0; i < flagUniques.length; i++) {
		var color='';
		flagUniques[i][1]===0 ? color='#ffcc5f' : color='#B4D7A2';
		$('.flag_'+flagUniques[i][0]).css('color', color);
	}
	return true;
}
socket.on( 'broadcast', function( msg ) {
	if (msg.text.split('<-img->').length > 1) {
		pic_dom_fr(msg);
	}else{
		chat_dom_fr(msg);
	}
	// scrolldown
	chatMessages.scrollTop = chatMessages.scrollHeight;
	scroll();
});
socket.on( 'retract', function( msg ){ retractDOM(msg); });