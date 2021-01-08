@extends('layouts.app')

@section('content')

    <h2 class="text-center mt-5">New Paint Job</h2>

    <div class="mt-5">
        <div class="row justify-content-center">
            <img src="{{ asset('/images/Default Car.png') }}" alt="" id="current-car-image">
            <img src="{{ asset('/images/Shape 1.png') }}" height="50" width="60" class="p-2 ml-5 mr-5 mt-5" alt="">
            <img src="{{ asset('/images/Default Car.png') }}" alt="" id="target-car-image">
        </div>
    </div>

    <div class="mt-5">
        <h3>Car Details</h3>
        <form  method="POST"  id="create_car">
            @csrf
            <table class="create-form">
                <tr>
                    <td>Plate No.</td>
                    <td class="inputs">
                        <input type="text" class="form-control" name="plate" id="plate" required>
                    </td>
                </tr>
                <tr>
                    <td>Current Color</td>
                    <td class="inputs"> 
                        <select name="current_color" id="current_color" class="form-control" required>
                            <option value=""></option>
                            <option value="red">red</option>
                            <option value="green">green</option>
                            <option value="blue">blue</option>
                        </select>
                    </td >
                </tr>
                <tr >
                    <td>Target Color</td>
                    <td class="inputs">
                        <select name="target_color" id="target_color" class="form-control" required>
                            <option value=""></option>
                            <option value="red">red</option>
                            <option value="green">green</option>
                            <option value="blue">blue</option>
                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn bg-main text-light pl-5 pr-5 mt-2 btn-submit">Submit</button>
        </form>
    </div>

@endsection


@section('script')
    <script>


        function changeCarColor(colorValue, imgId) {

            if(colorValue == "red") {
                $(imgId).attr('src', '/images/Red Car.png');
            }
            else if(colorValue == "green") {
                $(imgId).attr('src', '/images/Green Car.png');
            }
            else if(colorValue == "blue") {
                $(imgId).attr('src', '/images/Blue Car.png');
            }
            else {
                $(imgId).attr('src', '/images/Default Car.png');
            }

        }

        $(document).on('change','#current_color', function() {
            var carColor = document.getElementById('current_color').value;
            var imgId = '#current-car-image';
            changeCarColor(carColor, imgId);
        });

        $(document).on('change','#target_color', function() {
            var carColor = document.getElementById('target_color').value;
            var imgId = '#target-car-image';
            changeCarColor(carColor, imgId);
        });

        $('#create_car').on('submit', function(event) {
            event.preventDefault();
            $('.btn-submit').prop('disabled', true);

            $.ajax({
                url:"{{ route('store') }}",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(data) {

                    if (data.success) {
                        alert(data.success);
                        $('#create_car')[0].reset();
                        $('.btn-submit').prop('disabled', false);
                        $('#current-car-image').attr('src', '/images/Default Car.png');
                        $('#target-car-image').attr('src', '/images/Default Car.png');
                    }
                    if (data.error) {
                        alert(data.error);
                        $('.btn-submit').prop('disabled', false);
                    }
                }
            });
        });
    </script>
@endsection
