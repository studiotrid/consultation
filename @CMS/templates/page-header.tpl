<div class="row">
            <div class="col-md-12">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
               <h3 class="page-title">
                  {$page_title}
               </h3>
               <ul class="page-breadcrumb breadcrumb">
                  <li>
                     <i class="icon-home"></i>
                     <a href="index.html">{$ADMIN_HOME}</a> 
                     <i class="icon-angle-right"></i>
                  </li>
                  {foreach from=$breadcrumbs item=bread name=step}
                  <li><a href="{$basepath}{$bread.link}">{$bread.title}</a>{if $smarty.foreach.step.iteration eq $smarty.foreach.step.total}{else}<i class="icon-angle-right"></i>{/if}</li>
                  {/foreach}
               </ul>
               <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
         </div>