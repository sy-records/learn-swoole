<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/7
 * Time: 15:27
 */

namespace app\Controllers\Test\Lf;

class MessageList extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/messageList
    public function http_messageList()
    {
        $template = $this->loader->view('app::Test/Lf/Lf_messageList');
        $this->http_output->end($template->render());
    }

}
