<div class="page-sidebar navbar-collapse collapse">
         <!-- BEGIN SIDEBAR MENU -->        
         <ul class="page-sidebar-menu">
            <li>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
               <div class="sidebar-toggler hidden-phone"></div>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li>

            </li>
            {if $loggedInUser.username neq 'ikcg' }
            <li class="start {if $smarty.server.SCRIPT_NAME eq '/@CMS/index.php'}active{/if} ">
               <a href="{$basepath}">
               <i class="icon-home"></i> 
               <span class="title">Kontrolna strana</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/administrators.php'}active{/if}">
               <a href="{$basepath}administrators">
               <i class="icon-user"></i> 
               <span class="title">Administratori</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/api.php'}active{/if}">
               <a href="{$basepath}api.php">
               <i class="icon-user"></i> 
               <span class="title">API korisnici</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/osiguranja.php'}active{/if}">
               <a href="{$basepath}osiguranja.php">
               <i class="icon-th"></i> 
               <span class="title">Tarife PZO Osiguranja</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/dzo.php'}active{/if}">
               <a href="{$basepath}dzo.php">
               <i class="icon-th"></i> 
               <span class="title">Tarife DZO Osiguranja</span>
               <span class="selected"></span>
               </a>
            </li>
            
           <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/registrovani.php'}active{/if}">
               <a href="{$basepath}registrovani.php">
               <i class="icon-user"></i> 
               <span class="title">Registrovani korisnici</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/zaposleni.php'}active{/if}">
               <a href="{$basepath}zaposleni.php">
               <i class="icon-user"></i> 
               <span class="title">Zaposleni</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/promo-kod.php'}active{/if}">
               <a href="{$basepath}promo-kod.php">
               <i class="icon-th"></i> 
               <span class="title">Promo kodovi</span>
               <span class="selected"></span>
               </a>
            </li> 
            
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/polise.php'}active{/if}">
               <a href="{$basepath}polise.php">
               <i class="icon-file-text"></i> 
               <span class="title">Polise</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/poliseKomdom.php'}active{/if}">
               <a href="{$basepath}poliseKomdom.php">
               <i class="icon-file-text"></i> 
               <span class="title">Polise [komdom]</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/zastupnici.php'}active{/if}">
               <a href="{$basepath}zastupnici.php">
               <i class="icon-user"></i> 
               <span class="title">Zastupnici</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/popusti.php'}active{/if}">
               <a href="{$basepath}popusti.php">
               <i class="icon-arrow-down-right-2"></i> 
               <span class="title">Popusti</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/reffer.php'}active{/if}">
               <a href="{$basepath}reffer.php">
               <i class="icon-user"></i> 
               <span class="title">Reffer</span>
               <span class="selected"></span>
               </a>
            </li>
            
            
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/standalone-nezgoda.php' or $smarty.server.SCRIPT_NAME eq '/@CMS/standalone-imovina.php'}active{/if}">
               <a href="#">
               <i class="icon-user"></i> 
               <span class="title">Standalone</span>
               <span class="selected"></span><span class="arrow "></span>
               </a>
               <ul class="sub-menu">
                
                <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/standalone-nezgoda.php'}active{/if}"><a href="{$basepath}standalone-nezgoda.php">Nezgoda</a></li>
                <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/standalone-imovina.php'}active{/if}"><a href="{$basepath}standalone-imovina.php">Imovina</a></li>
                <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/minikasko.php'}active{/if}"><a href="{$basepath}minikasko.php">MiniKasko</a></li>
               </ul>
            </li>
            
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/eplacanje.php'}active{/if}">
               <a href="{$basepath}eplacanje.php">
               <i class="icon-user"></i> 
               <span class="title">E-plaćanje</span>
               <span class="selected"></span><span class="arrow "></span>
               </a>
               <ul class="sub-menu">
                
                    <li><a href="{$basepath}eplacanje.php?tip=polisa">Polisa</a>
                        <ul class="sub-menu">
                            <li><a href="{$basepath}eplacanje.php?tip=polisa&status=paid">Plaćeno</a></li>
                            <li><a href="{$basepath}eplacanje.php?tip=polisa&status=process">U procesu</a></li>
                            <li><a href="{$basepath}eplacanje.php?tip=polisa&status=fail">Greška</a></li>
                        </ul>
                    </li>
               </ul>
            </li>
            
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/pages.php'}active{/if}">
               <a href="{$basepath}pages">
               <i class="icon-file-text"></i> 
               <span class="title">Stranice</span>
               <span class="selected"></span>
               </a>
            </li>
            {if $loggedInUser.username neq 'natasa.todorovic'}
                <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/forma.php'}active{/if}">
                   <a href="{$basepath}forma.php">
                   <i class="icon-file-text"></i> 
                   <span class="title">IKCG - prijave</span>
                   <span class="selected"></span>
                   </a>
                </li>
            {/if}
            {else}
            
            <li class="{if $smarty.server.SCRIPT_NAME eq '/@CMS/forma.php'}active{/if}">
               <a href="{$basepath}forma.php">
               <i class="icon-file-text"></i> 
               <span class="title">IKCG - prijave</span>
               <span class="selected"></span>
               </a>
            </li>
            
          {/if}
            
         </ul>
         <!-- END SIDEBAR MENU -->
      </div>