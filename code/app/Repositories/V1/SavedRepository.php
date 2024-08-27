<?php

namespace App\Repositories\V1;

use App\Models\SavedPosts;
use App\Repositories\V1\contracts\SavedRepositoryInterface;

class SavedRepository implements SavedRepositoryInterface
{
    public function save_items(int $user_id, array $items): SavedPosts
    {
        return SavedPosts::updateOrCreate(
            ['user_id' => $user_id],
            ['items'   => json_encode($items)]
        );
    }

    public function user_has_saved_record(int $user_id): bool
    {
        return SavedPosts::where('user_id', $user_id)->exists();
    }

    public function get_saved_items(int $user_id): array
    {
        if(! $this->user_has_saved_record($user_id)) {
            return [];
        }

        $saved = SavedPosts::where('user_id', $user_id)->first();
        return json_decode($saved->items, true);
    }
}
