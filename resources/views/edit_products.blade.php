@extends('templates.tpl_default')
@php
    $Field = [
        'Product Type:',
        'Ảnh thu nhỏ:',
        'Product ID:',
        'Là biến thể của:',
        'Tên sản phẩm:',
        'Màu sản phẩm:',
        'Danh mục:',
        'Giá trị giảm giá:',
        'Giá sản phẩm:',
        'Số lượng:',
        'Đã bán:',
        'Rating:',
        'Total Rating:',
        'Status:',
    ];
    $fillable = [
        'product_type',
        'thumbnail',
        'product_id',
        'group_id',
        'product_name',
        'color_id',
        'category_id',
        'discount',
        'price',
        'quantity',
        'sold',
        'rating',
        'total_rating',
        'status',

    ];
    function generateRandomNumberId($length = 10)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);

        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $result;
    }
    $randomId = generateRandomNumberId();
    $product = $data['data'][0] != 'new' ? $data['data'][0] : 'new';
@endphp
@section('content')
    <div class="p-2 lg:px-16">
        <p class="text-2xl text-center my-6 font-semibold">Sửa Sản Phẩm</p>
        {{-- <p onclick="window.history.go(-1);" class="btn btn-link"> ← Quay lại</p> --}}
        <a href="/products" class="btn btn-link"> ← Quay lại</a>

        <form id="formSubmit" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 lg:gap-8 gap-2">
            @if ($product != 'new')
                @include('Components.edit_products.edit')
            @else
                @include('Components.edit_products.new')
            @endif
            @if ($product != 'new')

                <div class="mt-auto text-center">
                    <label for="my_modal_7" class="btn">Ảnh mô tả</label>
                    <input type="checkbox" id="my_modal_7" class="modal-toggle" />

                    <div class="modal" role="dialog">

                        <div class="modal-box bg-gray-800 text-white text-center">
                            <h3 class="text-lg text-center mb-3 font-bold">Chọn Ảnh Mô Tả</h3>
                            <div id="show-images" class="my-2 text-center grid grid-cols-4 gap-y-2 gap-x-2">
                                @if ($product['images'])
                                    @foreach (explode(',', $product['images']) as $_img)
                                        <div class="relative">
                                            <span onclick="handleDeleteShowIMG(this)"
                                                class="badge -top-1 hover:cursor-pointer text-white font-bold  -right-1 bg-red-600 absolute">x</span>
                                            <img src="/{{ $_img }}" alt="">
                                            <input name="input_show_images" class="opacity-0 scale-0 size-0" type="text"
                                                value="{{ $_img }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div id="input-images" class=" mb-2">
                                <input name="input_images" type="file"
                                    class="file-input data-id-1 file-input-bordered file-input-warning w-full" />
                            </div>
                            <label class="mx-auto btn btn-success" for="my_modal_7">Xong</label>
                        </div>
                        <label class="modal-backdrop" style="background-color: rgba(0, 0, 0, 0.6)"
                            for="my_modal_7">Close</label>
                    </div>
                </div>
            @else
                {{-- <div class="mt-auto text-center">
                    <label for="my_modal_7" class="btn">Ảnh mô tả</label>
                </div> --}}
            @endif

            <div class="text-center mt-auto">
                <button class="btn mx-auto w-36 btn-success">
                    Xong
                </button>
            </div>
        </form>
    </div>
    <script>
        @if ($product != 'new')


            function handleChangeImages() {
                const input = document.querySelectorAll('input[name="input_images"]');
                input.forEach(element => {
                    element.onchange = async (e) => {
                        if (e.target.files[0]) {
                            const formdata = new FormData();
                            formdata.append("image", e.target.files[0],
                                "_______.png");
                            formdata.append("images_detail", "true");

                            const requestOptions = {
                                method: "POST",
                                body: formdata,
                                redirect: "follow"
                            };

                            await fetch("/api/upload", requestOptions)
                                .then((response) => response.text())
                                .then((result) => {
                                    if (result) {
                                        document.getElementById("show-images").innerHTML += `
                                    <div class="relative">
                                            <span onclick="handleDeleteShowIMG(this)"
                                                class="badge -top-1 hover:cursor-pointer text-white font-bold  -right-1 bg-red-600 absolute">x</span>
                                            <img src=${"/"+result.substring(1, result.length - 1)} alt="">
                                            <input name="input_show_images" class="opacity-0 scale-0 size-0" type="text"
                                                value="${result.substring(1, result.length - 1)}">
                                        </div>
                                    `;
                                        _handleDeleteShowIMG();
                                    }
                                })
                                .catch((error) => console.error(error));


                        } else
                            console.log("noImage");
                    }
                })
            }

            handleChangeImages();

            async function _handleDeleteShowIMG(e = null) {
                let imgValue = '';
                if (e) {
                    await e.parentNode.remove();
                }
                document.querySelectorAll("input[name='input_show_images']").forEach((element) => {
                    imgValue += element.value + ","
                });
                const postValue = await imgValue.substring(0, imgValue.length - 1);
                console.log(postValue);
                const formdata = new FormData();
                formdata.append("action", "changeImages");

                // -------------------------------------------------------------------------------------------------------- Vừa thay dổi
                formdata.append("id", <?=  $product['product_id'] ?>);
                formdata.append("value", postValue);

                const requestOptions = {
                    method: "POST",
                    body: formdata,
                    redirect: "follow"
                };

                await fetch("/api/Products", requestOptions)
                    .then((response) => response.text())
                    .then((result) => console.log("ok"))
                    .catch((error) => console.error(error));


            }
            async function handleDeleteShowIMG(e) {
                Swal.fire({
                    title: "Do you want to save the changes?",
                    showDenyButton: true,
                    confirmButtonText: "Xóa",
                    denyButtonText: `Không xóa`
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        _handleDeleteShowIMG(e);
                        Swal.fire("Saved!", "", "success");
                    } else if (result.isDenied) {}
                });
            }
        @endif


        const request = {
            'action': "",
            'thumbnail': "",
            'product_id': "",
            'color_id': "",
            'product_name': "",
            'category_id': "",
            'product_type': "",
            'sold': "",
            'price': "",
            'rating': "",
            'total_rating': "",
            'status': "",
            'discount': "",
            'quantity': "",
            'group_id':"",
        }

        var onSubmit = async function(event) {
            event.preventDefault();
            try {
                @if ($product != 'new')
                    for (item in request) {
                        if (item == 'product_id') {
                            request[item] = @php echo $product['product_id']; @endphp
                        } else if (item == 'thumbnail') {
                            request[item] = '@php echo $product['thumbnail']; @endphp'
                        } else if (item != 'action')
                            request[item] = document.getElementById("_" + item).value
                    }
                    request['action'] = 'update';
                @else
                    for (item in request) {
                        if (item != 'action')
                            request[item] = document.getElementById("_" + item).value
                    }
                    request['action'] = 'create';
                @endif
                console.log(request);
                const image = document.getElementById('_thumbnail');
                const imageUpload = image.files[0];
                let formData = new FormData();
                formData.append("image", imageUpload);
                formData.append("product", "product");
                if (imageUpload) {
                    let uploadImage = await axios.post('/api/upload', formData)
                    request.thumbnail = uploadImage?.data;
                }
                let response = await axios.post('/products', request);
                await Swal.fire("Đã Xong!", "", "success");
                // location.href = '/products'
            } catch (error) {
                try {
                    let responseData = error.response?.data?.errors;
                    for (item in request) {
                        if (item != 'action')
                            document.getElementById(item).innerText = responseData[item] == undefined ? '' :
                            responseData[item]
                    }
                } catch (error) {
                    console.log("errors");
                }

            }
        };
        var form = document.getElementById("formSubmit");
        form.addEventListener("submit", onSubmit, true);
    </script>
@endsection
