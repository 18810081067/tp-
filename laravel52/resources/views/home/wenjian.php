<style>
	h2,table{background-color:blue;}
</style>
<center>
<h2>文件上环</h2>
<form action="upload" method="post" enctype="multipart/form-data">
	<table>
		<tr>
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
			<td>文件上传:</td>
			<td><input type="file" name="my"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="上传"></td>
		</tr>
	</table>
</form>
</center>
