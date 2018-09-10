<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10
 * Time: 14:25
 */
namespace app\Controllers\Test\Lf;

class AdminSearchApi extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/adminSearchApi
    public function http_adminSearchApi()
    {
        $name = $this->http_input->getPost('name'); //名称
        $tel = $this->http_input->getPost('tel'); //手机号
        $email = $this->http_input->getPost('email'); //邮箱
        $title = $this->http_input->getPost('title'); //标题

        //名称
        if (!empty($name)) {
            $user = yield $this->mysqlPool['message']->dbQueryBuilder
                ->select('*')
                ->from('user')
                ->where('name', $name, '=')
                ->coroutineSend()
                ->row();

            $res = yield $this->mysqlPool['message']->dbQueryBuilder
                ->select('*')
                ->from('message')
                ->where('user_id', $user['id'], '=')
                ->where('is_show', 1, '=')
                ->coroutineSend();

            $this->end($res['result']);
        } elseif (!empty($tel)) {
            $user = yield $this->mysqlPool['message']->dbQueryBuilder
                ->select('*')
                ->from('user')
                ->where('tel', $tel, '=')
                ->coroutineSend()
                ->row();

            $res = yield $this->mysqlPool['message']->dbQueryBuilder
                ->select('*')
                ->from('message')
                ->where('user_id', $user['id'], '=')
                ->where('is_show', 1, '=')
                ->coroutineSend();

            $this->end($res['result'], 0);
        } elseif (!empty($email)) {
            // 邮箱
            $user = yield $this->mysqlPool['message']->dbQueryBuilder
                ->select('*')
                ->from('user')
                ->where('email', $email, '=')
                ->coroutineSend()
                ->row();

            $res = yield $this->mysqlPool['message']->dbQueryBuilder
                ->select('*')
                ->from('message')
                ->where('user_id', $user['id'], '=')
                ->where('is_show', 1, '=')
                ->coroutineSend();

            $this->end($res['result']);
        } elseif (!empty($title)) {
            $res = yield $this->mysqlPool['message']->dbQueryBuilder
                ->select('*')
                ->from('message')
                ->where('title', '%'.$title.'%', 'like')
                ->coroutineSend();

            $this->end($res['result']);
        }
    }
}
