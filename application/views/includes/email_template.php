<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $email_subject; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    </head>
    <body style="color: #4e566d; font-size: 14px; font-family: sans-serif, Tahoma; margin: 0; padding: 20px; line-height: 1.3;">
        <table bgcolor="#fff" border="0" align="center" cellpadding="0" cellspacing="0" width="650" style="border: 1px solid #eee; border-radius: 4px;">
            <tbody style="background-image:url('<?=base_url('assets/images/email_back.png')?>');  background-repeat: no-repeat; ">
                <tr valign="middle">
                    <td style="padding: 40px 15px 50px; font-size:24px;  color:white" align="center">
                        Crainly
                    </td>
                </tr>
                <tr>
                    <td  align="center" >
                        <table  width="65%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center"  bgcolor="#ffffff"  style="color:black; text-align:center;border-radius:5px; padding:5px 5px 50px" >
                                    <table  style="border-spacing:0"   width="100%">
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff"  align="center" style="padding: 30px 15px 0; font-size:24px; color:black; text-align:center;">
                                                <?php echo $email_subject; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff" style="padding: 50px 15px 20px;">
                                                <?php echo $email_body; ?>
                                            </td>
                                        </tr>
                                        <?php if(isset($loginlink) && $loginlink != null) {?>
                                            <tr>
                                                <td style="color:#58585A;padding:20px 20px 40px;" align="center">
                                                    <table cellpadding="0" cellspacing="0" style=" margin: 0;">
                                                        <tr>
                                                        <td style="padding:8px 50px;background:#2cb1ff;   border-radius: 3px;font-size: 16px;line-height: 20px;">
                                                            <a style='background: #2cb1ff;color: white;    text-decoration: none;' href='<?=$loginlink?>'> Login</a>
                                                        </td>
                                                            
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php }?>
                                        <tr>
                                            <td align="left" valign="top" bgcolor="#ffffff" style="font-size:14px; padding: 10px 15px 20px;">
                                               If you have any questions, just reply to this email-we're always happy to help out.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" bgcolor="#ffffff" style="font-size:14px; padding: 0px 15px;">
                                               Cheers
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" bgcolor="#ffffff" style="font-size:14px; padding: 0px 15px 20px;">
                                               Crainly team
                                            </td>
                                        </tr>
                                        <?php if(isset($need_help) && $need_help == true) {?>
                                            <tr>
                                                <td valign="top" bgcolor="#fafafa"  align="center" style="padding: 0px 15px 0; font-size:16px; color:black; text-align:center">
                                                    Need more help?
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" align="center"  style="font-size: 16px;line-height: 20px; padding: 10px 15px 20px; text-align:center">
                                                    <a style='color: #2cb1ff ' href='<?= site_url('contact-us')?>'> We're here, ready to talk</a>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>