<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\CRUD_Trait;
use App\Http\Resources\ProdactResource;


class CategoryResource extends JsonResource
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
            'Super Category'=>$this->superCategory_id,
            'products'=>ProdactResource::collection($this->products),
            // $this->products,
            'sub Categoris'=>CategoryResource::collection($this->children),
            
        ];
    }
}
