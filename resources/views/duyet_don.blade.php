@extends('templates.tpl_default')
@php
    $col = [
        [
            'name' => 'order_id',
            'title' => 'id',
        ],
        [
            'name' => 'product',
            'title' => 'product',
        ],
        [
            'name' => 'price',
            'title' => 'price',
        ],
        [
            'name' => 'local',
            'title' => 'local',
        ],
        [
            'name' => 'order_date',
            'title' => 'order date',
        ],
        [
            'name' => 'status',
            'title' => 'status',
        ],
    ];
@endphp
@section('content')
    <div class="overflow-x-auto">
        <p class="text-center text-xl font-bold ">CÁC ĐƠN HÀNG CHỜ DUYỆT</p>
        <table class="table mt-5">
            <thead>
                <tr class="">
                    @foreach ($col as $item)
                        <th style="text-transform: capitalize">{{ $item['title'] }}</th>
                    @endforeach
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['data'] as $row)
                    <tr>
                        @foreach ($col as $_col)
                            @if ($_col['name'] == 'status')
                                <td>
                                    @switch($row[$_col['name']])
                                        @case(0)
                                            <span class="italic">Trong giỏ hàng</span>
                                        @break

                                        @case(1)
                                            <span class="italic">Chờ duyệt</span>
                                        @break

                                        @case(2)
                                            <span class="italic">Đang Giao</span>
                                        @break

                                        @case(3)
                                            <span class="italic">Thành công</span>
                                        @break

                                        @case(4)
                                            <span class="italic">Thất bại</span>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                            @elseif ($_col['name'] == 'local')
                                <td>
                                    <p>
                                        <span class="italic"> Anh Chị: </span>
                                        <span class="font-bold not-italic">
                                            {{ explode(',', $row[$_col['name']])[4] }}
                                        </span>
                                    </p>
                                    <p>
                                        <span class="italic"> Số ĐT: </span>
                                        <span class="font-bold not-italic">
                                            {{ explode(',', $row[$_col['name']])[5] }}
                                        </span>
                                    </p>
                                    <p>
                                        <span class="italic"> Số nhà, đường </span>:<span class="font-bold not-italic">
                                            {{ explode(',', $row[$_col['name']])[3] }}
                                        </span>
                                    </p>
                                    <p>
                                        <span class="italic"> Xã: </span>
                                        <span class="font-bold not-italic">
                                            {{ explode(',', $row[$_col['name']])[2] }}
                                        </span>
                                    </p>
                                    <p>
                                        <span class="italic"> Huyện: </span>
                                        <span class="font-bold not-italic">
                                            {{ explode(',', $row[$_col['name']])[1] }}
                                        </span>
                                    </p>
                                    <p>
                                        <span class="italic"> Tỉnh: </span>
                                        <span class="font-bold not-italic">
                                            {{ explode(',', $row[$_col['name']])[0] }}
                                        </span>
                                    </p>
                                </td>
                            @elseif($_col['name'] == 'price')
                                <td>
                                    <p>{{ number_format($row[$_col['name']]) }} <sup>vnđ</sup>/chiếc </p>
                                    <p> <span class="italic">Số lượng:</span> <span
                                            class="font-bold">{{ number_format($row['quantity']) }} </span></p>
                                    <p><span class="italic">Tổng:</span><span class="font-bold">
                                            {{ number_format($row[$_col['name']] * $row['quantity']) }}</span>
                                        <sup>vnđ</sup>
                                    </p>
                                </td>
                            @elseif($_col['name'] == 'product')
                                <td>
                                    <img class="w-10 ms-0" src="/{{ $row[$_col['name']]['thumbnail'] }}" />
                                    <p class="text-left py-2 font-bold">{{ $row[$_col['name']]['product_name'] }}</p>
                                </td>
                            @elseif($_col['name'] == 'order_date')
                                <td>
                                    <p>
                                        <span class="italic"> Ngày: </span>
                                        <span class="font-bold not-italic">
                                            {{ explode('-', explode(' ', $row[$_col['name']])[0])[2] }}
                                        </span>
                                        <span class="italic"> Tháng: </span>
                                        <span class="font-bold not-italic">
                                            {{ explode('-', explode(' ', $row[$_col['name']])[0])[1] }}
                                        </span>
                                        <span class="italic"> Năm: </span>
                                        <span class="font-bold not-italic">
                                            {{ explode('-', explode(' ', $row[$_col['name']])[0])[0] }}
                                        </span>
                                    </p>
                                    <p>
                                        <span class="italic"> Lúc: </span>
                                        <span class="font-bold not-italic">
                                            {{ explode(':', explode(' ', $row[$_col['name']])[1])[0] }}
                                        </span>
                                        <span class="italic"> Giờ </span>

                                        <span class="font-bold not-italic">
                                            {{ explode(':', explode(' ', $row[$_col['name']])[1])[1] }}
                                        </span>
                                        <span class="italic"> Phút </span>
                                    </p>

                                </td>
                            @else
                                <td>{{ $row[$_col['name']] }}</td>
                            @endif
                        @endforeach
                        <td>
                            <div class="tooltip" data-tip="Chấp nhận">
                                <button onclick="handleAcceptOrder({{ $row['order_id'] }})" class="btn">
                                    ✔️
                                </button>
                            </div>
                            <div class="tooltip" data-tip="Hủy đơn">
                                <button onclick="handleCancelOrder({{ $row['order_id'] }})" class="btn">
                                    ❌
                                </button>
                            </div>
                            <div class="tooltip" data-tip="Xóa">
                                <button onclick="handleDeleteOrder({{ $row['order_id'] }})" class="btn">
                                    🗑
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function handleDeleteOrder(id) {

            Swal.fire({
                title: "Có chắc muốn xóa?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Xóa",
                denyButtonText: `Không xóa`,
                footer: "Một khi xóa không thể khôi phục?",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    location.href = `/duyet-don/delete?id=${id}`
                } else if (result.isDenied) {
                    Swal.fire("Không xóa", "", "info");
                }
            });

        }




        @if (Session::has('success'))
            Swal.fire("<?= Session::get('success') ?>", "", "success");
        @endif
        @if (Session::has('fail'))
            Swal.fire("<?= Session::get('fail') ?>", "", "warning");
        @endif








        function handleCancelOrder(id = 0) {
            Swal.fire({
                title: "Lý do hủy đơn",
                input: "textarea",
                inputAttributes: {
                    autocapitalize: "off"
                },
                showCancelButton: true,
                confirmButtonText: "Xong",
                showLoaderOnConfirm: true,
                preConfirm: async (value) => {
                    location.href = "/duyet-don/cancel?order_id=" + id + "&note=" + value;

                }

            })
        }

        function handleAcceptOrder(id = 0) {
            location.href = "/duyet-don/accept?order_id=" + id;
        }
    </script>
@endsection
