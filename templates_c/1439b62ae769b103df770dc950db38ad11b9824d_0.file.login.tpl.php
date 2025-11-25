<?php
/* Smarty version 3.1.46, created on 2025-11-06 16:16:54
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_690cbbe6cd8c75_59453759',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1439b62ae769b103df770dc950db38ad11b9824d' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/login.tpl',
      1 => 1762442206,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690cbbe6cd8c75_59453759 (Smarty_Internal_Template $_smarty_tpl) {
?>  
  <main class="wrap">
    <form class="card gradient-border" action="#" method="post" autocomplete="on">
      <h1><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Consultation<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h1>
      <?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {?><h3 class="message <?php if ($_smarty_tpl->tpl_vars['status']->value == 'ok') {?>success<?php } else { ?>error<?php }?>"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</h3><?php }?>
      <label for="username"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Username<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
      <input id="username" name="username" class="field" type="text" required placeholder="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Enter your username<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>">

      <div class="gap"></div>

      <label for="password"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Password<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
      <input id="password" name="password" class="field" type="password" required placeholder="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Enter your password<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>">

      <div class="gap"></div>

      <div class="actions">
        <div class="small">&nbsp;</div>
        <button type="submit" class="btn gradient-border"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Log in<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
      </div>
    </form>
  </main><?php }
}
