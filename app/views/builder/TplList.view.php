<?php if(!defined('IN_WONIU_APP')){exit();}?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>列表展示</title>
<script src="res/js/jq/j.js"></script>
<style type="text/css">
body{font-size:15px;padding:30px;}
fieldset{width:820px;margin:0 auto;}
.hr1{border-bottom:2px solid #A6C61C;margin:0;padding:0;}
legend{color:green;font-size:16px;font-weight:bold;}
table{
  border-collapse:collapse;
  margin-top:10px;
}
th{
    background-color:#DDD;
}
.trhover{background-color:#F5F5F5}
td,th{padding:5px;text-align:center;}
input[type=button],input[type=submit]{
    cursor:pointer;
    padding:2xp 5px;
}
label,input[type=checkbox]{
    cursor:pointer;
}
</style>
<script>
var actionName='<?php echo $_POST['action_name'];?>';
$.ajaxSetup({
    error:function(x){alert('通信出错,代码['+x.status+']');}
});
$(function(){
      $('tr:odd').css({'background-color':'#F5F5F5'});
      $('#choose').click(function(){
           $('.pk').attr('checked',$(this)[0].checked);
      });
      $('#del_choose').click(function(){
          var pks=getChoose();
           if(pks.length){
                if(!confirm('确定删除吗?')){return;}
                $.ajax({
                       url:'?'+actionName+'.dels'
                      ,type:'post'
                      ,data:{'pks':pks}
                      ,success:function(data){
                            alert(data.tip);
                            if(data.code==200){location=location;}
                      }
                      ,dataType:'json'
                });
           }
      });
});
function getChoose(){
     var pks=[];
     $('.pk:checked').each(function(){
         pks.push($(this).val());
     });
     return pks;
}
</script></head>
<body>
<fieldset>
    <legend>列表页&nbsp;&nbsp;[<a href="?<?php echo $_POST['action_name'];?>.add">添加</a>]</legend>
<hr class="hr1"/>
<table cellpadding="0" cellspacing="0" width="100%">
    <tr><?php foreach($rows as $row){?><th><?php echo $row['th'];?></th><?php }?><th>操作</th></tr>
&{foreach($items as $row){}&
    <tr><?php foreach($rows as $key=>$row){?><?php if($key==0){?><td><label><input type="checkbox" value="&{ echo $row['<?php echo $row['col'];?>']}&" class="pk"/>&{ echo $row['<?php echo $row['col'];?>']}&</label></td><?php }else{?><td>&{ echo $row['<?php echo $row['col'];?>']}&</td><?php }?><?php }?>
    <td>[<a href="?<?php echo $_POST['action_name'];?>.modify&<?php echo $_POST['pk'];?>=&{ echo $row[$pk]}&">修改</a>]</td>
    </tr>
&{}//end foreach}&
</table>
    <p><label><input type="checkbox" id="choose"/>全选/全不选</label><input type="button" id="del_choose" value="删除所选"></p>
    <p>&{ echo $page;}&</p>
</fieldset>
</body>
</html>