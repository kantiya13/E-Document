<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Newsbit</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <!--CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>

</head>
<body>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="caixa">
                    <h1 class="text-center txt-caixa mb-5">
                        <img src="../img/logo-transladoweb.png" alt="" width="200"/><br>
                        E-Document Login
                    </h1>
                    <hr>
                    <form action="" method="POST">
                        <div class="row p-4">
                            <div class="col-lg-9 col-md-9">
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                            <input type="text" class="formRow--input js-input" id="username" placeholder="Username">
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <label for="password" class="formRow--input-wrapper js-inputWrapper">
                                            <input type="password" class="formRow--input js-input" id="password" placeholder="Password ">
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <button type="submit" class="vamos_mudar_um_pouco" style="background-color: #F9B500;border: 0px" title="Login"><i
                                            class="fas fa-sign-in-alt fa-2x"></i></button>
                            </div>
                            <div class="col-lg-12 col-md-12 mt-3 ml-2">
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <p style="font-size: 15px">Do you have an account? <a href="regiter_user.php">regiter </a></p st>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</div>
<script>
    var $inputItem = $(".js-inputWrapper");
    $inputItem.length && $inputItem.each(function () {
        var $this = $(this),
            $input = $this.find(".formRow--input"),
            placeholderTxt = $input.attr("placeholder"),
            $placeholder;

        $input.after('<span class="placeholder">' + placeholderTxt + "</span>"),
            $input.attr("placeholder", ""),
            $placeholder = $this.find(".placeholder"),

            $input.val().length ? $this.addClass("active") : $this.removeClass("active"),

            $input.on("focusout", function () {
                $input.val().length ? $this.addClass("active") : $this.removeClass("active");
            }).on("focus", function () {
                $this.addClass("active");
            });
    });
</script>
</body>
<style>
    .caixa {
        padding: 20px;
        border-radius: 5px;
        border: 1px solid rgba(0, 0, 0, .2);
        box-shadow: 0 0 20px rgba(0, 0, 0, .2);
        margin-top: 25%;
        background-color: #fff !important;
        z-index: 99;
    }

    .formRow {
        position: relative;
        width: 100%;
        border-color: transparent;
        padding: 0;
        margin: 0;
    }

    .formRow--item {
        display: block;
        width: 100%;
    }

    .formRow--input {
        background-color: transparent;
        position: relative;
        padding: 15px 0 11px;
        width: 100%;
        outline: none;
        border-bottom: 1.5px solid rgba(0, 0, 0, .3);
        border-left: transparent;
        border-right: transparent;
        border-top: transparent;
        letter-spacing: .2px;
        font-weight: 400;
        font-size: 16px;
        resize: none;
        -webkit-transition: all .2s ease;
        transition: all .2s ease;
    }

    .formRow--input-wrapper {
        position: relative;
        display: block;
        width: 100%;
    }

    .formRow--input-wrapper.active .placeholder {
        top: -5px;
        background-color: transparent;
        color: rgba(0, 0, 0, .5);
        font-size: 11px;
        -webkit-transform: translateY(0);
        transform: translateY(0);
        font-family: sans-serif;
    }

    .formRow .placeholder {
        position: absolute;
        top: 50%;
        left: 10px;
        display: block;
        color: rgba(0, 0, 0, .5);
        white-space: nowrap;
        letter-spacing: .2px;
        -webkit-transition: all, .2s;
        transition: all, .2s;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        pointer-events: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-family: sans-serif;
        font-weight: 600;
        font-size: 14px;
    }

    .vamos_mudar_um_pouco {
        height: 100%;
        width: 100%;
        border-radius: 0;
        border: 2px solid rgba(0, 0, 0, .2);
        background-color: #5a667c;
        cursor: pointer;
        color: #fff;
        text-shadow: 2px 2px 10px rgba(255, 255, 255, .5);
    }
</style>
</html>