<?php

namespace App\Repositories;

use App\Models\Directorys;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository
{
    public function listWhere(array $att = [], $with = [], $orderBy = '')
    {
        $query        = $this->model()::query();
        $pageIndex    = (int)$att['page'] - 1;
        $pageSize     = (int)$att['limit'];

        if (count($with) > 0) {
            $query->with($with);
        }

        if ($orderBy != '' && $orderBy != '_name_') {
            $query->orderBy("price", $orderBy);
        }
        if ($orderBy == '_name_') {
            $query->orderBy("product_name", "asc");
        }

        if (isset($att['star']))
            if ($att['star'] != '') {
                $query->where(
                    'rating',
                    '=',
                    $att['star'],
                );
            }

        if (isset($att['color']))
            if ($att['color'] != '') {
                $query->where(
                    'color_id',
                    '=',
                    $att['color'],
                );
            }

        if (isset($att['range']))
            if ($att['range'] != '') {
                $range  = $att['range'];
                $start  = explode('->', $range)[0];
                $end    = explode('->', $range)[1];
                if ($end == "max") {
                    $query->where(
                        "price",
                        '>=',
                        $start
                    );
                } else {
                    $query->whereBetween(
                        "price",
                        [$start, $end]
                    );
                }
            }
        if (isset($att['getCart'])) {
            $query->where(
                'status',
                '=',
                '0',
            );
        }
        if (isset($att['where'])) {
            $query->where(
                $att['col'],
                $att['math'],
                $att['where'],
            );
        }
        $dataResult   =    $query
            ->skip($pageSize * $pageIndex)
            ->take($pageSize)
            ->get();

        if (isset($att['where'])) {
            $totalPage    = ceil(
                $this->model()::where(
                    $att['col'],
                    $att['math'],
                    $att['where'],
                )->count() / $pageSize
            );
        }else{
            $totalPage    = ceil(
                $this->model()::query()->count() / $pageSize
            );
        }
        
        return [
            "data"       => $dataResult,
            "totalPage"  => $totalPage,
            "pageIndex"  => $pageIndex + 1,
            'limit'      => $pageSize
        ];
    }
    public function deleteByCol($col, $id)
    {
        try {
            $query =  $this->model()::query();
            for ($i = 0; $i < sizeof($col); $i++) {
                $query->where(
                    $col[$i],
                    "=",
                    $id[$i]
                );
            }
            $query->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function create($att)
    {
        try {
            return $this->model()::create($att);
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function edit($col, $id, $update)
    {
        try {
            $query =  $this->model()::query();
            for ($i = 0; $i < sizeof($col); $i++) {
                $query->where(
                    $col[$i],
                    "=",
                    $id[$i]
                );
            }
            return $query->update($update);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function updateWhereIds($id, $update,$col = 'order_id')
    {
        $query = $this->model()::query();
        return $query->whereIn($col, $id)
            ->update($update);
    }
    public function createOrUpdate($att, $math, $updateWhere, $colUpdate)
    {
        $test = $this->model()::where($updateWhere)->get();
        if (sizeof($test) == 0) {
            return $this->model()::create($att);
        } else {
            try {
                $query = $this->model()::query();
                $query->where($updateWhere)
                    ->update([$colUpdate => DB::raw(
                        $colUpdate . $math
                    )]);
                return "update success";
            } catch (\Throwable $th2) {
                return false;
            }
        }
    }

    public function listWheres(array $att = [], $col = [], $id = [])
    {
        $query        = $this->model()::query();
        $pageIndex    = (int)$att['page'] - 1;
        $pageSize     = (int)$att['limit'];

        if (isset($att['where'])) {
            for ($i = 0; $i < sizeof($col); $i++) {
                $query->where(
                    $col[$i],
                    "=",
                    $id[$i]
                );
            }
        }

        if (isset($att['month']) && isset($att['year'])) {
            $query->whereMonth('order_date', $att['month']);
            $query->whereYear('order_date', $att['year']);
        }
        
        if (isset($att['getTotalCustomer'])) {
            $query->whereYear('order_date', $att['year']);
            return $query->get()->groupBy('customer_id')->count();
        }

        if (isset($att['getDoanhThu'])) {
            try {
                $getPrice     = $query->get('price');
                $getQuantity  = $query->get('quantity');
                $totalAmount  = 0;
                for ($i = 0; $i < sizeof($getPrice); $i++) {
                    $totalAmount  += (int)$getPrice[$i]->price *  (int)$getQuantity[$i]->quantity;
                }
                return  $totalAmount;
            } catch (\Throwable $th) {
                return 0;
            }
        } elseif (isset($att['getLength'])) {
            if (isset($att['groupBy'])) {
                return $query->get()->groupBy('customer_id')->count();
            }
            $dataResult = $query->count();
            return  $dataResult;
        } else {
            $dataResult   =    $query
                ->skip($pageSize * $pageIndex)
                ->take($pageSize)
                ->get();
            $totalPage    = ceil(
                $this->model()::query()->count() / $pageSize
            );
            return [
                "data"       => $dataResult,
                "totalPage"  => $totalPage,
                "pageIndex"  => $pageIndex + 1,
                'limit'      => $pageSize
            ];
        }
    }
}
