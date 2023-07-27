<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PHPUnit\Logging\TeamCity\TeamCityLogger;

class FeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return    [
            'id' => $this->id,
            'feedback' => $this->feedback,
            'teachers' => new TeacherResource($this->teacher),
            'term' => new TermResource ($this->term)
        ];
    }
}
