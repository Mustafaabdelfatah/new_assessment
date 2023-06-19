<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;

class PositionController extends Controller
{
     /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('dashboard.pages.positions.index', [
            'positions' => Position::with('parent_position')->latest()->get()
        ]);
    }

     /**
     * @param id $id
     * @return Application|Factory|View
     */
    public function getPosition($id)
    {
        $position = Position::findOrFail($id);
        $positions = Position::get();
        return view('dashboard.pages.positions.edit',compact('positions','position'));
    }


    /**
     * @param PositionRequest $request
     * @return Application|Factory|View
     */
    public function store(PositionRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->parent_id == 'select parent position') {
            $validatedData['parent_id'] = null;
        }
        $position = Position::create($validatedData);
        return view('dashboard.pages.positions.render', [
            'position' => $position,
            'create' => true
        ]);
    }

    /**
     * @param PositionRequest $request
     * @param Position $Position
     * @return Application|Factory|View
     */
    public function update(PositionRequest $request, Position $position)
    {
        $validatedData = $request->validated();
        if ($request->parent_id == 'select parent position') {
            $validatedData['parent_id'] = null;
        }
        $position->update($validatedData);
        return view('dashboard.pages.positions.render', [
            'position' => $position,
            'create' => false
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $position = Position::select('id')
            ->where('id', $id)
            ->withCount(['child_positions','users'])
            ->first();

        $position_array = $position->toArray();
        unset($position_array['id']);
        if (max(array_values($position_array))) {
            return response()->json([
                'message' => trans('Unable To Delete This Position Because It BelongsTo Another Modules'),
            ], 403);
        }

        $position->delete();

        return response()->json([
            'success' => true,
            'message' => 'Position deleted successfully'
        ]);
    }
}
