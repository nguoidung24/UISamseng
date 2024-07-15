<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    @foreach ($data as $key => $_data)
        Tên điện thoại: {{ $_data['product_name'] }},
        Hãng: {{ $_data['category']['category_name'] }},
        Giá: {{ number_format($_data['price'], 0, ',', '.') }} vnđ,
        Màu: {{ $_data['color']['value'] }},
        Danh mục: {{ $_data['category']['category_name'] }},
        {{ $_data['discount'] . '_' == '0' . '_' ? 'Không giảm giá' : 'Đang giảm giá còn '.number_format(($_data['price'] - ($_data['price'] * $_data['discount'] / 100)), 0, ',', '.').' vnđ' }}.
        <br />
    @endforeach
   
</body>

</html>
