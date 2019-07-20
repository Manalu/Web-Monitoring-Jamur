// run this function when the document has loaded
//var mqtt = require('mqtt');
/*
var client = mqtt.connect('wss://388c0808:056dbb86bd193a10@broker.shiftr.io', {
		clientId: 'web-client'
	}); 
*/

 var options = {
	 clientId: 'webclient_' + Math.random().toString(16).substr(2, 8),
	 connectTimeout: 5000,
	 hostname: '192.168.100.6', //ip server mosquitto broker
	 username: 'katon',
	 password: 'katon',
	 port: 8883,
	path: '/mqtt'
	 };

var client = mqtt.connect(options);

var pengabutan_kelembaban1="mati";
var pengabutan_kelembaban2="mati";

$(function(){
		client.on('connect', function(){
		console.log('client has connected!');
		client.subscribe('node1/#'); //subscribe semua yang bertopik node1
		client.subscribe('node2/#'); //subscribe semua yang bertopik node2
	});

	client.on('message', function(topic, message) {
	var strTopic = String(topic);
	var strMessage = String(message);
    var onoff_mode_otomatis =  document.getElementById("onoff_mode_otomatis").value;
	console.log("Received '" + strMessage + "' on '" + strTopic + "'"); //untuk debugging

	if(topic == 'node1/status/kelembaban') {
	//simpan_kelembaban1(message);
	tampilkan_kelembaban1(message);

	  if (onoff_mode_otomatis=="aktif"){
		 mode_otomatis_kelembaban(topic, message);
	  }

	}
	if(topic == 'node2/status/kelembaban'){
	//simpan_kelembaban2(message);
	tampilkan_kelembaban2(message);

     if (onoff_mode_otomatis=="aktif"){
       mode_otomatis_kelembaban(topic, message);
      }
		 
	}
	if (topic == 'node1/status/suhuCelcius') {
	//simpan_suhu1(message);
    tampilkan_suhu1(message);
	 if (onoff_mode_otomatis=="aktif"){
	   mode_otomatis_suhu(topic, message);
	  }
	}
	if (topic == 'node2/status/suhuCelcius') {
	//simpan_suhu2(message);
	tampilkan_suhu2(message);
     if (onoff_mode_otomatis=="aktif"){
       mode_otomatis_suhu(topic, message);
      }
	}

	if (topic == 'node1/status/suhuFahrenheit') {
		$('#suhu-fahrenheit1').text(message.toString());
	}
	else if (topic == 'node2/status/suhuFahrenheit') {
		$('#suhu-fahrenheit2').text(message.toString());
	}

		
	/*------------AUTO INPUT STATUS RELAY MODE OTOMATIS----------------*/
	if (topic == 'node1/pengabutan/otomatis/relay' && message == "aktif") {
		node= "node1";
		mode= "otomatis";
		//simpan_status_relay(message, node, mode);
	}
	if (topic == 'node2/pengabutan/otomatis/relay' && message == "aktif") {
		node= "node2";
		mode= "otomatis";
		//simpan_status_relay(message, node, mode);   
	}

	});

	mode_manual_node1();
	mode_manual_node2();  
})


/*-----------------FUNGSI SIMPAN OTOMATIS-------------------*/
function simpan_kelembaban1(message) { 
	message = parseInt(message);
	$.post("auto-input.php",
		{
				nilai_kelembaban1: message,
		});
}
function simpan_kelembaban2(message) { 
	message = parseInt(message);
	$.post("auto-input.php",
		{
				nilai_kelembaban2: message,
		});
}
function simpan_suhu1(message) { 
	message = parseInt(message);
	$.post("auto-input.php",
		{
				nilai_suhu1: message,
		});
}
function simpan_suhu2(message) { 
	message = parseInt(message);
	$.post("auto-input.php",
		{
				nilai_suhu2: message,
		});
}
function simpan_status_relay(message, node, mode) {
	message = String(message);
	$.post("auto-input.php",
		{
		node:node,
		mode:mode,
		status_relay: message,
		});
}

/*-----------------END FUNGSI SIMPAN OTOMATIS-------------------*/

/*---------FUNGSI TAMPILKAN NILAI SUHU KELEMBABAN REALTIME -------*/
function tampilkan_kelembaban1(message){
	$('#kelembaban-1').text(message.toString());
}
function tampilkan_kelembaban2(message){
	$('#kelembaban-2').text(message.toString());
}
function tampilkan_suhu1(message){
	$('#suhu-celcius1').text(message.toString());
}
function tampilkan_suhu2(message){
	$('#suhu-celcius2').text(message.toString());
}
/*-------------------END FUNGSI CEK --------------------*/


/*------------------- MENYALAKAN MODE MANUAL --------------------*/

