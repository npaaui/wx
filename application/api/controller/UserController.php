<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/2/27
 * Time: 10:07
 */

namespace app\api\controller;


use app\api\validate\UserValidate;
use app\common\model\UserModel;
use crypt\WXBizDataCrypt;
use \think\facade\Config;

class UserController extends ApiBaseController
{
    private $userModel;
    private $userValidate;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userValidate = new UserValidate();
    }

    /**
     * @param int $id
     * @param string $openId
     * @param bool $isLogin
     * @return string
     * @throws \think\Exception\DbException
     */
    public function getUserOne($id = 0, $openId = '', $isLogin = 0)
    {
        if ($id > 0) {
            $where['id'] =  $id;

        } elseif ($openId != '') {
            $where['open_id'] = $openId;

        } else {
            return $this->_out(self::PARAM_VALIDATE_ERROR, '', '参数不能为空');
        }

        if ($isLogin) {
            //更新最后登录时间及次数
            $updateData = array('login_cnt' => ['inc',1],'last_login_time' => date('Y-m-d H:i:s', time()));
            $this->userModel->save($updateData,$where);
        }

        $user = $this->userModel->get($where);

        return $this->_out(self::SUCCESS, $user);
    }

    /**
     * @return string
     * @throws \think\Exception\DbException
     */
    public function insertUser()
    {
        $postData = $this->_in();
        $openId = $postData['open_id'];
        $userInfo = $this->userModel->get(array('open_id' => $openId));
        if (!empty($userInfo)) {
            return $this->_out(self::SUCCESS, $userInfo);
        }

        $encryptedData = $postData['encrypted_data'];
        $iv = $postData['iv'];
        $sessionKey = $postData['session_key'];
        $appId = Config::get('wx.miniProgram.appId');

        $pc = new WXBizDataCrypt($appId, $sessionKey);
        $errCode = $pc->decryptData($encryptedData, $iv, $data);
        if ($errCode == 0) {
            $data = json_decode($data, true);
            $user = array(
                'open_id' => $data['openId'],
                'nickname' => $data['nickName'],
                'gender' => $data['gender'],
                'language' => $data['language'],
                'city' => $data['city'],
                'province' => $data['province'],
                'country' => $data['country'],
                'avatar_url' => $data['avatarUrl'],
                'first_login_time' => date('Y-m-d H:i:s', time()),
                'last_login_time' => date('Y-m-d H:i:s', time()),
            );

        } else {
            return $this->_out(self::USER_LOGIN_FAIL, '');
        }

        $id = $this->userModel->insertGetId($user);
        $userInfo = $this->userModel->get($id);

        return $this->_out(self::SUCCESS, $userInfo);
    }
}