<?php

namespace App\Repositories;

use App\Repositories\contracts\RepositoryInterface;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use RuntimeException;

abstract class BaseRepository implements RepositoryInterface
{

    public function __construct(private Model $model)
    {
    }

    public function all(array $columns = ['*'], array $relations = [], array $parameters = [], ?string $orderBy = null): Collection
    {
        $this->applyOrderBy($orderBy);

        return $this->model
            ->with($relations)
            ->select($columns)
            ->get();
    }

    public function paginate(int $limit=20, array $columns = ['*'], array $relations = [], array $parameters = [], ?string $orderBy = null): LengthAwarePaginator
    {
        return $this->model
            ->with($relations)
            ->select($columns)
            ->paginate($limit);
    }

    /**
     * Apply parameters, which can be extended in child classes for filtering.
     */
    protected function applyFilters(array $filters = []): void
    {
        // Should be implemented in specific repositories.
    }

    protected function applyOrderBy(?string $orderBy): Model
    {
        $this->model->when($orderBy, function(Builder $query, $orderBy) {
            str_starts_with($orderBy, '-')
                ? $query->orderBy(ltrim($orderBy, '-'), 'desc')
                : $query->orderBy($orderBy, 'asc');
        });
        return $this->model;
    }

    public function getBy($parameters, array $columns = ['*'], array $relations = []): Collection
    {
        foreach ($parameters as $field => $value) {
            $this->model->where($field, $value);
        }

        return $this->model
            ->with($relations)
            ->select($columns)
            ->get();
    }

    public function pluck(array $fields = ['id'])
    {
        return $this->model
            ->pluck(...$fields)
            ->all();
    }

    public function find($id, array $columns = ['*'], array $relations = [])
    {
//        $this->instance = $this->getNewInstance();

        return $this->model
            ->with($relations)
            ->select($columns)
            ->findOrFail($id);
    }

    public function findBy($field, $value, array $columns = ['*'], array $relations = [], array $appends = []): ?Model
    {
//        $this->instance = $this->getNewInstance();

        return $this->model
            ->with($relations)
            ->select($columns)
            ->where($field, $value)
            ->first();
    }

    public function findByMany(array $data, array $columns = ['*'], array $relations = [])
    {
//        $this->instance = $this->getNewInstance();

        foreach ($data as $key => $value) {
            $this->model->where($key, $value);
        }

        return $this->model
            ->with($relations)
            ->select($columns)
            ->first();
    }

    public function getWhereIn(array $ids, array $columns = ['*'], array $relations = [])
    {
//        $this->instance = $this->getNewInstance();

        return $this->model
            ->with($relations)
            ->select($columns)
            ->whereIn('id', $ids)
            ->get();
    }

    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function destroy(int $id): bool
    {
        return $this->model->where('id', $id)->delete();
    }

    public function count(): int
    {
        return $this->model->count();
    }

//    public function getModelName(): string
//    {
//        if (! $this->modelName) {
//            throw new RuntimeException('Model has not been set in ' . get_called_class());
//        }
//
//        return $this->modelName;
//    }
//
//    public function getNewInstance()
//    {
//        $model = $this->getModelName();
//
//        return new $model();
//    }
}
