 <?php 
echo "前台<br>";
  ?>
  <center>
  <h2>前台接口测试</h2>
   <input type="hidden" name="token" value="<?php echo csrf_token(); ?>" id="a" > 
   <input type="submit" id="kai" value="提交">
  </center>
 <script src="js/base.js"></script>
 	
	 <script>
	 	var data = {};

	 	$("#kai").click(function(){
	 		//alert(1);return;
	 	//alert(csrf);return;
//		data.username = $('input[name=username]').val();
//		data.pwd = $('input[name=pwd]').val();
		//alert(data.pwd);
		data.username = '1';
	 	data.pwd = '1';
	 	data.csrf = $("#a").val();
	 	//console.log(data);return;
// 	 	$.get("index",{rsa:data},function(res){
// console.log(res); //成功
// 	 	})
		api('index',data,function(msg){
//			if(msg.code=1){
//				alert(msg.ol);
//				locaton.href = 'index.html';
//			}
	 		console.log(msg);
//	 		if(msg==1){
//	 			alert('跳转');
//				location.href = 'api/goood/getlist';
//	 		}
	 	})
	 })
	 </script>