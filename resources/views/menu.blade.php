@extends('templates.tpl_default')
@section('content')
@php
            if (Session::has('data')) {
                $linkBack = Session::get('data')[2];
            }
@endphp
    <a href="{{$linkBack}}" class="ms-3 btn-link btn">⬅️ Quay lại</a>

    <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[60vh]">
        <div>
            <p class="text-center font-semibold text-xl my-5">Tất cả Menu</p>
            <div class="overflow-auto h-80 my-scroll">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Tên hiển thị</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $key => $menu)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $menu['menu_name'] }}</td>
                                <td>{{ $menu['display_name'] }}</td>
                                <td><a href="{{ route('menus-delete', ['id' => $menu['menu_id']]) }}" class="btn">❌</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <p class="text-center font-semibold text-xl my-5">Thêm Menu</p>
            <form method="POST" action="{{ route('menus-create') }}" class="grid grid-cols-1">
                @csrf
                <label class="form-control w-full mx-auto max-w-xs">
                    <div class="label">
                        <span class="label-text">Tên menu: </span>
                    </div>
                    <input name="menu_name" type="text" placeholder="Tên menu"
                        class="input input-bordered w-full max-w-xs" />

                </label>
                <label class="form-control w-full mx-auto max-w-xs">
                    <div class="label">
                        <span class="label-text">Tên hiển thị: </span>
                    </div>
                    <input name="display_name" type="text" placeholder="Tên hiển thị"
                        class="input input-bordered w-full max-w-xs" />
                </label>
                <input type="hidden" name="create" value="create">
                <div class="text-center mt-3">
                    <button name="create" class="btn btn-success mx-auto">
                        Xong
                    </button>
                    <input type="hidden" value="{{$linkBack}}" name="linkBack">
                </div>
            </form>
        </div>

    </div>
    <script>
        @php
            if (Session::has('data')) {
                $message = Session::get('data')[1];
                $typeMessage = Session::get('data')[0];
            }
        @endphp

        @if (isset($message))
            Swal.fire("<?= $message ?>", "", "<?= $typeMessage ?>");
            fetch("/api/ForgetSession?name=success")
        @endif
    </script>
@endsection
