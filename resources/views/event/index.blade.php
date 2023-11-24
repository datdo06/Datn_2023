<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    body {
        margin-top: 20px;
    }

    .event-schedule-area .section-title .title-text {
        text-align: center;
        margin-bottom: 50px;
    }

    .event-schedule-area .tab-area .nav-tabs {
        text-align: center;
        border-bottom: inherit;
    }

    .event-schedule-area .tab-area .nav {
        border-bottom: inherit;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        margin-top: 80px;
        text-align: center;

    }

    .event-schedule-area .tab-area .nav-item {
        margin-bottom: 75px;
        text-align: center;

    }

    .event-schedule-area .tab-area .nav-item .nav-link {
        text-align: center;
        font-size: 22px;
        color: #333;
        border-radius: inherit;
        border: inherit;
        padding: 0px;
        text-transform: capitalize !important;
    }

    .event-schedule-area .tab-area .nav-item .nav-link.active {
        color: #4125dd;
        background-color: transparent;
    }

    .event-schedule-area .tab-area .tab-content .table {
        margin-bottom: 0;
        width: 80%;
    }

    .event-schedule-area .tab-area .tab-content .table thead td,
    .event-schedule-area .tab-area .tab-content .table thead th {
        border-bottom-width: 1px;
        font-size: 20px;
        color: #252525;
    }

    .event-schedule-area .tab-area .tab-content .table td,
    .event-schedule-area .tab-area .tab-content .table th {
        border: 1px solid #b7b7b7;
        padding-left: 30px;
    }

    .event-schedule-area .tab-area .tab-content .table tbody th,
    .event-schedule-area .tab-area .tab-content .table tbody td {
        font-size: 16px;
        text-transform: capitalize;
        margin-bottom: 16px;
        color: #252525;
        margin-bottom: 6px;
    }

    .event-schedule-area .tab-area .tab-content .table tbody th span,
    .event-schedule-area .tab-area .tab-content .table tbody td span {
        color: #4125dd;
        font-size: 18px;
        text-transform: uppercase;
        margin-bottom: 6px;
        display: block;
    }

    .event-schedule-area .tab-area .tab-content .table tbody th span.date,
    .event-schedule-area .tab-area .tab-content .table tbody td span.date {
        color: #656565;
        font-size: 14px;
        margin-top: 15px;
    }

    .event-schedule-area .tab-area .tab-content .table tbody th p {
        font-size: 14px;
        margin: 0;
    }

    .event-schedule-area-two .section-title .title-text {
        margin: 0px 0 15px;
    }

    .event-schedule-area-two ul.custom-tab {
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 30px;
    }

    .event-schedule-area-two ul.custom-tab li {
        margin-right: 70px;
        position: relative;
    }

    .event-schedule-area-two ul.custom-tab li a {
        color: #252525;
        font-size: 25px;
        line-height: 25px;
       
        text-transform: capitalize;
        padding: 35px 0;
        position: relative;
    }

    .event-schedule-area-two ul.custom-tab li a:hover:before {
        width: 100%;
    }

    .event-schedule-area-two ul.custom-tab li a:before {
        position: absolute;
        left: 0;
        bottom: 0;
        content: "";
        background: #4125dd;
        width: 0;
        height: 2px;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        transition: all 0.4s;
    }

    .event-schedule-area-two ul.custom-tab li a.active {
        color: #4125dd;
    }

    .event-schedule-area-two .primary-btn {
        margin-top: 40px;
    }

    .event-schedule-area-two .tab-content .table {
        -webkit-box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
        box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 0;
    }

    .event-schedule-area-two .tab-content .table thead {
        background-color: #007bff;
        color: #fff;
        
    }

    .event-schedule-area-two .tab-content .table thead tr th {
        padding: 20px;
        border: 0;
    }

    .event-schedule-area-two .tab-content .table tbody {
        background: #fff;
    }

    .event-schedule-area-two .tab-content .table tbody tr.inner-box {
        border-bottom: 1px solid #dee2e6;
    }

    .event-schedule-area-two .tab-content .table tbody tr th {
        border: 0;
        padding: 30px 20px;
        vertical-align: middle;
    }

    .event-schedule-area-two .tab-content .table tbody tr th .event-date {
        color: #252525;
        text-align: center;
    }

    .event-schedule-area-two .tab-content .table tbody tr th .event-date span {
        font-size: 50px;
        font-weight: normal;
    }

    .event-schedule-area-two .tab-content .table tbody tr td {
        padding: 30px 20px;
        vertical-align: middle;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .r-no span {
        color: #252525;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap h3 a {
        font-size: 20px;
        line-height: 20px;
        color: #cf057c;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        transition: all 0.4s;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap h3 a:hover {
        color: #4125dd;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .categories {
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        margin: 10px 0;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .categories a {
        color: #252525;
        font-size: 16px;
        margin-left: 10px;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        transition: all 0.4s;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .categories a:before {
        content: "\f07b";
        padding-right: 5px;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .time span {
        color: #252525;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .organizers {
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        margin: 10px 0;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .organizers a {
        color: #4125dd;
        font-size: 16px;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        transition: all 0.4s;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .organizers a:hover {
        color: #4125dd;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .organizers a:before {
        content: "\f007";
        padding-right: 5px;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .primary-btn {
        margin-top: 0;
        text-align: center;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-img img {
        width: 100px;
        height: 100px;
        border-radius: 8px;
    }
    </style>
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
    }

    .container-event {
        margin-left: 5px;
        display: flex;
        flex-direction: row;
        width: 1100px;
        height: 300px;
        background: #111;
    }

    @media (min-width: 1024px) {
        .container {
            flex-direction: row;
        }
    }

    .item {
        position: relative;
        flex: calc(100vw / 6) 1 1;
        background-size: cover;
        overflow: hidden;
        filter: saturate(90%);
        transition: 1s;
    }

    .item:before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(25deg, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0));
    }

    .item:not(:last-child) {
        border-bottom: 1px solid #ccc;
        animation: borderPulse 5s infinite;
    }

    @media (min-width: 1024px) {
        .item:not(:last-child) {
            border-right: 1px solid #ccc;
            border-bottom: none;
        }
    }

    .item:hover {
        flex-basis: 40%;
        filter: saturate(120%);
    }

    @media (min-width: 1024px) {
        .item:hover {
            flex-basis: 75%;
        }
    }

    .item:hover .quote {
        opacity: 1;
        transform: translateX(0);
    }

    .item:nth-child(1) {
        background-image: url("../img/event/event-17.jpg");
        background-position: 72% 35%;
    }

    .item:nth-child(2) {
        background-image: url("../img/event/event-18.jpg");
        background-position: 60% 8%;
    }

    .item:nth-child(3) {
        background-image: url("../img/event/event-19.jpg");
        background-position: 52% 8%;
    }

    .item:nth-child(4) {
        background-image: url("../img/event/event-20.jpg");
        background-position: 45% 8%;
    }

    .item:nth-child(5) {
        background-image: url("../img/event/event-21.jpg");
        background-position: 45% 25%;
    }

    .item:nth-child(6) {
        background-image: url("../img/homestay/homestay-14.jpg");
        background-position: 65% 2%;
    }

    .item:nth-child(7) {
        background-image: url("../img/homestay/homestay-18.jpg");
        background-position: 65% 2%;
    }

    .quote {
        position: absolute;
        color: #fff;
        bottom: 35%;
        left: 5rem;
        width: calc(100% - 10rem);
        opacity: 0;
        transition: 1s;
        transform: translateX(50%);
    }

    @media (min-width: 512px) {
        .quote {
            left: 15%;
            bottom: 35%;
            width: 20vw;
        }
    }

    @media (min-width: 1024px) {
        .quote {
            left: 15%;
            bottom: 35%;
            width: 30vw;
        }
    }

    .quote p {
        position: relative;
        display: inline-block;
        margin-bottom: 1.7rem;
        font-size: 1.4rem;
        text-wrap: balance;
        font-style: italic;
    }
    

    .layout {
        display: flex;
        height: 300px;
        ;
    }

    .layout>div {
        flex: 1;
        border-radius: 10px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: auto 100%;
        transition: all 0.8s cubic-bezier(0.25, 0.4, 0.45, 1.4);
    }

    .layout>div:hover {
        flex: 3;
    }
    </style>
</head>

@extends('client.layout.master')
@section('content')

<!-- SUB BANNER -->
<section class="section-sub-banner bg-10">
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
                <h2>Sự kiện</h2>
                <p> </p>
            </div>
        </div>

    </div>

</section>
<!-- END / SUB BANNER -->
<br><br>
<section class="container">
    <h1 class=""> Sự kiện gần đây</h1>
</section>

<section>

    <div class="container layout img">
        <div style="background-image: url(../img/event/event-1.jpg);"></div>
        <div style="background-image: url(../img/event/event-2.jpg);"></div>
        <div style="background-image: url(../img/event/event-3.jpg);"></div>
        <div style="background-image: url(../img/event/event-4.jpg);"></div>
        <div style="background-image: url(../img/event/event-5.jpg);"></div>

    </div>
</section>

<section>

    <div class="event-schedule-area-two bg-color pad100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <div class="title-text">
                            <br><br>
                            <h1>Các sự kiện sắp tới</h1>
                        </div>
                        
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav custom-tab" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="home-taThursday" data-toggle="tab" href="#home"
                                role="tab" aria-controls="home" aria-selected="true">Tháng 9</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Tháng 10</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Tháng 11</a>
                        </li>
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" id="sunday-tab" data-toggle="tab" href="#sunday" role="tab"
                                aria-controls="sunday" aria-selected="false">Tháng 12</a>
                        </li>
                         
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">Thời gian</th>
                                            <th scope="col">Sự kiện</th>
                                            <th scope="col">Mô tả</th>
                                            <th scope="col">Cơ sở</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="inner-box">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>2</span>
                                                    <p>Tháng 9/2023</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    <img src="img/event/event-6.jpg" alt />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h3><a href="#">Ngày Quốc Khánh</a></h3>
                                                    <div class="meta">
                                                        <div class="organizers">
                                                            
                                                        </div>
                                                        
                                                        <div class="time">
                                                            <span>17:00 - 22:00 </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="r-no">
                                                    <span>Toàn cơ sở</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <tr class="inner-box">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>21</span>
                                                    <p>Tháng 9/2023</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    <img src="img/event/event-7.jpg" alt />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h3><a href="#">Ngày Quốc Tế Hòa Bình</a></h3>
                                                    <div class="meta">
                                                        <div class="organizers">
                                                             
                                                        </div>
                                                         
                                                        <div class="time">
                                                            <span>9:00 - 17:00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="r-no">
                                                    <span>Đống Đa</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <tr class="inner-box border-bottom-0">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>29</span>
                                                    <p>Tháng 9/2023</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    <img src="img/event/event-8.jpg" alt />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h3><a href="#">Tết Trung Thu ( Dương Lịch )</a></h3>
                                                    <div class="meta">
                                                        <div class="organizers">
                                                             
                                                        </div>
                                                         
                                                        <div class="time">
                                                            <span>16:00 - 22:30</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="r-no">
                                                    <span>Toàn cơ sở</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
        
                                            <th class="text-center" scope="col">Thời gian</th>
                                            <th scope="col">Sự kiện</th>
                                            <th scope="col">Mô tả</th>
                                            <th scope="col">Cơ sở</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="inner-box">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>10</span>
                                                    <p>Tháng 10/2023</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    <img src="img/event/event-9.jpg" alt />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h3><a href="#">Ngày Giải phóng Thủ Đô </a></h3>
                                                    <div class="meta">
                                                        <div class="organizers">
                                                             
                                                        </div>
                                                         
                                                        <div class="time">
                                                            <span>16:30 - 21:30</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="r-no">
                                                    <span>Toàn cơ sở</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <tr class="inner-box">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>20</span>
                                                    <p>Tháng 10/2023</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    <img src="img/event/event-10.jpg" alt />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h3><a href="#">Ngày Hội Phụ nữ Việt Nam</a></h3>
                                                    <div class="meta">
                                                        <div class="organizers">
                                                             
                                                        </div>
                                                         
                                                        <div class="time">
                                                            <span>10:00 - 22:00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="r-no">
                                                    <span>Toàn cơ sở</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <tr class="inner-box border-bottom-0">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>31</span>
                                                    <p>Tháng 10/2023</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    <img src="img/event/event-11.jpg" alt />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h3><a href="#">Lễ hội Halloween</a></h3>
                                                    <div class="meta">
                                                        <div class="organizers">
                                                             
                                                        </div>
                                                         
                                                        <div class="time">
                                                            <span>16:00 - 23:30</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="r-no">
                                                    <span>Toàn cơ sở</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">Thời gian</th>
                                            <th scope="col">Sự kiện</th>
                                            <th scope="col">Mô tả</th>
                                            <th scope="col">Cơ sở</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="inner-box">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>19</span>
                                                    <p>Tháng 11/2023</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    <img src="img/event/event-12.jpg" alt />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h3><a href="#">Ngày Quốc Tế Đàn Ông</a></h3>
                                                    <div class="meta">
                                                        <div class="organizers">
                                                             
                                                        </div>
                                                         
                                                        <div class="time">
                                                            <span>10:00 - 22:00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="r-no">
                                                    <span>Toàn cơ sở</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <tr class="inner-box">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>20</span>
                                                    <p>Tháng 11/2023</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    <img src="img/event/event-13.jpg" alt />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h3><a href="#">Ngày Nhà Giáo Việt Nam</a></h3>
                                                    <div class="meta">
                                                        <div class="organizers">
                                                            
                                                        </div>
                                                         
                                                        <div class="time">
                                                            <span>10:00 - 22:30</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="r-no">
                                                    <span>Toàn cơ sở</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <tr class="inner-box border-bottom-0">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>24</span>
                                                    <p>Tháng 11/2023</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    <img src="img/event/event-14.jpg" alt />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h3><a href="#">Black Friday</a></h3>
                                                    <div class="meta">
                                                        <div class="organizers">
                                                             
                                                        </div>
                                                         
                                                        <div class="time">
                                                            <span>9:00 - 23:30'</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="r-no">
                                                    <span>Toàn cơ sở</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sunday" role="tabpanel" aria-labelledby="sunday-tab">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">Thời gian</th>
                                            <th scope="col">Sự kiện</th>
                                            <th scope="col">Mô tả</th>
                                            <th scope="col">Cơ sở</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr class="inner-box">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>25</span>
                                                    <p>Tháng 12/2023</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    <img src="img/event/event-15.jpg" alt />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h3><a href="#">Ngày Lễ Giáng Sinh</a></h3>
                                                    <div class="meta">
                                                        <div class="organizers">
                                                             
                                                        </div>
                                                         
                                                        <div class="time">
                                                            <span>10:00 - 23:30</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="r-no">
                                                    <span>Toàn cơ sở</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <tr class="inner-box">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>31</span>
                                                    <p>Tháng 12/2023</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    <img src="img/event/event-16.jpg" alt />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h3><a href="#">Tiệc Tất Niên</a></h3>
                                                    <div class="meta">
                                                        <div class="organizers">
                                                           
                                                        </div>
                                                         
                                                        <div class="time">
                                                            <span>22:00 - 3:00'</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="r-no">
                                                    <span>Toàn cơ sở</span>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>

                </div>

            </div>

        </div>
    </div>

</section>
<br><br><br>

<section class="container">
    <h2 class=" heading"> Khoảnh khắc </h2>
</section>

<section>
    <br> <br>
    <div class="container">
        <div class=" container-event">
            <div class="item">
                <div class="quote">
                    <p>2018</p>
                </div>
            </div>
            <div class="item">
                <div class="quote">
                    <p>2019</p>
                </div>
            </div>
            <div class="item">
                <div class="quote">
                    <p>2020</p>
                </div>
            </div>
            <div class="item">
                <div class="quote">
                    <p>2021</p>
                </div>
            </div>
            <div class="item">
                <div class="quote">
                    <p>2022</p>
                </div>
            </div>
            <div class="item">
                <div class="quote">
                    <p>2023</p> 
                </div>
            </div>

        </div>
    </div>
</section>
<br>
<br>

@endsection



<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>