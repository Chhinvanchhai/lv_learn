<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Slider Captcha Demo</title>
    <link href="src/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{ { asset('src/disk/slidercaptcha.css') } }" rel="stylesheet" />
    <style>
        .slidercaptcha {
            margin: 0 auto;
            width: 314px;
            height: 286px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.125);
            margin-top: 40px;
        }
        .slidercaptcha .card-body {
            padding: 1rem;
        }
        .slidercaptcha canvas:first-child {
            border-radius: 4px;
            border: 1px solid #e6e8eb;
        }
        .slidercaptcha.card .card-header {
            background-image: none;
            background-color: rgba(0, 0, 0, 0.03);
        }
        .refreshIcon {
            top: -54px;
        }

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="form-row">
            <div class="col-12">
                <div class="slidercaptcha card">
                    <div class="card-header">
                        <span>请完成安全验证!</span>
                    </div>
                    <div class="card-body">
                        <div id="captcha"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"> </script>
    <script src="{ { asset('src/disk/longbow.slidercaptcha.js') } }"></script>
    <script>
        var dataArr = []
        var captcha = sliderCaptcha({
            id: 'captcha',
            setSrc: function () {
                return 'http://127.0.0.1:8000/src/images/Pic' + Math.round(Math.random() * 2) + '.jpg';
            },
            onSuccess: function (data) {
                    //成功事件
                var handler = setTimeout(function () {
                    // window.clearTimeout(handler);
                    captcha.reset();
                }, 500);
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/captcha',
                    data: JSON.stringify(dataArr),
                    async: false,
                    cache: false,
                    type: 'post',
                    contentType: 'application/json',
                    dataType: 'json',
                    success: function (result) {
                        ret = result;
                    }
                });
            },
            verify: function (arr, url) {
                var ret = false;
                dataArr = arr
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/captcha',
                    data: JSON.stringify(arr),
                    async: false,
                    cache: false,
                    type: 'post',
                    contentType: 'application/json',
                    dataType: 'json',
                    success: function (result) {
                        ret = result;
                    }
                });
                return ret;
            },
            remoteUrl: "api/captcha"

        });

    </script>
</body>

</html>
