-- phpMyAdmin SQL Dump
-- version 4.4.15.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-08-24 01:58:08
-- 服务器版本： 5.5.48-log
-- PHP Version: 5.5.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dzx`
--

-- --------------------------------------------------------

--
-- 表的结构 `think_address`
--

CREATE TABLE IF NOT EXISTS `think_address` (
  `id` int(11) NOT NULL COMMENT '主键，自动增长',
  `mid` int(11) NOT NULL COMMENT '会员id',
  `name` varchar(50) NOT NULL COMMENT '收件人',
  `prov` varchar(150) NOT NULL COMMENT '省份',
  `city` varchar(250) NOT NULL COMMENT '城市',
  `district` varchar(500) NOT NULL COMMENT '区县',
  `address` varchar(100) NOT NULL COMMENT '详细地址',
  `zipcode` varchar(10) NOT NULL COMMENT '邮编',
  `mobile` varchar(15) NOT NULL COMMENT '手机',
  `phone` varchar(15) NOT NULL COMMENT '座机',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认地址:1默认,0不默认',
  `contact` varchar(250) NOT NULL COMMENT '联系方式'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员收货地址表';

-- --------------------------------------------------------

--
-- 表的结构 `think_admin`
--

CREATE TABLE IF NOT EXISTS `think_admin` (
  `id` int(11) NOT NULL COMMENT '主键,自增长',
  `gid` varchar(150) NOT NULL COMMENT '所属群组:-1为超级管理员',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '用户密码',
  `hash` varchar(50) NOT NULL COMMENT '密码校验',
  `status` tinyint(1) NOT NULL COMMENT '状态:0正常;1锁定',
  `date` int(10) NOT NULL COMMENT '添加日期',
  `last_date` int(10) NOT NULL COMMENT '最后登录时间',
  `last_ip` varchar(15) NOT NULL COMMENT '最后登录IP'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员表';

--
-- 转存表中的数据 `think_admin`
--

INSERT INTO `think_admin` (`id`, `gid`, `username`, `password`, `hash`, `status`, `date`, `last_date`, `last_ip`) VALUES
(1, '-1', 'admin', 'fcea920f7412b5da7be0cf42b8c93759', 'MTIzNDU2Nw==', 0, 0, 1471920953, '192.168.188.184'),
(2, '10', 'dzx_wine', 'e10adc3949ba59abbe56e057f20f883e', 'MTIzNDU2', 0, 0, 1471410192, '192.168.188.184'),
(3, '11', 'dzx_goods', 'e10adc3949ba59abbe56e057f20f883e', 'MTIzNDU2', 0, 1471410373, 1471576312, '192.168.188.184');

-- --------------------------------------------------------

--
-- 表的结构 `think_advert`
--

CREATE TABLE IF NOT EXISTS `think_advert` (
  `id` int(11) NOT NULL COMMENT '主键自增长',
  `title` varchar(250) NOT NULL COMMENT '标题',
  `image` varchar(250) NOT NULL COMMENT '图片',
  `url` varchar(250) NOT NULL COMMENT '地址',
  `status` int(11) NOT NULL COMMENT '状态:0正常,1禁用',
  `time` int(11) NOT NULL COMMENT '时间',
  `times` int(11) NOT NULL COMMENT '时间戳'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='广告表';

-- --------------------------------------------------------

--
-- 表的结构 `think_article`
--

CREATE TABLE IF NOT EXISTS `think_article` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '规则id,自增主键',
  `column_id` int(1) NOT NULL DEFAULT '0' COMMENT '所属栏目',
  `tid` int(11) NOT NULL COMMENT '类型：0礼券,1礼盒',
  `title` varchar(500) NOT NULL DEFAULT '' COMMENT '文章中文名称',
  `author` varchar(50) NOT NULL DEFAULT '' COMMENT '作者:默认Admin',
  `keywords` varchar(500) NOT NULL COMMENT '关键词',
  `description` varchar(500) NOT NULL DEFAULT '' COMMENT '栏目简单介绍',
  `ico` varchar(150) NOT NULL COMMENT 'ico图标',
  `image` text NOT NULL COMMENT '文章图片',
  `file` varchar(50) NOT NULL COMMENT '文件',
  `content` text NOT NULL COMMENT '内容',
  `mass` varchar(20) NOT NULL COMMENT '质量,kg',
  `extend` text NOT NULL COMMENT '扩展内容',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `tprice` decimal(10,2) NOT NULL COMMENT '特价',
  `sum` int(11) NOT NULL COMMENT '库存数量',
  `hits` int(11) NOT NULL COMMENT '点击次数',
  `com` tinyint(1) NOT NULL DEFAULT '0' COMMENT '推荐，0否，1是',
  `hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '最热，0否，1是',
  `new` tinyint(1) NOT NULL DEFAULT '0' COMMENT '最新，0否，1是',
  `head` tinyint(1) NOT NULL DEFAULT '0' COMMENT '头条，0否，1是',
  `top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '置顶，0否，1是',
  `img` tinyint(1) NOT NULL DEFAULT '0' COMMENT '图文',
  `date` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `time` int(11) NOT NULL COMMENT '时间',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序：越小越靠前',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：0正常，1禁用'
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='文章表';

--
-- 转存表中的数据 `think_article`
--

INSERT INTO `think_article` (`id`, `column_id`, `tid`, `title`, `author`, `keywords`, `description`, `ico`, `image`, `file`, `content`, `mass`, `extend`, `price`, `tprice`, `sum`, `hits`, `com`, `hot`, `new`, `head`, `top`, `img`, `date`, `time`, `sort`, `status`) VALUES
(1, 1, 1, '8只移民蟹豪华礼盒', '', '8只移民蟹豪华礼盒', '4只公蟹2.5-3两，4只母蟹2.0-2.5两', '', '/Uploads/Images/2016-08-05/57a43b11f10e0.png', '', '8只移民蟹豪华礼盒8只移民蟹豪华礼盒8只移民蟹豪华礼盒8只移民蟹豪华礼盒8只移民蟹豪华礼盒', '8.5', '', '650.00', '499.00', 6, 0, 0, 0, 0, 0, 0, 0, 1470380867, 1471601228, 100, 0),
(2, 5, 1, '张裕葡萄酒', '', '张裕葡萄酒', '张裕葡萄酒', '', '/Uploads/Images/2016-08-05/57a43c7f08df4.jpg', '', '&lt;p&gt;\r\n	张裕葡萄酒\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	解百纳\r\n&lt;/p&gt;', '', '', '650.00', '499.00', 3, 0, 0, 0, 0, 0, 0, 0, 1470381215, 1470640827, 100, 0),
(3, 5, 0, '张裕葡萄酒红酒张裕窖酿干红葡萄酒礼盒', '', '张裕葡萄酒红酒张裕窖酿干红葡萄酒礼盒', '张裕葡萄酒红酒张裕窖酿干红葡萄酒礼盒', '', '/Uploads/Images/2016-08-05/57a43d76d3e35.png', '', '&lt;h1 class=&quot;des_content_tit&quot; style=&quot;font-size:18px;color:#333333;font-family:MHei, &amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	张裕葡萄酒红酒张裕窖酿干红葡萄酒礼盒\r\n&lt;/h1&gt;\r\n&lt;h1 class=&quot;des_content_tit&quot; style=&quot;font-size:18px;color:#333333;font-family:MHei, &amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	张裕葡萄酒红酒张裕窖酿干红葡萄酒礼盒\r\n&lt;/h1&gt;\r\n&lt;h1 class=&quot;des_content_tit&quot; style=&quot;font-size:18px;color:#333333;font-family:MHei, &amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	张裕葡萄酒红酒张裕窖酿干红葡萄酒礼盒\r\n&lt;/h1&gt;\r\n&lt;h1 class=&quot;des_content_tit&quot; style=&quot;font-size:18px;color:#333333;font-family:MHei, &amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	张裕葡萄酒红酒张裕窖酿干红葡萄酒礼盒\r\n&lt;/h1&gt;', '', '', '98.00', '89.00', 3, 0, 0, 0, 0, 0, 0, 0, 1470381444, 1470640816, 100, 0),
(4, 5, 0, '加州乐事 红葡萄酒750ml 美国原装进口', '', '加州乐事 红葡萄酒750ml 美国原装进口', '加州乐事 红葡萄酒750ml 美国原装进口', '', '/Uploads/Images/2016-08-17/57b3f7f4ce0d3.jpg', '', '&lt;p&gt;\r\n	规格参数&lt;a id=&quot;medica_record&quot; class=&quot;medica_record&quot; href=&quot;http://item.yhd.com/item/106376?tc=3.0.5.106376.3&amp;amp;tp=52.22968.108.3.1.LQMzwM1-10-CjLsf&amp;amp;ti=T7BDa3&quot; target=&quot;_blank&quot;&gt;&lt;/a&gt;产地：美国品牌：&lt;a href=&quot;http://www.yhd.com/brand/1917/8644&quot;&gt;加州乐事&lt;/a&gt;储存方式：卧放或倒放产区：其他产区瓶塞：木塞类型：半干红酿造工艺：混合葡萄品种葡萄品种：其它（红葡萄酒）葡萄品种：其它（红葡萄酒）净含量(ml)：750ml\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;div class=&quot;text&quot; style=&quot;color:#333333;font-family:&amp;quot;font-size:14px;&quot;&gt;\r\n	&amp;nbsp;\r\n&lt;/div&gt;\r\n&lt;table border=&quot;0&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot; style=&quot;color:#333333;font-family:&amp;quot;font-size:14px;&quot; class=&quot;ke-zeroborder&quot;&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td width=&quot;50%&quot;&gt;\r\n				&lt;img src=&quot;http://d6.yihaodianimg.com/N08/M07/0F/BB/ChEi1VWx3liAKTJ8AABGzV8HtAo579.webp&quot; alt=&quot;&quot; style=&quot;width:350px;height:350px;&quot; /&gt; \r\n			&lt;/td&gt;\r\n			&lt;td width=&quot;50%&quot; style=&quot;vertical-align:top;&quot;&gt;\r\n				&lt;ul class=&quot;ull&quot;&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【商品名称】：Carlo Rossi加州乐事 红葡萄酒\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【原产国家】：美国\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【商品规格】：750mL\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【商品配料】：葡萄汁、食品添加剂（山梨酸、二氧化硫）\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【酒精浓度】：11.5%vol\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【产品类型】：半干红\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【保质期限】：10年\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【贮藏方法】：常温、避光、卧放\r\n					&lt;/li&gt;\r\n				&lt;/ul&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;div class=&quot;text&quot; style=&quot;color:#333333;font-family:&amp;quot;font-size:14px;&quot;&gt;\r\n	1.Carlo Rossi加州乐事 红葡萄酒，美国原装进口，精选葡萄，手工采摘。&lt;br /&gt;\r\n2.Carlo Rossi加州乐事 红葡萄酒，犒赏自己，放松地享受此柔顺而多面貌的葡萄酒。\r\n&lt;/div&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;', '0.5', '', '40.00', '39.00', 98, 0, 0, 0, 0, 0, 0, 0, 1471412324, 1471501275, 100, 0),
(5, 5, 0, '百利甜酒 爱尔兰甜酒 750ML 原装进口', '', '百利甜酒 爱尔兰甜酒 750ML 原装进口', '百利甜酒 爱尔兰甜酒 750ML 原装进口', '', '/Uploads/Images/2016-08-17/57b3f8d403cd7.jpg', '', '&lt;table cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; style=&quot;color:#333333;font-family:&amp;quot;font-size:14px;&quot; class=&quot;ke-zeroborder&quot;&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td width=&quot;50%&quot; style=&quot;vertical-align:top;&quot;&gt;\r\n				&lt;ul class=&quot;ull&quot;&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【商品名称】：BAILEYS百利 甜酒（配制酒）\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【原产国家】：爱尔兰\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【商品规格】：750mL/瓶\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【商品配料】：奶油、白砂糖、食用酒精、麦芽糊精、牛奶蛋白、可可味食用香料、威士忌、着色剂、乳化剂、酸度调节剂\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【酒精浓度】：17%vol\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【保质期限】：两年\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【贮藏方法】：0℃-25℃\r\n					&lt;/li&gt;\r\n					&lt;li style=&quot;font-size:16px;font-family:微软雅黑;&quot;&gt;\r\n						【过敏信息】：本品含有牛奶\r\n					&lt;/li&gt;\r\n				&lt;/ul&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;div class=&quot;text&quot; style=&quot;color:#333333;font-family:&amp;quot;font-size:14px;&quot;&gt;\r\n	1.BAILEYS百利 甜酒（配制酒），甜蜜满溢心底。&lt;br /&gt;\r\n2.BAILEYS百利 甜酒（配制酒），爱尔兰奶油与威士忌的融合。\r\n&lt;/div&gt;', '0.5', '', '69.00', '65.00', 100, 0, 0, 0, 0, 0, 0, 0, 1471412507, 1471501233, 100, 0),
(6, 2, 0, '外贸蟹', '', '外贸蟹', '3只公蟹2.5-3两 ，3只母蟹2.0-2.5两', '', '/Uploads/Images/2016-08-19/57b6b562ca743.jpg', '', '外贸蟹外贸蟹外贸蟹外贸蟹外贸蟹外贸蟹外贸蟹外贸蟹', '2', '', '250.00', '249.00', 99, 0, 0, 0, 0, 0, 0, 0, 1471591731, 1471591782, 100, 0),
(7, 10, 0, '1盒1瓶', '', '1盒1瓶', '1盒1瓶', '', '/Uploads/Images/2016-08-23/57bbbc2de2248.jpg', '', '1盒1瓶', '', '', '10.00', '9.00', 100, 0, 0, 0, 0, 0, 0, 0, 1471921243, 0, 100, 0),
(8, 10, 0, '1盒2瓶', '', '1盒2瓶', '1盒2瓶', '', '/Uploads/Images/2016-08-23/57bbbc691b370.jpg', '', '1盒2瓶', '', '', '18.00', '15.00', 100, 0, 0, 0, 0, 0, 0, 0, 1471921274, 0, 100, 0),
(9, 10, 0, '1盒3瓶', '', '1盒3瓶', '1盒3瓶', '', '/Uploads/Images/2016-08-23/57bbbc8956ed0.jpg', '', '1盒3瓶', '', '', '20.00', '19.00', 100, 0, 0, 0, 0, 0, 0, 0, 1471921307, 0, 100, 0),
(10, 10, 0, '1盒4瓶', '', '1盒4瓶', '1盒4瓶', '', '/Uploads/Images/2016-08-23/57bbbca77f070.jpg', '', '1盒4瓶', '', '', '28.00', '25.00', 100, 0, 0, 0, 0, 0, 0, 0, 1471921338, 0, 100, 0),
(11, 10, 0, '1盒5瓶', '', '1盒5瓶', '1盒5瓶', '', '/Uploads/Images/2016-08-23/57bbbcd59eb10.jpg', '', '1盒5瓶', '', '', '30.00', '29.00', 100, 0, 0, 0, 0, 0, 0, 0, 1471921367, 0, 100, 0),
(12, 10, 0, '1盒6瓶', '', '1盒6瓶', '1盒6瓶', '', '/Uploads/Images/2016-08-23/57bbbcf2e0297.jpg', '', '1盒6瓶', '', '', '40.00', '35.00', 100, 0, 0, 0, 0, 0, 0, 0, 1471921411, 0, 100, 0);

-- --------------------------------------------------------

--
-- 表的结构 `think_cart`
--

CREATE TABLE IF NOT EXISTS `think_cart` (
  `id` int(11) NOT NULL COMMENT '主键自增',
  `cart_title` varchar(50) NOT NULL COMMENT '主题',
  `cart_uid` int(11) NOT NULL COMMENT '用户id',
  `cart_user` varchar(20) NOT NULL COMMENT '购买人',
  `cart_pid` varchar(50) NOT NULL COMMENT '物品id，多个使用'',''隔开',
  `cart_price` varchar(50) NOT NULL COMMENT '单价多个使用'',''隔开',
  `cart_total` varchar(50) NOT NULL COMMENT '总价多个使用'',''隔开',
  `cart_status` int(11) NOT NULL COMMENT '购物车状态:0未支付,已支付',
  `cart_time` int(11) NOT NULL COMMENT '加入时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车';

-- --------------------------------------------------------

--
-- 表的结构 `think_column`
--

CREATE TABLE IF NOT EXISTS `think_column` (
  `id` int(11) NOT NULL COMMENT '规则id,自增主键',
  `fid` int(11) NOT NULL COMMENT '父节点：0,为顶级',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '栏目中文名称',
  `name` char(20) NOT NULL DEFAULT '' COMMENT '栏目英文名称',
  `keywords` varchar(250) NOT NULL COMMENT '栏目关键词',
  `description` text NOT NULL COMMENT '栏目简单介绍',
  `banner` char(250) NOT NULL DEFAULT '' COMMENT '栏目Banner',
  `iamge` varchar(250) NOT NULL DEFAULT '' COMMENT '栏目图片',
  `ico` char(250) NOT NULL DEFAULT '' COMMENT '栏目图标',
  `position` int(1) NOT NULL DEFAULT '0' COMMENT '栏目位置：1头部，2中部，3左侧，4右侧，5底部',
  `date` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `type` int(1) NOT NULL COMMENT '类型:1列表页;2下载页;3单页面;4封面页;5表单页,6跳转页',
  `uri` varchar(150) NOT NULL DEFAULT ' ' COMMENT '跳转地址',
  `isnav` int(1) NOT NULL COMMENT '是否导航显示:0显示;1不显示',
  `effective` int(11) NOT NULL DEFAULT '0' COMMENT '栏目有效时间,在有效时间内会显示',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序：越小越靠前',
  `attach` varchar(500) NOT NULL COMMENT '参数扩展',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态：0正常，1禁用',
  `dates` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间'
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='栏目表';

--
-- 转存表中的数据 `think_column`
--

INSERT INTO `think_column` (`id`, `fid`, `title`, `name`, `keywords`, `description`, `banner`, `iamge`, `ico`, `position`, `date`, `type`, `uri`, `isnav`, `effective`, `sort`, `attach`, `status`, `dates`) VALUES
(1, 0, '移民蟹', 'migrate', '移民蟹', '移民蟹', '', '', '', 1, 1470377564, 1, '', 0, 0, 100, 'price,50', 0, 1470377564),
(2, 0, '外贸蟹', 'best', '外贸蟹', '外贸蟹', '', '', '', 1, 1470377464, 1, '', 0, 0, 100, 'price,400', 0, 1470377464),
(3, 0, '小众蟹', 'small', '小众蟹', '小众蟹', '', '', '', 1, 1470377282, 1, '', 0, 0, 100, 'price,120', 1, 1470377282),
(4, 0, '大众蟹', 'usually', '大众蟹', '大众蟹', '', '', '', 1, 1470377399, 1, '', 0, 0, 100, 'price,200', 0, 1470377399),
(5, 0, '红酒专区', 'redwine', '红酒专区', '红酒专区', '', '', '', 1, 1470381056, 1, '', 0, 0, 100, '', 0, 1470381056),
(10, 0, '红酒盒子', 'Boxes', '红酒盒子', '红酒盒子', '', '', '', 1, 1471834152, 1, '', 0, 0, 100, '', 0, 1471834152);

-- --------------------------------------------------------

--
-- 表的结构 `think_coupons`
--

CREATE TABLE IF NOT EXISTS `think_coupons` (
  `id` int(11) NOT NULL COMMENT '主键自增',
  `coupons_no` varchar(20) NOT NULL COMMENT '卡号',
  `coupons_title` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '主题',
  `coupons_name` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT '礼券名称',
  `coupons_type` int(11) NOT NULL COMMENT '礼券类型:0实物,1折扣,2现金',
  `coupons_val` varchar(20) CHARACTER SET utf32 NOT NULL COMMENT '礼券面值，实物券无',
  `coupon_cid` int(11) NOT NULL COMMENT '栏目',
  `coupon_content` text NOT NULL COMMENT '介绍',
  `coupons_status` int(11) NOT NULL COMMENT '礼券使用状态:0未发放,1已发放,2已使用,3实物够买',
  `coupons_date` int(11) NOT NULL COMMENT '礼券创建时间',
  `coupon_send` int(11) NOT NULL,
  `coupons_use_date` int(11) NOT NULL COMMENT '礼券使用时间',
  `coupons_use_user` varchar(50) NOT NULL COMMENT '礼券使用用户',
  `coupons_use_order` varchar(50) NOT NULL COMMENT '礼券使用订单'
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COMMENT='礼券表';

--
-- 转存表中的数据 `think_coupons`
--

INSERT INTO `think_coupons` (`id`, `coupons_no`, `coupons_title`, `coupons_name`, `coupons_type`, `coupons_val`, `coupon_cid`, `coupon_content`, `coupons_status`, `coupons_date`, `coupon_send`, `coupons_use_date`, `coupons_use_user`, `coupons_use_order`) VALUES
(1, 'NO.0000000001', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 2, 1471329214, 1471332597, 1471427270, '魏巍|13584866592', '2016081653575097'),
(2, 'NO.0000000002', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 2, 1471329214, 1471332597, 1471427046, '魏巍|13584866592', '2016081653575097'),
(3, 'NO.0000000003', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 1, 1471329214, 1471333514, 0, '', ''),
(4, 'NO.0000000004', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 1, 1471329214, 1471333514, 0, '', ''),
(5, 'NO.0000000005', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 1, 1471329214, 1471333744, 0, '', ''),
(6, 'NO.0000000006', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 1, 1471329214, 1471334745, 0, '', ''),
(7, 'NO.0000000007', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 1, 1471329214, 1471337060, 0, '', ''),
(8, 'NO.0000000008', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 0, 1471329214, 0, 0, '', ''),
(9, 'NO.0000000009', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 0, 1471329214, 0, 0, '', ''),
(10, 'NO.0000000010', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 0, 1471329214, 0, 0, '', ''),
(11, 'NO.0000000011', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 0, 1471329214, 0, 0, '', ''),
(12, 'NO.0000000012', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 0, 1471329214, 0, 0, '', ''),
(13, 'NO.0000000013', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 0, 1471329214, 0, 0, '', ''),
(14, 'NO.0000000014', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 0, 1471329214, 0, 0, '', ''),
(15, 'NO.0000000015', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 0, 1471329214, 0, 0, '', ''),
(16, 'NO.0000000016', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 0, 1471329214, 0, 0, '', ''),
(17, 'NO.0000000017', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 0, 1471329214, 0, 0, '', ''),
(18, 'NO.0000000018', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 0, 1471329214, 0, 0, '', ''),
(19, 'NO.0000000019', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 3, 1471329214, 0, 0, '', ''),
(20, 'NO.0000000020', '8只大众蟹豪华礼券', 'migrate', 0, '1|migrate|移民蟹', 1, '8只大众蟹豪华礼券', 3, 1471329214, 0, 0, '', ''),
(21, 'NO.0000000021', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599221, 0, 0, '', ''),
(22, 'NO.0000000022', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599221, 0, 0, '', ''),
(23, 'NO.0000000023', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599221, 0, 0, '', ''),
(24, 'NO.0000000024', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599221, 0, 0, '', ''),
(25, 'NO.0000000025', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599221, 0, 0, '', ''),
(26, 'NO.0000000026', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599221, 0, 0, '', ''),
(27, 'NO.0000000027', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599221, 0, 0, '', ''),
(28, 'NO.0000000028', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599221, 0, 0, '', ''),
(29, 'NO.0000000029', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599221, 0, 0, '', ''),
(30, 'NO.0000000030', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599221, 0, 0, '', ''),
(31, 'NO.0000000031', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(32, 'NO.0000000032', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(33, 'NO.0000000033', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(34, 'NO.0000000034', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(35, 'NO.0000000035', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(36, 'NO.0000000036', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(37, 'NO.0000000037', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(38, 'NO.0000000038', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(39, 'NO.0000000039', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(40, 'NO.0000000040', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(41, 'NO.0000000041', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(42, 'NO.0000000042', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(43, 'NO.0000000043', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(44, 'NO.0000000044', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(45, 'NO.0000000045', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(46, 'NO.0000000046', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(47, 'NO.0000000047', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(48, 'NO.0000000048', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(49, 'NO.0000000049', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(50, 'NO.0000000050', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(51, 'NO.0000000051', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(52, 'NO.0000000052', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(53, 'NO.0000000053', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(54, 'NO.0000000054', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(55, 'NO.0000000055', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(56, 'NO.0000000056', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(57, 'NO.0000000057', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(58, 'NO.0000000058', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(59, 'NO.0000000059', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(60, 'NO.0000000060', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(61, 'NO.0000000061', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(62, 'NO.0000000062', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(63, 'NO.0000000063', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(64, 'NO.0000000064', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(65, 'NO.0000000065', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(66, 'NO.0000000066', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(67, 'NO.0000000067', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(68, 'NO.0000000068', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(69, 'NO.0000000069', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(70, 'NO.0000000070', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(71, 'NO.0000000071', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(72, 'NO.0000000072', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(73, 'NO.0000000073', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(74, 'NO.0000000074', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(75, 'NO.0000000075', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(76, 'NO.0000000076', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(77, 'NO.0000000077', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(78, 'NO.0000000078', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(79, 'NO.0000000079', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(80, 'NO.0000000080', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(81, 'NO.0000000081', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(82, 'NO.0000000082', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(83, 'NO.0000000083', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(84, 'NO.0000000084', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(85, 'NO.0000000085', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(86, 'NO.0000000086', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(87, 'NO.0000000087', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(88, 'NO.0000000088', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(89, 'NO.0000000089', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(90, 'NO.0000000090', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(91, 'NO.0000000091', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(92, 'NO.0000000092', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(93, 'NO.0000000093', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(94, 'NO.0000000094', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(95, 'NO.0000000095', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(96, 'NO.0000000096', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(97, 'NO.0000000097', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(98, 'NO.0000000098', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(99, 'NO.0000000099', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(100, 'NO.0000000100', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(101, 'NO.0000000101', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(102, 'NO.0000000102', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(103, 'NO.0000000103', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(104, 'NO.0000000104', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(105, 'NO.0000000105', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(106, 'NO.0000000106', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(107, 'NO.0000000107', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(108, 'NO.0000000108', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(109, 'NO.0000000109', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(110, 'NO.0000000110', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(111, 'NO.0000000111', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(112, 'NO.0000000112', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(113, 'NO.0000000113', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(114, 'NO.0000000114', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(115, 'NO.0000000115', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(116, 'NO.0000000116', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(117, 'NO.0000000117', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(118, 'NO.0000000118', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(119, 'NO.0000000119', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', ''),
(120, 'NO.0000000120', '外贸蟹礼品券', 'best', 0, '6|best|外贸蟹', 2, '外贸蟹礼品券', 0, 1471599251, 0, 0, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `think_express`
--

CREATE TABLE IF NOT EXISTS `think_express` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `order_no` varchar(50) NOT NULL COMMENT '订单号',
  `express_mall` varchar(50) NOT NULL COMMENT '购买人信息',
  `express_geter` varchar(50) NOT NULL COMMENT '收货人信息',
  `express_title` varchar(50) NOT NULL COMMENT '快递公司',
  `express_no` varchar(50) NOT NULL COMMENT '快递单号',
  `express_type` int(11) NOT NULL COMMENT '快递类型:0购买,1兑换',
  `express_status` int(11) NOT NULL COMMENT '状态;0未发送,1已发送,2已接受',
  `express_create` int(11) NOT NULL COMMENT '创建时间',
  `express_send` int(11) NOT NULL COMMENT '发送时间'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='快递信息';

--
-- 转存表中的数据 `think_express`
--

INSERT INTO `think_express` (`id`, `orderid`, `order_no`, `express_mall`, `express_geter`, `express_title`, `express_no`, `express_type`, `express_status`, `express_create`, `express_send`) VALUES
(9, 1, '2016081510098579', '魏巍|13584866592', '魏巍|13584866592|江苏省-苏州市-姑苏区|苏锦一村百合苑', '', '', 0, 0, 1471227997, 0),
(10, 1, '2016081549485056', '魏巍|13584866592', '魏巍|13584866592|江苏省-苏州市-姑苏区|苏锦一村百合苑', '', '', 0, 0, 1471229185, 0),
(11, 1, '2016081553100569', '魏巍|13584866592', '魏巍|13584866592|江苏省,苏州市,姑苏区|苏锦一村百合苑', '', '', 0, 0, 1471254533, 0),
(12, 1, '2016081555971029', '魏巍|13584866592', '魏巍|13584866592|江苏省,苏州市,姑苏区|苏锦一村百合苑', '', '', 0, 0, 1471254583, 0),
(13, 1, '2016081554485751', '魏巍|13584866592', '魏巍|13584866592|江苏省,苏州市,姑苏区|苏锦一村百合苑', '', '', 0, 0, 1471254918, 0);

-- --------------------------------------------------------

--
-- 表的结构 `think_flink`
--

CREATE TABLE IF NOT EXISTS `think_flink` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '规则id,自增主键',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '友情链接中文名称',
  `name` char(20) NOT NULL DEFAULT '' COMMENT '友情链接英文名称',
  `description` char(250) NOT NULL DEFAULT '' COMMENT '友情链接简单介绍',
  `ico` char(250) NOT NULL DEFAULT '' COMMENT '友情链接图标',
  `uri` char(250) NOT NULL DEFAULT '' COMMENT '友情链接链接指向,链接到的地址',
  `position` int(1) NOT NULL DEFAULT '0' COMMENT '友情链接位置：1首页，2内页',
  `date` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `effective` varchar(150) NOT NULL DEFAULT '0' COMMENT '友情链接有效时间,在有效时间内会显示',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序：越小越靠前',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态：0正常，1禁用'
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='友情链接表';

--
-- 转存表中的数据 `think_flink`
--

INSERT INTO `think_flink` (`id`, `title`, `name`, `description`, `ico`, `uri`, `position`, `date`, `effective`, `sort`, `status`) VALUES
(7, '', '', '', '', '', 0, 0, '0', 0, 0),
(8, '', '', '', '', '', 0, 0, '0', 0, 0),
(9, '', '', '', '', '', 0, 0, '0', 0, 0),
(10, '', '', '', '', '', 0, 0, '0', 0, 0),
(11, '', '', '', '', '', 0, 0, '0', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `think_kefu`
--

CREATE TABLE IF NOT EXISTS `think_kefu` (
  `id` int(11) NOT NULL COMMENT '主键自增长',
  `qq` varchar(20) NOT NULL COMMENT 'QQ号',
  `name` varchar(50) NOT NULL COMMENT '客服名',
  `status` int(11) NOT NULL COMMENT '状态:0正常,1禁用',
  `time` int(11) NOT NULL COMMENT '时间戳'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客服表';

--
-- 转存表中的数据 `think_kefu`
--

INSERT INTO `think_kefu` (`id`, `qq`, `name`, `status`, `time`) VALUES
(1, '1173989924', '客服-小白', 0, 1464663213),
(2, '2371934114', '客服-小许', 0, 1464663207),
(3, '2880672180', '客服-老翟', 0, 1464663199),
(4, '1339858962', 'VIP-高跃', 0, 1464663176);

-- --------------------------------------------------------

--
-- 表的结构 `think_member`
--

CREATE TABLE IF NOT EXISTS `think_member` (
  `id` int(11) NOT NULL COMMENT '主键，自动增长',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `qq` varchar(20) NOT NULL COMMENT 'qq',
  `tel` varchar(50) NOT NULL COMMENT '联系方式',
  `address` varchar(150) NOT NULL COMMENT '详细地址',
  `type` int(11) NOT NULL COMMENT '用户类型:0个人1企业',
  `real_name` varchar(50) NOT NULL COMMENT '个人/企业真实名称',
  `banlace` decimal(10,0) NOT NULL COMMENT '提现总额',
  `jifen` int(11) NOT NULL COMMENT '积分',
  `pmun` int(11) NOT NULL COMMENT '产品数量',
  `create_time` int(11) NOT NULL COMMENT '注册时间',
  `time` int(11) NOT NULL COMMENT '时间戳',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：1禁用,0启用',
  `last_login_time` int(11) NOT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(20) NOT NULL COMMENT '最后登录ip'
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- --------------------------------------------------------

--
-- 表的结构 `think_model`
--

CREATE TABLE IF NOT EXISTS `think_model` (
  `id` int(11) NOT NULL COMMENT '主键',
  `fid` int(11) NOT NULL COMMENT '父节点：0,为顶级',
  `title` varchar(30) NOT NULL COMMENT '英文标识',
  `name` varchar(50) NOT NULL COMMENT '中文名',
  `contr_name` varchar(50) NOT NULL COMMENT '控制器名',
  `info` varchar(250) NOT NULL COMMENT '简介',
  `url` varchar(250) NOT NULL COMMENT '地址',
  `ico` varchar(50) NOT NULL COMMENT '图标',
  `pic` varchar(500) NOT NULL COMMENT '控制器图片',
  `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序,越小越靠前',
  `show` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示导航,0显示,1不显示',
  `status` int(10) NOT NULL COMMENT '状态:0正常,1锁定',
  `date` int(10) NOT NULL COMMENT '添加日期',
  `dates` int(10) NOT NULL COMMENT '修改日期'
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='控制器';

