<div style="width:500px; margin: 0 auto; padding: 15px; text-align:center">
  <h2>Hi {{ session()->get('user')['name'] }}</h2>
  <p>Mã xác nhận của bạn là: <strong>{{ $verificationCode }}</strong></p>
  <p>Vui lòng nhập code này vào trang xác nhận của chúng tôi để xác nhận email của bạn. Xin cảm ơn bạn đã ủng hộ!</p>
</div>
