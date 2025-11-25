<?php /* Smarty version Smarty-3.1.17, created on 2014-07-11 01:09:19
         compiled from "/home/denem/public_html/new/@CMS/templates/menu_items.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131442109953bf1d1facf0d4-18637010%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3879ea5a1c15565d0e612e2664757934a3e62442' => 
    array (
      0 => '/home/denem/public_html/new/@CMS/templates/menu_items.tpl',
      1 => 1404995497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131442109953bf1d1facf0d4-18637010',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ADMIN_MENUS_AVAILABLE' => 0,
    'wholemenu' => 0,
    'menuitem' => 0,
    'ADMIN_MENUS_EDIT_ITEM' => 0,
    'ADMIN_MENUS_REMOVE_ITEM' => 0,
    'submenu' => 0,
    'subsubmenu' => 0,
    'ADMIN_MENUS_GENERAL' => 0,
    'langs' => 0,
    'lang' => 0,
    'ADMIN_MENUS_ITEM' => 0,
    'edit' => 0,
    'ADMIN_MENUS_ENTER_TEXT' => 0,
    'ADMIN_MENUS_PARENT' => 0,
    'ADMIN_MENUS_NOPARENT' => 0,
    'ADMIN_MENUS_LINK_TYPE' => 0,
    'pages' => 0,
    'ADMIN_MENUS_PAGE_TYPE' => 0,
    'posts' => 0,
    'ADMIN_MENUS_POST_TYPE' => 0,
    'ADMIN_MENUS_CUSTOM_TYPE' => 0,
    'ADMIN_MENUS_LINK' => 0,
    'ADMIN_MENUS_HYPERLINK' => 0,
    'ADMIN_MENUS_LINK_TO_PAGE' => 0,
    'page' => 0,
    'ADMIN_MENUS_NO_PAGE' => 0,
    'ADMIN_MENUS_LINK_TO_POST' => 0,
    'post' => 0,
    'ADMIN_MENUS_NO_POST' => 0,
    'ADMIN_MENUS_MENUS_TITLE' => 0,
    'ADMIN_MENUS_ITEM_ACTIVE' => 0,
    'ADMIN_UPDATE' => 0,
    'ADMIN_ADD' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53bf1d1fcfb023_26001321',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bf1d1fcfb023_26001321')) {function content_53bf1d1fcfb023_26001321($_smarty_tpl) {?>         <div class="row">
         
            <div class="col-md-6">
               <div class="portlet box yellow">
                  <div class="portlet-title">
                     <div class="caption"><i class="icon-comments"></i><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_AVAILABLE']->value;?>
</div>
                  </div>
                  <div class="portlet-body">
                     <div class="dd" id="nestable_list_3">
                        <ol class="dd-list">
                            <?php  $_smarty_tpl->tpl_vars['menuitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menuitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wholemenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menuitem']->key => $_smarty_tpl->tpl_vars['menuitem']->value) {
$_smarty_tpl->tpl_vars['menuitem']->_loop = true;
?>
                                <li class="dd-item dd3-item" data-id="<?php echo $_smarty_tpl->tpl_vars['menuitem']->value['id'];?>
">
                                      <div class="dd-handle dd3-handle"></div>
                                      <div class="dd3-content"><?php echo $_smarty_tpl->tpl_vars['menuitem']->value['title'];?>

                                      <div class="tools">
                                        <a href="?menu_id=<?php echo $_GET['menu_id'];?>
&edit=<?php echo $_smarty_tpl->tpl_vars['menuitem']->value['id'];?>
" class="config" title="<?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_EDIT_ITEM']->value;?>
"></a>
                                        <a href="?menu_id=<?php echo $_GET['menu_id'];?>
&remove=<?php echo $_smarty_tpl->tpl_vars['menuitem']->value['id'];?>
" class="remove" title="<?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_REMOVE_ITEM']->value;?>
"></a>
                                     </div>
                                      </div>
                                
                                    <?php if (count($_smarty_tpl->tpl_vars['menuitem']->value['submenu'])>0) {?>
                                    <ol class="dd-list">
                                        <?php  $_smarty_tpl->tpl_vars['submenu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['submenu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menuitem']->value['submenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['submenu']->key => $_smarty_tpl->tpl_vars['submenu']->value) {
$_smarty_tpl->tpl_vars['submenu']->_loop = true;
?>
                                            <li class="dd-item dd3-item" data-id="<?php echo $_smarty_tpl->tpl_vars['submenu']->value['id'];?>
">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content"><?php echo $_smarty_tpl->tpl_vars['submenu']->value['title'];?>

                                                <div class="tools">
                                                    <a href="?menu_id=<?php echo $_GET['menu_id'];?>
&edit=<?php echo $_smarty_tpl->tpl_vars['submenu']->value['id'];?>
" class="config" title="<?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_EDIT_ITEM']->value;?>
"></a>
                                                    <a href="?menu_id=<?php echo $_GET['menu_id'];?>
&remove=<?php echo $_smarty_tpl->tpl_vars['submenu']->value['id'];?>
" class="remove" title="<?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_REMOVE_ITEM']->value;?>
"></a>
                                                 </div>
                                                </div>
                                    	   <?php if (count($_smarty_tpl->tpl_vars['submenu']->value['submenu'])>0) {?>
                                            <ol class="dd-list">
                                                <?php  $_smarty_tpl->tpl_vars['subsubmenu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subsubmenu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['submenu']->value['submenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subsubmenu']->key => $_smarty_tpl->tpl_vars['subsubmenu']->value) {
$_smarty_tpl->tpl_vars['subsubmenu']->_loop = true;
?>
                                            	   <li class="dd-item dd3-item" data-id="<?php echo $_smarty_tpl->tpl_vars['subsubmenu']->value['id'];?>
">
                                                    <div class="dd-handle dd3-handle"></div>
                                                    <div class="dd3-content"><?php echo $_smarty_tpl->tpl_vars['subsubmenu']->value['title'];?>

                                                        <div class="tools">
                                                            <a href="?menu_id=<?php echo $_GET['menu_id'];?>
&edit=<?php echo $_smarty_tpl->tpl_vars['subsubmenu']->value['id'];?>
" class="config" title="<?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_EDIT_ITEM']->value;?>
"></a>
                                                            <a href="?menu_id=<?php echo $_GET['menu_id'];?>
&remove=<?php echo $_smarty_tpl->tpl_vars['subsubmenu']->value['id'];?>
" class="remove" title="<?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_REMOVE_ITEM']->value;?>
"></a>
                                                         </div>
                                                    </div>
                                                 </li>
                                            	<?php } ?>
                                             </ol>
                                            <?php }?>
                                           </li>
                                    	<?php } ?>
                                     </ol>
                                    <?php }?>
                                </li>
                            <?php } ?>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
            
            <div class="col-md-6">
                <form action="?menu_id=<?php echo $_GET['menu_id'];?>
&<?php if (isset($_GET['edit'])) {?>update=<?php echo $_GET['edit'];?>
<?php } else { ?>addmenu=1<?php }?>" class="" method="post">
                <div class="tabbable tabbable-custom ">
                <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_0" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_GENERAL']->value;?>
</a></li>
                <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                    <li><a href="#tab_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
" data-toggle="tab"><img src="/img/flags/<?php echo $_smarty_tpl->tpl_vars['lang']->value['code'];?>
.png" height="26"/> <?php echo $_smarty_tpl->tpl_vars['lang']->value['name'];?>
</a></li>
                <?php } ?>
                </ul>
               <div class="portlet-body form tab-content">
                    
                        <div class="tab-pane active" id="tab_0">
                    
                                       <div class="form-body">
                                          <div class="form-group">
                                             <label  class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_ITEM']->value;?>
</label>
                                             <input type="text" name="title" class="form-control" <?php if (isset($_GET['edit'])) {?>value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['title'];?>
"<?php }?> placeholder="<?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_ENTER_TEXT']->value;?>
">
                                          </div>
                                          <div class="form-group">
                                             <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_PARENT']->value;?>
</label>
                                             
                                                <select class="form-control" name="parent">
                                                    <option value="0" 
                                                    <?php if (isset($_GET['edit'])) {?>
                                                    <?php if ($_smarty_tpl->tpl_vars['edit']->value['parent']==0) {?>selected="selected"<?php }?>
                                                    <?php }?>
                                                    ><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_NOPARENT']->value;?>
</option>
                                                    <?php  $_smarty_tpl->tpl_vars['menuitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menuitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wholemenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menuitem']->key => $_smarty_tpl->tpl_vars['menuitem']->value) {
$_smarty_tpl->tpl_vars['menuitem']->_loop = true;
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['menuitem']->value['id'];?>
"
                                                        <?php if (isset($_GET['edit'])) {?>
                                                            <?php if ($_smarty_tpl->tpl_vars['edit']->value['parent']==$_smarty_tpl->tpl_vars['menuitem']->value['id']) {?>selected="selected"<?php }?>
                                                            <?php }?>
                                                        ><?php echo $_smarty_tpl->tpl_vars['menuitem']->value['title'];?>
</option>
                                                            <?php if (count($_smarty_tpl->tpl_vars['menuitem']->value['submenu'])>0) {?>
                                                                <?php  $_smarty_tpl->tpl_vars['submenu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['submenu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menuitem']->value['submenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['submenu']->key => $_smarty_tpl->tpl_vars['submenu']->value) {
$_smarty_tpl->tpl_vars['submenu']->_loop = true;
?>
                                                                <option value="<?php echo $_smarty_tpl->tpl_vars['submenu']->value['id'];?>
"
                                                                <?php if (isset($_GET['edit'])) {?>
                                                                    <?php if ($_smarty_tpl->tpl_vars['edit']->value['parent']==$_smarty_tpl->tpl_vars['submenu']->value['id']) {?>selected="selected"<?php }?>
                                                                    <?php }?>
                                                                ><?php echo $_smarty_tpl->tpl_vars['submenu']->value['title'];?>
</option>
                                                            	   <?php if (count($_smarty_tpl->tpl_vars['submenu']->value['submenu'])>0) {?>
                                                                        <?php  $_smarty_tpl->tpl_vars['subsubmenu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subsubmenu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['submenu']->value['submenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subsubmenu']->key => $_smarty_tpl->tpl_vars['subsubmenu']->value) {
$_smarty_tpl->tpl_vars['subsubmenu']->_loop = true;
?>
                                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['subsubmenu']->value['id'];?>
"
                                                                        <?php if (isset($_GET['edit'])) {?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['edit']->value['parent']==$_smarty_tpl->tpl_vars['subsubmenu']->value['id']) {?>selected="selected"<?php }?>
                                                                            <?php }?>
                                                                        ><?php echo $_smarty_tpl->tpl_vars['subsubmenu']->value['title'];?>
</option>
                                                                    	<?php } ?>
                                                                    <?php }?>
                                                            	<?php } ?>
                                                            <?php }?>
                                                    <?php } ?>
                                                </select>
                                             
                                          </div>
                                          <div class="form-group">
                                                <label  class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_LINK_TYPE']->value;?>
</label>
                                                <select class="form-control" name="link_type" id="link">
                                                    <?php if (count($_smarty_tpl->tpl_vars['pages']->value)>0) {?><option value="page"
                                                                        <?php if (isset($_GET['edit'])) {?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['edit']->value['link_type']=="page") {?>selected="selected"<?php }?>
                                                                            <?php }?>
                                                    ><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_PAGE_TYPE']->value;?>
</option><?php }?>
                                                    <?php if (count($_smarty_tpl->tpl_vars['posts']->value)>0) {?><option value="post"
                                                                        <?php if (isset($_GET['edit'])) {?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['edit']->value['link_type']=="post") {?>selected="selected"<?php }?>
                                                                            <?php }?>
                                                    ><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_POST_TYPE']->value;?>
</option><?php }?>
                                                    <option value="custom"
                                                                    <?php if (isset($_GET['edit'])) {?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['edit']->value['link_type']=="custom") {?>selected="selected"<?php }?>
                                                                            <?php }?>
                                                    ><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_CUSTOM_TYPE']->value;?>
</option>
                                                </select>
                                          </div>
                                          
                                          <div class="form-group" id="link_custom">
                                             <label  class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_LINK']->value;?>
</label>
                                             <input type="text" name="link_custom" class="form-control" <?php if (isset($_GET['edit'])) {?>value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['link'];?>
"<?php }?> placeholder="<?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_HYPERLINK']->value;?>
"/>
                                          </div>
                                          
                                          <div class="form-group" id="link_page">
                                          <?php if (count($_smarty_tpl->tpl_vars['pages']->value)>0) {?>
                                                <label  class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_LINK_TO_PAGE']->value;?>
</label>
                                                <select class="form-control" name="link_page">
                                                    <?php if (isset($_GET['edit'])) {?>
                                                    <?php if ($_smarty_tpl->tpl_vars['edit']->value['link_type']=="page") {?>
                                                        <?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['page']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->_loop = true;
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['edit']->value['link']==$_smarty_tpl->tpl_vars['page']->value['id']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['page']->value['title'];?>
</option>
                                                        <?php } ?>
                                                        
                                                        <?php } else { ?>
                                                        <?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['page']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->_loop = true;
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value['title'];?>
</option>
                                                        <?php } ?>
                                                    <?php }?>
                                                    <?php } else { ?>
                                                        <?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['page']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->_loop = true;
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value['title'];?>
</option>
                                                        <?php } ?>
                                                    <?php }?>
                                                    
                                                </select>
                                                <?php } else { ?>
                                                <?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_NO_PAGE']->value;?>

                                                
                                          <?php }?>
                                          </div>
                                          
                                          <div class="form-group" id="link_post">
                                            <?php if (count($_smarty_tpl->tpl_vars['posts']->value)>0) {?>
                                                <label  class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_LINK_TO_POST']->value;?>
</label>
                                                <select class="form-control" name="link_post">
                                                    <?php if (isset($_GET['edit'])) {?>
                                                    <?php if ($_smarty_tpl->tpl_vars['edit']->value['link_type']=="post") {?>
                                                        <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['edit']->value['link']==$_smarty_tpl->tpl_vars['post']->value['id']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</option>
                                                        <?php } ?>
                                                        
                                                        <?php } else { ?>
                                                        <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</option>
                                                        <?php } ?>
                                                    <?php }?>
                                                    <?php } else { ?>
                                                        <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</option>
                                                        <?php } ?>
                                                    <?php }?>
                                                    
                                                </select>
                                                <?php } else { ?>
                                                <?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_NO_POST']->value;?>

                                            <?php }?>
                                          </div>
                                          
                                          
                                       </div>
                                       
                          </div> 
                          <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                          <div class="tab-pane" id="tab_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
">
                    
                                       <div class="form-body">
                                          <div class="form-group">
                                             <label  class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_MENUS_TITLE']->value;?>
</label>
                                             <input type="text" name="title_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
" <?php if (isset($_GET['edit'])) {?>value="<?php echo $_smarty_tpl->tpl_vars['edit'.($_smarty_tpl->tpl_vars['lang']->value['id'])]->value['title'];?>
"<?php }?> class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_ENTER_TEXT']->value;?>
">
                                          </div>
                                          
                                          <div class="form-group">
                                             <label  class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_ITEM_ACTIVE']->value;?>
</label>
                                             <input type="checkbox" name="active_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
" <?php if (isset($_GET['edit'])) {?><?php if ($_smarty_tpl->tpl_vars['edit'.($_smarty_tpl->tpl_vars['lang']->value['id'])]->value['active']==1) {?>checked="checked"<?php }?><?php }?> value="1" class="form-control"/>
                                          </div>
                                          
                                          
                                       </div>
                                       
                          </div> 
                          <?php } ?>
                                        <div class="form-actions right">
                                          <button type="submit" class="btn green"><?php if (isset($_GET['edit'])) {?><?php echo $_smarty_tpl->tpl_vars['ADMIN_UPDATE']->value;?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['ADMIN_ADD']->value;?>
<?php }?></button>     
                                       </div>
                               
               </div>
               </div>
               </form>  
            </div>
         </div><?php }} ?>
