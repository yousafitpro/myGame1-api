@extends('layouts.dashboard')
@section('content')
    <div class="card">
<div class="card-header">
    <h3>Wallet Amounts     Total= {{$total}}</h3>
</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.game.add')}}">  <button class="btn btn-primary float-right"> Add New</button></a>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table  table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Recieved At</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($payments as $p)
                        <tr class="center">
                            <td>{{$p->amount}}</td>
                            <td>{{$p->created_at}}</td>

                        </tr>




                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Amount</th>
                        <th>Recieved At</th>
                    </tr>
                    </tfoot>
                </table>

            </div>

            <script>
                $(document).ready(function(){
                    $('.dataTables-example').DataTable({
                        pageLength: 25,
                        responsive: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [
                            { extend: 'copy'},
                            {extend: 'csv'},
                            {extend: 'excel', title: 'ExampleFile'},
                            {extend: 'pdf', title: 'ExampleFile'},

                            {extend: 'print',
                                customize: function (win){
                                    $(win.document.body).addClass('white-bg');
                                    $(win.document.body).css('font-size', '10px');

                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                }
                            }
                        ]

                    });

                });

            </script>

        </div>
    </div>

@endsection
