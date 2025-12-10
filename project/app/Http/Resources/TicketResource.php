<?php

namespace App\Http\Resources;

use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'customer_id' => $this->customer_id,
            'theme' => $this->theme,
            'text' => $this->text,
            'status' => Status::where('id', $this->status_id)->value('name'),
            'response_date' => Carbon::create($this->response_date)->format('Y-m-d'),
        ];
    }
}
