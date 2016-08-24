<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index() {
        $this->com_list=$this->get_com_list();
        $this->get_redwine_list=$this->get_redwine_list();
        $this->display();
    }
    public function test(){
        $data['username']="张勇";
        $data['ordid']=get_order_trade_no();
        $data['ordfee']=2000;
        $data['phone']='15371829847';
        $sms_info1 ="尊敬的".$data['username']."，你成功支付了订单号为".$data['ordid']."的账单".$data['ordfee']."元，现等待官方发货。";
        $_var = random(4,1);
        session('var',$_var);
        $_result = sendSMS($data['phone'],$_var,$sms_info1);
    }

    /**
     * 生成短网址
     * @param string $u 生成地址
     */
    public function short_url($u=''){
        if(empty($u)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'转换地址不能为空'));
        }
        echo cn50r($u); //结果: http://50r.cn/Y62jjZ
    }
    public function get_article_list($cid=0,$s=5){
        if(!$cid){
            $this->ajaxReturn(array('msg'=>0,'msg'=>'栏目ID不能为空'));
        }
        $cols = M('column')->where('status=0')->select();
        $child = \Tool\Category::getChildrenForIds($cols,$cid);
        $child.=",".$cid;

        $map['status']=0;
        $map['column_id']=array('in',$child);
        $list = M('article')->where($map)->limit($s)->select();
        $this->list=$list;
        $data = $this->fetch('pro_list');
        $this->ajaxReturn(array('status'=>1,'list'=>$data));
    }

    /**
     * 获取推荐列表
     * @param int $s
     * @param int $o
     * @return mixed
     */
    public function get_com_list($s=5,$o=0){
        $map['status']=0;
        $map['column_id']=array('in','1,2,3,4');
        $list = M('article')->where($map)->limit($s)->select();
        if($o){
            $this->ajaxReturn(array('msg'=>1,'data'=>$list));
        }
        return $list;
    }
    /**
     * 获取推荐列表
     * @param int $s
     * @param int $o
     * @return mixed
     */
    public function get_redwine_list($s=6,$o=0){
        $map['status']=0;
        $map['column_id']=5;
        $list = M('article')->where($map)->limit($s)->select();
        if($o){
            $this->ajaxReturn(array('msg'=>1,'data'=>$list));
        }
        return $list;
    }
}