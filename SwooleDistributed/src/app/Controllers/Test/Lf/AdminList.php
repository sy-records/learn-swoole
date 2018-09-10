<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/7
 * Time: 17:54
 */
namespace app\Controllers\Test\Lf;

class AdminList extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/adminList
    public function http_adminList()
    {
        $data = [
            'title' => '留言管理',
        ];
        $template = $this->loader->view('app::Test/Lf/Lf_adminList');
        $this->http_output->end($template->render($data));
    }

}
