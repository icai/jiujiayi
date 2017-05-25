<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $this->set['texts']['commission']?>排名</title>
<link rel="stylesheet" href="../addons/ewei_shopv2/template/mobile/default/static/css/rank.css">
<div class="fui-page page-rank yellow" style="overflow:auto;">
        <div class="fui-header">
            <div class="fui-header-left">
                <a class="back" onclick='location.back()'></a>
            </div>
            <div class="title"><?php  echo $_W['shopset']['trade']['credittext'];?>排名</div>
            <div class="fui-header-right">&nbsp;</div>
        </div>
    <div class="fui-content">
    <div class="rankhead">
    <div class="head">
        <div class="child">
            <span><?php  echo $user['seven'];?></span>
            <p class="text">本周<?php  echo $_W['shopset']['trade']['credittext'];?></p>
        </div>
        <div class="child gold">
            <span><?php echo $user['paiming']>=1000 ? '1000+' : $user['paiming']?></span>
            <p class="text">我的名次</p>
        </div>
        <div class="child">
            <span><?php  echo $user['credit1'];?></span>
            <p class="text">总<?php  echo $_W['shopset']['trade']['credittext'];?></p>
        </div>
    </div>
    <div class="title"><?php  echo $_W['shopset']['trade']['credittext'];?>排名为每小时自动更新</div>
</div>
<div class="rankline">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center"></div>
</div>
<div class="ranklist">
    <div class="main">
        <div class="line title">
            <div class="col">排名</div>
            <div class="col">昵称</div>
            <div class="col"><?php  echo $_W['shopset']['trade']['credittext'];?></div>
        </div>

        <div id="container" ></div>
        <a id="btn-more" class="btn btn-default disabled block" >点击加载更多</a>



    </div>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_copyright', TEMPLATE_INCLUDEPATH)) : (include template('_copyright', TEMPLATE_INCLUDEPATH));?>
</div>

<script id="tpl_member_rank_list" type="text/html">
     <%each list as row,index%>

     <div class="line">
         <div class="col<% if ((page+index)<4) %> icon-<%page+index%><%/if%>"><% if ((page+index)>3) %><%page+index%><%/if%></div>
         <div class="col">
             <div class="face"><img src="<%row.avatar%>" /></div>
             <div class="name"><%row.nickname%></div>
         </div>
         <div class="col index-1"><%row.credit1%></div>
     </div>
    <%/each%>
</script>
    <script language='javascript'>
        require(['biz/member/rank'], function (modal) {
            modal.init();
        });
    </script>
</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>