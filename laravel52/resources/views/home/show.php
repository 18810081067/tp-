<?php header('content-type:text/html;charset=utf8'); ?>
<h2>展示页面</h2>  
    <table border="1">  
        <tr>  
            <td>id</td>  
            <td>姓名</td>  
            <td>密码</td>  
            <td>图片</td> 
            <td>操作</td>  
        </tr>  
        <?php foreach ($arr as $key => $v) {?>  
        <tr>  
            <td><?=$v->id ?></td>
            <td><?=$v->name ?></td>  
            <td><?=$v->password ?></td>  
            <td><img src="<?=$v->img ?>" alt="" width="50" height="50"></td>  
            <td>  
                <a href="del?id=<?php echo $v->id ?>">删除</a>  
                <a href="up?id=<?php echo $v->id ?>">修改</a>  
            </td>  
        </tr>    
        <?php }?> 
    </table>  
    