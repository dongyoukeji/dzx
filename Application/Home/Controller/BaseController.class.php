<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller {
  	protected function _initialize(){
		header('Content-type:text/html;charset=utf-8;');
		set_time_limit(0);

        if(is_mobile()){    //手机端访问
           session('isMobile',1);
        }else{
            session('isMobile',0);
        }
        $this->_get_column_list();
	}
    
    /**
     * 获取分页数据
     * @param type $model模型名(默认获取当前model)
     * @param type $map条件
     * @param type $order排序
     * @param type $field需要查询的字段，默认全部
     * @param type $pagination为每页显示的数量，默认为配置中的值
     * @return type返回结果数组
     */
    protected function getlist($model = '', $map = '', $order = '',$group = '', $pagination = '', $field = '*') {
        $model=!empty($model)?$model:M(CONTROLLER_NAME);
        $count = $model->where($map)->cache(true)->group($group)->count('*');
        $pagination = $pagination ? $pagination : C('PAGE_SIZE');

        $p = new \Think\Page($count, $pagination);
        $p->setConfig('header', '<a class="rows">共 %TOTAL_ROW% 条记录&nbsp;当前 %NOW_PAGE% 页/共 %TOTAL_PAGE% 页</a>');
        $p->setConfig('prev', '上一页');
        $p->setConfig('next','下一页');
        $p->setConfig('last', '最后一页');
        $p->setConfig('first','第一页');
        $p->setConfig('theme','%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%');
        
        $p->lastSuffix = true;  //最后一页不显示为总页数
        $show=$p->show();
        $this->assign('page', $show);
        $res = $model->where($map)->cache(true)->field($field)->group($group)->limit($p->firstRow . ',' . $p->listRows)->order($order)->select();

        return $res;
    }
    /**
     * 获取最新订单动态
     * @param int $lg
     */
    public function get_new_order($lg = 10,$o=0){

        $map['ordstatus']=1;
        $order = M('order')->where($map)->order($lg)->select();
        $count = M('order')->where($map)->count('*');
        if($o){
            $this->ajaxReturn(array('status'=>0,'count'=>$count,'data'=>$order));
        }
        $this->count=$count;
        return $order;
    }

    protected function _get_column_list(){
        $list = M('column')->where('status=0 and id!=5 and id!=10')->select();
        $list=\Tool\Category::LimitForLevel($list);
        $this->columns = $list;
    }

    /**
     * 获取分页数据 Ajax返回
     * @param string $model
     * @param string $map
     * @param string $order
     * @param string $pagination
     * @param string $field
     * @return array
     */
    protected function get_ajax_list($model = '', $map = '', $order = '', $pagination = '', $field = '*') {
        $model=!empty($model)?$model:M(CONTROLLER_NAME);
        $count = $model->where($map)->cache(true)->count('*');
        $pagination = $pagination ? $pagination : C('PAGE_SIZE');
        $p = new \Think\Page($count, $pagination);
        $p->setConfig('header', '<li class="rows">共%TOTAL_ROW%条记录&nbsp;当前%NOW_PAGE%页/共%TOTAL_PAGE%页</li>');
        $p->setConfig('prev', '上一页');
        $p->setConfig('next','下一页');
        $p->setConfig('last', '最后一页');
        $p->setConfig('first','第一页');
        $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $p->lastSuffix = true;  //最后一页不显示为总页数
        $show=$p->show();
        $res = $model->where($map)->cache(true)->field($field)->limit($p->firstRow . ',' . $p->listRows)->order($order)->select();

        return array(
            'status'=>1,
            'count'=>$count,
            'list'=>$res,
            'page'=>$show
        );
    }
    /**
     * 删除图片
     * @param $path 图片路径
     */
    protected function delImage($path){
    	$path=!empty($path)?$path:I('path');
    	
    	if(!empty($path)){
    		$id=I('id','',intval);
            $index=I('index','',intval);
            $result=M('Article')->find($id);

            $image=array_filter(explode(',', $result['image']));
            unset($image[$index]); 
            $image=implode(',', $image);
         
    		$data=array('id'=>$id,'image'=>$image);
    		$result=M('Article')->save($data);

    		if(!unlink('./Uploads/ueditor/'.$path) || !$result){
    			if(!$result){
    				echo 1;
    			}else{
    				echo 2;
    			}
    		}else{
    			echo 0;
    		}
    	}
    }
    /**
     * 删除文件
     * @param int $id
     */
    public function delFile($id=0){
        $id=$id?$id:I('id','',intval);
        $file=!empty($_POST['file'])?$_POST['file']:'';
       
        if(!unlink('./Uploads/file/'.$file)){  
            echo 0;
        }else{
            $data=array('id'=>$id,'file'=>'');
            $result=M('Article')->save($data);
            echo 1;
        }
    }
  	/**
  	* [_setDel 定时删除]
    * @param integer $time [间隔]
    * @param string  $model [模型]
    * @param string  $type [跨度]
  	*/
    protected function _setDel($time=10,$model='',$type='day'){	
        switch ($type) {
        	case 'day':
        		$after=time()- $time*24*60*60;
        		break;
        	case 'week':
        		$after=time()- $time*24*60*60*7;
        		break;
        	case 'hour':
        		$after=time()- $time*60*60;
        		break;
        	default:
        		$after=time()- $time*24*60*60;
        		break;
        }
        
        $name=!empty($model)?$model:$this->getActionName();
        $model=M($name);
        $where['date']=array('lt',$after);
        $result=$model->where($where)->delete(); 
        return $result;
    }

    /**
     * 获取参数信息
     * @param string $param 参数
     * @return string
     */
    protected function _param($param=''){
        if(empty($param)){
            foreach ($_REQUEST as $k => $v) {
                if($k!='_URL_'){
                    $param[$k]=$v;
                }
            }
        }
        return $param;
    }

    /**
     * 获取详情
     * @param int $id
     */
    public function detail($id=0){
        if($id){
            $article =  M('article')->field('id,title,description,content,date')->find($id);
            $article['date']=date('Y-m-d',$article['date']);
            if(!empty($article)){
                $this->ajaxReturn(array('status'=>1,'content'=>$article));
            }else{
                $this->ajaxReturn(array('status'=>0,'msg'=>'没有数据'));
            }

        }
    }

    /**
     * 用户登出
     */
    public function logout(){
        session('mid',null);
        session('mname',null);
        session('jifen',null);
        $this->ajaxReturn(array('status'=>1,'msg'=>'退出成功','redirect'=>U('/')));
    }

    /**
     * 用户登录状态
     */
    public function is_login(){
        $mid = session('mid');
        if(empty($mid)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'您还未登陆,请登录网站','redirect'=>U('/login')));
        }

        $username = M('member')->field('id,username,tel,type,email,real_name,jifen')->where(array("id"=>$mid))->find();
        //p($username);die;
        $username['ptype']='';
        if(empty($username)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'您还未登陆,请登录网站','redirect'=>U('/login')));
        }
        $username['personal']=U('/private');
        $this->ajaxReturn(array('status'=>1,'data'=>$username));
    }

    /**
     * 用户登录
     */
    public function user_login(){
        if(empty($_POST['code'])){
            $this->ajaxReturn(array('status'=>0,'msg'=>'验证码不能为空'));
        }
        $username = M('member')->field('id,username,password,email,real_name,jifen,status')->where(array("username"=>I('post.username')))->find();

        if(empty($username)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'用户名不存在'));
        }
        $pwd = md5(trim(I('post.password')));
        if($pwd!=$username['password']){
            $this->ajaxReturn(array('status'=>1,'msg'=>'密码错误'));
        }

        session('mid',$username['id'],3600*5);
        session('mname',$username['username'],3600*5);
        session('mtype',$username['type'],3600*5);
        $this->ajaxReturn(array('status'=>2,'data'=>$username,'redirect'=>U('/private')));
    }

    /**
     * 检查用户名是否存在
     */
    public function check_username(){
        $username= I('post.username');
        $user = M('member')->where(array('username'=>$username))->find();

        if(!empty($user)){
            $this->ajaxReturn(array('status'=>1,'msg'=>'用户名已存在'));
        }
        $this->ajaxReturn(array('status'=>0,'msg'=>'恭喜您可以注册'));
    }
    /**
     * 验证码
     */
    public function verify(){
        $verify = new \Think\Verify();
        //$verify->imageW=180;
        $verify->imageH=50;
        $verify->length   = 4;
        $verify->entry();
    }

    /**
     * 校验验证码
     * @param $code
     */
    public function check_code($code){
        if($this->check($code)){
            $this->ajaxReturn(array('status'=>1,'msg'=>'验证码输入正确'));
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'验证码输入错误'));
        }
    }

    /**
     * 验证码检查
     */
    protected function check($code, $id =""){
        $verify = new \Think\Verify();
        return $verify->check($code,$id);
    }

    public function kefu($qq=0){
        if(!$qq){
            exit('QQ号不能为空');
        }
        $url = 'http://wpa.qq.com/msgrd?v=3&uin='.$qq.'&site=qq&menu=yes';
        header('Location:'.$url);
    }
    /**
     * 获取客服列表
     * @param int $lg       长度
     */
    public function get_kefu($lg=3){
        $list = M('kefu')->field('id,name,qq')->where('status=0')->limit($lg)->select();
        if(empty($list)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'没有可用的客服'));
        }
        foreach ($list as $v){
            $v['uri']=U('Public/kefu?qq='.$v['qq']);
            $list1[]=$v;
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'查询成功','list'=>$list1));
    }

//    protected function _error(){
//        header("HTTP/1.0 404 Not Found");
//        $this->assign('home',C('DOMAIN'));
//        $this->display("Common:404");
//    }
}