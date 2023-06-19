<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('dashboard.pages.categories.index', [
            'categories' => Category::latest()->get()
        ]);
    }

     /**
     * @param id $id
     * @return Application|Factory|View
     */
    public function getCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.pages.categories.edit')->with('category', $category);
    }


    /**
     * @param CategoryRequest $request
     * @return Application|Factory|View
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return view('dashboard.pages.categories.render', [
            'category' => $category,
            'create' => true
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return Application|Factory|View
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return view('dashboard.pages.categories.render', [
            'category' => $category,
            'create' => false
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $category = Category::select('id')
            ->where('id', $id)
            ->withCount(['questions'])
            ->first();

        $category_array = $category->toArray();
        unset($category_array['id']);

        if (max(array_values($category_array))) {
            return response()->json([
                'message' => trans('Unable To Delete This Category Because It BelongsTo Another Modules'),
            ], 403);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}
