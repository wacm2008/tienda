<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品添加</title>
</head>
<body>
    <ul>
        <h2>欢迎<font color="red">{{$session_name}}</font>登录</h2>
        <a href="/merlogout"><input type="button" value="退出"></a>
    </ul>
    <form action="/goodsdo" method="post" enctype="multipart/form-data">
        <table border="1">
            @csrf
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="goods_name"></td>
            </tr>
            <tr>
                <td>商品图片</td>
                <td><input type="file" name="goods_img"></td>
            </tr>
            <tr>
                <td>商品数量</td>
                <td><input type="text" name="goods_num"></td>
            </tr>
            <tr>
                <td>商品价格</td>
                <td><input type="text" name="self_price"></td>
            </tr>
            <tr>
                <td>是否上架</td>
                <td>
                    <input type="radio" name="goods_up" value="1">上架
                    <input type="radio" name="goods_up" value="2">下架
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="提交"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>