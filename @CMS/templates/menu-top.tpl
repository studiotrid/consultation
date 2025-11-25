<div class="header navbar navbar-inverse navbar-fixed-top">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="header-inner">
         <!-- BEGIN LOGO -->  
         <a class="navbar-brand" href="index.html">
         <img src="{$basepath}includes/img/logo-w.png" alt="logo" style="max-width:70px" class="img-responsive" />
         </a>
         <!-- END LOGO -->
         <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
         <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <img src="includes/img/menu-toggler.png" alt="" />
         </a> 
         <!-- END RESPONSIVE MENU TOGGLER -->
         <!-- BEGIN TOP NAVIGATION MENU -->
         <ul class="nav navbar-nav pull-right">


            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
               <img alt="" src="{$basepath}image/29/29/{if $loggedInUser.picture!=''}{$loggedInUser.picture}{else}avatar.png{/if}"/>
               <span class="username">{$loggedInUser.name}</span>
               <i class="icon-angle-down"></i>
               </a>
               <ul class="dropdown-menu">
                  <li><a href="{$basepath}profile"><i class="icon-user"></i> {$ADMIN_MYPROFIL}</a></li>
                  <li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> {$ADMIN_FULLSCREEN}</a></li>
                  <li><a href="?page=logout"><i class="icon-key"></i> {$ADMIN_LOGOUT}</a></li>
               </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
         </ul>
         <!-- END TOP NAVIGATION MENU -->
      </div>
      <!-- END TOP NAVIGATION BAR -->
   </div>