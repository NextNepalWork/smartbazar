@extends('admin.layouts.app')
@section('title', 'Referral')

@section('content')
    <section>
        <div class="row">
            <h3>All Referrals</h3>
            <div class="col-sm-12 content__box content__box--shadow">
                <table class="table table-striped table-hover" id="referalTable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

