<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <title>Document</title>  
</head>  
<body>  
    <form action="upd" method="post">  
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">  
        <input type="hidden" name="id" value="<?php echo $arr->id ?>">  
        <table>  
            <tr>  
                <td>姓名：</td>  
                <td><input type="text" name="name" value="<?php echo $arr->name ?>"></td>  
            </tr>  
            <tr>  
                <td>密码：</td>  
                <td><input type="password" name="password" value="<?php echo $arr->password ?>"></td>  
            </tr>  
            <tr>  
                <td><input type="submit" value="修改"></td>  
                <td></td>  
            </tr>  
        </table>  
    </form>  
</body>  
</html>