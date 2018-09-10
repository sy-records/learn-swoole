<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/7
 * Time: 15:27
 */

namespace app\Controllers\Test\Lf;

class MessageListApi extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/messageListApi
    public function http_messageListApi()
    {
        $page = $this->http_input->get('page');
        $limit = $this->http_input->get('limit');
        $page = $page ? :1;
        $limit = $limit ? : 100;

        $result = yield $this->mysqlPool['message']->dbQueryBuilder
            ->select('*')
            ->from('message')
            ->where('is_show', 1)
            ->limit($limit, ($page - 1) * $limit)
            ->orderBy('message_id', 'desc')
            ->coroutineSend();

        $this->end($result['result']);
    }

}
