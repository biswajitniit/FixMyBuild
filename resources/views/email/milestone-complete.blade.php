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
                                                    <td><img src="{{ asset('frontend/emailtemplateimage/Group181.svg') }}" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 style="font-size: 32px;">Project milestone complete</h2>
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
                                        {{-- @foreach($tasks as $key=>$task)
                                            @if($task->is_initial == 0) --}}
                                                <h5 style="color: #6d717a; font-size: 20px; line-height: 23px;">Milestone in your project titled "{{ $data['project_name'] }}" has been completed.</h5>
                                            {{-- @endif
                                        @endforeach --}}
                                        <h5 style="color: #6d717a; font-size: 20px; line-height: 23px;">If there is a payment due for this milestone, please make the payment through our website.</h5>

                                        <h5 style="color: #061a48; font-size: 16px; line-height: 23px; text-align: center; margin-bottom: 10px;">Team Fix My Build</h5>
                                        {{-- <a href="#" style="margin-right: 10px; text-decoration: none;">
                                            <img src="{{ asset('frontend/emailtemplateimage/facebook.svg') }}" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('frontend/emailtemplateimage/twitter.svg') }}" alt="">
                                        </a> --}}
                                    </td>
                                </tr>
                                <tr style='height: 70px;'>
                                </tr>
                                <tr>
                                    <td style='text-align:center'>
                                       <p>Copyright &copy; {{ date('Y') }} FixMyBuild. All Rights Reserved.</p>
                                       <a href="tel:{{ env('COMPANY_CONTACT_NO') }}" style='font-size: 14px;margin-right: 5px; text-decoration: none;color:#EE5719;'><img src="{{ asset('frontend/emailtemplateimage/phone.svg') }}" alt=''> {{ env('COMPANY_CONTACT_NO') }}</a>
                                       <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}" style='font-size: 14px;margin-right: 5px; text-decoration: none;color:#EE5719;'><img src="{{ asset('frontend/emailtemplateimage/mail.svg') }}" alt=''> {{ env('MAIL_FROM_ADDRESS') }}</a>
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
