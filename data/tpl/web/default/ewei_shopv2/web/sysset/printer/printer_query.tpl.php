<?php defined('IN_IA') or exit('Access Denied');?><div style='max-height:500px;overflow:auto;min-width:850px;'>
<table class="table table-hover" style="min-width:850px;">
    <thead>
        <th>模板名称</th>
        <th>选择</th>
    </thead>
    <tbody>   
        <?php  if(is_array($ds)) { foreach($ds as $row) { ?>
        <tr>
           <td><?php  echo $row['title'];?></td>
            <td style="width:80px;"><a href="javascript:;" onclick='biz.selector.set(this,<?php  echo json_encode($row)?>)'>选择</a></td>
        </tr>
        <?php  } } ?>
        <?php  if(count($ds)<=0) { ?>
        <tr> 
            <td colspan='5' align='center'>未找到任何打印机, 点击 <a href="<?php  echo webUrl('sysset/printer_list')?>">【创建打印机】</a></td>
        </tr>
        <?php  } ?>
    </tbody>
</table>
</div>