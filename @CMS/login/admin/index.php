<?php

include_once( ROOT . 'login/classes/check.class.php');
protect("1");



?>
<div class="container" >
			<div class="row">

				<div class="span12">
		<div class="tabbable tabs-left">
			<div id="search_suggest"></div>
			<ul class="nav nav-tabs" >
				<li><a href="#user-control" data-toggle="tab"><i class="icon-list"></i> <?php _e('Users'); ?></a></li>
				<li><a href="#level-control" data-toggle="tab"><i class="icon-list"></i> <?php _e('Levels'); ?></a></li>
				<li><a href="#reports" data-toggle="tab"><i class="icon-folder-open"></i> <?php _e('Reports'); ?></a></li>
				<li><a href="#send-email" data-toggle="tab"><i class="icon-envelope"></i> <?php _e('Send email'); ?></a></li>
				<li><a href="?login=admin/settings.php"><i class="icon-cog"></i> <?php _e('Settings'); ?></a></li>
			</ul>

		
			<div class="tab-content">

				<!-- - - - - - - - - - - - - - - - -

						Control users

				- - - - - - - - - - - - - - - - - -->
				<div class="tab-pane fade" id="user-control">
					<?php include_once(ROOT.'login/admin/page/user-control.php'); ?>
				</div>

				<!-- - - - - - - - - - - - - - - - -

						Modify levels

				- - - - - - - - - - - - - - - - - -->

				<div class="tab-pane fade" id="level-control">
                    <?php include_once(ROOT.'login/admin/page/level-control.php'); ?>
                </div>

				<!-- - - - - - - - - - - - - - - - -

						Reports

				- - - - - - - - - - - - - - - - - -->
				<div class="tab-pane fade" id="reports">
                    <?php include_once(ROOT.'login/admin/page/reports.php'); ?>
                </div>

				<!-- - - - - - - - - - - - - - - - -

						Send email

				- - - - - - - - - - - - - - - - - -->
				<div class="tab-pane fade" id="send-email">
                    <?php include_once(ROOT.'login/admin/page/send-email.php'); ?>
                </div>

		</div>
		</div>
</div></div></div>
    