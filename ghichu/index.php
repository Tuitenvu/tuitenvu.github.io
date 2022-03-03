<?php

// Url trang chủ
$base_url = 'https://tuitenvu.github.io/ghichu';
// Tiêu đề
$tieude = 'Ghichu.tk';
// Vô hiệu hóa caching.
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Nếu tên của một ghi chú không được cung cấp hoặc chứa các ký tự không phải chữ và số / không phải ASCII.
if (!isset($_GET['note']) || !preg_match('/^[a-zA-Z0-9]+$/', $_GET['note'])) {

    // Tạo tên với 5 ký tự ngẫu nhiên rõ ràng. Chuyển hướng đến nó.
    header("Location: $base_url/" . substr(str_shuffle('qwertyuiopasdfghjklzxcvbnmQWẺTYUIOPLKJHGFDSAZXCVBNM1234567890'), -5));
    die;
}

$path = '_tmp/' . $_GET['note'];

if (isset($_POST['text'])) {

    // Cập nhật tệp.
    file_put_contents($path, $_POST['text']);

    // Nếu đầu vào được cung cấp trống, hãy xóa tệp.
    if (!strlen($_POST['text'])) {
        unlink($path);
    }
    die;
}

// Đầu ra tập tin thô nếu khách hàng là curl.
if (strpos($_SERVER['HTTP_USER_AGENT'], 'curl') === 0) {
    if (is_file($path)) {
        print file_get_contents($path);
    }
    die;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php print $tieude; ?> -<?php print $_GET['note']; ?></title>
    <link rel="shortcut icon" href="<?php print $base_url; ?>/favicon.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- sweetaler-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.all.min.js" integrity="sha512-hDt6c6JA9ytE/b7OF73Bhj1lXT0wucQXm9yKjSV7BrJ6o5CVs1hq7nIQWU4OhOyrUbbL1KhN7Jt00v7UZA18og==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>">

</head>
<body>
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php print $base_url; ?>"><?php print $tieude; ?></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php print $base_url; ?>">Trang Chủ</a></li>
    </ul>
  </div>
</nav>

    <div class="container">
       <div style="height: 50%;" class="form-group">
        <textarea placeholder="Nhập nội dung cần lưu trữ vào đây.." class="form-control" id="content"><?php
            if (is_file($path)) {
                print htmlspecialchars(file_get_contents($path), ENT_QUOTES, 'UTF-8');
            }
        ?></textarea>
        
    </div> 
        <div class="form-group">
 <a onclick="window.location.reload(true);"><button  onclick="myFunction()" type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>
 Lưu Notepad</button></a>
<a href='javascript:;' onclick='CopyLink()' type="submit" class="btn btn-danger"><i class='fa fa-clipboard'></i>
 Copy Link Notepad</a>
 <div class="btn btn-primary" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore" class="btn btn-primary"><i class='fa fa-facebook'></i>
 Share Lên Facebook</a></div>

<script>
function copyTextToClipboard(e){var t=document.createElement("textarea");t.style.position="fixed",t.style.top=0,t.style.left=0,t.style.width="2em",t.style.height="2em",t.style.padding=0,t.style.border="none",t.style.outline="none",t.style.boxShadow="none",t.style.background="transparent",t.value=e,document.body.appendChild(t),t.select();
try{document.execCommand("copy"),
    Swal.fire(
        'Đã chép',
        'Đã chép xong vào khay nhớ tạm',
        'success'
  )}catch(o){alert("Không thể sao chép liên kết!")}document.body.removeChild(t)}function CopyLink(){copyTextToClipboard(location.href)}
</script>
<script>
function myFunction() {
    Swal.fire(
        'Đã lưu',
        'Đã lưu xong vào server',
        'success'
  );
}
</script>
<script type="text/javascript">
            function Copy() 
            {
                urlCopied.innerHTML = window.location.href;
            }
        </script>
<script>
document.getElementById("demo").innerHTML = 
"" + window.location.href;
</script>
  </div>
  </div>
<link rel="stylesheet" href="<?php print $base_url; ?>/huunhan.css">
    <pre id="printable"></pre>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <script src="<?php print $base_url; ?>/script.js"></script>
</body>
</html>
