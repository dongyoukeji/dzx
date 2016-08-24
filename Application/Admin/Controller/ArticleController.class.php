<?php
namespace Admin\Controller;
use Think\Controller;

class ArticleController extends BaseController{
	/**
	 * [index 文章列表]
	 * @return [type]
	 */
	public function index(){
		$id=!empty($_REQUEST['column_id'])?I('column_id'):I('cid');
		$map = $this->_search_arc();
		$columns = M('column')->field('id,fid')->where('status=0')->select();
		$inIt=0;
        //排序
        $ordermap = $this->ordermap(I('sort'),I('order'));
		$this->child = $child = M('column')->field('id,fid,title')->where(array('fid'=>$id,'status'=>0))->select();
		$this->column = $column = M('column')->field('id,fid,title')->where(array('id'=>$id,'status'=>0))->find();
		$parents = \Tool\Category::getChildrens($columns,$column['fid']);
		$parents[]=$column['fid'];
		if($column['fid']!=0){
			foreach ($parents as $v){
				if($v['id']==$column['fid']){
					$inIt=$column['fid'];
					break;
				}
			}
		}else{
			$inIt = $id= (count($child)!=0)?$child[0]['id']:$id;
		}

		$map['column_id']=$id;
		//
		$this->inIt =$inIt;
		$this->list=$arclist=$this->getlist(M('article'), $map, $ordermap);
		$this->display('arclist');
	}
	/**
	 * [recycle 回收站]
	 * @return [type]
	 */
	public function add($aid=0){
		$inIt = 0;

		$this-> column = $list = \Tool\Category::LimitForLevel(M('column')->select());
		if($aid){
			$this->info = $info = M('article')->find($aid);
		}
		$columns = M('column')->field('id,fid')->where('status=0')->select();
		$thiscol = M('column')->find(I('get.cid'));
		if(empty($thiscol)){
			$thiscol['fid']=$info['column_id'];
		}
		$parents = \Tool\Category::getParents($columns,$thiscol);
		foreach ($parents as $v){
			if($v['id']==$thiscol['fid']){
				$inIt=$thiscol['fid'];
				break;
			}
		}
		$this->inIt =$inIt;
		$this->display();
	}

	/**
	 * 修改状态
	 * @param $id
	 * @param $t
	 * @param $ct
	 */
	public function status($id,$t,$ct){
		if(!M('article')->save(array('id'=>$id,'status'=>$t))){
			$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败'));
		}
		$this->ajaxReturn(array('status'=>1,'msg'=>'操作失败','redirect'=>U('index?id='.$ct)));
	}

	/**
	 * 文档操作
	 */
	public function addhandler(){
		//$images = $this->uploadsEditor();	//上传图片
		//$file=$this->UploadsFile();			//上传文件
		$data=$_POST;
		//$data['image']=$images['image'];
		$attr=$this->makeAttr($_POST['attr']);	//重置属性
		$data['content']=I('content',htmlspecialchars);
		$data=array_merge($data,$attr);
		$_post=$_POST['file']?$_POST['file']:'';

		$data['startTime']=!empty($data['startTime'])?strtotime($data['startTime']):0;
		$data['endTime']=!empty($data['endTime'])?strtotime($data['endTime']):0;
		$data['file']=!empty($file['file'])?$file['file']:$_post;
		//$data['image']=!empty($data['image'])?$data['image']:'';
//		foreach ($images as $k => $v) {
//			$data[$k]=$v;
//		}

		if($data['id']){
			$data['time']=time();
			if(!M('article')->save($data)){
				$this->ajaxReturn(array('status'=>0,'msg'=>'修改失败,请重试!'));
			}
			$this->ajaxReturn(array('status'=>1,'msg'=>'修改成功','redirect'=>U('index?cid='.I('post.rid'))));
		}else{
			$data['date']=time();
			if(!M('article')->add($data)){
				$this->ajaxReturn(array('status'=>0,'msg'=>'添加失败,请重试!'));
			}
			$this->ajaxReturn(array('status'=>1,'msg'=>'添加成功','redirect'=>U('index?cid='.I('post.rid'))));
		}
	}

	/**
	 * 删除文件含图片
	 * @param int $id
	 */
	public function del($id){
		if(!$id){
			$this->ajaxReturn(array('status'=>0,'msg'=>'参数错误'));
		}
		$a= M('article')->find($id);
		if(!empty($a['image'])){
			$src = $a['image'];
			$ii = explode('/', $src);
			$ii[4]="m_".$ii[4];
			$ii1 = implode('/', $ii);
			if(file_exists($ii1)){
				if(!unlink('./'.$ii1)){
					$this->ajaxReturn(array('status'=>0,'msg'=>'删除图片失败,请重试!'));
				}
			}
			if(!unlink(".".$a['image'])){
				$this->ajaxReturn(array('status'=>0,'msg'=>'删除图片失败,请重试!'));
			}
		}
		if(!M('article')->delete($id)){
			$this->ajaxReturn(array('status'=>0,'msg'=>'删除失败,请重试!'));
		}
		$this->ajaxReturn(array('status'=>1,'msg'=>'删除成功'));
	}
	/**
	 * [update 更新视图]
	 * @return [type]
	 */
	public function update(){
		$this->article=$article=M('article')->find(I('id'));
		if($article['image']){
			$this->images=$images=array_filter(explode(',',$article['image']));
		}
		$this->display();
	}
	
	/**
	 * [delete 更新处理函数]
	 * @return [type]
	 */
	public function updatehandler(){
		$images = $this->uploadsEditor();	//上传图片
		$file=$this->UploadsFile();			//上传文件
		$data=$_POST;
		$data['date']=time();
		$data['column_id']=$data['cid'];
		$attr=$this->makeAttr($_POST['attr']);	//重置属性
		$data['content']=I('content',htmlspecialchars);
		$data=array_merge($data,$attr);
        $image='';

		$data['startTime']=!empty($data['startTime'])?strtotime($data['startTime']):0;
		$data['endTime']=!empty($data['endTime'])?strtotime($data['endTime']):0;
		$data['file']=!empty($file['file'])?$file['file']:$_POST['file'];
		
		if(!empty($_POST['image'])){
			foreach ($_POST['image'] as $i => $e) {
				$image .= $e.',';
			}
		}

		if(!empty($images)){
			foreach ($images as $k => $v) {
				$data[$k]=$v;
			}
			if(!empty($images['image'])){
				$image .= $images['image'];
			}
		}
		
		$data['image']=substr($image,0,-1);
		if(!M('article')->save($data)){			
			$this->error('操作失败');
		}
		$this->redirect('index?cid='.I('cid'));	
	}

	/**
	 * [delete 删除操作]
	 * @return [type]
	 */
	public function delete(){
		if(!M('article')->delete(I('id'))){
			$this->error('操作失败');
		}
		$this->redirect('index?cid='.I('cid'));
	}
	/**
	 * [_search_arc 搜索]
	 * @return [type]
	 */
	protected function _search_arc(){
		$map=array();
		$username=I('k');
		$status=I('q');
		if($status>-1&&$status!=""){
			$map['status']=array('eq',$status);
		}
		
		$map['title']=array('like','%'.I('k').'%');
		$this->search=array(
			'k'=>$username,
			'q'=>$status
			);
		return $map;
	}
}