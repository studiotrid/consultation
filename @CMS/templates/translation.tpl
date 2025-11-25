<div class="tabbable tabbable-custom boxless tabbable-reversed">
    <form action="translation?translated=1" class="form-horizontal" method="post">
						<ul class="nav nav-tabs">
                        {foreach from=$langs item=lang name=ka}
							<li class="{if $smarty.foreach.ka.first}active{/if}">
								<a href="#tab_{$lang.id}" data-toggle="tab">
								{$lang.name} </a>
							</li>
                        {/foreach}
						</ul>
						<div class="tab-content">
                            
                            {foreach from=$langs item=lang name=la}
							<div class="tab-pane {if $smarty.foreach.la.first}active{/if}" id="tab_{$lang.id}">
								
                                    {foreach from=$blocks{$lang.id} item=block}
                                    <div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>{$block.title} {$block.prevedeno}/{count($block.element)}
										</div>
                                        <div class="tools">
											<a href="javascript:;" class="{if $block.prevedeno eq count($block.element)}expand{else}collapse{/if}" id="block{$block.id}_{$lang.id}"></a>
										</div>
									</div>
									<div class="portlet-body form" {if $block.prevedeno eq count($block.element)}style="display: none;"{/if}>
											<div class="form-body">
                                                {foreach from=$block.element item=element}
												<div class="form-group">
													<label class="col-md-3 control-label">{$element.opis|escape:'htmlall'}</label>
													<div class="col-md-9">
														<textarea name="termin_{$lang.id}_{$element.id}" class="col-md-9">{$element.prevod|stripslashes}</textarea>
													</div>
												</div>
                                                {/foreach}

											</div>
									   </div>
                                    </div>

                                    {/foreach}
								</div>
                                {/foreach}
                            <div class="form-actions fluid">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn blue">Submit</button>
										<button type="button" class="btn default">Cancel</button>
									</div>
								</div>
						
                    </div>
                    </form>
      </div>