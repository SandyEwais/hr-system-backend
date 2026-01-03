<?php
namespace App\Enums;

enum OtpPurpose: string
{
    case SIGNUP = 'signup';
    case FORGOT_PASSWORD = 'forgot_password';
    case RESET_PASSWORD = 'reset_password';
    case LOGIN_PIN = 'login_pin';
}