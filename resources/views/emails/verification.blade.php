<x-mail::message>
    # Verify Your Email Address

    Hi there,
    Welcome to {{ config('app.name', 'Laboratory Management System') }}! We are thrilled to have you on board.
    Please use the verification code below to complete your login and secure your account:
    <x-mail::panel>
        # {{ $code }}
    </x-mail::panel>

    This code will expire in 15 minutes.

    If you did not request this code or create an account with us, please ignore this email. No further action is
    required.

    Best regards,<br>
    The {{ config('app.name') }}
</x-mail::message>