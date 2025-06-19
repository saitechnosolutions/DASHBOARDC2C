<!DOCTYPE html>
<html>

<head>
    <title>Enrollment Email</title>
</head>

<body style="background-color: #F2F5DE; padding: 1rem; font-family: monospace;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #F2F5DE; padding: 1rem;">
        {{-- <tr>
            <td align="center">
                <img src="/assets/images/logo/logo_slogan.png" alt="logo" height="100px" width="150px">
            </td>
        </tr> --}}
        <tr>
            <td align="center" style="margin-top: 2.5rem;">
                <div
                    style="background-color: white; padding: 1rem; border-radius: 5px; max-width: 600px; margin: auto;">
                    <h3 style="margin-bottom: 1rem;">
                        Dear Vendor,
                    </h3>

                    <p style="line-height: 1.5;">
                        We hope this message finds you well. We're writing to inform you that we enrolled you as a
                        vendor in colors2cart.
                        The login details is attached below.
                    </p>

                    <h4 style="margin-top: 2rem;">
                        Login Details:
                    </h4>

                    <p style="line-height: 1.5;">
                        Vendor Name : {{ $vendorname }}<br>
                        Email : {{ $email }}<br>
                        Password: {{ $password }}
                    </p>
                </div>
            </td>
        </tr>
        <tr>
            <td align="center" style="margin-top: 2.5rem;">
                <h2>Thank you</h2>
            </td>
        </tr>
    </table>
</body>


</html>
