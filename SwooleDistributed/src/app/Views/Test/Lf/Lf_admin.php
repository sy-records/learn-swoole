<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>
    <script src="https://cdn.bootcss.com/jquery.form/4.2.2/jquery.form.js"></script>
</head>
<body>

<form>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">账号</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="username"
                   placeholder="请输入你的账号" required>
        </div>
        <label for="firstname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password"
                   placeholder="请输入你的密码" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">

            <button type="submit" class="btn btn-default">提交</button>
        </div>
    </div>
</form>

</body>
</html>
<script type="text/javascript">
        $('form').submit(function(){
            $(this).ajaxSubmit({
                url:"/Test/Lf/adminLoginApi",
                type:'post',
                dataType:'json',
                success:function(msg){
                    if(msg.code==1){
                        layer.msg(msg.message, {
                            icon: 2,
                        });;
                    }else{
                        layer.msg(msg.data, {
                            icon: 1,
                            time: 2000,
                            end:function(){
                                location.href='/Test/Lf/adminList';
                            }
                        });
                    }
                }
            });
            return false;
        });
</script>