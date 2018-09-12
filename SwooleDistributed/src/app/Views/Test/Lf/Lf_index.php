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
    <body style="overflow: scroll; overflow-y: hidden; overflow-x: hidden">
    <div style="height: 20px"></div>
    <div class="container">
        <div class="row">
            <form method="post" action="/Test/Lf/submit">

                <div class="form-group">
                    <label for="title"  class="col-sm-2 control-label">留言标题</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="请输入留言标题" required>
                    </div>
                </div>

                <div class="form-group" style="padding: 5px; width: auto">
                    <label class="col-sm-2 control-label">留言板</label>
                    <textarea class="form-control" rows="5" id="content" name="content" placeholder="请输入你的留言，不能超过140个字符" required></textarea>
                </div>

                <div class="form-group">
                    <label for="toUid">发送对象</label>
                    <select class="form-control" id="userList" name="toUid">
                        <option value="0">无</option>
                    </select>
                </div>

                <div class="control-group">
                    <label for="requirement" class="col-md-3 control-label span3">图片上传</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input id="photoCover" class="form-control" readonly type="text">
                            <label class="input-group-btn">
                                <input id="file" type="file" name="file" style="left: -9999px; position: absolute;">
                                <span class="btn btn-default">Browse</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div style="height: 20px"></div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">提交</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
<script type="text/javascript">

    $('form').submit(function(){
        $(this).ajaxSubmit({
            url:"/Test/Lf/submit",
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
                            location.href='/Test/Lf/messageList';
                        }
                    });
                }
            }
        });
        return false;
    });

    $(function () {
        $("#userList").ready(function (e) {
            $.ajax({
                type:"GET",
                url:"http://127.0.0.1:8081/Test/Lf/userListApi",
                dataType: "json",
                success: function(data){
                    var str = "";
                    $.each(data.data,function(i,n){
                        str +="<option value="+n.id+">"+n.name+"</option>";
                    });
                    $("#userList").append(str);
                }
            });
        });
    })

    $(function () {
        $("#file").change(function (e) {
            var file = e.target.files[0] || e.dataTransfer.files[0];
            $('#photoCover').val(document.getElementById("file").files[0].name);
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $("img").attr("src", this.result);
                }
                reader.readAsDataURL(file);
            }
        });
    })

</script>
