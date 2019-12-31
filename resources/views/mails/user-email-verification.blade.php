@extends('mails.layouts.index')
@section('content')
<tr>
    <td valign="top">
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr>
                <td valign="top" width="20"></td>
                <td valign="top" width="660">
                    <table cellpadding="0" cellspacing="0" border="0" width="660">
                        <tr>
                            <td valign="top">
                                <h4 style="font-size:16px; font-family: Arial; margin:0; color: #3C56A1;">Dear {{ $user->firstname }},</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p
                                    style="font-size: 15px; font-family: Arial; margin: 0; padding-bottom: 10px;">
                                    Thank You for registering Forex Twist.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <p
                                    style="font-size: 14px; font-family: Arial; margin: 0; padding-bottom: 22px;">
                                    Kindly click the below mentioned “Verify Email” to get your email verified.</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" style="padding-bottom: 20px;"></td>
                        </tr>
                        <tr>
                            <td valign="top" style="text-align: center; padding-bottom: 22px;">
                                <a href="{{$action_url}}" target="_blank;"
                                    style="font-family: Arial; text-transform: uppercase; background: #3C56A1; padding: 10px 80px; border-radius:5px; text-decoration: none; color: white;">Verify Email</a>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" style="padding-bottom: 20px;"></td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table cellspacing="0" cellpadding="0" width="100%" border="0">
                                    <tr>
                                        <td valign="top" width="20">
                                            <span
                                                style="font-size: 28px; line-height: 16px; color:#3C56A1;">&bull;</span>
                                        </td>
                                        <td valign="top" width="640">
                                            <p
                                                style="font-size: 14px;font-family: Arial; margin: 0; padding-bottom: 42px; display: inline-block; vertical-align: top;">
                                                If you face any errors or need assistance, please write to us on
                                                <a href="javascript:void(0);"
                                                    style="color: #3C56A1;">info@daisy-health.com
                                                </a>or call us on number.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"
                                style="font-size: 14px; font-family: Arial; margin: 0; padding-bottom: 15px;">
                                <span> Thanks, </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" style="font-size: 14px; font-family: Arial; margin: 0;">
                                <span>Daisy-Health Team</span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"
                                style="font-size: 14px; font-family: Arial; margin: 0; font-weight:bold; color: #3C56A1;">
                                <span>"Monitoring Health to Blossom"</span>
                            </td>
                        </tr>
                    </table>
                </td>
                <td valign="top" width="20"></td>
            </tr>
        </table>
    </td>
</tr>

<tr>
    <td valign="top">
        <table cellpadding="0" cellspacing="0" border="0">

            <tr>
                <td valign="top" width="10"></td>
                <td valign="top" width="680">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top" style="border-bottom: 1px solid #3C56A1; padding-bottom: 10px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p
                                    style="font-family: Arial; font-size:12px; color: #666666; padding-bottom:10px;">
                                    If you’re having trouble clicking the "Verify Email" button, copy and
                                    paste
                                    the
                                    URL below into your web browser:{{$action_url}}</p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td valign="top" width="10"></td>
            </tr>
        </table>
    </td>
</tr>
@endsection