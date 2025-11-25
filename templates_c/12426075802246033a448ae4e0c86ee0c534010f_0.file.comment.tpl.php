<?php
/* Smarty version 3.1.46, created on 2025-11-18 21:45:42
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/moduli/comment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_691cdaf612ac78_22462153',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12426075802246033a448ae4e0c86ee0c534010f' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/moduli/comment.tpl',
      1 => 1763498739,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_691cdaf612ac78_22462153 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['modulnapomena']->value)) && $_smarty_tpl->tpl_vars['modulnapomena']->value != '') {?>
    <div class="napomena">
        <label><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Comment:<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
        <p><?php echo $_smarty_tpl->tpl_vars['modulnapomena']->value;?>
</p>
    </div>
<?php }
}
}
