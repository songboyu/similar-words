<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="add_task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">新增任务</h4>
      </div>
      <div class="modal-body">
        <form method='post' action="word_manage/taskReg" id="task_form">
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td><label for="seeds" style="width:100px;">任务种子词：<i style="font-style:normal;color: #F00;"><br/>(必填) </i></label></td>
                <td>
                  <textarea class="ckeditor form-control" type="text" name="seeds" id="seeds" style="width: 440px; height:100px;"
                  tabindex="1" placeholder="请输入任务种子词，空格分隔"></textarea>
                </td>
              </tr>
           </tbody>
         </table>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn blue" data-dismiss="modal" id="task_reg">录入任务</button>
        <button type="button" class="btn default" data-dismiss="modal">关闭</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

<script type="text/javascript">
  var base_url = "<?php echo base_url();?>";
  $("#task_reg").click(function() {
    $.post(base_url+"word_manage/addTask", {seeds: $("#seeds").val()},
      function(data){
        data = JSON.parse(data);
        alert(data.desc);
        reload_datatable('#task_manage_table');
      });
  });
</script>