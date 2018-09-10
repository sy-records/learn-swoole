<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10
 * Time: 15:41
 */
namespace app\Controllers\Test\Lf;

class AdminMessageDel extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/adminMessageDel
    public function http_adminMessageDel()
    {
        $id = $this->http_input->getPost('id'); // 留言id

        $value = yield $this->mysqlPool['message']->dbQueryBuilder
            ->update('message')
            ->where('message_id', $id)
            ->set('is_show', '0')
            ->coroutineSend();
        if ($value['result'] == true && $value['affected_rows']) {
            $this->end('删除成功');
        } else {
            $this->end('删除失败', 0);
        }
    }
}