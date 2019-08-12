<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/jquery.js"></script>
    <script src="/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <title>商家登录</title>
</head>
<body>
    <h3 align="center">登录</h3>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form class="form-horizontal" method="" action="">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="shop_email" placeholder="Email" name="shop_email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="shop_pwd" placeholder="Password" name="shop_pwd">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="button" class="btn btn-default" id ="btn" value="Sign in">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-"></div>
    </div>
</body>
</html>
<script>
    $(function () {
        $('#btn').click(function () {
            var shop_email = $('#shop_email').val();
            var shop_pwd = $('#shop_pwd').val();
            if(shop_email==''||shop_pwd==''){
                alert('请正确操作');
                return false;
            }
            $.ajax({
                url:'/merlogdo',
                data:{shop_email:shop_email,shop_pwd:shop_pwd},
                dataType:'json',
                type:'post',
                async:false,
                success:function (res) {
                    console.log(res);
                    if(res.code==2){
                        alert(res.msg);
                    }else{
                        alert('登录成功');
                        location.href="/goodscreate";
                    }
                }
            })
        })
    })
</script>
