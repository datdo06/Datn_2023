@extends('template.master')
@section('title', 'User')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
@endsection
@section('content')
    @include('transaction.reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center mt-4 my-3">
            <div class="col-lg-8 ">
            <form class="d-flex" method="GET" action="{{ route('transaction.reservation.pickFromCustomer') }}">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Tìm" id="search-user"
                        name="q" value="{{ request()->input('q') }}">
                    <button class="btn btn-outline-dark" type="submit">Tìm</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                @if (!empty(request()->input('q')))
                    <h4>Result for "{{ request()->input('q') }}"</h4>
                    <h4>Total Data: {{ $usersCount }}</h4>
                @endif
            </div>
        </div>
        <div class="row justify-content-md-center mt-3">
            <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                <div class="pagination-block">
                    {{ $users->onEachSide(1)->links('template.paginationlinks') }}
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($users as $user)
                <div class="col-lg-3 col-md-4 col-sm-6 my-1">
                    <div class="card shadow-sm justify-content-start" style="min-height:350px; ">
                        <img class="myImages" src="{{ $user->getAvatar() }}"
                            style="object-fit: cover; height:250px; border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem;">
                        <div class="card-body">
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5 class="mt-0">{{ $user->name }}
                                                </h5>
                                                <div class="table-responsive">
                                                    <table>
                                                        <tr>
                                                            <td><i class="fas fa-envelope"></i></td>
                                                            <td>
                                                                <span>
                                                                    {{ $user->email }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="fas fa-phone"></i></td>
                                                            <td>
                                                                <span>
                                                                    {{$user->phone}}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-grid gap-2 col-6 mx-auto">
                                        <a href="{{ route('transaction.reservation.viewCountPerson', ['user' => $user->id]) }}"
                                            class="btn btn-primary">Chọn</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-md-center mt-3">
            <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                <div class="pagination-block">
                    {{ $users->onEachSide(1)->links('template.paginationlinks') }}
                </div>
            </div>
        </div>
    </div>
@endsection
