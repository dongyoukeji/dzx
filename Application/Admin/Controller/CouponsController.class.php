<?php

namespace Admin\Controller;
use Think\Controller;
/**
 * 礼券管理
 * @author 魏巍
 *
 */
class CouponsController extends BaseController {

	public function index(){
        $map=$this->_search();
        $map['coupons_status']=array('neq',3);
        $this->list = $list = $this->getlist(M('coupons'),$map,'coupons_no asc');
		$this->display();
	}

    public function add(){
       $this->display();
    }

    public function see($id=0){
        if($id){
            $this->arc=$arc = M('coupons')->find($id);
        }
        $this->display();
    }

    public function addhd(){
        $data=$_POST;
        
        if($data['coupons_type']==0){
            $cols = M('column')->find($data['coupons_list_val']);
            $coupons = M('coupons')->where(array('coupons_type'=>0))->order('id desc')->find();
            if(!empty($coupons['coupons_no'])){
                $ii=str_replace('NO.','',$coupons['coupons_no']);
                $ii = preg_replace('/^0+/','',$ii);
                $ii=$ii+1;
            }else{
                $ii= 1;
            }
            $j = 0;
            //生成礼券
            for ($i=0;$i<$data['coupons_sum'];$i++){
                $key[$j]['coupons_name'] =$cols['name'];
                $key[$j]['coupons_val'] =$data['coupons_val']."|".$cols['name']."|".$cols['title'];
                $key[$i]['coupon_cid'] =$data['coupons_list_val'];
                $key[$j]['coupons_title'] =$data['coupons_title'];
                $key[$j]['coupons_type'] =$data['coupons_type'];
                $key[$i]['coupon_content']=htmlspecialchars($data['coupon_content']);
                $key[$j]['coupons_no'] = "NO.".zeroize($i+$ii,10);
                $key[$j]['coupons_date'] = time();
                $j++;
            }
        }else{
            $map['coupons_no']= array('like',$data['coupons_pre'].'%');
            //检测前缀是否存在
            $count = M('coupons')->where($map)->count('*');
            if($count>0){
                $this->ajaxReturn(array('status'=>0,'msg'=>'卡券添加失败,卡券前缀已存在'));
            }
            //构造优惠券
            for($i=0;$i<$data['coupons_sum'];$i++){
                if(iconv_strlen($i,'utf-8') == '1'){
                    $num[$i] = '000'.$i;
                }elseif(iconv_strlen($i,'utf-8') == '2'){
                    $num[$i] = '00'.$i;
                }elseif(iconv_strlen($i,'utf-8') == '3'){
                    $num[$i] = '0'.$i;
                }else{
                    $num[$i] = $i;
                }
                $key[$i]['coupons_name'] =$data['coupons_title'];
                $key[$i]['coupons_val'] =$data['coupons_val'];
                $key[$i]['coupons_title'] =$data['coupons_title'];
                $key[$i]['coupons_type'] =$data['coupons_type'];
                $key[$i]['coupon_cid'] =$data['coupons_val'];
                $key[$i]['coupon_content']=htmlspecialchars($data['coupon_content']);
                $key[$i]['coupons_no'] = $data['coupons_pre'].getEncyptStr($num[$i]);
                $key[$i]['coupons_date'] = time();
            }
        }

        if(!M('coupons')->addAll($key)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'卡券添加失败,请重试'));
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'卡券添加成功','redirect'=>U('index')));
    }

    /**
     * 获取可以生成食物礼券的栏目
     */
    public function get_columns(){
        $cols = M('column')->field('id,fid,title')->where('status=0 and fid=0')->select();

        foreach ($cols as $k => $v){
            $list = M('column')->field('id,fid,title')->where('status=0 and fid='.$v['id'])->select();
            if(!empty($list)){
                $cols[$k]['child'] = $list;
            }else{
                $cols[$k]=$v;
            }
        }
        $this->list = $cols;
        $tpl  = $this->fetch('liquan');
        $this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','result'=>$tpl));
    }
    /**
     * 获取产品列表
     * @param $cid
     */
    public function get_article_list($cid){
        $goods = M('article')->where('status=0 and column_id='.$cid)->select();
        if(empty($goods)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'没有相应产品'));
        }
        $this->list = $goods;
        $tpl  = $this->fetch('alist');
        $this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','result'=>$tpl));
    }

    /**
     * 或生成数量
     * @param int $cid
     */
    public function get_article_count($cid=0){
        if(!$cid){
            $this->ajaxReturn(array('status'=>0,'msg'=>'参数错误'));
        }
        $goods = M('article')->where('status=0 and id='.$cid)->find();
        
        $map['coupons_val']= array('like',$cid.'|%');
        $coupons_count = M('coupons')->where($map)->count();
        if($goods['sum'] == $coupons_count){
            $this->ajaxReturn(array('status'=>0,'msg'=>'您应经生成了相关礼券,请重新选择'));
        }else{
            $count = $goods['sum']-$coupons_count;
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','result'=>$count));
    }

    /**
     * 搜索
     * @return array
     */
    protected function _search() {
        $map = array();
        //控制器名称
        ($title = I('get.coupons_title','', 'trim')) && $map['coupons_title'] = array('like', '%' . $title . '%');
        //状态（正常，禁用）
        if ($_GET['coupons_type'] == null) {
            $status = -1;
        } else {
            $status = intval($_GET['coupons_type']);
        }
        $status >= 0 && $map['coupons_type'] = array('eq', $status);
        //输出
        $this->assign('search', array(
            'title' => $title,
            'status' => $status,
        ));

        return $map;
    }
}
