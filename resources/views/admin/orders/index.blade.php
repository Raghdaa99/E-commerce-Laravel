@extends('admin.layout.master')


@section('content')
    @include('admin.layout.messages')
    <style>
        /* The heart of the matter */

        .horizontal-scrollable > .row {
            overflow-x: auto;
            white-space: nowrap;
        }

        .horizontal-scrollable > .row > .col-xs-4 {
            display: inline-block;
            float: none;
        }
        /* Decorations */
    </style>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="card-header">
                    <h3 class="card-title">Projects</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Order Number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Company Name</th>
                            <th>Total Price</th>
                            <th>Zip Code</th>
                            <th>email</th>
                            <th>country</th>
                            <th>phone</th>
                            <th>street_address</th>
                            <th>Payment Method</th>
                            <th>payment Status</th>
                            <th>status</th>
                            <th>comment</th>
                            <th>User ID</th>
                            <th>Created at</th>
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->first_name }}</td>
                                <td>{{$order->last_name }}</td>
                                <td>{{ $order->company_name }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->zip_code }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->country }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->street_address }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->comment }}</td>
                                <td>{{ $order->user_id  }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <form action="{{ route('order.destroy',$order->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')
                                        {{--                    @can('product-delete')--}}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        {{--                    @endcan--}}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {!! $orders->links() !!}
        </div>
    </section>


@endsection
