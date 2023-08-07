@component('mail::message')
  # Evrağınız Onaylandı

  Merhaba {{ $user_name }},

  {{ $document_name }} belgeniz başarıyla onaylandı.

  Teşekkürler,<br>
  {{ config('app.name') }}
@endcomponent
