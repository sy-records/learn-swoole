<?php

namespace app\Service\Test\Lf;

class Lf_getPost extends Lf
{
    public function initialization(&$context)
    {
        var_dump($context);

        parent::initialization($context);
    }

    public function getPost($get, $post)
    {
        return ['get' => $get, 'post' => $post];
    }
}