<?php
$customerList = [
    "1" => [
        "ten" => "Mai Văn Toàn",
        "ngaysinh" => "1983-08-20",
        "diachi" => "Hà Nội",
        "hotline" => "8123751537",
        "anh" => "image/cbd.jpeg"
    ],
    "2" => [
        "ten" => "Nguyễn Du",
        "ngaysinh" => "1983-08-20",
        "diachi" => "An Giang",
        "hotline" => "83614734639",
        "anh" => "image/cmd.jpeg"
    ],
    "3" => [
        "ten" => "Nguyễn Thái Anh",
        "ngaysinh" => "1992-08-21",
        "diachi" => "Nam Định",
        "hotline" => "83614734639",
        "anh" => "image/shc.jpeg"
    ],
    "4" => [
        "ten" => "Trần Dần",
        "ngaysinh" => "1983-08-22",
        "diachi" => "Hà Giang",
        "hotline" => "83614734639",
        "anh" => "image/4.jpeg"
    ],
    "5" => [
        "ten" => "Nguyễn Đình Chi",
        "ngaysinh" => "1963-08-17",
        "diachi" => "Hà Nội",
        "hotline" => "83614734639",
        "anh" => "image/5.jpeg"
    ],
    "6" => [
        "ten" => "Lê Đức Thinh",
        "ngaysinh" => "1986-08-17",
        "diachi" => "Hà Nội",
        "hotline" => "83614734639",
        "anh" => "image/6.jpeg"
    ]
];
// Xây dựng hàm tìm kiếm searchByDate() với 3 tham số đầu vào.
function searchByDate($customers, $from_date, $to_date)
{
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer['day_of_birth']) > strtotime($from_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer['day_of_birth']) > strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
    <?php
    // Gọi hàm tìm kiếm
    $from_date = null;
    $to_date = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $from_date = $_POST["from"];
        $to_date = $_POST["to"];
    }
    $filtered_customers = searchByDate($customerList, $from_date, $to_date);
    ?>
    <?php if (count($filtered_customers) === 0) : ?>
        <tr>
            <td colspan="6" class="message">Không tìm thấy khách hàng nào</td>
        </tr>
    <?php endif; ?>
    <form method="post">
        Từ: <input id="from" type="text" name="from" placeholder="yyyyy/mm/dd" />
        Đến: <input id="to" type="text" name="to" placeholder="yyyy/mm/dd" />
        <input type="submit" id="submit" value="Lọc" />
    </form>
    <table>
        <caption>
            <h1>Danh sách khách hàng</h1>
        </caption>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Ngày sinh</th>
                <th>Địa chỉ</th>
                <th>Hotline</th>
                <th>Ảnh</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customerList as $key => $value) : ?>
                <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $value["ten"] ?></td>
                    <td><?php echo $value["ngaysinh"] ?></td>
                    <td><?php echo $value["diachi"] ?></td>
                    <td><?php echo $value["hotline"] ?></td>
                    <td><img src="<?php echo $value["anh"] ?>" style="width:150px; height:150px"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
