<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
</head>
<style>
    body{
	margin:0;
	padding:0;
}
/* .container{
	width:90%
	margin:10px auto;
} */
.portfolio-menu{
	text-align:center;
}
.portfolio-menu ul li{
	display:inline-block;
	margin:0;
	list-style:none;
	padding:10px 15px;
	cursor:pointer;
	-webkit-transition:all 05s ease;
	-moz-transition:all 05s ease;
	-ms-transition:all 05s ease;
	-o-transition:all 05s ease;
	transition:all .5s ease;
}

.portfolio-item{
	width:100%;
}
.portfolio-item .item{
	width:303px;
	float:left;
	margin-bottom:10px;
}
.hover {
  overflow: hidden;
  position: relative;
  padding-bottom: 60%;
}

.hover-overlay {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 90;
  transition: all 0.4s;
}

.hover img {
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  transition: all 0.3s;
}

.hover-content {
  position: relative;
  z-index: 99;
}




/* DEMO 5 ============================== */
.hover-5::after {
  content: '';
  width: 100%;
  height: 10px;
  background: #47c650;
  position: absolute;
  bottom: -10px;
  left: 0;
  display: block;
  transition: all 0.3s;
  z-index: 999;
}

.hover-5 .hover-overlay {
  background: rgba(0, 0, 0, 0.4);
}

.hover-5-title {
  position: absolute;
  bottom: 1rem;
  left: 0;
  transition: all 0.3s;
  padding: 2rem 3rem;
  z-index: 99;
}

.hover-5-title span {
  transition: all 0.4s;
  opacity: 0;
  color: #47c650;
}

.hover-5:hover .hover-overlay {
  background: rgba(0, 0, 0, 0.8);
}

.hover-5:hover .hover-5-title {
  bottom: 0;
}

.hover-5:hover .hover-5-title span {
  opacity: 1;
}

.hover-5:hover::after {
  bottom: 0;
}

</style>
@extends('client.layout.master')
@section('content')
<!-- SUB BANNER -->
<section class="section-sub-banner bg-7">
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
                <h2>Ảnh sưu tầm</h2>
                <p> </p>
            </div>
        </div>

    </div>

</section>
<!-- END / SUB BANNER -->

<section class="container">
    <br><br>
    <h2 class=" heading">KingTheLand Homestay</h2>
</section>

<section class="section">

    <!-- DEMO 5 -->
  <div class="container py-5">
    <div class="row">
      <!-- DEMO 5 Item-->
      <div class="col-lg-6 mb-3 mb-lg-0">
        <div class="hover hover-5 text-white rounded"><img src="img/gallery/img-6.jpg" alt="">
          <div class="hover-overlay"></div>
          <div class="hover-5-content">
            <h3 class="hover-5-title text-uppercase font-weight-light mb-0"> <strong class="font-weight-bold text-white"> </strong><span>Thư Giãn</span></h3>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <!-- DEMO 5 Item-->
        <div class="hover hover-5 text-white rounded"><img src="img/gallery/img-8.jpg" alt="">
          <div class="hover-overlay"></div>
          <div class="hover-5-content">
            <h3 class="hover-5-title text-uppercase font-weight-light mb-0"> <strong class="font-weight-bold text-white"> </strong><span>Nghỉ Dưỡng</span></h3>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>


<section class="container">
 <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center my-2">
                <h4></h4>
            </div>
         </div>
         <div class="portfolio-menu mt-2 mb-4">
            <ul>
               <li class="btn btn-outline-dark active" data-filter="*">All</li>
               <li class="btn btn-outline-dark" data-filter=".homestay">Khu nghỉ dưỡng</li>
               <li class="btn btn-outline-dark" data-filter=".guest">Bởi khách hàng</li>
               <li class="btn btn-outline-dark text" data-filter=".other">Khác</li>
            </ul>
         </div>
         <div class="portfolio-item row">
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-1.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-1.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-1.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-1.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-2.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-2.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-2.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-2.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-3.jpg " class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-3.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-4.jpg " class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-4.jpg " alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-1.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-1.jpg" alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-2.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-2.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-5.jpg " class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-5.jpg " alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-3.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-3.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-6.jpg " class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-6.jpg " alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-7.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-7.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-8.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-8.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-9.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-9.jpg" alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-4.jpg " class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-4.jpg " alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-10.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-10.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-11.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-11.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-14.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-14.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-3.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-3.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-4.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-4.jpg" alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-5.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-5.jpg" alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-6.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-6.jpg" alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-7.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-7.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-12.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-12.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-13.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-13.jpg" alt="">
               </a>
            </div>
            <div class="item homestay col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/homestay/homestay-14.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/homestay/homestay-14.jpg" alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-8.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-8.jpg" alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-9.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-9.jpg" alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-10.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-10.jpg" alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-11.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-11.jpg" alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-12.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-12.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-5.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-5.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-6.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-6.jpg" alt="">
               </a>
            </div>
            <div class="item guest col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/guest/guest-13.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/guest/guest-13.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-7.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-7.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-8.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-8.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-9.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-9.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-10.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-10.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-6 col-sm">
               <a href="img/event/event-11.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-11.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-12.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-12.jpg" alt="">
               </a>
            </div>
            <div class="item other col-lg-3 col-md-4 col-6 col-sm">
               <a href="img/event/event-13.jpg" class="fancylight popup-btn" data-fancybox-group="light">
               <img class="img-fluid" src="img/event/event-13.jpg" alt="">
               </a>
            </div>
         </div>
      </div>

      <script>
                $('.portfolio-item').isotope({
         	itemSelector: '.item',
         	layoutMode: 'fitRows'
         });
        $('.portfolio-menu ul li').click(function(){
         	$('.portfolio-menu ul li').removeClass('active');
         	$(this).addClass('active');

         	var selector = $(this).attr('data-filter');
         	$('.portfolio-item').isotope({
         		filter:selector
         	});
         	return  false;
         });
         $(document).ready(function() {
         var popup_btn = $('.popup-btn');
         popup_btn.magnificPopup({
         type : 'image',
         gallery : {
         	enabled : true
         }
         });
         });
      </script>

    </section>




@endsection


