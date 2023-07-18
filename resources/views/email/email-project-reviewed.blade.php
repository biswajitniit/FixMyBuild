<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>FixMyBuild</title>
        <meta name="description" content="" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
        <style>
            body {
                font-family: "Roboto", sans-serif;
            }
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            p,
            a {
                font-family: "Roboto", sans-serif;
            }
        </style>
    </head>
    <body>
        <table
            align="center"
            border="0"
            cellpadding="0"
            cellspacing="0"
            style="background: #f6f6f6; padding: 20px; color: #232f3e; font-family: helvetica, arial, sans-serif; font-size: 15px; line-height: 24px; margin: 20px auto 0; width: 600px;">
            <tbody>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; padding: 10px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; text-align: center;">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('frontend/emailtemplateimage/fix-my-build.svg') }}" alt="">
                                                    </td>
                                                </tr>
                                                <tr style="height: 40px;">
                                                    <td><img src="{{ asset('frontend/emailtemplateimage/Mask group.svg') }}" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @if($data['reviewer_status'] == 'approved')
                                                            <h2 style="font-size: 32px;">Project approved</h2>
                                                        @else
                                                            <h2 style="font-size: 32px;">Project reviewed</h2>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="height: 30px;">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; background: #fff; padding: 20px 30px; border-radius: 10px;">
                                        @if($data['reviewer_status'] == 'approved')
                                            <h5 style="color: #6d717a; font-size: 20px; font-weight: 100; line-height: 23px;">Thank you for submitting your project {{ ucwords($data['project_name']) }}. Our team have sent your project to tradespeople in order to obtain estimates.</h5>
                                            <p><strong>Message from Reviewer :</strong> {{ $data['notes_for_customer'] }}</p>
                                        @else
                                            <h5 style="color: #6d717a; font-size: 20px; font-weight: 100; line-height: 23px;">Thank you for submitting your project. Our team have reviewed your project and require some more information:</h5>
                                            <p><strong>Once at least one estimate has been received we will let you know.</p>
                                        @endif

                                        <h5 style="color: #061a48; font-size: 16px; line-height: 23px; text-align: center; margin-bottom: 10px;">Team Fix My Build</h5>
                                        <a href="#" style="margin-right: 10px; text-decoration: none;">
                                            <img src="{{ asset('frontend/emailtemplateimage/facebook.svg') }}" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('frontend/emailtemplateimage/twitter.svg') }}" alt="">
                                        </a>
                                    </td>
                                </tr>
                                <tr style='height: 70px;'>
                                    <td><h5>If you would like to unsubscribe from this notification please amend your settings <a href="{{ route('customer.notifications') }}">here.</a><h5></td>
                                </tr>
                                <tr>
                                    <td style='text-align:center'>
                                       <p>Copyright &copy; {{ date('Y') }} FixMyBuild. All Rights Reserved.</p>
                                       <a href="tel:+447975777666" style='font-size: 14px;margin-right: 5px; text-decoration: none;color:#EE5719;'><img src="{{ asset('frontend/emailtemplateimage/phone.svg') }}" alt=''> +447975777666</a>
                                       <a href="support@fixmybuild.com" style='font-size: 14px;margin-right: 5px; text-decoration: none;color:#EE5719;'><img src="{{ asset('frontend/emailtemplateimage/mail.svg') }}" alt=''> help@fixmybuild.com</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
