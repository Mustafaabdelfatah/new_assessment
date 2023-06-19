<?php

namespace App\Contracts\Eloquent;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface MainRepositoryInterface
{
    /**
     * Get model builder.
     *
     * @param array $cols
     * @param array $relations
     * @param string $order
     * @return Builder
     */
    public function builder(array $cols = ['*'], array $relations = [], string $order = 'asc'): Builder;


    /**
     * Get model data paginate.
     *
     * @param array $cols
     * @param array $relations
     * @param string $order
     * @param int $paginate
     * @return LengthAwarePaginator
     */
    public function paginate(array $cols, array $relations, string $order, int $paginate = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator;


    /**
     * Get model all data.
     *
     * @param array $cols
     * @param array $relations
     * @param string $order
     * @return Collection
     */
    public function all(array $cols, array $relations, string $order): Collection;


    /**
     * store data model.
     *
     * @param array $data
     * @return Model|null
     */
    public function store(array $data): ?Model;


    /**
     * update model with id.
     *
     * @param array $data
     * @param int $id
     */
    public function update(int $id, array $data): ?Model;


    /**
     * find model with columns.
     *
     * @param array $cols
     */
    public function findByCols(array $cols): ?Model;


    /**
     * Destroy model with id.
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool;


}
