@component('mail::message')
<p>Bem vindo, <span style="color: #0072b4; font-weight: bold;">{{ $user->name }}</span>! </p>
<p>Você recebeu acesso à plataforma de notícias {{ env('APP_NAME') }}.</p>
<p>Sua senha de acesso é: <strong>{{ $password }}</strong></p>
<p>É importante que esta senha seja alterada ao realizar o login.</p>
<p>Clique <a href="{{ env('APP_URL')  }}" target="_blank">aqui</a> para acessar. </p></div>
@endcomponent
