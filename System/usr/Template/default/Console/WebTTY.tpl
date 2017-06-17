<!doctype html>
<title>Cloud Compute Container Console System - CCCCS</title>
<script src="/static/default/site/js/xterm.js"></script>
<style>
  html {
    background: #555;
  }

  h1 {
    margin-bottom: 20px;
    font: 20px/1.5 sans-serif;
  }


  .terminal {
    float: left;
    border: #000 solid 5px;
    font-family: Consolas, "Microsoft Mono";
    /*height: 500px;*/
    font-size: 14px;
    color: #f0f0f0;
    background: #000;
  }

  .terminal-cursor {
    color: #000;
    /*border: 2px solid green;*/
    background: #f0f0f0;
  }
  
  .paste-here textarea{
      height: 30px;
      width: 300px;
  }
  .paste-here button{
      height: 25px;
      width: 40px;
  }
  
</style>
<body>
    <div class="paste-here">
        <!--<input type="text" placeholder="Paste here..." id="pasteHere" />-->
        <textarea id="pasteHere" placeholder="Paste here..."></textarea>
        <button onclick="pasteHere();">OK!</button>
    </div>
</body>
<script>
    if(window.WebSocket){
        window.addEventListener('load', function() {
            window.socket = new WebSocket("{{$Protocol}}://"+ document.domain +":{{$Port}}");
            socket.onopen = function() {
                var term = new Terminal({
                    cols: 100,
                    rows: 29,
                    cursorBlink: false
                });
                term.open(document.body);
                var explode = window.location.href.split("?");
                if(explode[1]){
                    for(var item in explode){
                        if(item != 0){
                            socket.send(explode[item]+"\n");
                        }
                    }
                }
                term.on('data', function(data) {
                    socket.send(data);
                });
                socket.onmessage = function(data) {
                    term.write(data.data);
                };
                socket.onclose = function() {
                    term.write("Connection closed.");
                };
            };
        }, false);
    }
    else {
        alert("Browser do not support WebSocket.");
    }
    
    function pasteHere(){
        socket.send(document.getElementById("pasteHere").innerHTML);
        document.getElementById("pasteHere").innerHTML = "";
        return false;
    }
</script>
