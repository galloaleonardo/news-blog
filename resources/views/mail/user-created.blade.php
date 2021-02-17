@component('mail::message')
<p>Bem vindo <span style="color: #0072b4; font-weight: bold;">{{ $user->name }}</span>! </p>
<p>Foi recebeu acesso à plataforma XXXXX.</p>
<p>Sua senha provisória: <strong>{{ $password }}</strong>. É importante que esta senha seja alterada ao realizar o login.</p>
<p>Clique <a href="#" target="_blank">aqui</a> para acessar. </p></div>
@endcomponent
