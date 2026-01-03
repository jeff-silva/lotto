<?php

namespace App\Addon\Search;

use Illuminate\Support\Fluent;
use Illuminate\Database\Eloquent\Builder;

/** @property \MongoDB\Laravel\Eloquent\Model $model */
class Search
{
  public function __construct()
  {
    // Macro para facilitar busca mais complexa
    Builder::macro('fullSearch', function ($term, $fields, $operator = 'or') {

      /** @var \Illuminate\Database\Eloquent\Builder $this */
      return $this->where(function ($query) use ($term, $fields, $operator) {

        /** @var \Illuminate\Database\Eloquent\Builder $this */
        $terms = array_values(array_filter(preg_split('/[^a-zA-Z0-9]/', $term)));
        foreach ($terms as $i => $term) {
          foreach ($fields as $field) {
            if ($operator == 'and') {
              $query->where($field, 'like', "%{$term}%");
            } else if ($operator == 'or') {
              $query->orWhere($field, 'like', "%{$term}%");
            }
          }
        }
      });
    });

    $prepare = (object) [
      'whereHas' => [],
      'orWhereHas' => [],
    ];

    Builder::macro('whereHasPrepare', function ($name, $callback) use ($prepare) {
      if (!isset($prepare->whereHas[$name])) $prepare->whereHas[$name] = [];
      $prepare->whereHas[$name][] = $callback;
    });

    Builder::macro('orWhereHasPrepare', function ($name, $callback) use ($prepare) {
      if (!isset($prepare->whereHas[$name])) $prepare->orWhereHas[$name] = [];
      $prepare->orWhereHas[$name][] = $callback;
    });

    Builder::macro('customBuild', function () use ($prepare) {
      /** @var \Illuminate\Database\Eloquent\Builder $this */

      foreach ($prepare->whereHas as $name => $calls) {
        $this->whereHas($name, function ($query) use ($calls) {
          foreach ($calls as $call) $query->orWhere($call);
        });
      }

      foreach ($prepare->orWhereHas as $name => $calls) {
        $this->orWhereHas($name, function ($query) use ($calls) {
          foreach ($calls as $call) $query->orWhere($call);
        });
      }
    });
  }

  public function options($options)
  {
    return $options;
  }

  public function getOptions($params)
  {
    $options = (object) [];

    $options->order = [
      [
        'id' => 'id:asc',
        'name' => 'Primeiro > Último',
      ],
      [
        'id' => 'id:desc',
        'name' => 'Último > Primeiro',
      ],
      [
        'id' => 'name:asc',
        'name' => 'Alfabética A-Z',
      ],
      [
        'id' => 'name:desc',
        'name' => 'Alfabética Z-A',
      ],
    ];

    return $this->options($options);
  }

  public function params()
  {
    return [];
  }

  public function getParams(array $merge = [])
  {
    return new Fluent(
      array_merge(
        [
          'page' => 1,
          'ids' => null,
          'with' => null,
          'find' => null,
          'limit' => null,
          'per_page' => 10,
          'order' => 'id:desc',
        ],
        $this->params(),
        $merge
      )
    );
  }

  public function query($query, $params)
  {
    // 
  }

  public function getQuery($params)
  {
    $query = $this->model->query();

    if ($params->with) {
      $withs = array_filter(explode(',', $params->with));
      foreach ($withs as $with) {
        if (!is_callable([$query, $with])) continue;
        call_user_func([$query, 'with'], $with);
      }
    }

    if ($params->ids) {
      if (is_string($params->ids)) {
        $params->ids = explode(',', $params->ids);
      }
      if (!is_array($params->ids)) {
        $params->ids = [$params->ids];
      }
      $query->whereIn('id', $params->ids);
    }

    if ($params->order) {
      $order = explode(':', $params->order);
      $query->orderBy($order[0], $order[1]);
    }

    if ($params->find) {
      $query->where('id', $params->find);
    }

    if ($params->limit) {
      $query->limit($params->limit);
    }

    $this->query($query, $params);
    $query->customBuild();
    return $query;
  }

  public function first(array $params = [])
  {
    $params = $this->getParams($params);
    return $this->getQuery($params)->first();
  }

  public function firstOrCreate(array $params = [])
  {
    $params = $this->getParams($params);
    return $this->getQuery($params)->firstOrCreate();
  }

  public function firstOrNew(array $params = [])
  {
    $params = $this->getParams($params);
    return $this->getQuery($params)->firstOrNew();
  }

  public function get(array $params = [])
  {
    $params = $this->getParams($params);
    return $this->getQuery($params)->get();
  }

  public function paginate(array $params = [])
  {
    $scope = new Fluent([]);
    $scope->params = $this->getParams($params);
    $scope->options = $this->getOptions($params);

    $query = $this->getQuery($scope->params);
    $pagination = $query->paginate($scope->params->per_page);

    $scope->pagination = [
      'results' => $pagination->total(),
      'pages' => $pagination->lastPage(),
    ];

    $scope->data = $pagination->items();

    // if (config('app.secret.debug')) {
    //   $scope->mql = $query->toMql();
    // }

    return $scope;
  }
}
