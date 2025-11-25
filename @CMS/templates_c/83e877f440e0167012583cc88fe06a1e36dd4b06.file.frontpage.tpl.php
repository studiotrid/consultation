<?php /* Smarty version Smarty-3.1.17, created on 2022-11-17 02:44:26
         compiled from "/var/www/html/@CMS/templates/frontpage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6644656325ae1e0c3ee92f6-27771913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83e877f440e0167012583cc88fe06a1e36dd4b06' => 
    array (
      0 => '/var/www/html/@CMS/templates/frontpage.tpl',
      1 => 1668653064,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6644656325ae1e0c3ee92f6-27771913',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5ae1e0c3f0b328_85350924',
  'variables' => 
  array (
    'loggedInUser' => 0,
    'ADMIN_SAVE_CHANGES' => 0,
    'ADMIN_CLOSE' => 0,
    'prodaja' => 0,
    'poli' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ae1e0c3f0b328_85350924')) {function content_5ae1e0c3f0b328_85350924($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['username']!='ikcg') {?>
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
        
  
  <?php if (isset($_smarty_tpl->tpl_vars['prodaja']->value)) {?>
  
  <h1>Prodaja</h1>
  <table class="table table-striped table-hover">
   
    <thead class="thead-dark">
        <tr>
            <th scope="row">Mesec i godina</th>
            <th scope="row" style="text-align:center">PZO broj polisa</th>
            <th scope="row" style="text-align:right">PZO Premija</th>
        </tr>
    </thead>
    <tbody>
        <?php  $_smarty_tpl->tpl_vars['poli'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['poli']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['prodaja']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['poli']->key => $_smarty_tpl->tpl_vars['poli']->value) {
$_smarty_tpl->tpl_vars['poli']->_loop = true;
?>
            <tr>
                <td><strong><?php echo $_smarty_tpl->tpl_vars['poli']->value['mesec'];?>
</strong></td>
                <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['poli']->value['brojPZO'];?>
</td>
                <td style="text-align:right"><?php echo number_format($_smarty_tpl->tpl_vars['poli']->value['iznosPZO'],2,".",",");?>
</td>
            </tr>
        <?php } ?>
    </tbody>
  </table>

  <?php }?>
  
  
  <style>

  .table .thead-dark th {
    color: #fff;
    background-color: #212529;
    border-color: #32383e;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
  </style>
  <?php }?>
         <?php }} ?>
