<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DokumenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_dokumen' => $this->id_dokumen,
            'id_detail_pengajuan' => $this->id_detail_pengajuan,
            'patch_dokumen' => asset('/storage/' . $this->patch_dokumen)
        ];
    }
}
