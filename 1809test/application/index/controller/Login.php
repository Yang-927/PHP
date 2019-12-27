<?php
namespace app\index\controller;

use \think\Controller;
use app\index\model\Users;//引入Users模型
use \think\Session;//引入session会话

class Login extends Controller
{
	/*
		渲染登录页面
		石
		20191011
	 */
    public function login()
    {
    	//echo $_SERVER['SERVER_NAME'];die;
        return $this->fetch('login');
    }
    /*
		注册页面
		石
		20191014
	 */
    public function reg(){
        return $this->fetch('register');
    }
     /*
		忘记密码页面
		石
		20191017
	 */
	public function forget_pwd(){
		$users = new Users;
		//1、获取数据并确认数据不能为空
		$return_data = [];
    	$data = $_POST;
    	if($data){

	    	if (!$data['user_name']) {
	    		//错误页面的默认跳转页面是返回前一页，通常不需要设置
	    		//$this->error(错误提示,要跳转的路径);
	            $return_data['error_code'] = 1;
	            $return_data['error_msg'] = "用户名不能为空";
	            return $return_data;
	    	}
	    	if (!$data['pwd']) {
	    		$return_data['error_code'] = 1;
	            $return_data['error_msg'] = "密码不能为空";
	            return $return_data;
	    	}
	    	if (!$data['repwd']) {
	    		$return_data['error_code'] = 1;
	            $return_data['error_msg'] = "确认密码不能为空";
	            return $return_data;
	    	}
			/*
	    		用户名正则匹配
	    	 */
	    	$user_name_flag = '/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]{2,8}$/u';
	    	if(!preg_match($user_name_flag,$data['user_name'])){
	    		$return_data['error_code'] = 1;
	            $return_data['error_msg'] = "用户名应该由4-8位汉字、数字、字母组成";
	            return $return_data;
	    	}

	    	/*
	    		正则格式  以 /^ 开头	以$/结尾
	    		php中正则表达式必须加引号
	    		\w 小写、大写字母,数字,_
	    		知识扩充1:在word中总结正则符号的含义
	    	 */
			$pwd_flag="/^(\w){6,16}$/";//密码的正则
			if(!preg_match($pwd_flag, $data['pwd'])){
				$return_data['error_code'] = 1;
	            $return_data['error_msg'] = "密码应以数字、字母组成，长度6-16位";
	            return $return_data;
			}
			if(!preg_match($pwd_flag, $data['repwd'])){
				$return_data['error_code'] = 1;
	            $return_data['error_msg'] = "确认密码应以数字、字母组成，长度6-16位";
	            return $return_data;
			}
			//判断密码与确认密码是否相同
	    	if($data['pwd'] !== $data['repwd']){
				$return_data['error_code'] = 1;
	            $return_data['error_msg'] = "密码与确认密码不相同";
	            return $return_data;
	    	}
			//判断用户是否已经注册
			$user_info = $users->getUser($data['user_name']);
			if(empty($user_info)){
				$return_data['error_code'] = 1;
	            $return_data['error_msg'] = "请您先注册用户";
	            return $return_data;
			}
			//将修改完的密码保存入库
			$data['pwd'] = md5($data['pwd']);
			unset($data['repwd']);
			$res = $users->updateData($data);
			if($res){
				$return_data['error_code'] = 0;
	            $return_data['error_msg'] = "密码修改成功";
	            return $return_data;
			}else{
				$return_data['error_code'] = 1;
	            $return_data['error_msg'] = "密码修改失败";
	            return $return_data;
			}
		}
		return $this->fetch('forget_pwd');
	}

