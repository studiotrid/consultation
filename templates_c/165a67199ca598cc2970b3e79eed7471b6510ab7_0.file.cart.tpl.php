<?php
/* Smarty version 3.1.46, created on 2025-11-27 17:28:15
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/moduli/cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_69287c1fdeb135_93179328',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '165a67199ca598cc2970b3e79eed7471b6510ab7' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/moduli/cart.tpl',
      1 => 1763678734,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69287c1fdeb135_93179328 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['modulcart']->value)) && $_smarty_tpl->tpl_vars['modulcart']->value != '') {?>
<div class="cartModul ikona" data-cart="<?php echo $_smarty_tpl->tpl_vars['modulcart']->value;?>
" title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Click to view cart<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><span><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>CART<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></div>
<?php }
}
}
