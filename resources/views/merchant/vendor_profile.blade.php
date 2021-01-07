@extends('merchant.layouts.app')
@section('title', 'Profile')

@section('content')

     <!--Main content -->
    <section class="content vendor-profile">

        <div class="row">
            <h3>User Profile</h3>
            <div class="col-md-3">

                 <!--Profile Image -->
                <div class="content__box content__box--shadow">
                        <img class="img-responsive img-circle"
                             src="{{ null !== $user->getImage() ? optional($user->getImage())->smallUrl : url('/uploads/avatar.jpg') }}"
                             alt="User profile picture">

                        <h3 class="profile-username text-center">{{ $user->user_name }}</h3>

                        <p class="text-muted text-center">
                            {{ optional($user->roles->first())->display_name }}
                        </p>
                </div>
                 <!--/.box -->

            </div>
             <!--/.col -->
            <div class="col-md-9">
                <div class="content__box content__box--shadow">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab">Info</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>User Name: </strong>{{ $user->user_name }}</li>
                                <li class="list-group-item"><strong>Email: </strong>{{ $user->email }}</li>
                                <li class="list-group-item"><strong>Phone: </strong>{{ $user->phone }}</li>
                            </ul>
                        </div>
                         <!--/.tab-pane -->
                    </div>
                     <!--/.tab-content -->
                </div>
                 <!--/.nav-tabs-custom -->
            </div>
             <!--/.col -->
        </div>
         <!--/.row -->

    </section>
     <!--/.content -->



@endsection