<?php

namespace App\Repositories\V1\contracts;

use App\Models\SavedPosts;

interface SavedRepositoryInterface
{
    public function save_items(int $user_id, array $items): SavedPosts;
    public function user_has_saved_record(int $user_id): bool;
    public function get_saved_items(int $user_id): array;
}