    public function checkInfo(){
    	//var_dump($_POST);//打印接收的数d据
    	$return_data = [];
    	$data = $_POST;
    	if (!$data['user_name']) {
    		//错误页面的默认跳转页面是返回前一页，通常不需要设置
    		//$this->error(错误提示,要跳转的路径);
            $return_data['error_code'] = 1;
            $return_data['error_msg'] = "用户名不能为空";
            return $return_data;
    	}
    	if (!$data['pwd']) {
    		$return_data['error_code'] = 1;
            $return_data['error_msg'] = "密码不能为空";
            return $return_data;
    	}
    	if (!$data['repwd']) {
    		$return_data['error_code'] = 1;
            $return_data['error_msg'] = "确认密码不能为空";
            return $return_data;
    	}
    	if (!$data['mobile']) {
    		$return_data['error_code'] = 1;
            $return_data['error_msg'] = "手机号不能为空";
            return $return_data;
    	}
    	// if (!$data['code']) {
    	// 	$return_data['error_code'] = 1;
     //        $return_data['error_msg'] = "验证码不能为空";
     //        return $return_data;
    	// }
    	/*
    		用户名正则匹配
    	 */
    	$user_name_flag = '/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]{2,8}$/u';
    	if(!preg_match($user_name_flag,$data['user_name'])){
    		$return_data['error_code'] = 1;
            $return_data['error_msg'] = "用户名应该由4-8位汉字、数字、字母组成";
            return $return_data;
    	}

    	/*
    		正则格式  以 /^ 开头	以$/结尾
    		php中正则表达式必须加引号
    		\w 小写、大写字母,数字,_
    		知识扩充1:在word中总结正则符号的含义
    	 */
		$pwd_flag="/^(\w){6,16}$/";//密码的正则
		if(!preg_match($pwd_flag, $data['pwd'])){
			$return_data['error_code'] = 1;
            $return_data['error_msg'] = "密码应以数字、字母组成，长度6-16位";
            return $return_data;
		}
		if(!preg_match($pwd_flag, $data['repwd'])){
			$return_data['error_code'] = 1;
            $return_data['error_msg'] = "确认密码应以数字、字母组成，长度6-16位";
            return $return_data;
		}
		/*
			[] 代表其中任意一个
			\d 代表数字0-9
		 */
		$mobile_flag = "/^1[3456789]\d{9}$/";
		if(!preg_match($mobile_flag,$data['mobile'])){
			$return_data['error_code'] = 1;
            $return_data['error_msg'] = "请输入11位正确的手机号";
            return $return_data;
		}
		/*
    		验证码验证
    	 */
  //   	if(!captcha_check($data['code'])){
 	// 		$return_data['error_code'] = 1;
  //           $return_data['error_msg'] = "验证码输入有误，请重新输入";
  //           return $return_data;
		// };
    	//判断密码与确认密码是否相同
    	if($data['pwd'] !== $data['repwd']){
			$return_data['error_code'] = 1;
            $return_data['error_msg'] = "密码与确认密码不相同";
            return $return_data;
    	}    	
    	//判断此用户是否已经注册
    	$users = new Users;
    	//如果此方法获取到数据，说明用户已注册
    	//如果获取到NULL，说明可以注册
    	if($users->getUser($data['user_name'])){
			$return_data['error_code'] = 1;
            $return_data['error_msg'] = "此用户已注册";
            return $return_data;
    	}

    	//$data 数据处理
    	unset($data['repwd']);
    	unset($data['code']);
    	$data['pwd'] = md5($data['pwd']);
    	$data['add_time'] = time();
    	//将数据传入到添加数据方法中，从而保存入库
    	$res = $users->insterData($data);
		if($res){
			$return_data['error_code'] = 0;
            $return_data['error_msg'] = "注册成功";
            return $return_data;
		}else{
			$return_data['error_code'] = 1;
            $return_data['error_msg'] = "注册失败";
            return $return_data;
		}
    }
	/*
    	登录，检测用户名密码是否正确
     */
    public function checkUserInfo(){
    	$users = new Users;
    	//1、获取数据
    	//var_dump($_POST);
    	//2、非空判断
    	$return_data = [];
    	$data = $_POST;
    	if (!$data['user_name']) {
    		//错误页面的默认跳转页面是返回前一页，通常不需要设置
    		//$this->error(错误提示,要跳转的路径);
            $return_data['error_code'] = 1;
            $return_data['error_msg'] = "用户名不能为空";
            return $return_data;
    	}
    	if (!$data['pwd']) {
    		$return_data['error_code'] = 1;
            $return_data['error_msg'] = "密码不能为空";
            return $return_data;
    	}
    	// if (!$data['code']) {
    	// 	$return_data['error_code'] = 1;
     //        $return_data['error_msg'] = "验证码不能为空";
     //        return $return_data;
    	// }
    	//3、正则验证
    	/*
    		用户名正则匹配
    	 */
    	$user_name_flag = '/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]{2,8}$/u';
    	if(!preg_match($user_name_flag,$data['user_name'])){
    		$return_data['error_code'] = 1;
            $return_data['error_msg'] = "用户名应该由4-8位汉字、数字、字母组成";
            return $return_data;
    	}
    	/*
    		正则格式  以 /^ 开头	以$/结尾
    		php中正则表达式必须加引号
    		\w 小写、大写字母,数字,_
    		知识扩充1:在word中总结正则符号的含义
    	 */
		$pwd_flag="/^(\w){6,16}$/";//密码的正则
		if(!preg_match($pwd_flag, $data['pwd'])){
			$return_data['error_code'] = 1;
            $return_data['error_msg'] = "密码应以数字、字母组成，长度6-16位";
            return $return_data;
		}
		/*
    		验证码验证
    	 */
  //   	if(!captcha_check($data['code'])){
 	// 		$return_data['error_code'] = 1;
  //           $return_data['error_msg'] = "验证码输入有误，请重新输入";
  //           return $return_data;
		// };
		//4、判断用户是否已经注册
		$user_info = $users->getUser($data['user_name']);
		if(empty($user_info)){
			$return_data['error_code'] = 1;
            $return_data['error_msg'] = "请您先注册用户";
            return $return_data;
		}
		//5、判断输入的密码是否与数据库中此用户的密码匹配，如果匹配，登录成功;不匹配，则提醒用户重新输入
		$data['pwd'] = md5($data['pwd']);
		if($data['pwd'] !== $user_info['pwd']){
			$return_data['error_code'] = 1;
            $return_data['error_msg'] = "您输入的密码有误，请重新输入";
            return $return_data;
		}else{
			Session::set('user_name',$user_info['user_name']);
			Session::set('id',$user_info['id']);
			$return_data['error_code'] = 0;
            $return_data['error_msg'] = "恭喜您，登录成功";
            return $return_data;
		}
    }
    /*
    	如果访问空方法，则访问此方法
     */
    public function _empty(){
    	return $this->fetch('error');
    }

