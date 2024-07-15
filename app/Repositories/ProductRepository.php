<?php

namespace App\Repositories;

use App\Models\Products;
use App\Models\Rating;
use App\Models\Order;

use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return Products::class;
    }
    public function changeStar($product_id, $star, $order_id)
    {
        $totalStar         = 0;
        $att['product_id'] = $product_id;
        $att['star']       = $star;
        Rating::create($att);
        $data = Rating::where('product_id', '=', $product_id)->get();
        foreach ($data as $value) {
            $totalStar += (int)$value->star;
        }
        $update_star         =  round($totalStar / sizeof($data));
        $update_total_rating = sizeof($data);
        Order::where('order_id', '=', $order_id)
            ->update([
                "rating"        => $star,
            ]);
        return Products::where('product_id', '=', $product_id)
            ->update([
                "rating"        => $update_star,
                "total_rating"  => $update_total_rating
            ]);
    }

    public function getProductType(string $productType, array $att = [], $with = [], $orderBy = '')
    {
        $query        = $this->model()::query();
        $pageIndex    = (int)$att['page'] - 1;
        $pageSize     = (int)$att['limit'];
        $dataResult   = [];

        $query->with($with);
        $query->where('status','=','1');
        $products = $query->where('product_type', 'LIKE', '%' . '_$*' . $productType . '*$_' . '%');
        $totalPage    = ceil(
            count($query->get()) / $pageSize
        );
        $total        = count($query->get());

        $dataResult   =    $products
            ->skip($pageSize * $pageIndex)
            ->take($pageSize)
            ->get();

        foreach ($dataResult as $key => $item) {
            if ($item['images']) {
                $images = explode(",", $item['images']);
                $dataResult[$key]["images"] = $images;
            }
        }

        return [
            "data"       => $dataResult,
            "totalPage"  => $totalPage,
            "pageIndex"  => $pageIndex + 1,
            'limit'      => $pageSize,
            'total'      => $total
        ];
    }
    public function getByGroupId(string $groupId, array $att = [], $with = [], $orderBy = '')
    {
        $query        = $this->model()::query();
        $pageIndex    = (int)$att['page'] - 1;
        $pageSize     = (int)$att['limit'];
        $dataResult   = [];

        $query->with($with);
        $products = $query->where('group_id', '=', $groupId);
        $totalPage    = ceil(
            count($query->get()) / $pageSize
        );
        $total        = count($query->get());

        $dataResult   =    $products
            ->skip($pageSize * $pageIndex)
            ->take($pageSize)
            ->get();

        foreach ($dataResult as $key => $item) {
            if ($item['images']) {
                $images = explode(",", $item['images']);
                $dataResult[$key]["images"] = $images;
            }
        }

        return [
            "data"       => $dataResult,
            "totalPage"  => $totalPage,
            "pageIndex"  => $pageIndex + 1,
            'limit'      => $pageSize,
            'total'      => $total
        ];
    }
    public function changeImages($id, $value)
    {
        $query        = $this->model()::query();
        $query->where('product_id', "=", $id)->update(['images' => $value]);
        return $query->where('product_id', "=", $id)->get();
    }

    public function findById($id)
    {
        $query        = $this->model()::query();
        $query->where("product_id", "=", $id);
        return $query->firstOrFail();
    }
    public function listProducts(array $arr = [])
    {
        $condition = array_filter($arr['where'], function ($value) {
            return !is_null($value);
        });

        $query = Products::query();
        $query->with(['color','category']);
        if ($arr['keywords'] != null)
            $query->where('product_name', 'LIKE', '%' . $arr['keywords'] . '%');

        if ($arr['range'] != null) {

            $query->whereRaw('price - (price * discount / 100) >= ?', explode("->", $arr['range'])[0]);
            $query->whereRaw('price - (price * discount / 100) < ?', explode("->", $arr['range'])[1]);


            // $query->where('price', '>=', explode("->", $arr['range'])[0]);
            // $query->where('price', '<', explode("->", $arr['range'])[1]);
        }
        if ($arr['sort'] != null)
            $query->orderByRaw('price - (price * discount / 100) ' . $arr['sort']);

        $query->where($condition);
        $query->where('status','=','1');

        $result = $query->paginate($arr['limit'], ['*'], 'page', $arr['page']);
        return $result;
    }
}
