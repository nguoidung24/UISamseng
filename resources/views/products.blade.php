@extends('templates.tpl_default')
@php
    $Field = [
        '#',
        'Tên',
        'Thumbnail',
        'Màu',
        'Category',
        'Kiểu',
        'Đã bán',
        'Giá (vnđ)',
        'Rating',
        'Total Rating',
        'Status',
        'Giảm giá',
        'Số lượng',
    ];
    $fillable = [
        'product_id',
        'product_name',
        'thumbnail',
        'color',
        'category',
        'product_type',
        'sold',
        'price',
        'rating',
        'total_rating',
        'status',
        'discount',
        'quantity',
    ];
    $response = $data['data'];
    $search = '';
    if (isset($data['search'])) {
        $search = $data['search'];
    }
@endphp

@section('content')
    <div>
        <div class="my-scroll min-h-[50vh]">
            <p class="text-center my-5 font-semibold text-2xl">
                Danh Sách Sản Phẩm
            </p>
            <div class="flex justify-between px-4 py-2">
                <div class=" w-[300px]">
                    <a class="btn btn-link text-base-content" href="/edit_products/new"> + Thêm mới</a>
                </div>
                @if ($search)
                    <form action="/products" class='italic'>
                        Hiển thị kết quả tìm kiếm cho: "<span class="font-semibold text-lg">{{ $search }}</span>"
                        <div class="tooltip" data-tip="Bỏ tìm">
                            <button class="py-1 px-2 text-red-500">x</button>
                        </div>
                    </form>
                @endif
                <form action="/products" class="w-[300px] relative">
                    <input value="{{ $search }}" autocomplete="off" type="text" placeholder="Tìm Kiếm"
                        class="input input-bordered pe-14 w-[300px]" name="search" />
                    <button class="btn btn-ghost absolute top-0 right-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        @foreach ($Field as $item)
                            <th>{{ $item }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($response['data'] as $item)
                        <tr name="row-products" data-id='{{ $item->product_id }}'
                            data-href='/products{{ '?search=' . $search }}'
                            class="hover:bg-base-300 text-center hover:cursor-pointer">
                            @foreach ($fillable as $key)
                                @if ($key == 'thumbnail')
                                    <td>
                                        <img class="h-12 w-10 mx-auto" src="{{ $item[$key] }}" alt="">
                                    </td>
                                @elseif ($key == 'color')
                                    <td>
                                        <div class="tooltip" data-tip="{{ $item[$key]['value'] }}">
                                            <p class="size-8 rounded-full mx-auto border-2 border-base-content"
                                                style="background-color: {{ $item[$key]['value'] }}"></p>
                                        </div>
                                    </td>
                                @elseif ($key == 'category')
                                    <td> {{ $item[$key]['category_name'] }} </td>
                                @elseif ($key == 'product_type')
                                    <td>
                                        @foreach (explode(',', $item[$key]) as $value)
                                            {{ substr($value, 3, -3) }} <br />
                                        @endforeach
                                    </td>
                                @elseif ($key == 'price')
                                    <td>{{ number_format($item[$key], 0, ',', '.') }}</td>
                                @else
                                    <td>{{ $item[$key] == '' ? '_' : $item[$key] }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-center">
            <form action="/products" method="get" class="join mt-5 mb-2">
                <button value="{{ (int) $response['pageIndex'] - 1 }}" name="page"
                    class="join-item btn {{ $response['pageIndex'] <= 1 ? 'btn-disabled' : '' }}">
                    «
                </button>
                @if ($search)
                    {!! '<input class="scale-0 opacity-0 size-0" type="text" value="' . $search . '" name="search">' !!}
                @endif
                <button id="change-page" type="button" data-href="/products{{ '?search=' . $search }}"
                    data-totalPage="@php echo $response['totalPage']; @endphp" class="join-item btn">
                    Trang {{ $response['pageIndex'] }}
                </button>
                <button value="{{ (int) $response['pageIndex'] + 1 }}" name="page"
                    class="join-item btn {{ $response['pageIndex'] >= $response['totalPage'] ? 'btn-disabled' : '' }}">
                    »
                </button>
            </form>
        </div>
    </div>
@endsection