    public function qqLogin(){
    	$app_id = '101811958';
    	$app_key = 'aded61f2bf76dc5448e26f3e007e9840';

	   	//【成功授权】后的回调地址，即此地址在腾讯的信息中有储存
   		$my_url = "/index/Login/callback";
  
   		//Step1：获取Authorization Code
   		session_start();
   		$code = !empty($_REQUEST["code"])?$_REQUEST["code"]:'';//存放Authorization Code
   		if(empty($code))
   		{
    	//state参数用于防止CSRF攻击，成功授权后回调时会原样带回
    	$_SESSION['state'] = md5(uniqid(rand(), TRUE));
    	//拼接URL
    	$dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
     . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
     . $_SESSION['state'];
    echo("<script> top.location.href='" . $dialog_url . "'</script>");

    	}
	}


    // public function sub_curl($url,$post_data=[]){
    //    $curl = curl_init();
    //    //设置提交的url
    //    curl_setopt($curl, CURLOPT_URL, $url);
    //    //设置头文件的信息作为数据流输出
    //    curl_setopt($curl, CURLOPT_HEADER, 0);
    //    //设置获取的信息以文件流的形式返回，而不是直接输出。
    //    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //    //设置post方式提交
    //    curl_setopt($curl, CURLOPT_POST, 1);
    //    //设置post数据
    //    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
    //    //设置curl总执行动作的最长秒数，如果设置为0，则无限
    //    curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    //    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    //    //执行命令
    //    $data = curl_exec($curl);
    //    //关闭URL请求
    //    curl_close($curl);
    //    //获得数据并返回
    //    return $data;
   	// }
}
