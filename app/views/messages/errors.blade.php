@if ( $errors->all() )

  <ul class="flash error">
    @foreach ( $errors->all( '<li>:message</li>' ) as $error )
      {{ $error }}
    @endforeach
  </ul>

@endif