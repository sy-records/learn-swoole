<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/7
 * Time: 17:02
 */
namespace app\Controllers\Test\Lf;

class Admin extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/admin
    public function http_admin()
    {
        $data = [
            'title' => '后台登录',
        ];
        $template = $this->loader->view('app::Test/Lf/Lf_admin');
        $this->http_output->end($template->render($data));
    }

}
