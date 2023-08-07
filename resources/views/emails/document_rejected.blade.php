@component('mail::message')
  # Evrağınız Rededildi

  Merhaba {{ $user_name }},

  {{ $document_name }} belgeniz reddedildi.

  Teşekkürler,<br>
  {{ config('app.name') }}
@endcomponent
