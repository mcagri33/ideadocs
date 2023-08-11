@component('mail::message')
  # Yeni Evrak Yüklendi

  {{ $emailData['uploader']->name }} adlı kullanıcı {{ $emailData['document_name'] }} adlı belgeyi yükledi  ve onayınızı bekliyor.

  {{ config('app.name') }}
@endcomponent
