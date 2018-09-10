<?php
namespace app\Controllers\Test\Lf;

class Index extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/Index
    public function http_index()
    {
        $data = [
            'title' => '留言板',
        ];
        $template = $this->loader->view('app::Test/Lf/Lf_index');
        $this->http_output->end($template->render($data));
    }

}
