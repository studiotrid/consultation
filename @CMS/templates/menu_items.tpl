         <div class="row">
         
            <div class="col-md-6">
               <div class="portlet box yellow">
                  <div class="portlet-title">
                     <div class="caption"><i class="icon-comments"></i>{$ADMIN_MENUS_AVAILABLE}</div>
                  </div>
                  <div class="portlet-body">
                     <div class="dd" id="nestable_list_3">
                        <ol class="dd-list">
                            {foreach from=$wholemenu item=menuitem}
                                <li class="dd-item dd3-item" data-id="{$menuitem.id}">
                                      <div class="dd-handle dd3-handle"></div>
                                      <div class="dd3-content">{$menuitem.title}
                                      <div class="tools">
                                        <a href="?menu_id={$smarty.get.menu_id}&edit={$menuitem.id}" class="config" title="{$ADMIN_MENUS_EDIT_ITEM}"></a>
                                        <a href="?menu_id={$smarty.get.menu_id}&remove={$menuitem.id}" class="remove" title="{$ADMIN_MENUS_REMOVE_ITEM}"></a>
                                     </div>
                                      </div>
                                
                                    {if count($menuitem.submenu)>0}
                                    <ol class="dd-list">
                                        {foreach from=$menuitem.submenu item=submenu}
                                            <li class="dd-item dd3-item" data-id="{$submenu.id}">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content">{$submenu.title}
                                                <div class="tools">
                                                    <a href="?menu_id={$smarty.get.menu_id}&edit={$submenu.id}" class="config" title="{$ADMIN_MENUS_EDIT_ITEM}"></a>
                                                    <a href="?menu_id={$smarty.get.menu_id}&remove={$submenu.id}" class="remove" title="{$ADMIN_MENUS_REMOVE_ITEM}"></a>
                                                 </div>
                                                </div>
                                    	   {if count($submenu.submenu)>0}
                                            <ol class="dd-list">
                                                {foreach from=$submenu.submenu item=subsubmenu}
                                            	   <li class="dd-item dd3-item" data-id="{$subsubmenu.id}">
                                                    <div class="dd-handle dd3-handle"></div>
                                                    <div class="dd3-content">{$subsubmenu.title}
                                                        <div class="tools">
                                                            <a href="?menu_id={$smarty.get.menu_id}&edit={$subsubmenu.id}" class="config" title="{$ADMIN_MENUS_EDIT_ITEM}"></a>
                                                            <a href="?menu_id={$smarty.get.menu_id}&remove={$subsubmenu.id}" class="remove" title="{$ADMIN_MENUS_REMOVE_ITEM}"></a>
                                                         </div>
                                                    </div>
                                                 </li>
                                            	{/foreach}
                                             </ol>
                                            {/if}
                                           </li>
                                    	{/foreach}
                                     </ol>
                                    {/if}
                                </li>
                            {/foreach}
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
            
            <div class="col-md-6">
                <form action="?menu_id={$smarty.get.menu_id}&{if isset($smarty.get.edit)}update={$smarty.get.edit}{else}addmenu=1{/if}" class="" method="post">
                <div class="tabbable tabbable-custom ">
                <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_0" data-toggle="tab">{$ADMIN_MENUS_GENERAL}</a></li>
                {foreach from=$langs item=lang}
                    <li><a href="#tab_{$lang.id}" data-toggle="tab"><img src="/img/flags/{$lang.code}.png" height="26"/> {$lang.name}</a></li>
                {/foreach}
                </ul>
               <div class="portlet-body form tab-content">
                    
                        <div class="tab-pane active" id="tab_0">
                    
                                       <div class="form-body">
                                          <div class="form-group">
                                             <label  class="control-label">{$ADMIN_MENUS_ITEM}</label>
                                             <input type="text" name="title" class="form-control" {if isset($smarty.get.edit)}value="{$edit.title}"{/if} placeholder="{$ADMIN_MENUS_ENTER_TEXT}">
                                          </div>
                                          <div class="form-group">
                                             <label class="control-label">{$ADMIN_MENUS_PARENT}</label>
                                             
                                                <select class="form-control" name="parent">
                                                    <option value="0" 
                                                    {if isset($smarty.get.edit)}
                                                    {if $edit.parent eq 0}selected="selected"{/if}
                                                    {/if}
                                                    >{$ADMIN_MENUS_NOPARENT}</option>
                                                    {foreach from=$wholemenu item=menuitem}
                                                        <option value="{$menuitem.id}"
                                                        {if isset($smarty.get.edit)}
                                                            {if $edit.parent eq $menuitem.id}selected="selected"{/if}
                                                            {/if}
                                                        >{$menuitem.title}</option>
                                                            {if count($menuitem.submenu)>0}
                                                                {foreach from=$menuitem.submenu item=submenu}
                                                                <option value="{$submenu.id}"
                                                                {if isset($smarty.get.edit)}
                                                                    {if $edit.parent eq $submenu.id}selected="selected"{/if}
                                                                    {/if}
                                                                >{$submenu.title}</option>
                                                            	   {if count($submenu.submenu)>0}
                                                                        {foreach from=$submenu.submenu item=subsubmenu}
                                                                        <option value="{$subsubmenu.id}"
                                                                        {if isset($smarty.get.edit)}
                                                                            {if $edit.parent eq $subsubmenu.id}selected="selected"{/if}
                                                                            {/if}
                                                                        >{$subsubmenu.title}</option>
                                                                    	{/foreach}
                                                                    {/if}
                                                            	{/foreach}
                                                            {/if}
                                                    {/foreach}
                                                </select>
                                             
                                          </div>
                                          <div class="form-group">
                                                <label  class="control-label">{$ADMIN_MENUS_LINK_TYPE}</label>
                                                <select class="form-control" name="link_type" id="link">
                                                    {if count($pages)>0}<option value="page"
                                                                        {if isset($smarty.get.edit)}
                                                                            {if $edit.link_type eq "page"}selected="selected"{/if}
                                                                            {/if}
                                                    >{$ADMIN_MENUS_PAGE_TYPE}</option>{/if}
                                                    {if count($posts)>0}<option value="post"
                                                                        {if isset($smarty.get.edit)}
                                                                            {if $edit.link_type eq "post"}selected="selected"{/if}
                                                                            {/if}
                                                    >{$ADMIN_MENUS_POST_TYPE}</option>{/if}
                                                    <option value="custom"
                                                                    {if isset($smarty.get.edit)}
                                                                            {if $edit.link_type eq "custom"}selected="selected"{/if}
                                                                            {/if}
                                                    >{$ADMIN_MENUS_CUSTOM_TYPE}</option>
                                                </select>
                                          </div>
                                          
                                          <div class="form-group" id="link_custom">
                                             <label  class="control-label">{$ADMIN_MENUS_LINK}</label>
                                             <input type="text" name="link_custom" class="form-control" {if isset($smarty.get.edit)}value="{$edit.link}"{/if} placeholder="{$ADMIN_MENUS_HYPERLINK}"/>
                                          </div>
                                          
                                          <div class="form-group" id="link_page">
                                          {if count($pages)>0}
                                                <label  class="control-label">{$ADMIN_MENUS_LINK_TO_PAGE}</label>
                                                <select class="form-control" name="link_page">
                                                    {if isset($smarty.get.edit)}
                                                    {if $edit.link_type eq "page"}
                                                        {foreach from=$pages item=page}
                                                        <option value="{$page.id}" {if $edit.link eq $page.id}selected="selected"{/if}>{$page.title}</option>
                                                        {/foreach}
                                                        
                                                        {else}
                                                        {foreach from=$pages item=page}
                                                        <option value="{$page.id}">{$page.title}</option>
                                                        {/foreach}
                                                    {/if}
                                                    {else}
                                                        {foreach from=$pages item=page}
                                                        <option value="{$page.id}">{$page.title}</option>
                                                        {/foreach}
                                                    {/if}
                                                    
                                                </select>
                                                {else}
                                                {$ADMIN_MENUS_NO_PAGE}
                                                
                                          {/if}
                                          </div>
                                          
                                          <div class="form-group" id="link_post">
                                            {if count($posts)>0}
                                                <label  class="control-label">{$ADMIN_MENUS_LINK_TO_POST}</label>
                                                <select class="form-control" name="link_post">
                                                    {if isset($smarty.get.edit)}
                                                    {if $edit.link_type eq "post"}
                                                        {foreach from=$posts item=post}
                                                        <option value="{$page.id}" {if $edit.link eq $post.id}selected="selected"{/if}>{$post.title}</option>
                                                        {/foreach}
                                                        
                                                        {else}
                                                        {foreach from=$posts item=post}
                                                        <option value="{$post.id}">{$post.title}</option>
                                                        {/foreach}
                                                    {/if}
                                                    {else}
                                                        {foreach from=$posts item=post}
                                                        <option value="{$post.id}">{$post.title}</option>
                                                        {/foreach}
                                                    {/if}
                                                    
                                                </select>
                                                {else}
                                                {$ADMIN_MENUS_NO_POST}
                                            {/if}
                                          </div>
                                          
                                          
                                       </div>
                                       
                          </div> 
                          {foreach from=$langs item=lang}
                          <div class="tab-pane" id="tab_{$lang.id}">
                    
                                       <div class="form-body">
                                          <div class="form-group">
                                             <label  class="control-label">{$ADMIN_MENUS_MENUS_TITLE}</label>
                                             <input type="text" name="title_{$lang.id}" {if isset($smarty.get.edit)}value="{$edit{$lang.id}.title}"{/if} class="form-control" placeholder="{$ADMIN_MENUS_ENTER_TEXT}">
                                          </div>
                                          
                                          <div class="form-group">
                                             <label  class="control-label">{$ADMIN_MENUS_ITEM_ACTIVE}</label>
                                             <input type="checkbox" name="active_{$lang.id}" {if isset($smarty.get.edit)}{if $edit{$lang.id}.active eq 1}checked="checked"{/if}{/if} value="1" class="form-control"/>
                                          </div>
                                          
                                          
                                       </div>
                                       
                          </div> 
                          {/foreach}
                                        <div class="form-actions right">
                                          <button type="submit" class="btn green">{if isset($smarty.get.edit)}{$ADMIN_UPDATE}{else}{$ADMIN_ADD}{/if}</button>     
                                       </div>
                               
               </div>
               </div>
               </form>  
            </div>
         </div>