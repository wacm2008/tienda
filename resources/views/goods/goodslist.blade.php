<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/page.css" rel="stylesheet">
    <script src="/js/jquery.js"></script>
    <title>Document</title>
</head>
<body>
<table border="1">
    <tr>
        <td>商品图片</td>
        <td>商品名称</td>
        <td>购买数量</td>
        <td>商品价格</td>
        <td>是否上架</td>
        <td>商户id</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
        <input type="hidden" id="goods_id" value="{{$v['goods_id']}}">
        <tr>
            <td><img src="storage/{{$v['goods_img']}}" width="60" height="60"></td>
            <td>{{$v['goods_name']}}</td>
            <td>
                <button class="decrease less">-</button>
                <input type="text" class="spinnerExample buy_number" value="1"/>
                <button class="increase more">+</button>
                库存(<font color="red" size="3" id="goods_num">{{$v['goods_num']}}</font>)件
            </td>
            <td>{{$v['self_price']}}</td>
            <td>
                @if($v['goods_up']==1)
                    上架
                @elseif($v['goods_up']==2)
                    下架
                @endif
            </td>
            <td>{{$v['shop_id']}}</td>
            <td>
                <a href="#" id="carAdd">加入购物车</a>
                <a href="/goodsedit/{{$v['goods_id']}}">修改</a>
                <a href="/goodsdel/{{$v['goods_id']}}">删除</a>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
<script>
    $(function () {
        var goods_num=parseInt($("#goods_num").text());
        //加号
        $(".more").click(function(){
            var _this=$(this);
            var buy_number=parseInt(_this.prev('input').val());
            if(buy_number>=goods_num){
                _this.prop('disabled',true);
                _this.prev().prev().prop('disabled',false);
            }else{
                buy_number=buy_number+1;
                _this.prev('input').val(buy_number);
                _this.prev().prev().prop('disabled',false);
            }
        });
        //减号
        $(".less").click(function(){
            var _this=$(this);
            var buy_number=parseInt(_this.next('input').val());
            if(buy_number<=1){
                _this.prop('disabled',true);
                _this.next().next().prop('disabled',false);
            }else{
                buy_number=buy_number-1;
                _this.next('input').val(buy_number);
                _this.next().next().prop('disabled',false);
            }
        });
        //失去焦点
        $(".buy_number").blur(function(){
            var _this=$(this);
            var buy_number=parseInt(_this.val());
            var reg=/^[1-9]\d*$/;
            if(!reg.test(buy_number)){
                $(".buy_number").val(1);
            }else if(buy_number<=1){
                $(".buy_number").val(1);
            }else if(buy_number>=goods_num){
                $(".buy_number").val(goods_num);
            }
        });
    })
</script>