<x-mail::message>

    # Introduction

    Your reset passwrod link
    {{$mailData['url']}}

    <x-mail::button :url="$mailData['url']">
    Reset Password
    </x-mail::button>

    Thanks,<br>

    {{ config('app.name') }}

</x-mail::message>
