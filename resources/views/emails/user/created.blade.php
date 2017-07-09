@component('mail::message')
# Hello {{ $user->name }}!

You are receiving this email because {{ config('app.name') }} create new account for you with details :-
<table>
    <tr>
        <td><b>Email</b></td>
        <td><b> : </b></td>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <td><b>Password</b></td>
        <td><b> : </b></td>
        <td>{{ $password }}</td>
    </tr>
</table>

@component('mail::button', ['url' => config('app.url')])
Visit {{ config('app.name') }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
