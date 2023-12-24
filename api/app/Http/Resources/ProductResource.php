<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'cate_id'=>$this->cate_id,
            'cate_name'=>$this->getCategory->name,
            'desc'=>$this->desc,
            'price'=>$this->price,
            'maxRrice'=>$this->maxPrice,
            'minPrice'=>$this->minPrice,
            'discount'=>$this->discount,
            'status'=>$this->status,
            'img'=> $this->img ? 'http://127.0.0.1:8000/img/'.$this->img : 'http://127.0.0.1:8082/img/empty.jpg',
        ];
    }
}
