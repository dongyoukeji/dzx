<?php
namespace Admin\Controller;
/**
 * 栏目操作
 * @author 魏巍
 */
class ColumnController extends BaseController {
    /**
     * 列表页
     */
	public function index(){
        $list = $this->getlist();
        $list =   \Tool\Category::LimitForLevel($list);
        $this->list=$list;
		$this->display();
	}
    /**
     * 添加页
     */
	public function add($gid=0){
        if($gid){
            $this->column=$column=M('column')->find(I('gid','',intval));
        }
        $this-> column_list = $list = \Tool\Category::LimitForLevel(M('column')->select());
		$this->display();
	}

    public function edit(){
        $this->column=$column=M('column')->find(I('gid','',intval));
        $this->display();
    }

    /**
     * 修改操作
     */
    public function status($id,$t){
       if(!M('column')->save(array(
           'id'=>$id,
           'status'=>$t
       ))){
           $this->ajaxReturn(array('status'=>0,'msg'=>'修改失败,请重试'));
       }
        $this->ajaxReturn(array('status'=>1,'msg'=>'修改成功','redirect'=>U('index')));
        //$this->redirect('index');
    }
    /**
     * 添加处理函数
     */
    public function addhandler(){
        //$image = $this->UploadsImage();
        $data =!empty($image)?array_merge($image,$this->_param()):$this->_param();
        $data['title']=trim_all(I('title'));
        $data['effective']=strtotime(I('effective'));
        ksort($data);

        if($data['id']){    //修改
            $data['dates']=time();
            if(!M('column')->save($data)){
                $this->ajaxReturn(array('status'=>0,'msg'=>'修改失败,请重试'));
            }
            $this->ajaxReturn(array('status'=>1,'msg'=>'修改成功','redirect'=>U('index')));
        }else{      //添加
            $data['date']=$data['dates']=time();
            if(!M('column')->add($data)){
                $this->ajaxReturn(array('status'=>0,'msg'=>'添加失败,请重试'));
            }
            $this->ajaxReturn(array('status'=>1,'msg'=>'添加成功','redirect'=>U('index')));
        }
    }

    /**
     * 修改处理函数
     */
    public function edithandler(){
        $this->lang=$lang=!empty($_COOKIE['think_language'])?strtolower(cookie('think_language')):'zh-cn';
        $map['lang']=$lang;
        $this-> column_list = $list = \Tool\Category::LimitForLevel(M('column')->where($map)->select());
        $image = $this->UploadsImage();
        $data =!empty($image)?array_merge($image,$this->_param()):$this->_param();
        $data['title']=trim_all(I('title'));
        $data['effective']=strtotime(I('effective'));

        //获取旧图片参数
        foreach($data as $j=>$i){
            if(strpos($j,'old_')!==false){
                $old[str_replace('old_','',$j)]=$i;
                unset($data[$j]);
            }
        }
        //替换图片
        if(!empty($image)){     //有上传图片
            foreach($image as $k=>$v){
                $data[$k]=$v;
                if($image[$k]){ //删除旧图片
                    unlink(C('DEFAULT_UPLOAD_CONFIG.IMAGES').I('old_'.$k));
                }
            }
        }else{  //无上传图片,使用旧图片
            foreach($old as $o=>$q){
                $data[$o]=$q;
            }
        }
        $data['date']=time();
        if(!M('column')->save($data)){
            $this->error("操作失败请重试");
        }
        $this->redirect('index');
    }
}
