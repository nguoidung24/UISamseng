@extends('templates.tpl_default')
@php
    $col = [
        [
            'name' => 'category_id',
            'title' => 'id',
        ],
        [
            'name' => 'category_name',
            'title' => 'Danh mục',
        ],
        [
            'name' => 'menu_id',
            'title' => 'Tên menu',
        ],
    ];
@endphp
@section('content')
    <p class="text-2xl font-bold text-center pb-10 pt-5">
        Các Danh Mục
    </p>
    <div class="flex justify-end pe-5">
        <a href="/categorys/create" class="btn btn-link ">+ Thêm danh mục</a>
    </div>
    <table class="table mt-5 text-center ">
        <thead>
            <tr class="">
                @foreach ($col as $item)
                    <th style="text-transform: capitalize">{{ $item['title'] }}</th>
                @endforeach
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['data'] as $value)
                <tr>
                    @foreach ($col as $item)
                        @if ($item['name'] == 'category_name')
                            <td>
                                <p class="grid grid-cols-2 gap-x-4 items-center">
                                    <img class="w-14 ms-auto" src="{{ $value['thumbnail'] }}" alt="">
                                    <span class="me-auto"> {{ $value[$item['name']] }}</span>
                                </p>
                            </td>
                        @elseif ($item['name'] == 'menu_id')
                            <td>
                                {{ $value['menu']['menu_name'] }}
                            </td>
                        @else
                            <td>{{ $value[$item['name']] }}</td>
                        @endif
                    @endforeach
                    <td>
                        <div class="tooltip" data-tip="Sửa">
                            <a href="/categorys/edit?id={{ $value['category_id'] }}"
                                class="btn btn-neutral bg-cyan-700">✍️</a>
                        </div>
                        <div class="tooltip" data-tip="Xóa">
                            <button onclick="handleDeleteCate({{ $value['category_id'] }})"
                                class="btn btn-neutral bg-red-500">🗑</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        function handleDeleteCate(id) {
            Swal.fire({
                title: "Có chắc muốn xóa?",
                showCancelButton: true,
                confirmButtonText: "Đúng",
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = `/categorys/delete?id=${id}`
                }
            });
        }
        @php
            if (Session::has('success')) {
                $message = Session::get('success');
                $typeMessage = 'success';
            }
            if (Session::has('fail')) {
                $message = Session::get('fail');
                $typeMessage = 'warning';
            }
        @endphp

        @if (isset($message))
            Swal.fire("<?= $message ?>", "", "<?= $typeMessage ?>");
            fetch("/api/ForgetSession?name=success")
        @endif

    </script>
@endsection
