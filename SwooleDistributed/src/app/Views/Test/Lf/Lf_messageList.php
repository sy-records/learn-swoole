<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>留言列表</title>
    <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>内容</th>
            <th>包含图片</th>
        </tr>
        </thead>
        <tbody id="test">
        </tbody>
    </table>
<script type="text/javascript">
    $(function() {
        $.ajax({
            type:"GET",
            url:"http://127.0.0.1:8081/Test/Lf/messageListApi",
            dataType: "json",
            success: function(data){
                var str = "";
                $.each(data.data,function(i,n){
                    str+="<tr>"
                    str+="<td>"+n.message_id+"</td>";
                    str+="<td>"+n.title+"</td>";
                    str+="<td>"+n.content+"</td>";
                    str+="<td><img src="+n.image_url+" height=\"100px\"></td>";
                    str+="</tr>";
                });
                $("#test").append(str);
            }
        });
    });
</script>
</body>
</html>
