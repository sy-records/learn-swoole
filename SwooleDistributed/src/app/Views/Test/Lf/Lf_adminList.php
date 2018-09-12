<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>
</head>
<body>

<form class="form-inline">
    <div class="form-group">
        <input type="text" class="form-control" id="name" name="name" placeholder="请输入姓名">
        <input type="text" class="form-control" id="tel" name="tel" placeholder="请输入手机号">
        <input type="text" class="form-control" id="email" name="email" placeholder="请输入邮箱">
        <input type="text" class="form-control" id="title" name="title"  placeholder="请输入标题">
    </div>
    <button type="submit" id="submit" class="btn btn-default">提交</button>
</form>

<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>标题</th>
        <th>内容</th>
        <th>包含图片</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody id="test">
    </tbody>
</table>

</body>
</html>
<script type="text/javascript">
    //页面加载成功后数据
    $(function () {
        $("#test").ready(function (e) {
            $.ajax({
                type:"GET",
                url:"http://127.0.0.1:8081/Test/Lf/adminListApi",
                dataType: "json",
                success: function(data){
                    var str = "";
                    $.each(data.data,function(i,n){
                        str+="<tr>"
                        str+="<td>"+n.message_id+"</td>";
                        str+="<td>"+n.title+"</td>";
                        str+="<td>"+n.content+"</td>";
                        str+="<td><img src="+n.image_url+" height=\"100px\"></td>";
                        str+="<td><button type='button' class='btn btn-default' onclick='delMessage("+n.message_id+")' id='delMessage' data-id="+n.message_id+">删除</button></td>";
                        str+="</tr>";
                    });
                    $("#test").append(str);
                }
            });
        });
    })
    //搜索数据
    $('form').submit(function(){
        $(this).ajaxSubmit({
            url:"/Test/Lf/adminSearchApi",
            type:'get',
            dataType:'json',
            success:function(msg){
                $("#test").empty();
                var str = "";
                $.each(msg.data,function(i,n){
                    str+="<tr>"
                    str+="<td >"+n.message_id+"</td>";
                    str+="<td>"+n.title+"</td>";
                    str+="<td>"+n.content+"</td>";
                    str+="<td><img src="+n.image_url+" height=\"100px\"></td>";
                    str+="<td><a href=''>删除</a></td>";
                    str+="</tr>";
                });
                $("#test").append(str);
            }
        });
        return false;
    });

    //删除事件
    function delMessage(id)
    {
        $.ajax({
            type:"GET",
            url:"/Test/Lf/adminMessageDel",
            data: {id:id},
            dataType: "json",
            success: function(msg){
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
    }

</script>