<?php
/* Smarty version 3.1.46, created on 2026-03-12 14:34:54
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_69b2c0fe40c233_49563361',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c3b9e761a64e509b35231ead19ef0dae9a33cb15' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/footer.tpl',
      1 => 1762953291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69b2c0fe40c233_49563361 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['logged']->value))) {?>
    <div class="logo">
    <?php if ((isset($_smarty_tpl->tpl_vars['logo']->value))) {?>
        <img src="/img/<?php echo $_smarty_tpl->tpl_vars['logo']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['potpis']->value;?>
" class="img-responsive"/>
        <?php } else { ?>
        <?php echo $_smarty_tpl->tpl_vars['potpis']->value;?>

    <?php }?>
    </div>
<?php }
}
}
