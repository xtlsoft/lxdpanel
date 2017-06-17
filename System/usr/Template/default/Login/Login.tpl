{{# $this->vars['Title']=$L['login']; }}
{{# $this->need("Common/Header") }}
<body class="login-body body">

<div class="login-box">
    <form class="layui-form layui-form-pane" method="get" action="javascript:alert('Please allow javascript!');">
        <div class="layui-form-item">
            <h3>{{$L['login']}} - {{$GLOBALS['_C']['SiteName']}}</h3>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{$L['username']}}:</label>

            <div class="layui-input-inline">
                <input type="text" name="account" class="layui-input" lay-verify="account" placeholder="账号" autocomplete="on" maxlength="20"/>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{$L['password']}}:</label>

            <div class="layui-input-inline">
                <input type="password" name="password" class="layui-input" lay-verify="password" placeholder="密码" maxlength="20"/>
            </div>
        </div>
        <!--<div class="layui-form-item">
            <label class="layui-form-label">验证码：</label>

            <div class="layui-input-inline">
                <input type="number" name="code" class="layui-input" lay-verify="code" placeholder="验证码" maxlength="4"/><img src="../frame/static/image/v.png" alt="">
            </div>
        </div>-->
        <div class="layui-form-item">
            <button type="reset" class="layui-btn layui-btn-danger btn-reset">重置</button>
            <button type="button" class="layui-btn btn-submit" lay-submit="" lay-filter="sub">立即登录</button>
        </div>
    </form>
</div>

<script type="text/javascript" src="/static/default/layui/layui.js"></script>
<script type="text/javascript" src="/static/default/site/js/md5.js"></script>
<script type="text/javascript">
    layui.use(['form', 'layer', 'jquery'], function () {

        // 操作对象
        var form    = layui.form()
            ,layer  = layui.layer
            ,$      = layui.jquery;
        
        //msg
        {{# if($_GET['msg']): }}
            layer.msg("{{ $_GET['msg'] }}");
        {{# endif; }}
        
        // 验证
        form.verify({
            account: function (value) {
                if (value == "") {
                    return "{{$L['please_input'].$L['username']}}";
                }
            },
            password: function (value) {
                if (value == "") {
                    return "{{$L['please_input'].$L['password']}}";
                }
            }
        });

        // 提交监听
        form.on('submit(sub)', function (data) {
            data.field.password = md5(data.field.password);
            // layer.alert(data.field.password);
            DataJSON = encodeURIComponent(JSON.stringify(data.field));
            
            layui.jquery.getJSON("/login/checkLogin.do?inajax=yes&data=" + DataJSON,function(data){
                if(data.status == "success"){
                    layer.msg('{{ $L["login_success"] }}', {icon: 1});
                    setTimeout("window.location.href='{{ $_GET['refer'] ? $_GET['refer'] : "/manage/" }}'",1000);
                }else{
                    layer.msg('{{ $L["login_error"] }}', {icon: 5});
                }
            });
            return false;
        });

        // you code ...
    })

</script>
</body>
</html>