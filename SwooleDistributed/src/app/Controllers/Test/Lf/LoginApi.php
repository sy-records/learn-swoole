<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/7
 * Time: 17:09
 */
namespace app\Controllers\Test\Lf;

class LoginApi extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/loginapi
    public function http_loginApi()
    {
        $name = $this->http_input->getPost('username'); //账号
        $password = $this->http_input->getPost('password'); //密码

        // 验证参数
        $user = yield $this->mysqlPool['message']->dbQueryBuilder
            ->select('*')
            ->from('user')
            ->where('name', $name, '=')
            ->coroutineSend()
            ->row();

        if (empty($user)) {
            $this->end('用户不存在', 1);
        } elseif ($user['password'] != md5($password)) {
            $this->end('账号或密码错误', 1);
        }

        $this->http_output->setCookie('user', json_encode($user));

        $this->end('登录成功');
    }
}