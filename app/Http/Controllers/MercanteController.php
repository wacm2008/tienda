<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MercanteModel;
use Illuminate\Support\Facades\Session;
class MercanteController extends Controller
{
    public function merLogin()
    {
        return view('mercante/merlogin');
    }
    public function merLogdo(Request $request)
    {
        $shop_email = $request->input('shop_email');
        $shop_pwd = $request->input('shop_pwd');
        if($shop_email==''){
            echo json_encode(['msg'=>'邮箱不为空哦','code'=>2]);die;
        }
        if($shop_pwd==''){
            echo json_encode(['msg'=>'密码不为空哦','code'=>2]);die;
        }
        $merInfo = MercanteModel::where(['shop_email'=>$shop_email])->first();
        if($merInfo){
            if($shop_pwd==$merInfo['shop_pwd']){
                $shop_name=$merInfo->shop_name;
                Session::put(['shop_name'=>$shop_name,'shop_id'=>$merInfo['shop_id']]);
                echo json_encode(['msg'=>'登录成功','code'=>1]);
            }else{
                echo json_encode(['msg'=>'密码不对哦','code'=>2]);die;
            }
        }else{
            echo json_encode(['msg'=>'用户名或密码不对哦','code'=>2],JSON_UNESCAPED_UNICODE);die;
        }
    }
    public function merlogout(Request $request)
    {
        $request->session()->forget(['shop_id','shop_name']);
        $s=Session::get('shop_name');
        $s1=Session::get('shop_id');
        if(!$s&&!$s1){
            return redirect()->to("/merlogin");
        }
    }
}
