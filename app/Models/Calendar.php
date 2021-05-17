<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'calendar';
    public $timestamps = false;

    public static function prepareEventsJson()
    {
        $prepared_events = [];
        $events = self::all()->toArray();

        foreach ($events as $event) {
            $temp_event['id'] = $event['id'];
            $temp_event['resourceId'] = $event['event_id'];
            $temp_event['title'] = $event['event_name'];
            $temp_event['start'] = $event['start_date'];
            if (!empty($event['end_date']))
                $temp_event['end'] =
                    $event['end_date']; //+1 dan je zbog toga što fullcalendar ne uključuje datum kraja
            else
                //mora se raditi unset jer ukoliko imamo jedan sa end-om, te nakon njega drugi bez, ostat ce isti end i za taj iza
                unset($temp_event['end']);

            $temp_event['description'] = nl2br($event['event_description']);
            $temp_event['color'] = $event['event_color'];

            $prepared_events[] = $temp_event;
        }

        return $prepared_events;
    }
}
