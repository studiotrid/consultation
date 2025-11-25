<?php /* Smarty version Smarty-3.1.17, created on 2014-07-11 02:10:35
         compiled from "/home/denem/public_html/new/@CMS/templates/profile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181303948153bf2b7b9b0745-98320640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '60566bbf9a6bb8aa91427223583fb6f33756af5a' => 
    array (
      0 => '/home/denem/public_html/new/@CMS/templates/profile.tpl',
      1 => 1404995498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181303948153bf2b7b9b0745-98320640',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'loggedInUser' => 0,
    'ADMIN_PROFILE_PERSONAL' => 0,
    'ADMIN_PROFILE_CHANGEAVATAR' => 0,
    'ADMIN_PROFILE_CHANGEPASS' => 0,
    'ADMIN_PROFILE_FIRSTNAME' => 0,
    'ADMIN_PROFILE_LASTNAME' => 0,
    'ADMIN_PROFILE_MOBILE' => 0,
    'ADMIN_PROFILE_OCUPATION' => 0,
    'ADMIN_PROFILE_ROLE' => 0,
    'ADMIN_PROFILE_SUPERADMIN' => 0,
    'ADMIN_PROFILE_ADMIN' => 0,
    'ADMIN_PROFILE_CONTENTEDITOR' => 0,
    'ADMIN_PROFILE_BANNER' => 0,
    'ADMIN_PROFILE_OBSERVER' => 0,
    'ADMIN_PROFILE_EMAIL' => 0,
    'ADMIN_PROFILE_WWW' => 0,
    'ADMIN_SAVE_CHANGES' => 0,
    'basepath' => 0,
    'ADMIN_CLOSE' => 0,
    'ADMIN_PROFILE_NOIMAGE' => 0,
    'ADMIN_PROFILE_SELECTIMAGE' => 0,
    'ADMIN_PROFILE_CHANGE' => 0,
    'ADMIN_PROFILE_REMOVE' => 0,
    'ADMIN_PROFILE_NOTE' => 0,
    'ADMIN_PROFILE_NOTETEXT' => 0,
    'ADMIN_PROFILE_CURRENTPASS' => 0,
    'ADMIN_PROFILE_NEWPASS' => 0,
    'ADMIN_PROFILE_NEWPASSAGAIN' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53bf2b7bb0f8a6_32724583',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bf2b7bb0f8a6_32724583')) {function content_53bf2b7bb0f8a6_32724583($_smarty_tpl) {?>                     <div class="tab-pane" id="tab_1_3">
                        <div class="row profile-account">
                           <div class="col-md-3">
                              <ul class="ver-inline-menu tabbable margin-bottom-10">
                                <li><img alt="" class="img-responsive" src="../image/<?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['picture']!='') {?><?php echo $_smarty_tpl->tpl_vars['loggedInUser']->value['picture'];?>
<?php } else { ?>avatar.png<?php }?>"/>
                                 </li>
                                 <li class="active">
                                    <a data-toggle="tab" href="#tab_1-1"><i class="icon-cog"></i><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_PERSONAL']->value;?>
</a> 
                                    <span class="after"></span>                                    
                                 </li>
                                 <li ><a data-toggle="tab" href="#tab_2-2"><i class="icon-picture"></i> <?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_CHANGEAVATAR']->value;?>
</a></li>
                                 <li ><a data-toggle="tab" href="#tab_3-3"><i class="icon-lock"></i> <?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_CHANGEPASS']->value;?>
</a></li>
                              </ul>
                           </div>
                           <div class="col-md-9">
                              <div class="tab-content">
                                 <div id="tab_1-1" class="tab-pane active">
                                    <form role="form" method="post" action="profile">
                                        <input type="hidden" name="profileChange" value="1"/>
                                       <div class="form-group">
                                          <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_FIRSTNAME']->value;?>
</label>
                                          <input type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['loggedInUser']->value['Fname'])===null||$tmp==='' ? '' : $tmp);?>
" class="form-control" name="profileFName" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_LASTNAME']->value;?>
</label>
                                          <input type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['loggedInUser']->value['Lname'])===null||$tmp==='' ? '' : $tmp);?>
" class="form-control" name="profileLName"/>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_MOBILE']->value;?>
</label>
                                          <input type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['loggedInUser']->value['phone'])===null||$tmp==='' ? '' : $tmp);?>
" class="form-control" name="profileMobile" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_OCUPATION']->value;?>
</label>
                                          <input type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['loggedInUser']->value['occupation'])===null||$tmp==='' ? '' : $tmp);?>
" class="form-control" name="profileOcupation"/>
                                       </div>
                                       <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['level']==10) {?>
                                       <div class="form-group">
                                          <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_ROLE']->value;?>
</label>
                                          <select name="adminRole" class="form-control">
                                            <option value="10" <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['level']==10) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_SUPERADMIN']->value;?>
</option>
                                            <option value="8" <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['level']==8) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_ADMIN']->value;?>
</option>
                                            <option value="6" <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['level']==6) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_CONTENTEDITOR']->value;?>
</option>
                                            <option value="4" <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['level']==4) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_BANNER']->value;?>
</option>
                                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['level']==2) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_OBSERVER']->value;?>
</option>
                                          </select>
                                       </div>
                                       <?php } else { ?>
                                       <div class="form-group">
                                       <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_ROLE']->value;?>
</label>
                                        <span class="form-control">
                                            <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['level']==10) {?><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_SUPERADMIN']->value;?>
<?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['level']==8) {?><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_ADMIN']->value;?>
<?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['level']==6) {?><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_CONTENTEDITOR']->value;?>
<?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['level']==4) {?><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_BANNER']->value;?>
<?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['level']==2) {?><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_OBSERVER']->value;?>
<?php }?>
                                        </span>
                                       </div>
                                       <?php }?>
                                       <div class="form-group">
                                          <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_EMAIL']->value;?>
</label>
                                          <input type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['loggedInUser']->value['email'])===null||$tmp==='' ? '' : $tmp);?>
" class="form-control" name="profileEmail"/>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_WWW']->value;?>
</label>
                                          <input type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['loggedInUser']->value['website'])===null||$tmp==='' ? '' : $tmp);?>
" class="form-control" name="profileWeb"/>
                                       </div>
                                       <div class="margiv-top-10">
                                          <button class="btn green"><?php echo $_smarty_tpl->tpl_vars['ADMIN_SAVE_CHANGES']->value;?>
</button>
                                          <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
" class="btn default"><?php echo $_smarty_tpl->tpl_vars['ADMIN_CLOSE']->value;?>
</a>
                                       </div>
                                    </form>
                                 </div>
                                 
                                 <div id="tab_2-2" class="tab-pane">
                                    <form action="profile?avatar=1" role="form">
                                       <div class="form-group">
                                          <div class="thumbnail" style="width: 310px;">
                                             <img src="http://www.placehold.it/310x170/EFEFEF/AAAAAA&amp;text=<?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_NOIMAGE']->value;?>
" alt="">
                                          </div>
                                          <div class="margin-top-10 fileupload fileupload-new" data-provides="fileupload">
                                             <div class="input-group input-group-fixed">
                                                <span class="input-group-btn">
                                                <span class="uneditable-input">
                                                <i class="icon-file fileupload-exists"></i> 
                                                <span class="fileupload-preview"></span>
                                                </span>
                                                </span>
                                                <span class="btn default btn-file">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i> <?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_SELECTIMAGE']->value;?>
</span>
                                                <span class="fileupload-exists"><i class="icon-undo"></i> <?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_CHANGE']->value;?>
</span>
                                                <input type="file" class="default" name="avatar" />
                                                </span>
                                                <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> <?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_REMOVE']->value;?>
</a>
                                             </div>
                                          </div>
                                          <span class="label label-danger"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_NOTE']->value;?>
</span>
                                          <span><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_NOTETEXT']->value;?>
</span>
                                       </div>
                                       <div class="margin-top-10">
                                          <button class="btn green"><?php echo $_smarty_tpl->tpl_vars['ADMIN_SAVE_CHANGES']->value;?>
</button>
                                          <a href="#" class="btn default"><?php echo $_smarty_tpl->tpl_vars['ADMIN_CLOSE']->value;?>
</a>
                                       </div>
                                    </form>
                                 </div>
                                 <div id="tab_3-3" class="tab-pane">
                                    <form action="profile?pass=1">
                                       <div class="form-group">
                                          <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_CURRENTPASS']->value;?>
</label>
                                          <input type="password" class="form-control" name="profileOldPass" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_NEWPASS']->value;?>
</label>
                                          <input type="password" class="form-control" name="profileNewPass"/>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PROFILE_NEWPASSAGAIN']->value;?>
</label>
                                          <input type="password" class="form-control" name="profileRetypePass"/>
                                       </div>
                                       <div class="margin-top-10">
                                          <button class="btn green"><?php echo $_smarty_tpl->tpl_vars['ADMIN_SAVE_CHANGES']->value;?>
</button>
                                          <a href="#" class="btn default"><?php echo $_smarty_tpl->tpl_vars['ADMIN_CLOSE']->value;?>
</a>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <!--end col-md-9-->                                   
                        </div>
                     </div>
                    <?php }} ?>
