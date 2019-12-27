<?php 
    namespace app\index\controller;

    use \think\Controller;

    use app\index\model\Users;  // 引入Users模型

    use \think\Session;    // 引入Session会话
    class Login extends Controller
    {
        /*
            登录页面
            YANG
            20191014
         */
        public function login(){
            return $this -> fetch('login');

            
        }
        /*
            注册页面
            YANG
            20191014
         */
        public function register(){
            return $this ->fetch('register');
        }

        public function forget_pwd(){

            // 获取数据
            $data = $_POST;
            $return_data = [];
            $users = new Users;
            if ($data) {
                if (!$data['user_name']) {
                    $return_data['error_code'] = 1;
                    $return_data['error_msg'] ='用户名不能为空';
                    return $return_data;
                }

                if (!$data['password']) {
                    $return_data['error_code'] = 1;
                    $return_data['error_msg'] ='密码不能为空';
                    return $return_data;
                }

                if (!$data['repwd']) {
                    $return_data['error_code'] = 1;
                    $return_data['error_msg'] ='确认密码不能为空';
                    return $return_data;
                }

                $user_name_flag = "/^[A-Za_z0-9_\x{4e00}-\x{9fa5}]{2,8}$/u";
                if(!preg_match($user_name_flag,$data['user_name'])){
                    $return_data['error_code'] = 1;
                    $return_data['error_msg'] ='用户名至少由2-8位汉字组成或者由2-16位数字、字母组成';
                    return $return_data;
                }

                $pwd_flag="/^(\w){6,16}$/";//密码的正则
                if(!preg_match($pwd_flag,$data['password'])){
                    $return_data['error_code'] = 1;
                    $return_data['error_msg'] ='密码应以数字、字母组成、长度6-16位';
                    return $return_data;
                }

                $user_info = $users -> getUser($data['user_name']);
                if (empty($user_info)) {
                    $return_data['error_code'] = 1;
                    $return_data['error_msg'] = '您还没有用户,请先注册';
                    return $return_data;
                }

                if($data['password']!==$data['repwd']){
                    $return_data['error_code'] = 1;
                    $return_data['error_msg'] ='密码与确认密码不一致';
                    return $return_data;  //json_encode();
                }

                // 保存入库
                unset($data['repwd']);
                $res = $users -> updateData($data);
                if($res){
                    $return_data['error_code'] = 0;
                    $return_data['error_msg'] = "修改成功";
                    return $return_data;
                }else{
                    $return_data['error_code'] = 1;
                    $return_data['error_msg'] = "修改失败";
                    return $return_data;
                }
            }else{
                return $this -> fetch('forget_pwd');
            }
        }

        public function checkInfo(){
            $data = $_POST;
            $return_data = [];
            //判断非空
            if (!$data['user_name']) {
                 //$this->error('用户名不存在!');// $this->error(错误提示,跳转路径)
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='用户名不能为空';
                return $return_data;  //json_encode();
            }


            if (!$data['password']) {
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='密码不能为空';
                return $return_data;  //json_encode();
            }
            if (!$data['repwd']) {
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='确认密码不能为空';
                return $return_data;  //json_encode();
            }
            if (!$data['mobile']) {
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='手机号不能为空';
                return $return_data;  //json_encode();
            }
            if (!$data['code']) {
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='验证码不能为空';
                return $return_data;  //json_encode();
            }

            $user_name_flag = "/^[A-Za_z0-9_\x{4e00}-\x{9fa5}]{2,8}$/u";
            if(!preg_match($user_name_flag,$data['user_name'])){
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='用户名至少由2-8位汉字组成或者由2-16位数字、字母组成';
                return $return_data;
            }   
            $pwd_flag="/^(\w){6,16}$/";//密码的正则
            //正则格式 以/^ 开头 以$结尾
            //php中的正则表达式必须加引号
            //\w 小写 大写 数字 下划线 都可以
            //{6,16}区间 6-16位
            if(!preg_match($pwd_flag,$data['password'])){
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='密码应以数字、字母组成、长度6-16位';
                return $return_data;
            }
            if(!preg_match($pwd_flag,$data['repwd'])){
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='确认密码应以数字、字母组成、长度6-16位';
                return $return_data;
            }
            //手机号正则
            //[] 代表其中任意一个
            // \d 代表数字0-9
            $mobile_flag = "/^1([38]\d|5[0-35-9]|7[3678])\d{8}$/";
            if(!preg_match($mobile_flag,$data['mobile'])){
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='请输入11位正确手机号';
                return $return_data;
            }
            //判断密码与确认密码是否相同
            if($data['password']!==$data['repwd']){
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='密码与确认密码不一致';
                return $return_data;  //json_encode();
            }
            if(!captcha_check($data['code'])){
                //验证失败
                $return_data['error_code'] = 1;
                $return_data['error_msg'] = '验证码输入有误,请重新输入!';
                return $return_data;  //json_encode();
            }
            //判断此用户是否注册
            $users = new Users;
            $users ->getUser($data['user_name']);
            if($users->getUser($data['user_name'])){
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='用户名已经注册 ';
                return $return_data;  //json_encode();
            }
            unset($data['repwd']);
            unset($data['code']);
            $data["addtime"] = date("Y-m-d H-m-s");

            $res = $users -> insterData($data);

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

        // 登录页
        public function checkUserInfo(){
            $users = new Users;
            // 获取数据
            $data = $_POST;
            // 判断是否为空
            if (!$data['user_name']) {
                 //$this->error('用户名不存在!');// $this->error(错误提示,跳转路径)
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='用户名不能为空';
                return $return_data;  //json_encode();
            }

            if (!$data['password']) {
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='密码不能为空';
                return $return_data;  //json_encode();
            }

            if (!$data['code']) {
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='验证码不能为空';
                return $return_data;  //json_encode();
            }

            // 正则验证
            $user_name_flag = "/^[A-Za_z0-9_\x{4e00}-\x{9fa5}]{2,8}$/u";
            if(!preg_match($user_name_flag,$data['user_name'])){
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='用户名至少由2-8位汉字组成或者由2-16位数字、字母组成';
                return $return_data;
            }


            $pwd_flag="/^(\w){6,16}$/";//密码的正则
            if(!preg_match($pwd_flag,$data['password'])){
                $return_data['error_code'] = 1;
                $return_data['error_msg'] ='密码应以数字、字母组成、长度6-16位';
                return $return_data;
            }

            if(!captcha_check($data['code'])){
                //验证失败
                $return_data['error_code'] = 1;
                $return_data['error_msg'] = '验证码输入有误,请重新输入!';
                return $return_data;  //json_encode();
            }
            
            // 判断用户是否已经注册
            $user_info = $users -> getUser($data['user_name']);
            if (empty($user_info)) {
                $return_data['error_code'] = 1;
                $return_data['error_msg'] = '您还没有用户,请先注册后再登录';
                return $return_data;
            } 

            // 判断密码是否正确
            
            if ($data['password'] === $user_info['password']) {
                Session::set('user_name',$user_info['user_name']);
                Session::set('id',$user_info['id']);
                $return_data['error_code'] = 0;
                $return_data['error_msg'] = '密码正确,登录成功';
                return $return_data;
            }else{
                $return_data['error_code'] = 1;
                $return_data['error_msg'] = '密码错误,请重新输入';
                return $return_data;
            }

        }

    }

 ?>