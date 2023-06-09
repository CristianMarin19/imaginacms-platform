<?php

namespace Modules\Icommercepricelist\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Icommercepricelist\Repositories\PriceListRepository;

class EloquentPriceListRepository extends EloquentBaseRepository implements PriceListRepository
{
    public function getItemsBy($params)
    {
        // INITIALIZE QUERY
        $query = $this->model->query();

        // RELATIONSHIPS
        $defaultInclude = ['translations'];
        $query->with(array_merge($defaultInclude, $params->include));

        // FILTERS
        if ($params->filter) {
            $filter = $params->filter;

            //get language translation
            $lang = \App::getLocale();

            //add filter by search
            if (isset($filter->search)) {
                //find search in columns
                $query->where(function ($query) use ($filter, $lang) {
                    $query->whereHas('translations', function ($query) use ($filter, $lang) {
                        $query->where('locale', $lang)
                            ->where('name', 'like', '%'.$filter->search.'%');
                    })->orWhere('id', 'like', '%'.$filter->search.'%');
                });
            }
            if (isset($filter->store)) {
                $query->where('store_id', $filter->store);
            }
            //add filter by status
            if (! empty($filter->status)) {
                $query->where('status', $filter->status);
            }
        }

        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields)) {
            $query->select($params->fields);
        }

        /*== REQUEST ==*/
        if (isset($params->page) && $params->page) {
            return $query->paginate($params->take);
        } else {
            $params->take ? $query->take($params->take) : false; //Take

            return $query->get();
        }
    }

    public function getItem($criteria, $params = false)
    {
        // INITIALIZE QUERY
        $query = $this->model->query();

        $query->where('id', $criteria);

        // RELATIONSHIPS
        $includeDefault = ['translations'];
        $query->with(array_merge($includeDefault, $params->include));

        // FIELDS
        if ($params->fields) {
            $query->select($params->fields);
        }

        return $query->first();
    }

    public function create($data)
    {
        $priceList = $this->model->create($data);

        return $priceList;
    }

    public function updateBy($criteria, $data, $params = false)
    {
        // INITIALIZE QUERY
        $query = $this->model->query();

        // FILTER
        if (isset($params->filter)) {
            $filter = $params->filter;

            if (isset($filter->field)) {//Where field
                $query->where($filter->field, $criteria);
            } else {//where id
                $query->where('id', $criteria);
            }
        }

        // REQUEST
        $model = $query->first();

        if ($model) {
            $model->update($data);
        }

        return $model;
    }

    public function deleteBy($criteria, $params = false)
    {
        // INITIALIZE QUERY
        $query = $this->model->query();

        // FILTER
        if (isset($params->filter)) {
            $filter = $params->filter;

            if (isset($filter->field)) { //Where field
                $query->where($filter->field, $criteria);
            } else { //where id
                $query->where('id', $criteria);
            }
        }

        // REQUEST
        $model = $query->first();

        if ($model) {
            $model->delete();
        }
    }
}
