<?php
namespace app\Controllers\Test\Lf;

class Register extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/register
    public function http_register()
    {
        $data = [
            'title' => '注册',
        ];
        $template = $this->loader->view('app::Test/Lf/Lf_register');
        $this->http_output->end($template->render($data));
    }

}
