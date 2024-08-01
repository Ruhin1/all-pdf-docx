<?php 
  if(!($_GET['code']) && !($_GET['code'] === 301)){
    header("location:./index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Docx - Error-page</title>
    <style>
        
        .error-image{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
        .error p{
            text-align: center;
        }
        .error p span{
            font-size: 30px;
            font-weight: bold;
            color: red;
        }
        .contactaddresstyle{
            font-weight: bold;
            background-color: green;
            color: yellow !important;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="error">
    <div>
        <img class="error-image" src="./assets/image/error.png" alt="error-image">
    </div>
    <p><span>Someting weint wrong</span> please contact email: <span class="contactaddresstyle">mdruhinahmed93@gmail.com</span> or phone: <span class="contactaddresstyle">01890024840</span>.</p>
    </div>
</body>
</html>