<?php
/* Smarty version 3.1.46, created on 2025-11-20 15:04:46
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/lista.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_691f1ffe0a7223_13641666',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7432fe852599756f2730f6955c80fdc016258a5f' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/lista.tpl',
      1 => 1763647483,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_691f1ffe0a7223_13641666 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/admin/web/consultation.profesionalnaastrologija.com/public_html/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
if (!(isset($_smarty_tpl->tpl_vars['svesKonsultacije']->value['opis']))) {?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
  $( function() {
    $( "#accordion" ).accordion({
      heightStyle: "content"
    });
  } );
  <?php echo '</script'; ?>
>
  <h2><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['nazivTipa']->value;
$_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h2>
<div id="accordion" class="modulHolder">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['svesKonsultacije']->value, 'jednaKonsultacija', false, NULL, 'mdo', array (
));
$_smarty_tpl->tpl_vars['jednaKonsultacija']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['jednaKonsultacija']->value) {
$_smarty_tpl->tpl_vars['jednaKonsultacija']->do_else = false;
?>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['jednaKonsultacija']->value, 'moduls', false, NULL, 'mco', array (
  'first' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['moduls']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['moduls']->value) {
$_smarty_tpl->tpl_vars['moduls']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_mco']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_mco']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_mco']->value['index'];
?>
            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_mco']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_mco']->value['first'] : null)) {?>
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
                <div>
            <?php } else { ?>
                <?php echo $_smarty_tpl->tpl_vars['moduls']->value;?>

            <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>

<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
<?php } else { ?>
    <h2><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['nazivTipa']->value;
$_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h2>
   
    <p><img class="levo" src="/img/<?php echo $_smarty_tpl->tpl_vars['svesKonsultacije']->value['slika'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['nazivTipa']->value;?>
"/> <?php echo $_smarty_tpl->tpl_vars['svesKonsultacije']->value['opis'];?>
</p>
    <div style="clear:both;"><hr /></div>
    
    <form class="napomena">
    <input type="hidden" name="tip" id="tip" value="<?php echo $_GET['tip'];?>
"/>
    <?php if ((isset($_smarty_tpl->tpl_vars['termini']->value)) && count($_smarty_tpl->tpl_vars['termini']->value) > 0) {?>
    <h3><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>If you would like to schedule this consultation, please select an appointment below:<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h3>
    <label><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Available appointments<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
        <select name="termin" class="form-control">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['termini']->value, 'termin');
$_smarty_tpl->tpl_vars['termin']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['termin']->value) {
$_smarty_tpl->tpl_vars['termin']->do_else = false;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['termin']->value['id'];?>
"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['termin']->value['datum'],$_smarty_tpl->tpl_vars['date_format']->value);?>
 <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>in<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['termin']->value['datum'],"%H:%I");?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </select>
        </label>
        <button type="submit" class="btn btn-lg btn-danger"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sign In<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
        <?php } else { ?>
        <input type="hidden" name="inform" id="inform" value="1"/>
        <h3><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>There is no available appointments defined at the moment<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h3>
        <p><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>If you want you may inform your Couch that you interested in this consultation<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></p>
        <button type="submit" class="btn btn-lg btn-danger"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Inform Coach<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
     <?php }?>
    </form>
<?php }
}
}
