<?php

namespace App\Services\V1;

use App\Models\SavedPosts;
use App\Repositories\V1\contracts\SavedRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SavedService
{
    public function __construct(protected SavedRepositoryInterface $savedRepository)
    {
    }

    public function save_post(int $post_id, string $directory_name=null): SavedPosts
    {
        //@TODO: after adding authentication, fix this part
//        if(! Auth::check()) {
//            throw new \Exception('authentication failed', 401);
//        }

        $user_id = 1;//Auth::user()->id;
        $items = $this->savedRepository->user_has_saved_record($user_id)
            ? $this->savedRepository->get_saved_items($user_id)
            : ['others' => []];

        $directory_name ??= 'others';
        $items[$directory_name][] = $post_id;
        $items[$directory_name] = array_unique($items[$directory_name]);

        return $this->savedRepository->save_items($user_id, $items);
    }

    public function remove_saved_post(int $post_id): bool
    {
        //@TODO: after adding authentication, fix this part
//        if(! Auth::check()) {
//            throw new \Exception('authentication failed', 401);
//        }

        $user_id = 1;//Auth::user()->id;
        $saved_items = $this->savedRepository->get_saved_items($user_id);
        if($this->post_is_saved($post_id, $saved_items)) {
            foreach($saved_items as $directory_name => $items_array) {

                if(in_array($post_id, $items_array)){
                    $indx = array_search($post_id, $items_array);
                    unset($items_array[$indx]);
                    $saved_items[$directory_name] = array_values($items_array);
                    $this->savedRepository->save_items($user_id, $saved_items);
                    return true;
                }
            }
        }

        return false;
    }

    public function remove_saved_directory(string $directory_name): bool
    {
        //@TODO: after adding authentication, fix this part
//        if(! Auth::check()) {
//            throw new \Exception('authentication failed', 401);
//        }

        $user_id = 1;//Auth::user()->id;
        $saved_items = $this->savedRepository->get_saved_items($user_id);
        if(array_key_exists($directory_name, $saved_items)) {
            unset($saved_items[$directory_name]);
            $this->savedRepository->save_items($user_id, $saved_items);
            return true;
        }
        return false;
    }

    public function move_post_to_new_directory(int $post_id, string $new_directory_name, string $old_directory_name): bool
    {
        //@TODO: after adding authentication, fix this part
//        if(! Auth::check()) {
//            throw new \Exception('authentication failed', 401);
//        }

        if($new_directory_name == $old_directory_name) {
            return true;
        }

        $user_id = 1;//Auth::user()->id;
        $saved_items = $this->savedRepository->get_saved_items($user_id);

        if(array_key_exists($old_directory_name, $saved_items)) {
            $key = array_search($post_id, $saved_items[$old_directory_name]);
            unset($saved_items[$old_directory_name][$key]);
        }
        $saved_items[$new_directory_name][] = $post_id;
        $this->savedRepository->save_items($user_id, $saved_items);
        return true;
    }

    public function post_is_saved(int $post_id, array $saved_items): bool
    {
//        if(! $this->savedRepository->user_has_saved_record($user_id)){
//            return false;
//        }
//
//        $saved_items = $this->savedRepository->get_saved_items($user_id);
        return in_array($post_id, array_merge(...array_values($saved_items)));
    }
}
