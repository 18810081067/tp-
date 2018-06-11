document.write('<script src="js/conts.js"></script>');
document.write('<script src="js/ksort.js"></script>');
document.write('<script src="js/md5.js"></script>');
document.write('<script src="js/base64.js"></script>');
document.write('<script src="js/jsencrypt.min.js"></script>');

function api(url, data, returnfun){
	//returnfun(url)
	
	data.sign = get_sign(data);
//	console.log(data);
//	return;
	data.version = app_version;
	data.res_time = Date.parse(new Date()) / 1000;
	var encrypt = rsa_encrypt(data);
	alert(data.res_time)
	console.log(encrypt);return;
	
	$.ajax({
		url:base_api + url,
		data:{rsa: encrypt},
		datatype:'json',
		success: function(res){
			//alert(1)
			//console.log(res.code);
			returnfun(res)
		}
	})
}

function rsa_encrypt(data){
	var query_arr = [];
	$.each(data, function(ke, va){
		query_arr.push(ke+ "=" +va);
		
	})
	var query = query_arr.join('&');
	var crypt = new JSEncrypt();
	crypt.setPublicKey(PUBLIC_KEY);
	return crypt.encrypt(query);
}

function get_sign(){
	var noempty = unset_empty(data);
	var sort = ksort(noempty);
	var query_arr=[];
	$.each(sort, function(k, v){
		query_arr.push(k+ '=' +v);
	})
	var query = query_arr.join('&');
	//console.log(query);
	return $.md5(query + app_key);
}

function unset_empty(data){
	$.each(data, function(k, v){
		if(!v && v !==0){
			delete(data[k])
		}
	})
	return data;
}
