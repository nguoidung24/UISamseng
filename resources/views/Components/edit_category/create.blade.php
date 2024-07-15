<p class="text-center text-2xl font-bold py-5 pb-10">
    Thêm Mới Danh Mục
</p>
<form class="grid grid-cols-1 lg:px-5">
    <div class="mx-auto">
        <label class="form-control">
            <div class="label">
                <span class="label-text">Tên danh mục</span>
            </div>
            <input autocomplete="off" name="category_name" type="text" placeholder="Tên danh mục" class="input input-bordered w-96 max-w-[100vw]" />
        </label>
    </div>
    <div class="mx-auto">
        <label class="form-control">
            <div class="label">
                <span class="label-text">Thuộc menu</span>
                <a href="{{route("menus",['action' => 'create'])}}" class="label-text-alt link">+ Menu</a>
            </div>
            <select name="menu_id" class="select w-96 max-w-[100vw] select-bordered">
                <option disabled selected>-- Chọn --</option>
                @foreach ($menu['data'] as $_menu)
                    <option value="{{ $_menu['menu_id'] }}">{{ $_menu['menu_name'] }} ({{ $_menu['display_name'] }})</option>
                @endforeach
            </select>
        </label>
    </div>
    <div class="mx-auto">
        <label class="form-control">
            <div class="label">
                <span class="label-text">Ảnh thu nhỏ</span>
            </div>
            <p id="showIMG" class="size-36 mx-auto">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M1 3h22v13h-1.481L21 15.481v-1.414l1 1V4H2v11.067l2.533-2.533a.503.503 0 0 1 .704-.008.474.474 0 0 0 .678.049l3.627-3.628a.503.503 0 0 1 .677-.03l3.609 3.007a.503.503 0 0 0 .623.016l2.178-1.634a.503.503 0 0 1 .657.047L18.933 12h-1.414l-.635-.635-1.833 1.375a1.502 1.502 0 0 1-1.863-.049l-3.26-2.716-3.307 3.307a1.403 1.403 0 0 1-.997.415 1.506 1.506 0 0 1-.677-.163L2 16.48V20h10v1H1zm15 4.5A1.5 1.5 0 1 1 14.5 6 1.5 1.5 0 0 1 16 7.5zm-1 0a.5.5 0 1 0-.5.5.5.5 0 0 0 .5-.5zM19 18v-4h-1v4h-4v.999h4V23h1v-4.001h4V18z">
                        </path>
                        <path fill="none" d="M0 0h24v24H0z"></path>
                    </g>
                </svg>
            </p>
            <input autocomplete="off" id="fileSubmit" onchange="handleChangeImage(this)" type="file"
                class="file-input file-input-bordered mt-3 w-96  max-w-[100vw]" />
                <input autocomplete="off" type="text" class="opacity-0 size-0 scale-0" name="thumbnail">
                <input autocomplete="off" type="text" class="opacity-0 size-0 scale-0" name="create">

        </label>
    </div>


    <div class="flex items-center justify-center py-5">
        <button onclick="handleSubmit()" type="button" class="btn btn-success mt-auto">Xong</button>
        <button id="onSubmit" class="scale-0 opacity-0 size-0">Xong</button>
    </div>
</form>
<script>
    async function handleSubmit() {
        const fileSubmit = document.querySelector("#fileSubmit");
        if (fileSubmit.files[0]) {
            const formdata = new FormData();
            formdata.append("image", fileSubmit.files[0]);
            formdata.append("category", "true");

            const requestOptions = {
                method: "POST",
                body: formdata,
                redirect: "follow"
            };

            await fetch("/api/upload", requestOptions)
                .then((response) => response.text())
                .then((result) => document.querySelector("input[name='thumbnail']").value = result.split('"')[1])
                .catch((error) => console.error(error));

            document.querySelector("#onSubmit").click();

        } else {
            Swal.fire(`Chưa chọn ảnh`, "", "warning");
        }

    }

    function handleChangeImage(e) {
        if (e.files[0]) {
            const img = e.files[0];
            const link = URL.createObjectURL(img);
            document.querySelector("#showIMG").innerHTML = `<img src="${link}" />`;

        } else {
            document.querySelector("#showIMG").innerHTML = `<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M1 3h22v13h-1.481L21 15.481v-1.414l1 1V4H2v11.067l2.533-2.533a.503.503 0 0 1 .704-.008.474.474 0 0 0 .678.049l3.627-3.628a.503.503 0 0 1 .677-.03l3.609 3.007a.503.503 0 0 0 .623.016l2.178-1.634a.503.503 0 0 1 .657.047L18.933 12h-1.414l-.635-.635-1.833 1.375a1.502 1.502 0 0 1-1.863-.049l-3.26-2.716-3.307 3.307a1.403 1.403 0 0 1-.997.415 1.506 1.506 0 0 1-.677-.163L2 16.48V20h10v1H1zm15 4.5A1.5 1.5 0 1 1 14.5 6 1.5 1.5 0 0 1 16 7.5zm-1 0a.5.5 0 1 0-.5.5.5.5 0 0 0 .5-.5zM19 18v-4h-1v4h-4v.999h4V23h1v-4.001h4V18z">
                        </path>
                        <path fill="none" d="M0 0h24v24H0z"></path>
                    </g>
                </svg>`;
        }
    }
</script>
