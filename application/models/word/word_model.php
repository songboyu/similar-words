<?php

/**
* 文件名(word_model.php)
*
* PHP version 5
*
* 功能描述:数据库M层，用来和数据库进行交互，负责从数据库中存取数据
*
* @category word_Model
* @package  Model
* @author   ymy <ymy@ymy.com>
* @license  No licence
* @version  SVN: 1.0
* @link     about:blank
* 
*/

/**
* 类名(word_Model.php)
*
* 功能描述:数据库M层，用来和数据库进行交互，负责从数据库中存取数据
*
* @category word_Model
* @package  Model
* @author   ymy <ymy@ymy.com>
* @license  No licence
* @version  Release: @paclage_version@
* @link     about:blank
* 
*/
class word_Model extends CI_Model
{
    /**
     * 引用数据库文件
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('data_helper');
    }

    function getTasks($offset=0, $count=0, $sort_col='', $sort_type='desc', $search_str='')
    {
        //获取数据总数
        $result['total_records'] = $this->db->count_all('task');
        //利用codeigniter的cache机制在获取数据总条数的同时，获取分页数据
        $this->db->start_cache();
        //设置查询条件
        if($sort_col != ''){
            $this->db->order_by($sort_col, $sort_type);
        }else{
            $this->db->order_by('task_id', 'desc');
        }
        if($search_str != ''){
            $columns_array = array(
                1 => 'seeds'
            );
            //all_or_like 在data_helper中定义，用于多列匹配
            all_or_like($this, $columns_array, $search_str);
        }
        //结束缓存
        $this->db->stop_cache();
        //获取符合条件的数据条数
        $result['display_records'] = $this->db->count_all_results('task');
        $data = $this->db->get('task', $count, $offset)->result_array();
        $result['result_array'] = $data;
        return $result;
    }  

    function getDetailById($task_id=0)
    {
        $this->db->where('task_id', $task_id);
        $query = $this->db->get('task');
        if ($query->num_rows() != 0) {
            return $query->result_array()[0];
        } else {
            return null;
        }
    }

    function getResultList($task_id=0, $offset=0, $count=0, $sort_col='', $sort_type='desc', $search_str='')
    {   
        //获取数据总数
        $this->db->where('task_id', $task_id);
        $result['total_records'] = $this->db->count_all_results('result');
        //利用codeigniter的cache机制在获取数据总条数的同时，获取分页数据
        $this->db->start_cache();
        //设置查询条件
        $this->db->where('task_id', $task_id);
        if($sort_col != ''){
            $this->db->order_by($sort_col, $sort_type);
        }else{
            $this->db->order_by('rs', 'desc');
        }
        if($search_str != ''){
            $columns_array = array(
                1 => 'rs'
            );
            //all_or_like 在data_helper中定义，用于多列匹配
            all_or_like($this, $columns_array, $search_str);
        }
        //结束缓存
        $this->db->stop_cache();
        //获取符合条件的数据条数
        $result['display_records'] = $this->db->count_all_results('result');
        $data = $this->db->get('result', $count, $offset)->result_array();
        $result['result_array'] = $data;
        return $result;
    }
    function checkSeeds($seeds)
    {
        $this->db->where("seeds", $seeds);
        $query = $this->db->get("task");
        if ($query->num_rows()>0) {
            return true;
        }
        return false;
    }
    function do_post($url, $post) {  
        $options = array(  
            'http' => array(  
                'method' => 'POST',  
                // 'content' => 'name=caiknife&email=caiknife@gmail.com',  
                'content' => http_build_query($post),  
            ),  
        );  
      
        $result = file_get_contents($url, false, stream_context_create($options));  
      
        return $result;  
    }
    function addTask($data)
    {
        $this->db->insert('task', $data);
        $data['taskId'] = $this->db->insert_id();
        $result = $this->do_post('http://192.168.1.199:7788/task/createTask', $data);
        return $result;
    }
}