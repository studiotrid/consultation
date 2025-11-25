                     <div class="tab-pane" id="tab_1_3">
                        <div class="row profile-account">
                           <div class="col-md-3">
                              <ul class="ver-inline-menu tabbable margin-bottom-10">
                                <li><img alt="" class="img-responsive" src="../image/{if $loggedInUser.picture!=''}{$loggedInUser.picture}{else}avatar.png{/if}"/>
                                 </li>
                                 <li class="active">
                                    <a data-toggle="tab" href="#tab_1-1"><i class="icon-cog"></i>{$ADMIN_PROFILE_PERSONAL}</a> 
                                    <span class="after"></span>                                    
                                 </li>
                                 <li ><a data-toggle="tab" href="#tab_2-2"><i class="icon-picture"></i> {$ADMIN_PROFILE_CHANGEAVATAR}</a></li>
                                 <li ><a data-toggle="tab" href="#tab_3-3"><i class="icon-lock"></i> {$ADMIN_PROFILE_CHANGEPASS}</a></li>
                              </ul>
                           </div>
                           <div class="col-md-9">
                              <div class="tab-content">
                                 <div id="tab_1-1" class="tab-pane active">
                                    <form role="form" method="post" action="profile">
                                        <input type="hidden" name="profileChange" value="1"/>
                                       <div class="form-group">
                                          <label class="control-label">{$ADMIN_PROFILE_FIRSTNAME}</label>
                                          <input type="text" value="{$loggedInUser.Fname|default:""}" class="form-control" name="profileFName" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label">{$ADMIN_PROFILE_LASTNAME}</label>
                                          <input type="text" value="{$loggedInUser.Lname|default:""}" class="form-control" name="profileLName"/>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label">{$ADMIN_PROFILE_MOBILE}</label>
                                          <input type="text" value="{$loggedInUser.phone|default:""}" class="form-control" name="profileMobile" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label">{$ADMIN_PROFILE_OCUPATION}</label>
                                          <input type="text" value="{$loggedInUser.occupation|default:""}" class="form-control" name="profileOcupation"/>
                                       </div>
                                       {if $loggedInUser.level eq 10}
                                       <div class="form-group">
                                          <label class="control-label">{$ADMIN_PROFILE_ROLE}</label>
                                          <select name="adminRole" class="form-control">
                                            <option value="10" {if $loggedInUser.level eq 10}selected="selected"{/if}>{$ADMIN_PROFILE_SUPERADMIN}</option>
                                            <option value="8" {if $loggedInUser.level eq 8}selected="selected"{/if}>{$ADMIN_PROFILE_ADMIN}</option>
                                            <option value="6" {if $loggedInUser.level eq 6}selected="selected"{/if}>{$ADMIN_PROFILE_CONTENTEDITOR}</option>
                                            <option value="4" {if $loggedInUser.level eq 4}selected="selected"{/if}>{$ADMIN_PROFILE_BANNER}</option>
                                            <option value="2" {if $loggedInUser.level eq 2}selected="selected"{/if}>{$ADMIN_PROFILE_OBSERVER}</option>
                                          </select>
                                       </div>
                                       {else}
                                       <div class="form-group">
                                       <label class="control-label">{$ADMIN_PROFILE_ROLE}</label>
                                        <span class="form-control">
                                            {if $loggedInUser.level eq 10}{$ADMIN_PROFILE_SUPERADMIN}{/if}
                                            {if $loggedInUser.level eq 8}{$ADMIN_PROFILE_ADMIN}{/if}
                                            {if $loggedInUser.level eq 6}{$ADMIN_PROFILE_CONTENTEDITOR}{/if}
                                            {if $loggedInUser.level eq 4}{$ADMIN_PROFILE_BANNER}{/if}
                                            {if $loggedInUser.level eq 2}{$ADMIN_PROFILE_OBSERVER}{/if}
                                        </span>
                                       </div>
                                       {/if}
                                       <div class="form-group">
                                          <label class="control-label">{$ADMIN_PROFILE_EMAIL}</label>
                                          <input type="text" value="{$loggedInUser.email|default:""}" class="form-control" name="profileEmail"/>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label">{$ADMIN_PROFILE_WWW}</label>
                                          <input type="text" value="{$loggedInUser.website|default:""}" class="form-control" name="profileWeb"/>
                                       </div>
                                       <div class="margiv-top-10">
                                          <button class="btn green">{$ADMIN_SAVE_CHANGES}</button>
                                          <a href="{$basepath}" class="btn default">{$ADMIN_CLOSE}</a>
                                       </div>
                                    </form>
                                 </div>
                                 
                                 <div id="tab_2-2" class="tab-pane">
                                    <form action="profile?avatar=1" role="form">
                                       <div class="form-group">
                                          <div class="thumbnail" style="width: 310px;">
                                             <img src="http://www.placehold.it/310x170/EFEFEF/AAAAAA&amp;text={$ADMIN_PROFILE_NOIMAGE}" alt="">
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
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i> {$ADMIN_PROFILE_SELECTIMAGE}</span>
                                                <span class="fileupload-exists"><i class="icon-undo"></i> {$ADMIN_PROFILE_CHANGE}</span>
                                                <input type="file" class="default" name="avatar" />
                                                </span>
                                                <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> {$ADMIN_PROFILE_REMOVE}</a>
                                             </div>
                                          </div>
                                          <span class="label label-danger">{$ADMIN_PROFILE_NOTE}</span>
                                          <span>{$ADMIN_PROFILE_NOTETEXT}</span>
                                       </div>
                                       <div class="margin-top-10">
                                          <button class="btn green">{$ADMIN_SAVE_CHANGES}</button>
                                          <a href="#" class="btn default">{$ADMIN_CLOSE}</a>
                                       </div>
                                    </form>
                                 </div>
                                 <div id="tab_3-3" class="tab-pane">
                                    <form action="profile?pass=1">
                                       <div class="form-group">
                                          <label class="control-label">{$ADMIN_PROFILE_CURRENTPASS}</label>
                                          <input type="password" class="form-control" name="profileOldPass" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label">{$ADMIN_PROFILE_NEWPASS}</label>
                                          <input type="password" class="form-control" name="profileNewPass"/>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label">{$ADMIN_PROFILE_NEWPASSAGAIN}</label>
                                          <input type="password" class="form-control" name="profileRetypePass"/>
                                       </div>
                                       <div class="margin-top-10">
                                          <button class="btn green">{$ADMIN_SAVE_CHANGES}</button>
                                          <a href="#" class="btn default">{$ADMIN_CLOSE}</a>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <!--end col-md-9-->                                   
                        </div>
                     </div>
                    