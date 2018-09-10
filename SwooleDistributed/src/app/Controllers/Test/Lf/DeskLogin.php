<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/7
 * Time: 17:02
 */
namespace app\Controllers\Test\Lf;

class DeskLogin extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/deskLogin
    public function http_deskLogin()
    {
        $data = [
            'title' => '前台登录',
        ];

        $template = $this->loader->view('app::Test/Lf/Lf_deskLogin');
        $this->http_output->end($template->render($data));
    }

}
