<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/7
 * Time: 17:09
 */
namespace app\Controllers\Test\Lf;

class AdminLoginApi extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/adminLoginApi
    public function http_adminLoginApi()
    {
        $name = $this->http_input->getPost('username'); //账号
        $passWord = $this->http_input->getPost('password'); //密码

        // 验证参数
        if($name != 'lufei' || $passWord != 123456){
            $this->end('登录失败',1);
        }else{
            $this->end('登录成功');
        }
    }
}