function mode_manual_node1(){
	 var onoff_mode_manual1 =  document.getElementById("onoff_mode_manual1").value;
	 if(onoff_mode_manual1 == "aktif"){
			client.publish('node1/pengabutan/manual', 'aktif');
			console.log("manual node 1 :"+onoff_mode_manual1+"");
	 }
	 if (onoff_mode_manual1 == "mati"){
    client.publish('node1/pengabutan/manual', 'mati');
   } 
	 console.log("manual node 1 :"+onoff_mode_manual1+"");
}

function mode_manual_node2(){
	 var onoff_mode_manual2 =  document.getElementById("onoff_mode_manual2").value;
	 if(onoff_mode_manual2 == "aktif"){
			client.publish('node2/pengabutan/manual', 'aktif');
	 }
   if (onoff_mode_manual2 == "mati") {
      client.publish('node2/pengabutan/manual', 'mati');   
   }
	 console.log("manual node 2 :"+onoff_mode_manual2+"");
}
/*------------------- END MENYALAKAN MODE MANUAL --------------------*/


/*------------------- MENYALAKAN MODE OTOMATIS --------------------*/
//KELEMBABAN DI NAIK KAN
//SUHU DI TURUN KAN
//KELEMBABAN NAIK , MAKA SUHU PASTI TURUN
//SUHU TURUN , MAKA KELEMBABAN PASTI NAIK

function mode_otomatis_kelembaban(topic, message){
	var kelembabanSekarang = parseInt(message);
	var batas_kelembaban =  document.getElementById("id_kelembaban").value;
	var onoff_mode_otomatis =  document.getElementById("onoff_mode_otomatis").value;

	//RULE MENYALAKAN PENGABUTAN - AKTIF JIKA KURANG DARI BATAS KELEMBABAN
	if (topic == 'node1/status/kelembaban' && kelembabanSekarang<batas_kelembaban) {
		console.log("Pengabutan jalan ("+topic+") - karena kelembaban "+message+" kurangdari "+batas_kelembaban+"");
		client.publish('node1/pengabutan/otomatis', 'aktif');
		return pengabutan_kelembaban1="aktif";
	}
  if (topic == 'node1/status/kelembaban' && kelembabanSekarang>=batas_kelembaban) {
    console.log("kelembaban node1 sesuai");
    client.publish('node1/pengabutan/otomatis', 'mati');
      return pengabutan_kelembaban1="mati";
  }

	if (topic == 'node2/status/kelembaban' && kelembabanSekarang<batas_kelembaban){
		console.log("Pengabutan jalan ("+topic+") - karena kelembaban "+message+" kurangdari "+batas_kelembaban+"");
		client.publish('node2/pengabutan/otomatis', 'aktif');
		return pengabutan_kelembaban2="aktif";
	}
  if (topic == 'node2/status/kelembaban' && kelembabanSekarang>=batas_kelembaban){
    console.log("kelembaban node2 sesuai");
    client.publish('node2/pengabutan/otomatis', 'mati');
    return pengabutan_kelembaban2="mati";
  }

}

function mode_otomatis_suhu(topic, message){
	var suhuSekarang = parseInt(message);
	var batas_suhu =  document.getElementById("id_suhu").value;
	//console.log(""+batas_suhu+pengabutan_kelembaban1+suhuSekarang+topic+pengabutan_kelembaban1);
	
	//RULE MENTALAKAN PENGABUTAN - AKTIF JIKA LEBIH DARI BATAS SUHU
	if(topic == 'node1/status/suhuCelcius' && suhuSekarang>batas_suhu && pengabutan_kelembaban1=="mati"){
		console.log("Pengabutan sedang jalan ("+topic+") - karena suhu "+message+" lebihdari "+batas_suhu+"");
		client.publish('node1/pengabutan/otomatis', 'aktif');   
	}
  if(topic == 'node1/status/suhuCelcius' && suhuSekarang<=batas_suhu && pengabutan_kelembaban1=="mati"){
    console.log("suhu node1 sesuai");
    client.publish('node1/pengabutan/otomatis', 'mati');   
  }

	if(topic == 'node2/status/suhuCelcius' && suhuSekarang>batas_suhu && pengabutan_kelembaban2=="mati"){
		console.log("Pengabutan sedang jalan ("+topic+") - karena suhu "+message+" lebihdari "+batas_suhu+"");
		client.publish('node2/pengabutan/otomatis', 'aktif');    
	}
  if(topic == 'node2/status/suhuCelcius' && suhuSekarang<=batas_suhu && pengabutan_kelembaban2=="mati"){
    console.log("suhu node2 sesuai");
    client.publish('node2/pengabutan/otomatis', 'mati');    
  }
	
}
/*------------------- END MENYALAKAN MODE OTOMATIS --------------------*/