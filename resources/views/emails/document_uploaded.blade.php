@component('mail::message')
  # Evrağınız Yüklendi

  Merhaba {{ $user_name }},

  {{ $document_name }} belgeniz başarıyla yüklendi ve onay bekliyor.

  Teşekkürler,<br>
  {{ config('app.name') }}
@endcomponent
