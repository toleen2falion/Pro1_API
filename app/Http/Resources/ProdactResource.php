<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\CRUD_Trait;
class ProdactResource extends JsonResource
{

    use CRUD_Trait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[
            'id'=>$this->id,
            'created from'=> $this->created_from($this->created_at),
            'name'=>$this->name,
            'Category_id'=>$this->category_id,

        ];
    }
}
