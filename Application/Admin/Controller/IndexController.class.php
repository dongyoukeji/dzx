<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 
 */
class IndexController extends BaseController {
  	/**
	 * [index 首页]
	 * @return [type] [description]
	 */
    public function index(){
    	$model=M('article');
    	$map['column_id']=3;
    	$order='date desc,id desc';
    	$this->list=$list=$this->getlist($model,$map,$order,1);
        $this->count = M('column')->where('fid=0')->count();
    	$this->redirect('Member/index');

    } 
    //导航
	public function nav(){
		$this->display();
	}
	//欢迎
	public function main(){
		$this->display();
	}
}