--
-- 转存表中的数据 `think_model`
--

INSERT INTO `think_model` (`id`, `fid`, `title`, `name`, `contr_name`, `info`, `url`, `ico`, `pic`, `sort`, `show`, `status`, `date`, `dates`) VALUES
(1, 0, 'Member', '用户管理', 'Member', '用户管理', '/Admin/Member', '', '', 100, 0, 1, 0, 0),
(2, 0, 'Product', '产品管理', 'Product', '产品管理', '/Admin/Product', '', '', 100, 0, 1, 0, 0),
(3, 0, 'Column', '栏目管理', 'Column', '栏目管理', '/Admin/Column', '', '', 100, 0, 0, 0, 0),
(4, 0, 'Balance', '订单管理', 'Balance', '订单管理', '/Admin/Balance', '', '', 100, 0, 1, 0, 0),
(5, 0, 'Admin', '账号管理', 'Admin', '账号管理', '/Admin/Admin', '', '', 100, 0, 0, 0, 0),
(6, 0, 'Flink', '友情链接', 'Flink', '友情链接', '/Admin/Flink', '', '', 100, 0, 1, 0, 0),
(7, 0, 'Kefu', '客服管理', 'Kefu', '客服管理', '/Admin/Kefu', '', '', 100, 0, 1, 0, 0),
(8, 0, 'Coupons', '礼券管理', 'Coupons', '礼券管理', '/Admin/Coupons', '', '', 100, 0, 0, 0, 0),
(10, 0, 'Wine', '酒水订单', 'Wine', '酒水订单', '/Admin/Wine', '', '', 100, 0, 0, 0, 0),
(9, 0, 'Order', '订单管理', 'Order', '订单管理', '/Admin/Order', '', '', 100, 0, 0, 0, 0),
(11, 0, 'Goods', '产品订单', 'Goods', '产品订单', '/Admin/Goods', '', '', 100, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `think_order`
--

CREATE TABLE IF NOT EXISTS `think_order` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL COMMENT ' 购买者userid',
  `username` varchar(255) DEFAULT NULL COMMENT ' 购买者姓名',
  `phone` varchar(15) NOT NULL COMMENT '手机号',
  `ordid` varchar(255) DEFAULT NULL COMMENT '订单号',
  `ordtime` int(11) DEFAULT NULL COMMENT '订单时间',
  `finishtime` int(11) NOT NULL COMMENT '订单完成时间',
  `productid` varchar(150) DEFAULT NULL COMMENT '产品ID',
  `ordtitle` varchar(255) DEFAULT NULL COMMENT '订单标题',
  `ordbuynum` int(11) DEFAULT '0' COMMENT '购买数量',
  `sums` varchar(150) NOT NULL,
  `ordprice` float(10,2) DEFAULT '0.00' COMMENT '产品单价',
  `ordfee` float(10,2) DEFAULT '0.00' COMMENT '订单总金额',
  `ordstatus` int(11) DEFAULT '0' COMMENT '订单状态',
  `payment_type` varchar(255) DEFAULT NULL COMMENT '支付类型',
  `wine` varchar(250) NOT NULL COMMENT '酒水信息',
  `payment_trade_no` varchar(255) DEFAULT NULL COMMENT '支付接口交易号',
  `payment_trade_status` varchar(255) DEFAULT NULL COMMENT '支付接口返回的交易状态',
  `payment_notify_id` varchar(255) DEFAULT NULL COMMENT '异步推送ID',
  `payment_notify_time` varchar(255) DEFAULT NULL COMMENT '异步推送时间',
  `payment_buyer_email` varchar(255) DEFAULT NULL COMMENT '购买者帐号',
  `ordcode` varchar(255) DEFAULT NULL COMMENT '二维码',
  `isused` int(11) DEFAULT '0',
  `usetime` int(11) DEFAULT NULL,
  `checkuser` int(11) DEFAULT NULL,
  `shun_feng` int(11) NOT NULL COMMENT '快递费用0已付,1到付',
  `post_address` varchar(200) NOT NULL COMMENT '邮寄地址',
  `post_status` int(11) NOT NULL COMMENT '发送状态:0未发送,1已发送,2已完成',
  `post_userinfo` varchar(50) NOT NULL COMMENT '接收人信息',
  `post_goods_express` varchar(500) NOT NULL COMMENT '产品快递公司信息',
  `post_goods_time` int(11) NOT NULL,
  `post_wine_express` varchar(50) NOT NULL COMMENT '酒水快递公司',
  `post_wine_time` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `think_order`
--

INSERT INTO `think_order` (`id`, `userid`, `username`, `phone`, `ordid`, `ordtime`, `finishtime`, `productid`, `ordtitle`, `ordbuynum`, `sums`, `ordprice`, `ordfee`, `ordstatus`, `payment_type`, `wine`, `payment_trade_no`, `payment_trade_status`, `payment_notify_id`, `payment_notify_time`, `payment_buyer_email`, `ordcode`, `isused`, `usetime`, `checkuser`, `shun_feng`, `post_address`, `post_status`, `post_userinfo`, `post_goods_express`, `post_goods_time`, `post_wine_express`, `post_wine_time`) VALUES
(9, NULL, '魏巍', '13584866592', '2016081652555398', 1471330724, 1471330789, 'wine_2,wine_3,goods_1,coupon_1', NULL, 7, 'wine_2_2_499.00|wine_3_2_89.00|goods_1_1_499.00|coupon_1_2_499.00', 0.00, 2800.00, 1, 'alipay', '', NULL, 'TRADE_SUCCESS', 'RqPnCoPT3K9%2Fvwbh3InWf07kJ8Z46QupbDVSWFn4CpBRZRBoqtr3XwQ%2BcYm5Bpa9%2FeVV', '1471330740', '524314430@qq.com', '', 0, NULL, NULL, 0, '江苏省-苏州市-姑苏区 苏锦一村白兰苑', 0, '魏巍|13584866592', '', 0, '', 0),
(10, NULL, '魏巍', '13584866592', '2016081610156991', 1471331998, 0, 'wine_2,coupon_1', NULL, 4, 'wine_2_2_499.00|coupon_1_2_499.00', 0.00, 1996.00, 2, NULL, '', NULL, NULL, NULL, NULL, NULL, '', 0, NULL, NULL, 0, '广西壮族-贵港市-港南区 恩恩', 0, '魏巍|13584866592', '', 0, '', 0),
(11, NULL, '魏巍', '13584866592', '2016081653575097', 1471332597, 1471332653, 'wine_2,coupon_1', NULL, 4, 'wine_2_2_499.00|coupon_1_2_499.00', 0.00, 1996.00, 1, 'alipay', '', NULL, 'TRADE_SUCCESS', 'RqPnCoPT3K9%2Fvwbh3InWf07kJbBe6xMrcH49k1%2FYWnPzVy4p%2BrwGMwvdCyWtiZ%2BmqmRA', '1471332604', '524314430@qq.com', 'd_1,d_2', 0, NULL, NULL, 0, '江苏省-苏州市-姑苏区 苏锦一村白兰苑', 0, '魏巍|13584866592', '', 0, '', 0),
(12, NULL, '魏巍', '13584866592', '2016081697100102', 1471333514, 1471333569, 'wine_3,wine_2,goods_1,coupon_1', NULL, 8, 'wine_3_2_89.00|wine_2_2_499.00|goods_1_2_499.00|coupon_1_2_499.00', 0.00, 3418.00, 1, 'alipay', '', NULL, 'TRADE_SUCCESS', 'RqPnCoPT3K9%2Fvwbh3InWf07kJPGvlj6XDofUCvHUgbsEAQj0%2BGGRxT0ZHkQAJIyUSTCs', '1471333520', '15371829847', '3,4', 0, NULL, NULL, 0, '江苏省-苏州市-姑苏区 苏锦一村白兰玉', 0, '魏巍|13584866592', '', 0, '', 0),
(13, NULL, '魏巍', '13584866592', '2016081648511015', 1471333744, 1471333785, 'wine_2,coupon_1', NULL, 2, 'wine_2_1_499.00|coupon_1_1_499.00', 0.00, 998.00, 1, 'alipay', '', NULL, 'TRADE_SUCCESS', 'RqPnCoPT3K9%2Fvwbh3InWf07kJPPbMTCbjY3ipUdeiptGV5B5TdfiKnRM0KLBmUmX5txf', '1471333736', '15371829847', '5', 0, NULL, NULL, 0, '江苏省-苏州市-姑苏区 苏锦一村百合苑', 1, '魏巍|13584866592', '2222233444444', 1471576908, '', 0),
(14, NULL, '魏巍', '13584866592', '2016081697994857', 1471333930, 1471333971, 'goods_1', NULL, 2, 'goods_1_2_499.00', 0.00, 1244.00, 1, 'alipay', '', NULL, 'TRADE_SUCCESS', 'RqPnCoPT3K9%2Fvwbh3InWf07kJP1jK77PfljRTGFlgcMBAKECisFL7ikGh7cUH%2FzrK5O%2B', '1471333922', '15371829847', NULL, 0, NULL, NULL, 0, '江苏省-苏州市-虎丘区 景山路旭辉御府4幢1203', 1, '魏巍|13584866592', '2222222222222', 1471576613, '', 0),
(15, NULL, '魏巍', '15371829847', '2016081657100545', 1471334745, 1471334794, 'coupon_1', NULL, 1, 'coupon_1_1_499.00', 0.00, 499.00, 1, 'alipay', '', NULL, 'TRADE_SUCCESS', 'RqPnCoPT3K9%2Fvwbh3InWf07kI%2B%2Bn5EvXr3Uhzj2wcTluGJZ1%2BnHu2o6AOEtsZV6bjoh5', '1471334745', '15371829847', '6', 0, NULL, NULL, 1, '江苏省-苏州市-虎丘区 景山路旭辉御府', 1, '张勇|15371829847', '03365566222', 1471577043, '', 0),
(16, NULL, '张勇', '15371829847', '2016081652565748', 1471337060, 1471337120, 'coupon_1', NULL, 1, 'coupon_1_1_499.00', 0.00, 499.00, 1, 'alipay', '', NULL, 'TRADE_SUCCESS', 'RqPnCoPT3K9%2Fvwbh3InWf07kILqEq1IzSUHRZDy3TIW6dBvhuOQKjhQkqnb2FlYI3%2F5h', '1471337069', '15371829847', '7', 0, NULL, NULL, 0, '江苏省-苏州市-虎丘区 景山路旭辉御府', 1, '张勇|15371829847', '0111233300', 1471498087, '', 0),
(17, NULL, '魏巍', '13584866592', '2016081754575757', 1471427046, 1471427046, '2', NULL, 1, '', 0.00, 0.00, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 0, '北京市_市辖区_东城区|董各庄', 0, '魏巍|13584866592', '', 0, '', 0),
(18, NULL, '魏巍', '13584866592', '2016081754545651', 1471427270, 1471427270, '1', NULL, 1, '', 0.00, 0.00, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 0, '北京市_市辖区_东城区|平西王府西', 0, '魏巍|13584866592', '', 0, '', 0),
(23, NULL, '魏巍', '13584866592', '2016081951499756', 1471600243, 0, 'goods_1,goods_6', NULL, 2, 'goods_1_1_499.00|goods_6_1_249.00', 0.00, 787.00, 2, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '江苏省-苏州市-姑苏区 苏锦一村白兰苑', 0, '魏巍|13584866592', '', 0, '', 0),
(22, NULL, '魏巍', '13584866592', '2016081856541001', 1471500792, 0, 'wine_3,wine_4', NULL, 3, 'wine_3_1_89.00|wine_4_2_39.00', 0.00, 167.00, 2, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '北京市,市辖区,东城区 www', 0, '魏巍|13584866592', '', 0, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `think_address`
--
ALTER TABLE `think_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_admin`
--
ALTER TABLE `think_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gid` (`gid`);

--
-- Indexes for table `think_advert`
--
ALTER TABLE `think_advert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_article`
--
ALTER TABLE `think_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_cart`
--
ALTER TABLE `think_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_column`
--
ALTER TABLE `think_column`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `think_coupons`
--
ALTER TABLE `think_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_express`
--
ALTER TABLE `think_express`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_flink`
--
ALTER TABLE `think_flink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_kefu`
--
ALTER TABLE `think_kefu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_member`
--
ALTER TABLE `think_member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `think_model`
--
ALTER TABLE `think_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_order`
--
ALTER TABLE `think_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `think_address`
--
ALTER TABLE `think_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键，自动增长';
--
-- AUTO_INCREMENT for table `think_admin`
--
ALTER TABLE `think_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键,自增长',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `think_advert`
--
ALTER TABLE `think_advert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增长';
--
-- AUTO_INCREMENT for table `think_article`
--
ALTER TABLE `think_article`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `think_cart`
--
ALTER TABLE `think_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增';
--
-- AUTO_INCREMENT for table `think_column`
--
ALTER TABLE `think_column`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `think_coupons`
--
ALTER TABLE `think_coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增',AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `think_express`
--
ALTER TABLE `think_express`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `think_flink`
--
ALTER TABLE `think_flink`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `think_member`
--
ALTER TABLE `think_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键，自动增长',AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `think_model`
--
ALTER TABLE `think_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `think_order`
--
ALTER TABLE `think_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
