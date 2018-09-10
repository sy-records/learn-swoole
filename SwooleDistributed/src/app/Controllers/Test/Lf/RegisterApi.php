<?php
namespace app\Controllers\Test\Lf;

class RegisterApi extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    public function http_registerApi()
    {
        $data['name'] = $this->http_input->getPost('username'); //账号
        $passWord = $this->http_input->getPost('password'); //密码

        $data['password'] = md5($passWord); //处理密码使用md5加密

        $data['email'] = $this->http_input->getPost('email'); //邮箱
        $data['tel'] = intval($this->http_input->getPost('tel')); //手机号

        if (mb_strlen($data['name'], "utf-8") > 15) {
            $this->end("姓名不能大于15个字", 1);
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->end("邮箱无效", 1);
        }

        if (!preg_match('/^1[34578]\d{9}$/', $data['tel'])) {
            $this->end("手机号无效", 1);
        }

        $user = yield $this->mysqlPool['message']
            ->dbQueryBuilder
            ->select('id')
            ->from('user')
            ->where("name", $data['name'], "=")
            ->limit(1)
            ->coroutineSend()
            ->row();

        if (!empty($user)) {
            $this->end("该用用户已经存在", 1);
        }

        $data['register_ip'] = getRealIp($this); //注册ip
        $data['add_time'] = time(); //注册时间
        $data['role'] = 1;

        $result = yield $this->mysqlPool['message']->dbQueryBuilder->insert('user')->set($data)->coroutineSend();

        if (empty($result)) {
            $this->end("注册失败", 1);
        }
        $this->end("注册成功");
    }
}
