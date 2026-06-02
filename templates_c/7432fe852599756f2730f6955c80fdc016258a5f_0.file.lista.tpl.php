<?php
/* Smarty version 3.1.46, created on 2026-03-13 19:42:56
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/lista.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_69b45ab0b217c1_29962217',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7432fe852599756f2730f6955c80fdc016258a5f' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/lista.tpl',
      1 => 1771619080,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69b45ab0b217c1_29962217 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/admin/web/consultation.profesionalnaastrologija.com/public_html/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
if ((isset($_smarty_tpl->tpl_vars['buduceTipKonsultacije']->value)) && count($_smarty_tpl->tpl_vars['buduceTipKonsultacije']->value) > 0) {?>
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
    <div class="upcomingConsultations text-start" style="margin-bottom:20px;">
        <h4 class="mb-2"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Upcoming consultations<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h4>
        <ul class="list-unstyled mb-0">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['buduceTipKonsultacije']->value, 'upcoming');
$_smarty_tpl->tpl_vars['upcoming']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['upcoming']->value) {
$_smarty_tpl->tpl_vars['upcoming']->do_else = false;
?>
            <li><strong>
                <?php if ((isset($_smarty_tpl->tpl_vars['upcoming']->value['faza'])) && (isset($_smarty_tpl->tpl_vars['upcoming']->value['brojKonsultacijeUFazi'])) && $_smarty_tpl->tpl_vars['upcoming']->value['faza'] > 0 && $_smarty_tpl->tpl_vars['upcoming']->value['brojKonsultacijeUFazi'] > 0) {?>
                    <?php echo $_smarty_tpl->tpl_vars['upcoming']->value['naziv'];?>
 <?php echo $_smarty_tpl->tpl_vars['upcoming']->value['faza'];?>
/<?php echo $_smarty_tpl->tpl_vars['upcoming']->value['brojKonsultacijeUFazi'];?>

                <?php } else { ?>
                    <?php echo $_smarty_tpl->tpl_vars['upcoming']->value['naziv'];?>

                <?php }?>
            </strong> - <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['upcoming']->value['startTime'],$_smarty_tpl->tpl_vars['date_format']->value);?>
 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['upcoming']->value['startTime'],"%H:%M");?>
</li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </div>
<?php }?>

<?php if (!(isset($_smarty_tpl->tpl_vars['svesKonsultacije']->value['opis']))) {?>
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
<?php } elseif (!(isset($_smarty_tpl->tpl_vars['buduceTipKonsultacije']->value)) || count($_smarty_tpl->tpl_vars['buduceTipKonsultacije']->value) == 0) {?>
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
   
    <p><img class="levo" src="https://coach.profesionalnaastrologija.com/upload/image/<?php echo $_smarty_tpl->tpl_vars['svesKonsultacije']->value['slika'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['nazivTipa']->value;?>
"/> <?php echo $_smarty_tpl->tpl_vars['svesKonsultacije']->value['opis'];?>
</p>
    <div style="clear:both;"><hr /></div>
    
    <form class="napomena">
    <input type="hidden" name="tip" id="tip" value="<?php echo $_GET['tip'];?>
"/>
    <?php if ((isset($_smarty_tpl->tpl_vars['termini']->value)) && count($_smarty_tpl->tpl_vars['termini']->value) > 100000000) {?>
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
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['termin']->value['datum'],"%H:%M");?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </select>
        </label>
        <button type="submit" class="btn btn-lg gradient-border"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
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
ob_start();?>If you want you may inform your Coach that you are interested in this consultation<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></p>
        <button type="submit" class="btn btn-lg gradient-border"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Inform Coach<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
     <?php }?>
    </form>
    
    <?php echo '<script'; ?>
 type="text/javascript">
        $(document).ready(function(){
            $('form.napomena').on('submit', function(evt){
                evt.preventDefault();
                
                var $form = $(this);
                var $submitBtn = $form.find('button[type="submit"]');
                var termin = $form.find('select[name="termin"]').val();
                var tip = $form.find('input[name="tip"]').val();
                var inform = $form.find('input[name="inform"]').val();
                
                $submitBtn.prop('disabled', true);
                
                // Ako je "Inform Coach" (nema termina)
                if(inform == '1'){
                    $.ajax({
                        url: '/appointment.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'inform',
                            tip: tip
                        },
                        success: function(resp){
                            if(resp && resp.status === 'ok'){
                                alert('<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Coach has been notified<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>');
                                window.location.reload();
                            } else {
                                var msg = (resp && resp.message) ? resp.message : '<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>An error occurred<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>';
                                alert(msg);
                            }
                        },
                        error: function(){
                            alert('<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>An error occurred<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>');
                        },
                        complete: function(){
                            $submitBtn.prop('disabled', false);
                        }
                    });
                }
                // Ako je "Sign In" (sa terminom)
                else if(termin) {
                    $.ajax({
                        url: '/appointment.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'reserve',
                            termin: termin,
                            tip: tip
                        },
                        success: function(resp){
                            if(resp && resp.status === 'ok'){
                                alert('<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>You have successfully scheduled your consultation<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>');
                                window.location.reload();
                            } else {
                                var msg = (resp && resp.message) ? resp.message : '<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>An error occurred<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>';
                                alert(msg);
                            }
                        },
                        error: function(){
                            alert('<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>An error occurred<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>');
                        },
                        complete: function(){
                            $submitBtn.prop('disabled', false);
                        }
                    });
                }
            });
        });
    <?php echo '</script'; ?>
>
<?php }
}
}
