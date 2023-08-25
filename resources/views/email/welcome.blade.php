<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{\App\Helpers\SiteHelper::settings()['AppName']}}</title>

    <style type="text/css">
        body{
            margin: 30px;
            font-family: Arial,
            Helvetica, sans-serif;
        }

        .btn-primary {
            color: #fff !important;
            background-color: {{\App\Helpers\SiteHelper::settings()['PrimaryColor']}};
            border-color: {{\App\Helpers\SiteHelper::settings()['PrimaryColor']}};
            text-decoration: none !important;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        @media only screen and (max-width: 767px){
            .inner-column {
                margin-left: 0;
                max-width: 100%;
                text-align: justify;
            }
        }

        @media only screen and (min-width: 768px){
            .inner-column {
                margin-left: 20%;
                margin-right: 20%;
                max-width: 100%;
                text-align: justify;
            }
        }
    </style>
</head>
<body>
<div>
    <div class="inner-column">
        <div style="text-align: center;">
            <b>How to sell</b>
        </div>
        <div>
            <p style="margin-top: 2rem !important; font-size: 14px;">Hello! {{$name}}</p>
            <p style="margin-top: 0.3rem; font-size: 14px;">Thank you for registering.</p>
        </div>

        <div style="margin-top: 15px;">
            <p style="margin-top: 0.3rem !important; font-size: 14px;">We are thrilled to welcome you to our exciting multi-vendor.We are excited to have you on board.</p>
        </div>

        <p style="margin-top: 15px; font-size: 14px;">
            Regards,
            <br>
            <span style="color: #1818CD !important;">{{\App\Helpers\SiteHelper::settings()['AppName']}}</span>
        </p>
    </div>
</div>
</body>
</html>