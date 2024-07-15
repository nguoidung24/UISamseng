<p class="text-center text-2xl font-bold py-5 pb-10">
    Thêm Mới Danh Mục
</p>
<form class="grid grid-cols-1 lg:px-5">
    <div class="mx-auto">
        <label class="form-control">
            <div class="label">
                <span class="label-text">Tên danh mục</span>
            </div>
            <input autocomplete="off" value="{{ $category['category_name'] }}" name="category_name" type="text"
                placeholder="Tên danh mục" class="input input-bordered w-96 max-w-[100vw]" />
        </label>
    </div>
    <div class="mx-auto">
        <label class="form-control">
            <div class="label">
                <span class="label-text">Thuộc menu</span>
                <a href="{{route("menus",['action' => 'edit', 'id' => $category['category_id']])}}" class="label-text-alt link">+ Menu</a>

            </div>
            <select name="menu_id" class="select w-96 max-w-[100vw] select-bordered">
                <option disabled selected>-- Chọn --</option>
                @foreach ($menu['data'] as $_menu)
                    <option {{ $category['menu_id'] == $_menu['menu_id'] ? 'selected' : '' }}
                        value="{{ $_menu['menu_id'] }}">{{ $_menu['menu_name'] }} ({{ $_menu['display_name'] }})</option>
                @endforeach
            </select>
        </label>
    </div>
    <div class="mx-auto">
        <label class="form-control">
            <div class="label">
                <span class="label-text">Ảnh thu nhỏ</span>
            </div>
            <div id="showIMG">
                <img id="displayIMG" src="/{{ $category['thumbnail'] }}" class="w-36 mx-auto" alt="">
            </div>
            <input autocomplete="off" id="fileSubmit" onchange="handleChangeImage(this)" type="file"
                class="file-input file-input-bordered mt-3 w-96  max-w-[100vw]" />
            <input autocomplete="off" type="text" class="opacity-0 size-0 scale-0" name="thumbnail">
            <input autocomplete="off" type="text" class="opacity-0 size-0 scale-0" name="edit">
            <input autocomplete="off" type="text" class="opacity-0 size-0 scale-0" value="<?= $category['category_id'] ?>" name="id">

        </label>
    </div>


    <div class="flex items-center justify-center py-5">
        <button onclick="handleSubmit()" type="button" class="btn btn-success mt-auto">Xong</button>
        <button id="onSubmit" class="scale-0 opacity-0 size-0">Xong</button>
    </div>
</form>
<script>
    let changeImageCount = 0;

    async function handleSubmit() {
        const fileSubmit = document.querySelector("#fileSubmit");
        if (changeImageCount != 0) {
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
                    .then((result) => document.querySelector("input[name='thumbnail']").value = result.split('"')[
                        1])
                    .catch((error) => console.error(error));

                return document.querySelector("#onSubmit").click();

            } else {
                return Swal.fire(`Chưa chọn ảnh`, "", "warning");
            }
        }
        document.querySelector("input[name='thumbnail']").value = await "<?= $category['thumbnail'] ?>"
        return document.querySelector("#onSubmit").click();

    }

    function handleChangeImage(e) {
        if (e.files[0]) {
            const img = e.files[0];
            const link = URL.createObjectURL(img);
            document.querySelector("#showIMG").innerHTML = `<img src="${link}" class="w-36 mx-auto" />`;
            changeImageCount++;

        } else {
            document.querySelector("#showIMG").innerHTML =
                `<img src="/<?= $category['thumbnail'] ?>" class="w-36 mx-auto" alt="">`;
            changeImageCount = 0;
        }
    }
</script>
