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
                                <h4 style="font-size:16px; font-family: Arial; margin:0; color: #3C56A1;">Dear {{$user->firstname}},</h4>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <p
                                    style="font-size: 14px; font-family: Arial; line-height: 21px; margin: 0; padding-bottom: 15px;">
                                    Please note that your password has been successfully reset and now you may
                                    access your account using your {{$user->email}} and new password.</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <p
                                    style="font-size: 14px; font-family: Arial; line-height: 21px; margin: 0; padding-bottom: 15px;">
                                    If you face any errors or need assistance, please write to us on
                                    <a href="javascript:void(0);" style="color: #3C56A1;">info@daisy-health.com
                                    </a>or call us on number.</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <p style="font-size: 14px; font-family: Arial; margin: 0; padding-bottom: 30px;">
                                    Once again thank you and always here to assist.</p>
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
                                style="font-size: 14px; font-family: Arial; margin: 0; font-weight:bold; color: #3C56A1; padding-bottom: 15px;">
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
@endsection