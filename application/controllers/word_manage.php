<?php 
/**
* 类名(word_manage)
*
* 功能描述:数据库C层，用来控制数据库和界面的
*
* @category word_manage
* @package  Controllers
* @author   ymy <ymy@ymy.com>
* @license  No licence
* @version  Release: @paclage_version@
* @link     about:blank
* 
*/
class word_manage extends CI_Controller
{
    /**
    *加载函数
    *加载一些库函数和头文件
    */
    function __construct()
    {
        parent::__construct();
        $this->load->helper('pageination_helper');//分页函数
        $this->load->helper('common_helper');//公共函数
        $this->load->model('word/word_model');//M层的数据库读和写文件
        $this->load->database();
    }

    /**
    *录入任务界面的主函数, 显示主界面
    *包含
    *    头文件
    *    增加任务按钮
    *    增加任务和关键词函数
    *    任务列表
    *    尾文件
    *
    * @return void
    */

    function index()
    {
        $data['title'] = '关键词任务列表';

        $this->load->view('header_new', $data);
        $this->load->view('word/add_task_new');
        $this->load->view('word/task_list_new');
        $this->load->view('footer_new');
    }

    /**
    * 函数get_task_list, 返回任务列表datatables的ajax请求数据
    *
    * @return 数据json数据
    */
    function get_task_list()
    {
        $offset = get_get('iDisplayStart');
        $count = get_get('iDisplayLength');
        //获取被排列的列名称
        $sort_col = get_get('mDataProp_'.get_get('iSortCol_0'));
        $sort_type = get_get('sSortDir_0');
        $sort_col_num = get_get('iSortingCols');
        //获取搜索内容
        $search_str = get_get('sSearch');

        if($search_str==''){
            $result = $this->word_model->getTasks($offset, $count, $sort_col, $sort_type);
        }else{
            $result = $this->word_model->getTasks($offset, $count, $sort_col, $sort_type, $search_str);
        }

        $output = array(
            "sEcho" => intval(get_get('sEcho')),
            "iTotalRecords" => $result['total_records'],
            "iTotalDisplayRecords" => $result['display_records'],
            "aaData" => $result['result_array']
        );
        
        echo json_encode($output);
    }
    /**
    *任务详细信息界面的主函数，显示指定任务
    *包含
    *    头文件
    *    任务详细信息
    *    搜索到的任务信息列表
    *    尾文件
    *
    * @return void
    */
    function detail()
    {
        $task_id = get_get('task_id');
        $data['task_detail'] = $this->word_model->getDetailById($task_id);
        $data['task_id'] = $task_id;

        $this->load->view('header_new',$data);
        $this->load->view('word/task_detail_new');
        $this->load->view('word/result_list_new');
        $this->load->view('footer_new');
    }
    /**
    * get_result_list, 指定任务的搜索列表，响应datatables的ajax请求数据
    *
    * @return 数据json数据
    */
    function get_result_list()
    {
        $task_id = get_get('task_id');
        $offset = get_get('iDisplayStart');
        $count = get_get('iDisplayLength');
        //获取被排列的列名称
        $sort_col = get_get('mDataProp_'.get_get('iSortCol_0'));
        $sort_type = get_get('sSortDir_0');
        $sort_col_num = get_get('iSortingCols');
        //获取搜索内容
        $search_str = get_get('sSearch');
        if($search_str==''){
            $result = $this->word_model->getResultList($task_id, $offset, $count, $sort_col, $sort_type);
        }else{
            $result = $this->word_model->getResultList($task_id, $offset, $count, $sort_col, $sort_type, $search_str);
        }
        $output = array(
            "sEcho" => intval(get_get('sEcho')),
            "iTotalRecords" => $result['total_records'],
            "iTotalDisplayRecords" => $result['display_records'],
            "aaData" => $result['result_array']
        );
        echo json_encode($output);
    }
    function addTask()
    {
        $data['seeds']=get_post('seeds');
        $data['time']=date('Y-m-d H:i:s', time());
        $data['rs_count']=0;
        $data['state']=0;

        $result['result']=true;
        if ($data['seeds'] == ''){
            $result['desc']='种子词不可为空！';
            $result['result']=false;
            echo json_encode($result);
            return null;
        }
        if ($this->word_model->checkSeeds($data['seeds'])) {
            $result['desc']='输入的种子词已存在！';
            $result['result']=false;
            echo json_encode($result);
            return null;
        }
        $r = $this->word_model->addTask($data);
        $r = json_decode($r,true);
        if($r['result'] == "false"){
            $result['desc']='任务添加失败！';
            $result['result']=false;
            echo json_encode($result);
            return null;
        }
        $result['desc']='任务添加成功！';
        echo json_encode($result);
    }
    /**
    * 函数deleteTask,删除任务函数。
    * 仍存在问题：无法通知python任务队列停止任务
    *输入：任务id
    *输出：把任务id从数据库中删除
    *
    * @return void
    */
    function deleteTask()
    {
        $id=$this->uri->segment(3);        
        $data=$this->word_model->deleteTask($id);
    }
}
