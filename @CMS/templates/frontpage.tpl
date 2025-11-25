{if $loggedInUser.username neq 'ikcg'}
         <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
         <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title">Modal title</h4>
                  </div>
                  <div class="modal-body">
                     Widget settings form goes here
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn blue">{$ADMIN_SAVE_CHANGES}</button>
                     <button type="button" class="btn default" data-dismiss="modal">{$ADMIN_CLOSE}</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->
         <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        
  
  {if isset($prodaja)}
  
  <h1>Prodaja</h1>
  <table class="table table-striped table-hover">
   
    <thead class="thead-dark">
        <tr>
            <th scope="row">Mesec i godina</th>
            <th scope="row" style="text-align:center">PZO broj polisa</th>
            <th scope="row" style="text-align:right">PZO Premija</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$prodaja item=poli}
            <tr>
                <td><strong>{$poli.mesec}</strong></td>
                <td style="text-align:center">{$poli.brojPZO}</td>
                <td style="text-align:right">{$poli.iznosPZO|number_format:2:".":","}</td>
            </tr>
        {/foreach}
    </tbody>
  </table>

  {/if}
  
  {*
    {if isset($prodajaKOM)}
  
  <h1>Prodaja komdom</h1>
  <table class="table table-striped table-hover">
   
    <thead class="thead-dark">
        <tr>
            <th scope="row">Mesec i godina</th>
            <th scope="row" style="text-align:center">KOMDOM broj polisa</th>
            <th scope="row" style="text-align:right">KOMDOM premija</th>
        
        </tr>
    </thead>
    <tbody>
        {foreach from=$prodajaKOM item=poli}
            <tr>
                <td><strong>{$poli.mesec}</strong></td>

                <td style="text-align:center">{$poli.brojKOM}</td>
                <td style="text-align:right">{$poli.iznosKOM|number_format:2:".":","}</td>

            </tr>
        {/foreach}
    </tbody>
  </table>

  {/if}
  *}
  <style>

  .table .thead-dark th {
    color: #fff;
    background-color: #212529;
    border-color: #32383e;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
  </style>
  {/if}
         {*
         <!-- BEGIN DASHBOARD STATS -->
         <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="dashboard-stat blue">
                  <div class="visual">
                     <i class="icon-comments"></i>
                  </div>
                  <div class="details">
                     <div class="number">
                        1349
                     </div>
                     <div class="desc">                           
                        New Feedbacks
                     </div>
                  </div>
                  <a class="more" href="#">
                  View more <i class="m-icon-swapright m-icon-white"></i>
                  </a>                 
               </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="dashboard-stat green">
                  <div class="visual">
                     <i class="icon-shopping-cart"></i>
                  </div>
                  <div class="details">
                     <div class="number">549</div>
                     <div class="desc">New Orders</div>
                  </div>
                  <a class="more" href="#">
                  View more <i class="m-icon-swapright m-icon-white"></i>
                  </a>                 
               </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="dashboard-stat purple">
                  <div class="visual">
                     <i class="icon-globe"></i>
                  </div>
                  <div class="details">
                     <div class="number">+89%</div>
                     <div class="desc">Brand Popularity</div>
                  </div>
                  <a class="more" href="#">
                  View more <i class="m-icon-swapright m-icon-white"></i>
                  </a>                 
               </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="dashboard-stat yellow">
                  <div class="visual">
                     <i class="icon-bar-chart"></i>
                  </div>
                  <div class="details">
                     <div class="number">12,5M$</div>
                     <div class="desc">Total Profit</div>
                  </div>
                  <a class="more" href="#">
                  View more <i class="m-icon-swapright m-icon-white"></i>
                  </a>                 
               </div>
            </div>
         </div>
         <!-- END DASHBOARD STATS -->
         *}