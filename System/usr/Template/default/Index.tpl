{{# $this->vars['Title'] = $L['index']; }}
{{# $this->need('Common/Header_Common'); }}
    </head>
    <body>
        <a href="./login">{{$L['redirecting']}}</a>
        
        <script type="text/javascript" charset="utf-8">
            window.location.href="./login";
        </script>
    </body>
</html>