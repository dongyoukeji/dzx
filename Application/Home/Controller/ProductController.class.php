<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends BaseController {
    public function index() {
        $this->display();
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
        $p->setConfig('theme', '%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%');

        $p->lastSuffix = true;  //最后一页不显示为总页数
        $show=$p->show();
        $this->assign('page', $show);
        $res = $model->where($map)->cache(true)->field($field)->group($group)->limit($p->firstRow . ',' . $p->listRows)->order($order)->select();
        return $res;
    }

    /**
     * 显示购物车
     */
    public function cart(){
        //session('short_cart',null);die;
        $goods = session('short_cart');
      
        $this->boxes = $boxes = M('article')->field('id,title,description,image,price,tprice')->where(array('status'=>0,'column_id'=>10))->select();

        if(!empty($goods['wine']) || !empty($goods['goods']) || !empty($goods['coupon'])){
            
        }else{
            $this->redirect('index/index');
        }

        $this->list =$this->_get_cart_list($goods);
        $this->display();
    }

    public function get_price($n){
        $data = file_get_contents('./Data/SFExpress.js');
        $data = json_decode(trim_all($data),true);
        $price = array();
       foreach ($data as $v){
           if(strstr($n,$v['title'])){
               foreach ($v['price'] as $j){
                   if($j['date']==2){
                       $price =  $j;
                       break;
                   }
               }
               break;
           }
       }
        $this->ajaxReturn(array('status'=>1,'list'=>$price));
    }
    /**
     * 获取购物车列表
     * @param $goods
     * @return mixed
     */
    private function _get_cart_list($goods){
        //session('short_cart',null);
        $nums=0;
        $totals=0;
        $kg=0;
        if($goods){
            if($goods['wine']){
                foreach ($goods['wine'] as $k){
                    $wine = M('article')->find($k['id']);
                    $nums += $wine['get_num']=$k['sum'];
                    $totals += $wine['totals'] = $wine['tprice']*$k['sum'];
                    $wine['type']='2';
                    $wine['tt']='wine';
                    $list['wine'][]=$wine;
                }
            }
            if($goods['goods']){
                foreach ($goods['goods'] as $j){
                    $xie = M('article')->find($j['id']);
                    $nums += $xie['get_num']=$j['sum'];
                    $totals +=  $xie['totals'] = $xie['tprice']*$j['sum'];
                    $xie['type']='1';
                    $xie['tt']='goods';
                    if($xie['mass']>0){
                        $kg += $xie['mass']*$j['sum'];
                    }
                    $list['goods'][]=$xie;
                }
            }
            if($goods['coupon']){
                foreach ($goods['coupon'] as $s){
                    $coupon = M('coupons')->where("coupon_cid=".$s['id'])->find();
                    $coupon['coupons_id']=$coupon['id'];
                    $coupon1 = M('article')->where(array('column_id'=>$s['id']))->find(); 
                    $nums += $coupon['get_num']=$s['sum'];
                    $totals += $coupon['totals'] = $coupon1['tprice']*$s['sum'];
                    $coupon1['title']=$coupon['coupons_title'];
                    $coupon['type']='3';
                    $coupon['tt']='coupon';
                    $coupon = array_merge($coupon,$coupon1);
                    $list['coupon'][]=$coupon;
                }
            }
        }

        if($kg<1){
            $tal = 0;
        }else{
            $tal = 12+($kg-1)*2;
        }
        //p($kg);die;
        $this->kg=$kg;
        $this->mass_totals= $tal;
        $this->nums = ($nums>0)?$nums:0;
        $this->totals =  $totals+$tal;
        
        return $list;
    }

    /**
     * 检查商品库存
     * @param $t
     * @param $id
     */
    public function check_pro($t,$id){
        if(empty($t) || empty($id)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'参数错误'));
        }

        if($t=='coupon'){
            $count = M('coupons')->where(array('coupons_status'=>0,'coupon_cid'=>$id))->count('*');
        }else{
            $article = M('article')->field('id,sum')->find($id);
            $count = $article['sum'];
        }
        if(!$count){
            $this->ajaxReturn(array('status'=>0,'msg'=>'库存不足，无法购买，请联系客服'));
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'库存充足'));
    }

    /**
     *清除
     */
    public function delItems(){
        session('short_cart',null);
        $this->ajaxReturn(array('status'=>1,'msg'=>'删除成功'));
    }

    /**
     * 购车删除
     * @param string $i
     */
    public function delItem($i=''){
        if(!$i){
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败，请重试'));
        }
        $cart = session('short_cart');
       
        $temp = explode('_', $i);
       
        $ss = array();
        foreach ($cart as $k => $v) {
          if($k==$temp[0]){
            foreach ($v as $i => $j) {
               if($j['id']!=$temp[1]){
                    $ss[$k][]=$j;
               }
            }
          }else{
            $ss[$k]=$v;
           }
        }
       
       
        session('short_cart',$ss);
        $this->ajaxReturn(array('status'=>1,'msg'=>'删除成功'));
        //$this->_get_cart_list();
    }
    /**
     *添加购物车
     */
    public function addCart(){

        foreach ($_POST as $k=> $v){
            if($k!='PHPSESSID'){
                $v = explode(',',$v);

                if(strstr($k,'wine')){      //酒水
                    $t['wine'][]=array(
                        'id'=>$v[1],
                        'sum'=>$v[2]
                    );
                }
                if(strstr($k,'goods')){      //酒水
                    $t['goods'][]=array(
                        'id'=>$v[1],
                        'sum'=>$v[2]
                    );
                }
                if(strstr($k,'coupon')){      //酒水
                    $t['coupon'][]=array(
                        'id'=>$v[1],
                        'sum'=>$v[2]
                    );
                }

//                $t[$v[0]]=array(
//                    'id'=>$v[1],
//                    'sum'=>$v[2]
//                );
            }
        }
        session('short_cart',$t);
        $this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','redirect'=>U('cart')));
    }

    public function list_dzx($cid=0){
        $map['status']=0;
        if(!$cid){
            $map['column_id']=array('in','1,2,3,4');
        }else{
            $cols = M('column')->where('status=0')->select();
            $child = \Tool\Category::getChildrenForIds($cols,$cid);
            $child.=",".$cid;
            $map['column_id']=array('in',$child);
        }
        $list = $this->getlist(M('article'),$map,'sort asc');
        $this->list=$list;
        $this->display();
    }
    /**
     * 产品详细
     * @param int $id
     */
    public function details($id=0) {
        if($id){
            $product = M('article')->find($id);
            if(!empty($product)){
                $this->vo=$product;
                $this->kefu =$kefu= M('kefu')->where('status=0')->select();       // C('Kefu')
            }
        }
        $this->get_order=$this->get_new_order();
        $this->display();
    }
}