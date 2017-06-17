<html>
    <head>
        <title>XPHP错误</title>
        <style>
            body{
                margin:0;
                padding:30px;
                font:12px/1.5 "Microsoft Yahei UI",Helvetica,Arial,Verdana,sans-serif;
            }
            h1{
                margin:0;
                font-size:48px;
                font-weight:normal;
                line-height:48px;
            }
            strong{
                display:inline-block;
                width:65px;
            }
        </style>
    </head>
    <body>
        <h1>错误 {{$no ? "#".$no : ""}} :</h1>
        <h3>
            {{$e}}
        </h3>
        <p>我们已经记录这次错误，给您带来不便，抱歉！</p>
        
        {{# if ($jump){ }}
            <a href='{{$jump}}'>立即跳转</a> ({{$sec}}秒后自跳转)
            <script type="text/javascript">
                window.setTimeout("window.location.href='{{$jump}}';",{{$sec}}*1000);
            </script>
        {{# }else{ }}
            <a href='/'>返回首页</a>
        {{# } }}
    </body>
</html>