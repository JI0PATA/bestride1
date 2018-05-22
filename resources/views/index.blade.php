@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Available Rides</h1>
                <div class="row">

                    @forelse($rides as $ride)
                    <!-- RIDE -->
                    <div class="col-sm-3 col-lg-3 col-md-3 card__parent">
                        <div class="card__more">{{ $ride->comment }}</div>
                        <div class="thumbnail">
                            <div class="clearfix heading">
                                <img class="img-circle pull-left" style="width: 85px; height: 85px;" src="{{ asset('img/avatars/'.$ride->user->avatar) }}" alt="Avatar">
                                <strong class="date">{{ convertDate('d/m/Y', $ride->start_at) }}</strong>
                            </div>

                            <div class="caption">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="h6">Origin</h4>
                                        <strong class="text-uppercase">{{ $ride->origin }}</strong>
                                    </div>

                                    <div class="pull-right text-right">
                                        <h4 class="h6">Destination</h4>
                                        <strong class="text-uppercase">{{ $ride->destination }}</strong>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="pull-right text-right">
                                        <h4 class="h6">U$ PRICE</h4>
                                        <strong class="text-uppercase">{{ (int)$ride->price === 0 ? 'FREE' : number_format($ride->price, 2, ',', '.')}}</strong>
                                    </div>
                                    <div class="pull-left">
                                        <h4 class="h6">Seats available</h4>
                                        <strong class="text-uppercase">{{ $ride->seats - $ride->users->count() }}</strong>
                                    </div>
                                </div>

                                @auth
                                    <a href="#" class="btn btn-primary btn-block btn-join text-uppercase">Join</a>
                                @endauth
                            </div>

                            <div class="thumbnail-footer">
                                <small class="text-center help-block">Registered {{ convertDate('d/m/Y H:i', $ride->created_at) }}</small>
                                <small class="text-center help-block">by {{ $ride->user->name }}</small>
                            </div>
                        </div>
                    </div>
                    <!-- END RIDE -->
                    @empty
                        <h3>Поездок в данных момент нет</h3>
                    @endforelse

                    <div class="col-md-12 text-center">
                        {{ $rides->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
