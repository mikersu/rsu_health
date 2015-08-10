<?php  
$this->db->from( 'account_logins AS al' );
$this->db->join( 'accounts AS a', 'a.account_id = al.account_id', 'left' );
$this->db->join( 'account_level AS acl', 'acl.account_id = a.account_id', 'left' );
$this->db->where( 'acl.level_group_id', 1 );
$this->db->order_by( 'al.account_login_id', 'DESC' );
$this->db->limit( 10 );
$query = $this->db->get();
$data_login = $query->result();
?>

<!-- BEGIN CUSTOM BUTTONS WITH ICONS PORTLET-->
<div class="portlet box blue">
	<div class="portlet-title">
		<h4><i class="icon-reorder"></i>Main Menu - Setting</h4>
	</div>
	<div class="portlet-body">

		<div data-tablet="span3  fix-offset" class="span3 ">
			<div class="dashboard-stat purple">
				<div class="visual" style="width:auto">
					<i class="icon-calendar"></i>
				</div>
				<div class="details">
					<div class="number">
						Date
					</div>
					<div class="desc"><?php echo date( 'd M' ) ?> <?php echo date( 'Y' )+543 ?></div>
				</div>              
			</div>
		</div>

<!-- 		<div data-tablet="span3" class="span3 ">
		<a target="_blank" href="">
			<div class="dashboard-stat yellow">
				<div class="visual">
					<i class="icon-tasks"></i>
				</div>
				<div class="details">
					<div class="number">
						Manual
					</div>
					<div class="desc">                           
					</div>
				</div>                
			</div>
		</a>
		</div>

		<div data-tablet="span3" class="span3 ">
		<a target="_blank" href="">
			<div class="dashboard-stat green">
				<div class="visual">
					<i class="icon-bar-chart"></i>
				</div>
				<div class="details">
					<div class="number">
						Goto
					</div>
					<div class="desc">                           
						Google Analytics
					</div>
				</div>                
			</div>
		</a>
		</div> -->

		<div data-tablet="span3" class="span3 ">
		<a target="_blank" href="<?php echo site_url(); ?>">
			<div class="dashboard-stat blue">
				<div class="visual">
					<i class="icon-globe"></i>
				</div>
				<div class="details">
					<div class="number">
						Goto
					</div>
					<div class="desc">                           
						FrontEnd
					</div>
				</div>                
			</div>
		</a>
		</div>


		<div class="clearfix"></div>

		<table class="table table-striped table-bordered table-advance table-hover">
			<thead>
				<tr>
					<th>Account ID</th>
					<th class="hidden-phone"> Login OS</th>
					<th> Login Browser</th>
					<th>IP</th>
					<th>Login Time</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ( $data_login as $key => $value ): ?>
					
				<tr>
					<td class="highlight">
						<div class="success"></div>&nbsp;&nbsp;
						<?php echo $value->account_username ?>
					</td>
					<td class="hidden-phone"><?php echo $value->login_os ?></td>
					<td><?php echo $value->login_browser ?></td>
					<td><?php echo $value->login_ip ?></td>
					<td><?php echo getDateFull_All_time($value->login_time) ?></td>
				</tr>

				<?php endforeach ?>

			</tbody>
		</table>


		<hr>

	<!-- 	<h3>Menu</h3>
		<div class="row-fluid">
			<a href="<?php echo site_url( 'site-admin/home' ) ?>" class="icon-btn span3">
				<i class="icon-sitemap"></i>
				<div>Home</div>
			</a>
			<a href="<?php echo site_url( 'site-admin/promotion' ) ?>" class="icon-btn span3">
				<i class="icon-barcode"></i>
				<div>Promotion</div>
			</a>
			<a href="<?php echo site_url( 'site-admin/member' ) ?>" class="icon-btn span3">
				<i class="icon-group"></i>
				<div>Member</div>
			</a>
			<a href="<?php echo site_url( 'site-admin/news' ) ?>" class="icon-btn span3">
				<i class="icon-envelope"></i>
				<div>News</div>
			</a>
		</div>


		<div class="row-fluid">
			<a href="<?php echo site_url( 'site-admin/webboard' ) ?>" class="icon-btn span3">
				<i class="icon-globe"></i>
				<div>Webboard</div>
			</a>
			<a href="<?php echo site_url( 'site-admin/calendar' ) ?>" class="icon-btn span3">
				<i class="icon-calendar"></i>
				<div>Calendar</div>
			</a>

		</div> -->
	
	</div>
</div>
<!-- END CUSTOM BUTTONS WITH ICONS PORTLET-->