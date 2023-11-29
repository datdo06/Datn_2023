<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt phòng thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 600px;
            padding: 20px;
        }
        h1 {
            color: #007BFF;
            text-align: center;
        }
        p {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        strong {
            font-weight: bold;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .success-card {
            width: 800px;
            padding: 30px;
            margin: 100px auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }

        .success-card h1 {
            font-size: 36px;
            color: #FFFFFF;
            margin-bottom: 30px;
        }

        .success-card p {
            font-size: 18px;
            color: #666666;
            margin-bottom: 30px;
        }

        .success-card a {
            display: inline-block;
            font-size: 18px;
            color: #ffffff;
            background-color: #4caf50;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
        }
        .header {
            background-color: #4caf50;
            color: #fff;
            text-align: center;
            padding: 15px 0;
        }
    </style>
</head>
<body>
<div class="success-card">
    <div class="header">
        <h1>Đặt phòng thành công</h1>
    </div>
    <p>Xin chào [Tên khách hàng],</p>
    <p>Cảm ơn bạn đã đặt phòng tại khách sạn chúng tôi. Đặt phòng của bạn đã được xác nhận và thông tin đặt phòng chi tiết như sau:</p>

    <h2>Thông tin đặt phòng</h2>
    <ul>
        <li><strong>Ngày nhận phòng:</strong> [Ngày nhận phòng]</li>
        <li><strong>Ngày trả phòng:</strong> [Ngày trả phòng]</li>
        <li><strong>Loại phòng:</strong> [Loại phòng]</li>
        <li><strong>Số lượng người lớn:</strong> [Số người lớn]</li>
        <li><strong>Số lượng trẻ em:</strong> [Số trẻ em]</li>
        <li><strong>Tổng giá:</strong> [Tổng giá]</li>
    </ul>

    <p>Hãy kiểm tra email này để xem lại thông tin đặt phòng của bạn. Nếu bạn có bất kỳ câu hỏi hoặc cần sự hỗ trợ bổ sung, vui lòng liên hệ với chúng tôi tại <span>kingtheland@gmail.com</span> hoặc số điện thoại [Số điện thoại của khách sạn].</p>

    <p>Chúng tôi rất mong được phục vụ bạn tại homestay của chúng tôi. Chúc bạn có một kỳ nghỉ thú vị!</p>

    <p>Trân trọng,</p>
    <p>Kng The Land</p>
</div>



</body>
</html>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

$currentTime = time();
$currentDayOfWeek = date('w', $currentTime);
$firstDayOfWeek = strtotime("-$currentDayOfWeek days", $currentTime);
$lastDayOfWeek = strtotime("+" . (6 - $currentDayOfWeek) . " days", $currentTime);

echo "Thời gian bắt đầu của tuần: " . date('Y-m-d', $firstDayOfWeek) . "<br>";
echo "Thời gian kết thúc của tuần: " . date('Y-m-d', $lastDayOfWeek) . "<br>";

// In ra từng ngày trong tuần
echo "Các ngày trong tuần:<br>";
for ($day = $firstDayOfWeek; $day <= $lastDayOfWeek; $day += 86400) { // 86400 giây trong một ngày
    echo date('Y-m-d', $day) . "<br>";
}
?>


