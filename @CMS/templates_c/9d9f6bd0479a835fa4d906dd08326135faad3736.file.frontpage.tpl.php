<?php /* Smarty version Smarty-3.1.17, created on 2018-02-22 00:29:01
         compiled from "/home/savaos/webshop.sava-osiguranje.rs/@CMS/templates/frontpage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10363128855a442f5a5b2669-85698852%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d9f6bd0479a835fa4d906dd08326135faad3736' => 
    array (
      0 => '/home/savaos/webshop.sava-osiguranje.rs/@CMS/templates/frontpage.tpl',
      1 => 1519255738,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10363128855a442f5a5b2669-85698852',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5a442f5a5dd0c5_18374683',
  'variables' => 
  array (
    'ADMIN_SAVE_CHANGES' => 0,
    'ADMIN_CLOSE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a442f5a5dd0c5_18374683')) {function content_5a442f5a5dd0c5_18374683($_smarty_tpl) {?>
         <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
         <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title">Modal title</h4>
                  </div>
                  <div class="modal-body">
                     Widget settings form goes here
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn blue"><?php echo $_smarty_tpl->tpl_vars['ADMIN_SAVE_CHANGES']->value;?>
</button>
                     <button type="button" class="btn default" data-dismiss="modal"><?php echo $_smarty_tpl->tpl_vars['ADMIN_CLOSE']->value;?>
</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->
         <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
  
         <?php }} ?>
