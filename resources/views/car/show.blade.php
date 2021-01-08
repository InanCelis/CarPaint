@extends('layouts.app')

@section('content')

    <h2 class="text-center mt-5">Paint Jobs</h2>

    <div class="mt-5">
        <h3 class="ml-3">Paint Jobs in Progress</h3>
        <div class="row">
            <div class="col-md-8">
                <table class="table" id="progress">
                    <thead class="bg-light-gray font-weight-bold">
                        <tr>
                            <td>Plate No.</td>
                            <td>Current Color</td>
                            <td>Target Color</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody class="table-bordered">
                        @foreach($cardetails as $key => $cardetail)
                            @if ($key < 5)
                                <tr>
                                    <td>{{ $cardetail->plate_no }}</td>
                                    <td class="text-capitalize">{{ $cardetail->current_color }}</td>
                                    <td class="text-capitalize">{{ $cardetail->target_color }}</td>
                                    <td class="text-center ">
                                        <a href="javascript:" class="text-main status" id="{{ $cardetail->id }}">
                                            <b>Mark as Completed</b>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                <h3 class="ml-3 mt-5">Paint Queue</h3>
                <table class="table" id="queue">
                    <thead class="bg-light-gray font-weight-bold">
                        <tr>
                            <td>Plate No.</td>
                            <td>Current Color</td>
                            <td>Target Color</td>
                        </tr>
                    </thead>
                    <tbody class="table-bordered">
                        @foreach($cardetails as $key => $cardetail)
                            @if ($key > 4)
                                <tr>
                                    <td>{{ $cardetail->plate_no }}</td>
                                    <td class="text-capitalize">{{ $cardetail->current_color }}</td>
                                    <td class="text-capitalize">{{ $cardetail->target_color }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <table class="table performance" id="performance">
                    <thead class="bg-main text-light">
                        <tr>
                            <th colspan="3">SHOP PERFORMANCE</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light-gray font-weight-bold">
                        <tr>
                            <td>Total Car Painted:</td>
                            <td>{{ count($allcar->where('status', 1)) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Break down:</td>
                        </tr>
                        <tr>
                            <td><b class="pl-4">Blue</b></td>
                            <td>{{ count($allcar->where('target_color', 'blue')->where('status', 1)) }}</td>
                        </tr>
                         <tr>
                            <td><b class="pl-4">Red</b></td>
                            <td>{{ count($allcar->where('target_color', 'red')->where('status', 1)) }}</td>
                        </tr>
                         <tr>
                            <td><b class="pl-4">Green</b></td>
                            <td>{{ count($allcar->where('target_color', 'green')->where('status', 1)) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection


@section('script')
    <script>

        function reloadDiv() {
            $("#progress").load(location.href + " #progress");
            $("#queue").load(location.href + " #queue");
            $("#performance").load(location.href + " #performance");
        }

        $(document).on('click', '.status', function(){
            var id = this.id;
            if (confirm("Are you sure you want to complete it?")) {
                $.ajax({
                    url:"{{ route('update') }}",
                    type: 'post',
                    data: {'id': id},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data) {
                        alert(data.success);
                        reloadDiv();
                    },
                });
            }

        });
    </script>
@endsection
