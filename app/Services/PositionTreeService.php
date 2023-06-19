<?php
namespace App\Services;
use Location;
use Exception;
use App\Models\User;
use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PositionTreeService{

    public static function make($positions , $parent_id): array
    {
        $ids = [];
        return [
            'tree' => static::resolvePositions($positions, $ids , $parent_id),
            'ids' => $ids
        ];
    }

    /**
     * @param $positions
     * @param array $ids
     * @param null $parent_id
     * @return array
     */
    public static function resolvePositions($positions, array &$ids = [], $parent_id = null): array
    {
        $children = [];
        $positions = collect($positions)->filter(function ($item) use (&$children, $parent_id) {
            if ($item->parent_id != $parent_id) {
                $children[] = $item;
                return null;
            }
            return $item;
        });
        $json = [];
        foreach ($positions as $index => $position) {
            $ids[] = $position->id;
            $json[$index] = [
                'id' => $position->id,
                'title' => $position->title,
                'children' => array_values(static::resolvePositions($children , $ids ,  $position->id)),
            ];
        }
        return $json;
    }


}
