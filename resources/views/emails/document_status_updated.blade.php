@component('mail::message')
  # Evrak Durumu Güncellendi

  Sayın {{ $user->name }},

  {{ $document->document_name }} adlı evrakınızın durumu güncellendi. Yeni durum: {{ $status_text }}.

  Teşekkürler,<br>
  {{ config('app.name') }}
@endcomponent
