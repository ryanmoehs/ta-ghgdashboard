<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SensorAdded extends Notification
{
    use Queueable;

    public $sensor;

    public function __construct($sensor)
    {
        $this->sensor = $sensor;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Sensor Baru',
            'message' => 'Sensor ' . $this->sensor->sensor_name . ' berhasil ditambahkan.',
            'sensor_id' => $this->sensor->id,
        ];
    }
}