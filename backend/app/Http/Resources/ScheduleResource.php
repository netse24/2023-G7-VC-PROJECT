<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'course_id' =>$this->course_id,
            'teacher_id' =>$this->teacher_id,
            'class_id' =>$this->class_id,
            'room_id' =>$this->room_id,
            'start_date' =>$this->start_date,
            'end_date' =>$this->end_date,
            'start_time' =>$this->start_time,
            'end_time' =>$this->end_time
        ];
    }
}
