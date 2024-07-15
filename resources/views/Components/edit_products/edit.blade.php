@foreach ($fillable as $item => $key)
    @if ($key != 'product_id')
        <div>
            <label for="">{{ $Field[$item] }}</label>
            @if ($key == 'color_id')
                <div class="relative">
                    <select class="input input-bordered w-full mt-2 " id="_{{ $key }}">
                        <option disabled value="{{ $product[$key] }}" selected>
                            {{ $product['color']['value'] }}</option>
                    </select>
                    <p id="changeColor" class="absolute size-5 top-5 right-2 border-2 border-base-content"
                        style="background-color:  {{ $product['color']['value'] }}"> </p>
                    <p id="changeColor" class="absolute size-5 top-5 right-2 border-2 border-base-content">
                    </p>
                </div>
            @elseif ($key == 'thumbnail')
                <div class="relative text-center">
                    <label for="_{{ $key }}">
                        <img id="__{{ $key }}" class="w-20 h-22 mx-auto hover:cursor-pointer hover:scale-95"
                            src="/{{ $product[$key] }}" alt="">
                    </label>
                    <input name="img-product" id="_{{ $key }}" type="file" value="{{ $product[$key] }}"
                        class="mx-auto file:opacity-0 file:size-12" />
                </div>
            @elseif($key == 'category_id')
                <select class="input input-bordered w-full mt-2 " id="_{{ $key }}">
                    <option disabled value="{{ $product[$key] }}" selected>
                        {{ $product['category']['category_name'] }}</option>
                </select>
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
                                @foreach (explode(',', $product[$key]) as $value)
                            {{ $items_check['value'] == substr($value, 3, -3) ? 'checked' : '' }} @endforeach
                                class="checkbox" />
                        </label>
                    </div>
                @endforeach
                <input id="_{{ $key }}" class="scale-0 opacity-0 size-0" name="input_check_type"type="text">
            @elseif($key == 'group_id')
                <div>
                    @foreach ($products['data'] as $key_group_id => $_group_id)
                    @if ($_group_id['product_id'] == $product[$key])
                    <input readonly type="text" value="{{ $_group_id['product_name'] ==  $product['product_name'] ? 'Không phải là biến thể' : $_group_id['product_name'] }}"
                    class="input input-bordered w-full mt-2" disabled /> 
                    @endif
                    @endforeach
                    <input readonly id="_{{ $key }}" type="text" value="{{ $product[$key] }}"
                    class="scale-0 opacity-0 size-0" /> 
                </div>
            @else
                <input id="_{{ $key }}" type="text" value="{{ $product[$key] }}"
                    class="input input-bordered w-full mt-2 " />
            @endif
        </div>
    @endif
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
