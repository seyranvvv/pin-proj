<h1>Login</h1>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="submit">
</form>

<ul>
    @foreach ($users as $user)
    <li>
        <b>email:</b>{{ $user->email }};
        <b>password:</b> password;
        <b>role:</b> {{ $user->role }};
    </li>
    @endforeach
</ul>
