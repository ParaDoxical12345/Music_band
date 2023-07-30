
<div class="p-5" style="margin-top: -75px;">
    <div>
        <h1>Dash Board</h1>
        <div class="d-flex text-center text-white">
            <div class="card w-100 me-2" style="background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);">
                <div class="card-body">
                    <h1>{{ $total_bookings->count() }}</h1>
                    <h6>Total Booking</h6>
                </div>
            </div>
            <div class="card w-100 me-2" style="background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);">
                <div class="card-body">
                    <h1>0</h1>
                    <h6>Applications Received</h6>
                </div>
            </div>
            <div class="card w-100 me-2" style="background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);">
                <div class="card-body">
                    <h1>{{ $active_bookings->count() }}</h1>
                    <h6>Active Bookings</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex text-center text-white flex-wrap mt-5 shadow-lg">
        @foreach ($bookings as $booking)
            <div class="card m-2" style="width: 435px;background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);"  data-bs-toggle="modal" data-bs-target="#view" wire:click='viewBar({{$booking->id}})'>
                <div class="card-body viewImg">
                    <h1>{{ $booking->eventname }}</h1>
                    <hr>

                    @if(!is_null($booking->musicband))
                        <h6>Performer: {{ $booking->musicband->name }}</h6>
                    @endif

                    <h6>Event Date: {{ $booking->eventdate }}</h6>
                    <h6>Time Start: {{ $booking->timestart }}</h6>
                    <h6>Time End: {{ $booking->timeend }}</h6>
                    <h6>Location: {{ $booking->eventlocation }}</h6>

                    @if($booking->status == 'Pending')
                        <h6>Status: <span class="badge bg-primary">Pending</span> <br></h6>
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmCompleteModal">Finish</button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmCancelModal">Cancel</button>
                    @elseif($booking->status == 'Completed')
                        <h6>Status: <span class="badge bg-success">Completed</span></h6>
                    @elseif($booking->status == 'Canceled')
                        <h6>Status: <span class="badge bg-danger">Canceled</span></h6>
                    @endif

                </div>
            </div>
        @endforeach
    </div>


    <div wire:ignore.self class="modal mt-5 fade text-white" id="view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1000px;">
            <div class="modal-content"  style="background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);">
                <div class="modal-body p-5">

                    @if(!is_null($book))
                    <h1>Booking Details</h1>
                    <div class="card w-full" style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2">

                        <div class="card-body text-center">
                            <h4><b>Event Performer</b></h4>

                            @if(!is_null($book->musicband))
                                <h5>Performer: {{ $book->musicband->name }}</h5>
                                <h5>{{ $book->musicband->genre }}</h5>

                            @endif
                            <hr>
                            <h4><b>Event Details</b></h4>
                            <div class="">
                                <h5>Event Name:{{ $book->eventname }}</h5>
                                <h5>Time End: {{ $book->eventdate }}</h5>
                                <h5>Time Start: {{ $book->timestart }}</h5>
                                <h5>Time End: {{ $book->timeend }}</h5>
                                <h5>Location: {{ $book->eventlocation }}</h5>
                            </div>
                            <hr>
                            <h4><b>Description</b></h4>
                            <h5>{{ $book->description }}</h5>

                        </div>
                    </div>
                    @endif
                    <button type="button" class="btn btn-secondary float-end mt-4" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

<div style="margin-top: 275px;" wire:ignore.self class="modal fade" id="confirmCompleteModal" tabindex="-1" aria-labelledby="confirmCompleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"  style="background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmCompleteModalLabel">Confirm Completion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to mark this booking as completed?
          <h4>Rate Booking</h4>
          <div class="rating-input float-start" style="direction: rtl;">
            <div class="rating-stars">
              <input type="radio" wire:model="rating" value="5" id="rating-5" class="visually-hidden">
              <label for="rating-5"><i class="fa-solid fa-star"></i></label>

              <input type="radio" wire:model="rating" value="4" id="rating-4" class="visually-hidden">
              <label for="rating-4"><i class="fa-solid fa-star"></i></label>

              <input type="radio" wire:model="rating" value="3" id="rating-3" class="visually-hidden">
              <label for="rating-3"><i class="fa-solid fa-star"></i></label>

              <input type="radio" wire:model="rating" value="2" id="rating-2" class="visually-hidden">
              <label for="rating-2"><i class="fa-solid fa-star"></i></label>

              <input type="radio" wire:model="rating" value="1" id="rating-1" class="visually-hidden">
              <label for="rating-1"><i class="fa-solid fa-star"></i></label>
            </div>
          </div>
          <br>

          <h4>Give Feedback</h4>
          <textarea name="" id="" cols="30" rows="10" style="background-color: rgb(52, 52, 52);  height: 75px;" class="form-control border-0 text-white p-2 mb-2" wire:model='feedback'></textarea>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success" wire:click="completeBooking({{ $booking->id }})" data-bs-dismiss="modal">Mark as Completed</button>
        </div>
      </div>
    </div>
  </div>


  <div style="margin-top: 325px;" wire:ignore.self class="modal fade" id="confirmCancelModal" tabindex="-1" aria-labelledby="confirmCancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"  style="background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmCancelModalLabel">Confirm Cancellation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to cancel this booking?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" wire:click="cancelBooking({{ $booking->id }})" data-bs-dismiss="modal">Cancel Booking</button>
        </div>
      </div>
    </div>
  </div>



</div>
<style>
    .rating-stars {
  font-size: 16px; /* start with a smaller size */
}

     .rating-stars label {
            color: gray;
            cursor: pointer;
            transition: 0.2s;
        }
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: yellow;
        }
        .rating-stars input[type="radio"]:checked + label,
        .rating-stars input[type="radio"]:checked ~ label {
        color: gold;
        }
    .viewImg{
        cursor: pointer;
        background-color: rgba(29, 29, 29, 0.403);

        transition: 0.5s;
        box-shadow: 3px 3px 0px 0px rgb(31, 31, 31)
    }
    .viewImg:hover{
        transform: translateY(-15px);
        background-color: rgba(57, 57, 57, 0.403);

        box-shadow: 15px 15px 0px 0px rgba(31, 31, 31, 0.718)
    }
</style>
