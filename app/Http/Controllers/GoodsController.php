<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\GoodsModel;
use Illuminate\Support\Facades\Redis;
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
        $data=GoodsModel::get()->toArray();
        //展示查缓存
        foreach ($data as $k=>$v){
            $key="h:goods_info:".$v['goods_id'];
            echo $key;echo '</br>';
            Redis::hMset($key,$v);
        }
        return view('goods/goodslist',['data'=>$data]);
    }
    public function goodsdel($goods_id)
    {
        $goods_id = intval($goods_id);
        if(!$goods_id){
            return;
        }
        $res = GoodsModel::where(['goods_id'=>$goods_id])->delete();
        //删除更新缓存
        $key="h:goods_info:".$goods_id;
        Redis::del($key);
        if($res){
            return redirect('/goodslist');
        }
    }
    public function goodsedit($goods_id)
    {
        $goods_id = intval($goods_id);
        if(!$goods_id){
            return;
        }
        $res = GoodsModel::where(['goods_id'=>$goods_id])->first();
        return view('goods/goodsedit',['res'=>$res]);
    }
    public function goodsupdate(Request $request,$goods_id)
    {
        $goods_id = intval($goods_id);
        if(!$goods_id){
            return;
        }
        $data=$request->only(['goods_name','goods_num','self_price','goods_up']);
        $res=GoodsModel::where(['goods_id'=>$goods_id])->update($data);
        //修改更新缓存
        $key="h:goods_info:".$goods_id;
        Redis::hMset($key,$data);
        if($res){
            return redirect('/goodslist');
        }
    }
}
