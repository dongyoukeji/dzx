<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 订单管理
 */
class WineController extends BaseController {
  	/**
	 * [index 首页]
	 * @return [type] [description]
	 */
    public function index(){
		//$this->kefu=C('Kefu');
		$map=$this->_search();
		$map['ordstatus']=array('neq',2);
		$map['wine']=array('neq','');
		$this->list = $this->getlist(M('Order'),$map,'ordtime desc');
    	$this->display();
    }
	public function add($id=0){
		if($id){
			$order = M('Order')->field('payment_type,payment_trade_no,payment_trade_status,payment_notify_id,payment_notify_time,payment_buyer_email',true	)->find($id);
			$box = $this->_get_box_info($order);

			
			if($order['isused']==2){
				$goods= M('article')->field('id,title')->find($order['productid']);
				$goods['count']=1;
				$order['pro'][]=$goods;
			}else{
				foreach (explode('|',$order['sums']) as $k=>$v){
					$temp = explode('_',$v);
					if(strstr($v,'wine')){
						$wine= M('article')->field('id,title')->find($temp[1]);
						$wine['count']=$temp[2];
						$wine['box']=$box[$temp[1]];
						$order['pro'][$k]=$wine;
					}
				}
			}
		}
	
		$this->oder=$order;
		$this->display();
	}
	/**
	 * [_get_box_info 获取盒子信息]
	 * @param  [type] $order [description]
	 * @return [type]        [description]
	 */
	private function _get_box_info($order){
		$boxes = $order['boxid'];
		foreach (explode('|', $boxes) as $k => $v) {
			$temp = explode('_', $v);
			$arc = M('article')->field('id,title')->find($temp[2]);
			$arc['sum']=$temp[3];
			$arc['price']=$temp[4];
			$tt[$temp[1]]=$arc;
		}
		return $tt;
	}

	public function see($id=0){
		if($id){
			$order = M('Order')->find($id);

			if($order['isused']==2){
				$goods= M('article')->find($order['productid']);
				$goods['count']=1;
				$order['pro'][]=$goods;
			}else{
				foreach (explode('|',$order['sums']) as $k=>$v){
					$temp = explode('_',$v);
					if(strstr($v,'wine')){
						$wine= M('article')->find($temp[1]);
						$wine['count']=$temp[2];
						$order['pro'][]=$wine;
					}else if (strstr($v,'goods')){
						$goods= M('article')->find($temp[1]);
						$goods['count']=$temp[2];
						$order['pro'][]=$goods;
					}else{
						$coupon= M('coupons')->where(array('coupon_cid'=>$temp[1]))->find();
						$coupon['title']=$coupon['coupons_title'];
						$coupon['count']=$temp[2];
						$order['pro'][]=$coupon;
					}
				}
			}
		}
		$this->vo1=$order;
		$this->display();
	}
	public function addhd(){
		if(!IS_POST){
			$this->ajaxReturn(array('status'=>0,'msg'=>'错误的请求'));
		}
		$data = $_POST;
		$data['time']=time();
		
		if(empty($data['id'])){
			if(!M('Order')->add($data)){
				$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
			}
		}else{
			$data['post_userinfo']=I('post.usernames').'|'.I('post.phones');
			$data['post_wine_time']=time();
			if(!M('Order')->save($data)){
				$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
			}
		}
		$m = I('post.phones');
		$url = cn50r(C('SiteConfig.host')."/query/express/decode/0/no/".getEncyptStr(I('post.orderId')));

		$sms_info1 ="尊敬的".I('post.usernames')."，您购买的【葡萄酒】"."，你支付的订单".I('post.orderId')."，已发货。可到官方网站输入订单号查询订单物流状态。或点击该链接查询。".$url;

		$_var = random(4,1);
		session('var',$_var);
		$_result = sendSMS($m,$_var,$sms_info1);

		$this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','redirect'=>U('index')));
	}

	public function del($id=0){
		if(!$id){
			$this->ajaxReturn(array('status'=>0,'msg'=>'参数错误'));
		}
		if(!M('Order')->delete($id)){
			$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
		}
		$this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','redirect'=>U('index')));
	}

	public function status($id=0,$t=0){
		if(!$id){
			$this->error('参数错误');
		}
		if(!M('Order')->save(array('id'=>$id,'status'=>$t))){
			$this->error('操作失败');
		}
		$this->redirect('index');
	}

	protected function _search() {
		$map = array();
		//控制器名称
		($title = I('get.coupons_title','', 'trim')) && $map['username'] = array('like', '%' . $title . '%');
		//状态（正常，禁用）
        if ($_GET['coupons_type'] == null) {
            $status = -1;
        } else {
            $status = intval($_GET['coupons_type']);
        }
        $status >= 0 && $map['post_status'] = array('eq',$status);
		//输出
		$this->assign('search', array(
			'title' => $title,
			'status' => $status,
		));
		return $map;
	}
}