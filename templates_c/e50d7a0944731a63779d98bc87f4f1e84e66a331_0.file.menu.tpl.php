<?php
/* Smarty version 3.1.46, created on 2025-11-11 16:27:45
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_691355f155f6c4_74534467',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e50d7a0944731a63779d98bc87f4f1e84e66a331' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/menu.tpl',
      1 => 1762874841,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_691355f155f6c4_74534467 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="top">
    <div class="container">
        <?php echo $_SESSION['loggedName'];?>

        <div class="float-end">
            <a href="?logout" class="logout btn gradient-border"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Logout<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
        </div>
    </div>
</div><?php }
}
