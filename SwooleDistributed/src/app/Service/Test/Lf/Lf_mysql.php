<?php

namespace app\Service\Test\Lf;

class Lf_mysql extends Lf
{
    // 手册地址：http://docs.youwoxing.net/399875
    // 框架是用Miner扩展实现的Mysql语法构建器
    // Miner官方地址：https://github.com/jstayton/Miner
    public function mysql($data)
    {
        $return = [];

        // 默认数据库添加数据
        $result = yield $this->mysqlPool['test']->dbQueryBuilder->insert('log')->set($data)->coroutineSend();

        $insertId = $result['insert_id'];

        // 默认数据库获取数据
        $return['default'] = yield $this->mysqlPool['test']->dbQueryBuilder->select('*')->from('log')
            ->where('id', $insertId)->coroutineSend()->row();

        // 【指定】数据库添加数据
        $result = yield $this->mysqlPool['test']->dbQueryBuilder->insert('log')->set($data)->coroutineSend();

        $insertId = $result['insert_id'];

        // 【指定】数据库获取数据
        $return['choose'] = yield $this->mysqlPool['test']->dbQueryBuilder->select('*')->from('log')
            ->where('id', $insertId)->coroutineSend()->row();

        return $return;
    }
}