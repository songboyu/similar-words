<!-- BEGIN word_list -->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>相关词
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="word_list_table">
					<thead>
						<tr>
							<th>编号</th>
							<th>相关词</th>
							<th>相关程度</th>
							<th>相关类别</th>
						</tr>
					</thead>
					<tbody id="word_table_body">
						<tr>
							<td colspan="9">数据获取中，请稍后...</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<div id="word_wc_similar_content"></div>
<!-- END word_list -->
<script>
	jQuery(document).ready(function() {
		//全局js函数，header中定义
		global_function();
		//common_function.js中定义，渲染侧边栏
     	set_sidebar_selected('#word');
		//加载数据表格
		word_list_table_init();
	});
	function word_list_table_init(){
		var table = $('#word_list_table');
		table.dataTable( {
			"pageLength": 15,
			"bProcessing": true,
			"bFilter": false,//搜索框
			"bServerSide": true,//服务器端排序
			"bAutoWidth": true,//自动宽度
			"sPaginationType": "full_numbers",
			"sAjaxSource": "<?php echo base_url('word_manage/get_result_list?task_id=').$task_id?>",
			"oLanguage": {
				"sLengthMenu": "每页显示 _MENU_ 条记录",
				"sZeroRecords": "抱歉， 没有找到",
				"sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
				"sInfoEmpty": "没有数据",
				"sInfoFiltered": "(从 _MAX_ 条数据中检索)",
				"oPaginate": {  
					"sFirst": "首页",  
					"sPrevious": "前一页",
					"sNext": "后一页",  
					"sLast": "尾页"  
				}, 
				"sZeroRecords": "没有检索到数据",
				"sProcessing": "<img src='<?php echo base_url('rs/global/img/loading-spinner-blue.gif');?>' />",
			},
			"aaSorting":[//设置默认排序列
			[ 2, "desc" ]
			],
			'columns': //columns属性，配置具体列属性，详见http://sgyyz.blog.51cto.com/5069360/1408251
			[
			{ 'data': 'rs_id'},
			{ 'data': 'rs'},
			{ 'data': 'score'},
			{ 'data': 'tag'},
			],
			"columnDefs": [
				{
					"targets": [0], // 目标列位置，下标从0开始
					"data": "rs_id",
					"className": "td_text_align_center",
				},
				{
					"targets": [1], // 目标列位置，下标从0开始
					"data": "rs",
					"className": "td_text_align_center",
				},
				{
					"targets": [2], // 目标列位置，下标从0开始
					"data": "score",
					"className": "td_text_align_center",
				},
				{
					"targets": [3], // 目标列位置，下标从0开始
					"data": "tag",
					"className": "td_text_align_center",
					"render": function(data, type, full){
						return '<code>' + data + '</code>';
					}
				}
				],
			//回调函数，修改每个tr中Content的td的属性, 增加dataid属性;修改每个tr的属性, 增加dataid属性
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				$(nRow).children('.word_list_wc').attr("dataid", aData.title_id);
				$(nRow).attr("dataid", aData.id);
				return nRow;
			},
			//回调函数，当每次ajax请求返回数据并绘制表格后，需要对第一列的checkbox做扁平化渲染
            "fnDrawCallback": function( oSettings ) {
              Metronic.initAjax();
            }
		} );
		//修改perpage下拉菜单样式为扁平化
		datatables_flat_select('#word_list_table_wrapper');
	}
</script>