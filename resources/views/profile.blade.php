@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="pull-left">My Rides</h1>
                <a href="{{ route('profile.rides.add') }}" class="btn btn-primary pull-right">New Ride</a>
                <table class="table table-rides text-center">
                    <thead>
                    <tr>
                        <th>Date of Ride</th>
                        <th>Date of Registration</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Price</th>
                        <th>Number of seats</th>
                        <th>Associated Users</th>
                        <th>Used Places</th>
                        <th>Value Received</th>
                        <th>More Information</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($my_rides as $ride)
                        <tr>
                            <td>{{ convertDate('d/m/Y', $ride->start_)  }}</td>
                            <td>{{ convertDate('d/m/Y H:i', $ride->created_at) }}</td>
                            <td>{{ $ride->origin }}</td>
                            <td>{{ $ride->destination }}</td>
                            <td>{{ $ride->price }}</td>
                            <td>{{ $ride->seats }}</td>
                            <?php
                            $associate_count = $ride->users->count();
                            ?>
                            <td>{{ $associate_count }}</td>
                            <td>{{ $associate_count / $ride->seats * 100 }}%</td>
                            <td>{{ $associate_count * $ride->price }}</td>
                            <td><a class="btn btn-default spoiler_btn" href="#"><span
                                            class="glyphicon glyphicon-plus"></span> <span
                                            class="btn_text">More info</span></a></td>
                        </tr>
                        <tr class="associate_users">
                            <td colspan="10">
                            @forelse($ride->users as $a_user)
                                <!-- USER -->
                                    <div class="col-sm-2 col-lg-2 col-md-2">
                                        <div class="thumbnail">
                                            <div class="clearfix heading text-center">
                                                <img class="img-circle" style="width: 85px; height: 85px;" src="{{ asset('img/avatars/'.$a_user->avatar) }}"
                                                     alt="Avatar"/>
                                            </div>

                                            <div class="thumbnail-footer">
                                                <small class="text-center help-block">{{ $a_user->name }}</small>
                                                <small class="text-center help-block">{{ $a_user->email }}</small>
                                                <small class="text-center help-block">{{ getAge($a_user->birthdate) }} years old</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END USER -->
                                @empty
                                    <h3>Пользователи не присоединились!</h3>
                                @endforelse

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <hr/>

                <h1>My Associated Rides</h1>
                <div class="row">
                    @forelse($associate as $ride)
                    <!-- RIDE -->
                    <div class="col-sm-3 col-lg-3 col-md-3">
                        <div class="thumbnail">
                            <div class="clearfix heading">
                                <img class="img-circle pull-left" src="{{ asset('img/avatars/'.$ride->user->avatar) }}" style="width: 85px; height: 85px; " alt="Avatar">
                                <strong class="date">{{ convertDate('d/m/Y', $ride->ride->start_at) }}</strong>
                            </div>

                            <div class="caption">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="h6">Origin</h4>
                                        <strong class="text-uppercase">{{ $ride->ride->origin }}</strong>
                                    </div>

                                    <div class="pull-right text-right">
                                        <h4 class="h6">Destination</h4>
                                        <strong class="text-uppercase">{{ $ride->ride->destination }}</strong>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="pull-right text-right">
                                        <h4 class="h6">U$ PRICE</h4>
                                        <strong class="text-uppercase">{{ (int)$ride->ride->price === 0 ? 'FREE' : number_format($ride->ride->price, 2, ',', '.')}}</strong>
                                    </div>
                                    <div class="pull-left">
                                        <h4 class="h6">Seats available</h4>
                                        <strong class="text-uppercase">{{ $ride->ride->seats - $ride->ride->users->count() }}</strong>
                                    </div>
                                </div>

                                <a href="#" class="btn btn-danger btn-block btn-join text-uppercase">Delete</a>
                            </div>

                            <div class="thumbnail-footer">
                                <small class="text-center help-block">Associated in {{ convertDate('d/m/Y H:i', $ride->ride->user_ride->created_at) }}</small>
                                <small class="text-center help-block">Owner: {{ $ride->user->name }}</small>
                                <small class="text-center help-block">E-mail: {{ $ride->user->email }}</small>
                            </div>
                        </div>
                    </div>
                    <!-- END RIDE -->
                    @empty
                        <h3>Вы ещё не присоединялись!</h3>
                    @endforelse

                    <div class="col-md-12 text-center">
                        <ul class="pagination">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.associate_users').hide();

            $('.spoiler_btn').on('click', function () {
                $(this).parent().parent().next().slideToggle(1).toggleClass('unfolded');

                if ($(this).parent().parent().next().hasClass('unfolded')) {
                    $(this).find('.btn_text').text('Close info');
                    $(this).find('.glyphicon').removeClass('glyphicon-plus').addClass('glyphicon-remove');
                }
                else {
                    $(this).find('.glyphicon').addClass('glyphicon-plus').removeClass('glyphicon-remove');
                    $(this).find('.btn_text').text('More info');
                }
            });
        });
    </script>
@endpush