<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/7
 * Time: 14:15
 */
namespace app\Controllers\Test\Lf;

class Submit extends Lf
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    // 访问地址：http://127.0.0.1:8081/Test/Lf/submit
    public function http_submit()
    {
        $data['content'] = $this->http_input->getPost('content'); //留言内容
        $data['title'] = $this->http_input->getPost('title'); //留言标题
        $data['to_uid'] = $this->http_input->getPost('toUid'); //发送对象

        $file = $this->http_input->getFiles('file');
        if (!empty($file) && $file['file']['error'] == 0) {
            //防止文件名重复
            $filename = $file['file']['name'];
            //转码，把utf-8转成gb2312,返回转换后的字符串， 或者在失败时返回 FALSE
            $filename = iconv("UTF-8", "gb2312", $filename);
            $upload_real_path = "http://127.0.0.1/images/";
            //检查文件或目录是否存在
            if (file_exists($upload_real_path.$filename)) {
                $this->end('该文件已存在', 1);
            } else {
                //保存文件,   move_uploaded_file 将上传的文件移动到新位置
                move_uploaded_file($file['file']['tmp_name'], $filename);//将临时地址移动到指定地址
                $data['image_url'] = $upload_real_path.$filename;
            }
        }

        // 验证参数
        if (mb_strlen($data['title'], "utf-8") > 80) {
            $this->end("标题内容不能大于80个字", 1);
        }
        if (mb_strlen($data['content'], "utf-8") > 500) {
            $this->end("留言内容不能大于500个字", 1);
        }

        $nowTime = time();
        $data['add_time'] = $nowTime;

        $user = $this->http_input->cookie('user'); //获取cookie
        $user = json_decode($user);
        $data['user_id'] = $user->id;

        $result = yield $this->mysqlPool['message']->dbQueryBuilder->insert('message')->set($data)->coroutineSend();

        $info['m_uid'] = $result['insert_id']; //用户id
        $info['user_ip'] = getRealIp($this); //留言者ip
        $info['add_time'] = $nowTime;

        $updateResult = yield $this->mysqlPool['message']->dbQueryBuilder->insert('message_info')->set($info)->coroutineSend();

        if (!empty($updateResult['insert_id'])) {
            $this->end('留言成功');
        } else {
            $this->end('留言失败');
        }
    }

}
