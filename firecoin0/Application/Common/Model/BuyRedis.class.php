<?php

namespace Common\Model;
class BuyRedis extends RedisData
{
    public $model;
    public $queue_name;

    public function __construct($config, $market)
    {
        $this->queue_name = $market . '_buy';
        $this->model = D('Trade');
        parent::__construct($config, $market, $this->queue_name);
        if (!$this->get_list_len()) {
            $this->init();
        }
    }

    //重新实例化市场 队列
    public function init()
    {
        $this->redis->del($this->queue_name);
        $data = $this->model->get_save_redis_data($this->market, 1);
        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $this->right_add_data($data[$i]);
            }
        }
        return $this->get_list_len();
    }
}