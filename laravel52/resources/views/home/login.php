<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">  
<head>  
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">  
    <title>Document</title>  
</head>  
<body>  
<form action="add" method="post" enctype="multipart/form-data"> 
    <table>  
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
        <tr>
            <td>文件上传:</td>
            <td><input type="file" name="my"></td>
        </tr>
        <tr>  
            <td>用户</td>  
            <td><input type="text" name="name"/></td>  
        </tr>  
        <tr>  
            <td>密码</td>  
            <td><input type="password" name="password"/></td>  
        </tr>       
        <tr>  
            <td><input type="submit" value="提交"/></td>  
        </tr>  
    </table>  
</form>  
</body>  
</html>  