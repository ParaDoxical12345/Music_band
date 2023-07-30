
<div class="container">
    <div class="container">
        <div class="card mt-3 p-4" style="background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);">

                    <div class="d-flex justify-content-between w-100">
                        <div class="d-block p-5 rounded" >
                            <h1 class="text-white mb-5"><b>Booking Request</b></h1>
                            @if ($selectedMusicBand)
                            <div class="" style="margin-left: 36px;">
                            <div class="rounded-circle" style="background-image: url('{{ asset('uploads/image_uploads/' . $selectedMusicBand->image) }}'); background-size: cover; background-repeat: no-repeat; width: 250px; height: 250px; background-position: center;">

                            </div>

                            </div>
                            <div class="mt-3 text-center">
                                <h1>{{ $selectedMusicBand->name }}</h1>
                                <br>
                                <h5>Talent Fee: ₱{{ $selectedMusicBand->rate }}</h5>


                            </div>

                        @endif
                        </div>

                        <div class="card-left d-block rounded p-5" style="width: 700px; background-color: rgb(18, 18, 18)">
                            <h4>Booking Details</h4>
                            <hr>
                            <form wire:submit.prevent="sendRequest">
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }} <div class="float-end" style="margin-top: -5px;"><a href="/dashboard" class="btn btn-success">View bookings</a></div>
                                    </div>
                                @endif
                                <div class="flex-wrap">
                                    <div class="row">
                                        <div class="col-md-6">
                                          <input type="hidden" wire:model="selectedMusicBand.id" name="musicband_id">
                                          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                          <label for="">Event Name</label> <br>
                                          <input style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2" style="width: 300px;" type="text" name="eventname" id="" wire:model="eventname">
                                          @error('eventname')
                                            <span class="text-danger text-lg">{{$message}}</span>
                                          @enderror






                                          <label for="">Location</label>
                                          <input style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2" style="width: 300px;" type="text" name="eventlocation" id="" wire:model="eventlocation">
                                          @error('eventlocation')
                                            <span class="text-danger text-lg">{{$message}}</span>
                                          @enderror

                                          <label for="" class="">Date</label>
                                          <input style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2" style="width: 300px;" type="date" name="date" id="date" wire:model="date">
                                          @error('date')
                                            <span class="text-danger text-lg">{{$message}}</span>
                                          @enderror
                                        </div>

                                        <div class="col-md-6">
                                          <label for="" class="">Time Start</label>
                                          <input style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2" style="width: 300px;" type="time" name="timestart" id="timestart" wire:model="timestart">
                                          @error('timestart')
                                            <span class="text-danger text-lg">{{$message}}</span>
                                          @enderror

                                          <label for="" class="">Time End</label>
                                          <input style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2" style="width: 300px;" type="time" name="timeend" id="timeend" wire:model="timeend">
                                          @error('timeend')
                                            <span class="text-danger text-lg">{{$message}}</span>
                                          @enderror
                                        </div>
                                      </div>
                                </div>

                                <label for="" class="mt-4">Details</label>
                                <textarea name="" id="" cols="30" rows="10" style="background-color: rgb(52, 52, 52); width: 600px; height: 75px;" class="form-control border-0 text-white p-2 mb-2" wire:model='description'></textarea>
                                @error('description')
                                <span class="text-danger text-lg">{{$message}}</span>
                                @enderror
                                <button type="submit" class="btn btn-outline-light border-1 border-secondary float-end mt-4 p-3"> <i class="fa-solid fa-share"></i> Send Request</button>
                            </form>

                        </div>

                    </div>
        </div>
    </div>

</div>

<style>
     .card-left{
        background-color: rgba(29, 29, 29, 0.403);

        transition: 0.5s;
        box-shadow: 3px 3px 0px 0px rgb(31, 31, 31)

    }
    .card-left:hover{
        transform: translateY(-10px);
        background-color: rgba(57, 57, 57, 0.403);

        box-shadow: 10px 10px 0px 0px rgb(31, 31, 31);


    }
</style>

<script>
    // Get the time input element
    var timeInputStart = document.getElementById('timestart');
    var timeInputEnd = document.getElementById('timeend');


    // Set the input format to display only time
    timeInputStart.type = 'text';
    timeInputEnd.type = 'text';

    timeInputStart.addEventListener('click', function() {
        this.type = 'time';
        this.focus();
    });

    timeInputEnd.addEventListener('click', function() {
        this.type = 'time';
        this.focus();
    });
</script>








