<?php

namespace App\Addon\Service;

use Illuminate\Support\Fluent;

/** @property \MongoDB\Laravel\Eloquent\Model $model */
abstract class Service
{
  static function make()
  {
    return app(static::class);
  }

  public function upsert(array $data = [])
  {
    if (!property_exists($this, 'model')) return null;
    $data = new Fluent($data);
    $model = $this->model->firstOrNew(['id' => $data->id], $data->toArray());
    $model->fill($data->toArray())->save();
    return $this->select($model->id);
  }

  public function delete(string $id)
  {
    $entity = $this->select($id);
    $entity->delete();
    return $entity;
  }

  public function select(string $id, array $params = [])
  {
    if (!property_exists($this, 'model')) return null;
    $params['ids'] = $id;
    return $this->model->getSearch()->first($params);
  }

  public function search(array $params = [], $paginated = true)
  {
    $search = $this->model->getSearch();
    if (!$paginated) return $search->get($params);
    return $search->paginate($params);
  }
}
