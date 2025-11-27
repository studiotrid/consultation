<?php
/* Smarty version 3.1.46, created on 2025-11-27 17:28:15
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/moduli/test.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_69287c1fe08f65_88695669',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f3045906a7e68d4098454b2b5d8d51dcf77c79ad' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/moduli/test.tpl',
      1 => 1764205707,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:testForm.tpl' => 1,
    'file:testGraf-full.tpl' => 1,
  ),
),false)) {
function content_69287c1fe08f65_88695669 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/admin/web/consultation.profesionalnaastrologija.com/public_html/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<?php if ((isset($_smarty_tpl->tpl_vars['modultest']->value)) && is_array($_smarty_tpl->tpl_vars['modultest']->value)) {?>

<?php if (count($_smarty_tpl->tpl_vars['modultest']->value) > 0) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modultest']->value, 'test');
$_smarty_tpl->tpl_vars['test']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['test']->value) {
$_smarty_tpl->tpl_vars['test']->do_else = false;
?>
        <div class="testModul ikona" id="testDugme<?php echo $_smarty_tpl->tpl_vars['test']->value['id'];?>
" title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Click to make test<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><span><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>SHOW TEST<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></div>
        <?php $_smarty_tpl->_subTemplateRender("file:testForm.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    
    <?php echo '<script'; ?>
 type="text/javascript">
        $(document).ready(function(){ 
            $('#testDugme<?php echo $_smarty_tpl->tpl_vars['test']->value['id'];?>
').on('click', function(){
                $('#ispit-form<?php echo $_smarty_tpl->tpl_vars['test']->value['id'];?>
').dialog({
                    modal: true,
                    width: 600,
                    height: 700
                });
            });

        });
    <?php echo '</script'; ?>
>
     <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}?>


<?php if ((isset($_smarty_tpl->tpl_vars['modultestTest']->value)) && count($_smarty_tpl->tpl_vars['modultestTest']->value) > 0) {?>
<div class="testModultest ikona" title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Click to view test results<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><span><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>TEST RESULTS<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></div>
<?php if (count($_smarty_tpl->tpl_vars['modultestTest']->value) > 0) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modultestTest']->value, 'graf');
$_smarty_tpl->tpl_vars['graf']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['graf']->value) {
$_smarty_tpl->tpl_vars['graf']->do_else = false;
?>
        <div class="testGrafikoni dn">
            <h3><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Test taken on<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['graf']->value['datum'],"%d.%m.%Y");?>
 <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>at<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['graf']->value['vreme'],"%H:%M");?>
</h3>
            <div class="testGrafikonContainer " id="testGrafikonContainer<?php echo $_smarty_tpl->tpl_vars['graf']->value['broj'];?>
">
                <?php $_smarty_tpl->_subTemplateRender("file:testGraf-full.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?> 
            </div>
        </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
echo '<script'; ?>
 type="text/javascript">
    $(document).ready(function(){
        $('.testModultest').on('click', function(){
            $('.testGrafikoni').toggleClass('dn');
            });

    });
<?php echo '</script'; ?>
>

<?php }
}
}
