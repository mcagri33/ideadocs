<?php

namespace App\Events;

use App\Models\Documents;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DocumentStatusUpdated
{
  use Dispatchable, SerializesModels;

  public $document;
  public $user;
  public $newStatus;

  public function __construct(Documents $document, User $user, $newStatus)
  {
    $this->document = $document;
    $this->user = $user;
    $this->newStatus = $newStatus;
  }
}
