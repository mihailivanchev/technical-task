<?php

namespace App\Repository;

use App\Models\EmailNotification;

class EmailNotificationRepository
{
    /**
     * @param $data
     * @return void
     */
    public function saveEmailNotification($data): void
    {
        EmailNotification::upsert($data, 'email');
    }

}
