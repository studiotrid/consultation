<?php
/* Smarty version 3.1.46, created on 2025-11-18 22:07:49
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/moduli/audio.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_691ce025949823_28958541',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8a81852f15a3ffb31f70eae5fa18341a77489b8' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/moduli/audio.tpl',
      1 => 1763500064,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_691ce025949823_28958541 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['modulaudio']->value)) && $_smarty_tpl->tpl_vars['modulaudio']->value != '') {?>
<div class="audioModul ikona" data-audio="<?php echo $_smarty_tpl->tpl_vars['modulaudio']->value;?>
" title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Click to play Audio<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><span><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>AUDIO CONSULTATION<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></div>
<?php }
}
}
