<?php

namespace App\Jobs;

use App\Events\testWebsocket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use PhpMqtt\Client\Facades\MQTT;


class MqttSubscriberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $mqtt = MQTT::connection();
        $mqtt->subscribe('GreenHouseGas', function (string $topic, string $message) {
            $data = json_decode($message, true);
            // // $mqtt_message = new MQTT();
            
            // // $mqtt_message->sensor_name = $data['sensor_name'];
            // // $mqtt_message->CH4 = $data['CH4'];
            // // $mqtt_message->CH2 = $data['CH2'];
            // // $mqtt_message->timestamp = now();
            // // $mqtt_message->save();
            // echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
            DB::table('mqtt_messages')->insert([
                'sensor_name' => $data['sensor_name'],
                'CH4' => $data['CH4'],
                'CH2' => $data['CH2'],
                'timestamp' => now()
            ]);
            broadcast(new testWebsocket($data));
        }, 1);
        $mqtt->loop(true);

    }
}
