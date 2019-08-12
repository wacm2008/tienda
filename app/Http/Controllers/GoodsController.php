<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\GoodsModel;
class GoodsController extends Controller
{
    public function goodscreate()
    {
        $session_name=Session::get('shop_name');
        return view('goods/goodscreate',['session_name'=>$session_name]);
    }
    public function goodsdo(Request $request)
    {
        $data=$request->only(['goods_name','goods_num','self_price','goods_up']);
        $data['goods_img']=$this->upload($request,'goods_img');
        $data['shop_id']=Session::get('shop_id');
        $res=GoodsModel::insert($data);
        if($res){
            return redirect('/goodslist');
        }else{
            echo "添加失败哦";
            header("refresh:2,url=/goodscreate");
        }
    }
    //文件上传
    public function upload(Request $request,$filename){
        //hasFile方法判断文件在请求中是否存在 isValid方法判断文件在上传过程中是否出错
        if ($request->hasFile($filename) && $request->file($filename)->isValid()){
            $photo = $request->file($filename);
            $store_result = $photo->store('uploads/'.date('Ymd'));
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }
    public function goodslist()
    {
        $data=GoodsModel::paginate(3);
        return view('goods/goodslist',['data'=>$data]);
    }
}
