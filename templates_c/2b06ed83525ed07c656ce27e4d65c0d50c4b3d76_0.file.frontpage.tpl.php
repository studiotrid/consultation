<?php
/* Smarty version 3.1.46, created on 2025-11-27 17:28:15
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/frontpage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_69287c1fe760c1_75884407',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b06ed83525ed07c656ce27e4d65c0d50c4b3d76' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/frontpage.tpl',
      1 => 1764203996,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69287c1fe760c1_75884407 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/admin/web/consultation.profesionalnaastrologija.com/public_html/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<div class="container" style="margin-top:60px;text-align:center;margin-bottom:60px;">
    <h2 class="senka"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Welcome to Your Personal Astro-Energetic Space<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h2>
    <h3 class="senka" style="margin-top:30px;"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>This is where your journey into awareness, balance, and your inner map of time begins.<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h3>
</div>

<div class="container ">
  <div class="row g-3  px-4 p-0">
    <div class="gradient-border blue col-12 col-md-6 p-4 px-4">
        <?php if ((isset($_smarty_tpl->tpl_vars['levo']->value))) {
echo $_smarty_tpl->tpl_vars['levo']->value;?>

        <?php } else { ?>
        <?php if ((isset($_smarty_tpl->tpl_vars['lastKonsultacija']->value)) && is_array($_smarty_tpl->tpl_vars['lastKonsultacija']->value)) {?>
            <div class="modulHolder">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lastKonsultacija']->value, 'moduls', false, NULL, 'mso', array (
  'first' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['moduls']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['moduls']->value) {
$_smarty_tpl->tpl_vars['moduls']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_mso']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_mso']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_mso']->value['index'];
?>
                <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_mso']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_mso']->value['first'] : null)) {?>
                    <h3><strong><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['moduls']->value['naziv'];
$_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></strong> / <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['moduls']->value['startTime'],$_smarty_tpl->tpl_vars['date_format']->value);?>
</h3>
                    <?php if ((isset($_smarty_tpl->tpl_vars['moduls']->value['nextConsult'])) && $_smarty_tpl->tpl_vars['moduls']->value['nextConsult'] != '') {
$_smarty_tpl->_assignInScope('sledeca', $_smarty_tpl->tpl_vars['moduls']->value['nextConsult']);
}?>
                <?php } else { ?>
                    <?php echo $_smarty_tpl->tpl_vars['moduls']->value;?>

                <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php if ((isset($_smarty_tpl->tpl_vars['sledeca']->value))) {?>
                    <h4><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Next scheduled consultation<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?><br /><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['sledeca']->value,$_smarty_tpl->tpl_vars['date_format']->value);?>
 <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>in<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['sledeca']->value,"%H:%i");?>
</h4>
                <?php }?>
            </div>
        <?php }?>
        <?php }?>
    </div>

    <div class="col-12 col-md-6 px-0 px-md-3">
        <div class="row row-cols-2 row-cols-md-3 g-3 justify-content-center">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sveKonsultacije']->value, 'konsult');
$_smarty_tpl->tpl_vars['konsult']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['konsult']->value) {
$_smarty_tpl->tpl_vars['konsult']->do_else = false;
?>
                <div class="col text-center ">
                    <div class="gradient-border blue p-2 box <?php if ($_smarty_tpl->tpl_vars['konsult']->value['koliko'] > 0) {?>ima<?php }?>" data-tip="<?php echo $_smarty_tpl->tpl_vars['konsult']->value['id'];?>
">
                        <img src="/img/<?php echo $_smarty_tpl->tpl_vars['konsult']->value['logo'];?>
" class="img-fluid mb-2" alt="<?php echo $_smarty_tpl->tpl_vars['konsult']->value['naziv'];?>
" />
                        <br />
                        <span><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['konsult']->value['naziv'];
$_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span> 
                        <?php if ($_smarty_tpl->tpl_vars['konsult']->value['koliko'] > 0) {?><span class="broj"><?php echo $_smarty_tpl->tpl_vars['konsult']->value['koliko'];?>
</span><?php }?>
                    </div>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    </div> 
  </div>
</div>
<?php }
}
