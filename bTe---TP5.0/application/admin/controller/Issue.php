<?php
namespace Admin\Controller;
use think\Db;

class Issue extends AdminController
{
	public function index()
	{
        $name = strval(input('name'));
        $field = strval(input('field'));
        $status = intval(input('status'));
		$where = array();
		if ($field && $name) {
			if ($field == 'username') {
				$where['userid'] = Db::name('User')->where(array('username' => $name))->value('id');
			} else if ($field == 'name') {
				$where['name'] = array('like', '%' . $name . '%');
			} else {
				$where[$field] = $name;
			}
		}

		if ($status) {
			$where['status'] = $status - 1;
		}

		$count = Db::name('Issue')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = Db::name('Issue')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function issueimage()
	{
        if($_FILES['upload_file0']['size'] > 3145728){
            $this->error(['msg' => "error"]);
        }

        $ext = pathinfo($_FILES['upload_file0']['name'], PATHINFO_EXTENSION);
        if(!in_array($ext, ['jpg', 'gif', 'png', 'jpeg'])){
            $this->error(['msg' => "error"]);
        }

        $path = 'Upload/issue/';
        $filename = md5($_FILES['upload_file0']['name'] . session('admin_id')) . '.' . $ext;
        $info = oss_upload($path.$filename, $_FILES['upload_file0']['tmp_name']);

        if(!$info){
            $this->error(['msg' => "error"]);
        }

        echo $filename;
        exit();
	}

	public function edit()
	{
	    $id = input('get.id/d');
		if (empty($id)) {
			$this->data = false;
		} else {
			$this->data = Db::name('Issue')->where(['id' => $id])->find();
		}

		$this->display();
	}

	public function save()
	{
        $_POST = input('post./a');
		$_POST['addtime'] = time();

		if (strtotime($_POST['time']) != strtotime(addtime(strtotime($_POST['time'])))) {
			$this->error('开启时间格式错误！');
		}

		if($_POST['tuijian']==1){
			//推荐的话 先把其它的推荐修改成不推荐
			Db::name('Issue')-> where(['tuijian'=>1])->setField('tuijian','2');
		}

		if ($_POST['id']) {
			$rs = Db::name('Issue')->insert($_POST);
		} else {
			
			$rs = Db::name('Issue')->insert($_POST);
		}

		if ($rs) {
			$this->success('操作成功！');
		} else {
			$this->error('操作失败！');
		}
	}

	public function status()
	{
        $_POST = input('post./a');
		if (IS_POST) {
			$id = implode(',', $_POST['id']);
		} else {
			$id = input('get.id');
		}

		if (empty($id)) {
			$this->error('请选择要操作的数据!');
		}

		$where['id'] = array('in', $id);
		$method = input('get.method');

		switch (strtolower($method)) {
            case 'forbid':
                $data = array('status' => 0);
                break;

            case 'resume':
                $data = array('status' => 1);
                break;

            case 'delete':
                if (Db::name('Issue')->where($where)->delete()) {
                    $this->success('操作成功！');
                } else {
                    $this->error('操作失败！');
                }
                break;

            default:
                $this->error('参数非法');
		}

		if (Db::name('Issue')->where($where)->update($data)) {
			$this->success('操作成功！');
		} else {
			$this->error('操作失败！');
		}
	}

	public function log()
	{
        $name = input('name/s');
		if ($name && check($name, 'username')) {
			$where['userid'] = Db::name('User')->where(array('username' => $name))->value('id');
		} else {
			$where = [];
		}

		$count = Db::name('IssueLog')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = Db::name('IssueLog')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['username'] = Db::name('User')->where(array('id' => $v['userid']))->value('username');
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
}

?>