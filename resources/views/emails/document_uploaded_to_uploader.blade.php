@component('mail::message')
  # Evrağınız Yüklendi

  {{ $emailData['document_name'] }} adlı belgeniz başarıyla yüklendi ve incelemeye alındı.

  Teşekkürler,<br>
  {{ config('app.name') }}
@endcomponent
