@component('mail::message')
  # Evrak Durumu Güncellendi

  Sayın {{ $user->name }},

  {{ $document->document_name }} adlı evrakınızın durumu güncellendi. Yeni durum:
  @if ($newStatus == 2)
    "Onay Bekliyor"
  @elseif ($newStatus == 1)
    "Onaylandı"
  @elseif ($newStatus == 0)
    "Reddedildi"
  @else
    "Bilinmeyen Durum"
  @endif

  Teşekkürler,<br>
  {{ config('app.name') }}
@endcomponent
