<?php /* Smarty version Smarty-3.1.17, created on 2014-10-29 23:17:30
         compiled from "/hermes/bosoraweb110/b721/ipg.prosendnet/demo/@CMS/templates/translation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7105082885451adcaa53ca9-26877388%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3763a27199b0163d8a7c965339ac27cd7d657a4c' => 
    array (
      0 => '/hermes/bosoraweb110/b721/ipg.prosendnet/demo/@CMS/templates/translation.tpl',
      1 => 1414533171,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7105082885451adcaa53ca9-26877388',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'langs' => 0,
    'lang' => 0,
    'block' => 0,
    'element' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5451adcad035e5_41831720',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5451adcad035e5_41831720')) {function content_5451adcad035e5_41831720($_smarty_tpl) {?><div class="tabbable tabbable-custom boxless tabbable-reversed">
    <form action="translation?translated=1" class="form-horizontal" method="post">
						<ul class="nav nav-tabs">
                        <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['lang']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->_loop = true;
 $_smarty_tpl->tpl_vars['lang']->index++;
 $_smarty_tpl->tpl_vars['lang']->first = $_smarty_tpl->tpl_vars['lang']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['ka']['first'] = $_smarty_tpl->tpl_vars['lang']->first;
?>
							<li class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['ka']['first']) {?>active<?php }?>">
								<a href="#tab_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
" data-toggle="tab">
								<?php echo $_smarty_tpl->tpl_vars['lang']->value['name'];?>
 </a>
							</li>
                        <?php } ?>
						</ul>
						<div class="tab-content">
                            
                            <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['lang']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->_loop = true;
 $_smarty_tpl->tpl_vars['lang']->index++;
 $_smarty_tpl->tpl_vars['lang']->first = $_smarty_tpl->tpl_vars['lang']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['la']['first'] = $_smarty_tpl->tpl_vars['lang']->first;
?>
							<div class="tab-pane <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['la']['first']) {?>active<?php }?>" id="tab_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
">
								
                                    <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['blocks'.($_smarty_tpl->tpl_vars['lang']->value['id'])]->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->_loop = true;
?>
                                    <div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i><?php echo $_smarty_tpl->tpl_vars['block']->value['title'];?>
 <?php echo $_smarty_tpl->tpl_vars['block']->value['prevedeno'];?>
/<?php echo count($_smarty_tpl->tpl_vars['block']->value['element']);?>

										</div>
                                        <div class="tools">
											<a href="javascript:;" class="<?php if ($_smarty_tpl->tpl_vars['block']->value['prevedeno']==count($_smarty_tpl->tpl_vars['block']->value['element'])) {?>expand<?php } else { ?>collapse<?php }?>" id="block<?php echo $_smarty_tpl->tpl_vars['block']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
"></a>
										</div>
									</div>
									<div class="portlet-body form" <?php if ($_smarty_tpl->tpl_vars['block']->value['prevedeno']==count($_smarty_tpl->tpl_vars['block']->value['element'])) {?>style="display: none;"<?php }?>>
											<div class="form-body">
                                                <?php  $_smarty_tpl->tpl_vars['element'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['element']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['block']->value['element']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['element']->key => $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->_loop = true;
?>
												<div class="form-group">
													<label class="col-md-3 control-label"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['opis'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</label>
													<div class="col-md-9">
														<textarea name="termin_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
" class="col-md-9"><?php echo stripslashes($_smarty_tpl->tpl_vars['element']->value['prevod']);?>
</textarea>
													</div>
												</div>
                                                <?php } ?>

											</div>
									   </div>
                                    </div>

                                    <?php } ?>
								</div>
                                <?php } ?>
                            <div class="form-actions fluid">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn blue">Submit</button>
										<button type="button" class="btn default">Cancel</button>
									</div>
								</div>
						
                    </div>
                    </form>
      </div><?php }} ?>
