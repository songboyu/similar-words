<link href="<?php echo base_url('rs/css/puma2.css');?>" rel="stylesheet" type="text/css" />
<!-- BEGIN task_detail-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>任务详情
				</div>
				<div class="tools">
					<a class="collapse" href="javascript:;"></a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="tabbable">
					<div class="tab-content">
						<div>
							<?php if($task_detail!=NULL) {?>
							<h4 class="caption-subject bold">任务种子词：</h4>
							<p><?php
								$keywords = explode(' ', $task_detail['seeds']);
									foreach ($keywords as $kw) {
										echo '<span class="label label-sm label-info" style="margin-right: 5px;">'.$kw.'</span>';
									}
								?>
							</p>
							<h4 class="caption-subject bold">任务当前执行状态：</h4>
							<p>
								<?php $status = $task_detail['state'];
						        if($status==0) { ?>
						        <span class="label label-sm label-danger">任务未开始</span>
						        <?php }else if($status==1){ ?>
						        <span class="label label-sm label-info">网页获取中</span>
						        <?php }else if($status==2){ ?>
						        <span class="label label-sm label-warning">网页解析中</span>
						        <?php }else if($status==3){ ?>
						        <span class="label label-sm label-info">结果排序中</span>
						        <?php }else if($status==4){ ?>
						        <span class="label label-sm label-success">任务完成</span>
						        <?php } ?>
							</p>
							<h4 class="caption-subject bold">任务提交时间：</h4>
							<p><?php echo $task_detail['time'] ?></p>
							<?php }else{?>
							<h4 class="caption-subject bold">所查询任务不存在</h4>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END task_detail -->
