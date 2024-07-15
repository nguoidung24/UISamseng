@foreach ($fillable as $item => $key)
    <div class="max-h-36 overflow-y-auto overflow-x-hidden">
        <label for="">{{ $Field[$item] }}</label>
        @if ($key == 'thumbnail')
            <div class="relative text-center">
                <label for="_{{ $key }}">
                    <img id="__{{ $key }}" class="w-20 h-16 mx-auto hover:cursor-pointer hover:scale-95"
                        src="/assets/image/img-plus.svg" alt="">
                </label>
                <input name="img-product" id="_{{ $key }}" type="file" value=""
                    class="mx-auto file:opacity-0 file:size-12" />
            </div>
        @elseif($key == 'product_id')
            <input id="_{{ $key }}" type="text" value="{{ $randomId }}"
                class="input input-bordered w-full mt-2 " />
        @elseif($key == 'group_id')
            {{-- {{dd($products['data'][0]['product_name'])}} --}}

            <select id="_{{ $key }}" class="select select-bordered mt-2 w-full ">
                <option value="{{ $randomId }}" selected class=" text-base">Không phải biến thể</option>
                {{ $a = 0 }}
                @foreach ($products['data'] as $key => $_group_id)
                    @if ($_group_id['product_id'] == $_group_id['group_id'])
                        <option value="{{ $_group_id['product_id'] }}" class="text-base {{ $a % 2 ?: 'bg-gray-800' }}">
                            {{ $_group_id['product_name'] }}</option>
                        {{ $a += 1 }}
                    @endif
                @endforeach
            </select>
        @elseif($key == 'color_id')
            <div class="relative">
                <select class="input input-bordered w-full mt-2 " id="_{{ $key }}">
                    <option disabled value="" selected>-- Chọn Màu --</option>
                </select>
                <p id="changeColor" class="absolute size-5 top-5 right-2"> </p>
            </div>
        @elseif($key == 'product_type')
            @php
                $checks = [
                    [
                        'title' => 'Hot',
                        'value' => 'Hot',
                    ],
                    [
                        'title' => 'Mới',
                        'value' => 'New',
                    ],
                    [
                        'title' => 'Flash Sale',
                        'value' => 'FlashSale',
                    ],
                    [
                        'title' => 'Discount',
                        'value' => 'Discount',
                    ],
                    [
                        'title' => 'My Sale',
                        'value' => 'MySale',
                    ],
                    [
                        'title' => 'Hot Sale',
                        'value' => 'HotSale',
                    ],
                ];
            @endphp
            @foreach ($checks as $key_check => $items_check)
                <div class="form-control">
                    <label class="label cursor-pointer">
                        <span class="label-text">{{ $items_check['title'] }}</span>
                        <input value="{{ $items_check['value'] }}" name="productType" type="checkbox"
                            class="checkbox" />
                    </label>
                </div>
            @endforeach
            <input id="_{{ $key }}" class="scale-0 opacity-0 size-0" name="input_check_type"type="text">
        @elseif($key == 'category_id')
            <select class="input input-bordered w-full mt-2 " id="_{{ $key }}">
                <option disabled value="" selected>-- Chọn Category --</option>
            </select>
            @elseif( $key == 'status' || $key == 'rating' || $key == 'total_rating' || $key == 'sold')
            <input id="_{{ $key }}" type="text" value="0" class="input input-bordered w-full mt-2 " />
        @else
            <input id="_{{ $key }}" type="text" value="" class="input input-bordered w-full mt-2 " />
        @endif
        <p class="italic text-red-600" id='{{ $fillable[$item] }}'></p>
    </div>
@endforeach
<script>
    const _checks = document.querySelectorAll("input[name='productType']")
    const input_checks = document.querySelector("input[name='input_check_type']")
    _checks.forEach(item => {
        if (item.checked) {
            input_checks.value += `_$*${item.value}*$_,`
        }
    })
    _checks.forEach(element => {
        element.addEventListener("change", () => {
            input_checks.value = ""
            _checks.forEach(item => {
                if (item.checked) {
                    input_checks.value += `_$*${item.value}*$_,`
                }
            })
            console.log(input_checks.value);
        })
    });
</script>
