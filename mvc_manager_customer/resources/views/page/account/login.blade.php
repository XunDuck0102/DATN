<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>Responsive Login Form HTML CSS | CodingNepal</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }
    body {
        display: grid;
        height: 100vh;
        width: 100%;
        place-items: center;
        background: linear-gradient(to right, #9e1f1e 0%, #9e1f1e 100%);
    }
    ::selection {
        background: #9e1f1e;
    }
    .container {
        background: #fff;
        max-width: 400px;
        width: 100%;
        padding: 10px 30px;
        border-radius: 5px;
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.15);
    }
    .container form .title {
        font-size: 30px;
        font-weight: 600;
        margin: 20px 0 10px 0;
        position: relative;
    }
    .container form .title:before {
        content: "";
        position: absolute;
        height: 4px;
        width: 33px;
        left: 0px;
        bottom: 3px;
        border-radius: 5px;
        background: linear-gradient(to right, #9e1f1e 0%, #9e1f1e 100%);
    }
    .container form .input-box {
        width: 100%;
        height: 50px;
        margin-top: 30px;
        position: relative;
    }
    .container form .input-box input {
        width: 100%;
        height: 100%;
        outline: none;
        font-size: 18px;
        border: none;
    }
    .container form .underline::before {
        content: "";
        position: absolute;
        height: 2px;
        width: 100%;
        background: #ccc;
        left: 0;
        bottom: 0;
    }
    .container form .underline::after {
        content: "";
        position: absolute;
        height: 2px;
        width: 100%;
        background: #9e1f1e;
        left: 0;
        bottom: 0;
        transform: scaleX(0);
        transform-origin: left;
        transition: all 0.3s ease;
    }
    .container form .input-box input:focus ~ .underline::after,
    .container form .input-box input:valid ~ .underline::after {
        transform: scaleX(1);
        transform-origin: left;
    }
    .container form .button {
        margin: 40px 0 20px 0;
    }
    .container .input-box input[type="submit"] {
        background: #9e1f1e;
        font-size: 18px;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }
    .container .input-box input[type="submit"]:hover {
        background: linear-gradient(to left, #9e1f1e 0%, #9e1f1e 100%);
    }
    .container .option {
        font-size: 14px;
        text-align: center;
    }
    .container .option div {
        display: flex;
        align-items: center;
    }
    .container .facebook a,
    .container .twitter a {
        display: block;
        height: 50px;
        width: 100%;
        font-size: 15px;
        text-decoration: none;
        padding-left: 20px;
        line-height: 50px;
        color: #fff;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .container .facebook i,
    .container .twitter i {
        padding-right: 12px;
        font-size: 20px;
    }
    .container .twitter a {
        background: linear-gradient(to right, #00acee 0%, #1abeff 100%);
        margin: 20px 0 15px 0;
    }
    .container .twitter a:hover {
        background: linear-gradient(to left, #00acee 0%, #1abeff 100%);
        margin: 20px 0 15px 0;
    }
    .container .facebook a {
        background: linear-gradient(to right, #3b5998 0%, #476bb8 100%);
        margin: 20px 0 50px 0;
    }
    .container .facebook a:hover {
        background: linear-gradient(to left, #3b5998 0%, #476bb8 100%);
        margin: 20px 0 50px 0;
    }

</style>
<body>
<div class="container">
    <form action="{{ route('auth.postLogin') }}" method="post">
        @csrf
        <div class="title">Đăng nhập</div>
        <div class="input-box underline">
            <input type="text" placeholder="Nhập email của bạn" required name="email" />
            <div class="underline"></div>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Nhập mật khẩu của bạn" required name="password" />
            <div class="underline"></div>
        </div>
        <div class="input-box button">
            <input type="submit" value="Tiếp tục" />
        </div>
    </form>
</div>
</body>
</html>
