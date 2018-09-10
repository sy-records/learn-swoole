<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10
 * Time: 10:54
 */
namespace app\Controllers\Test\Lf;

class UserListApi extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    public function http_userListApi()
    {
        $userList = yield $this->mysqlPool['message']->dbQueryBuilder
            ->select('id,name')
            ->from('user')
            ->coroutineSend();

        $this->end($userList['result']);
    }
}