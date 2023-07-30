
<div style="margin-top: 100px;">
    <div class="card-left card rounded-lg p-2 m-5">
       @if (session()->has('message'))
           <div class="alert alert-success">
               {{ session('message') }}
           </div>
       @endif
       @if (session()->has('delete-info'))
       <div class="alert alert-danger">
           {{ session('delete-info') }}
       </div>
       @endif
       @if (session()->has('edit-info'))
       <div class="alert alert-warning">
           {{ session('edit-info') }}
       </div>
       @endif
          <div class="card-body">
                       <input type="text" name="" id="" placeholder="Search Name" class="form-control m-2 mb-4" wire:model='bandSearch'>

                       <div class="checkbox d-block m-2">

                       <label for="genre">Genre:</label> <br>
                           <input type="checkbox" name="" id="" wire:model='genRock' value="Rock"> &nbsp; Rock <br>
                           <input type="checkbox" name="" id="" wire:model='genPop' value="Pop"> &nbsp; Pop <br>
                           <input type="checkbox" name="" id="" wire:model='genReggae' value="Reggae"> &nbsp; Reggae <br>
                           <input type="checkbox" name="" id="" wire:model='genAcoustic' value="Acoustic"> &nbsp; Acoustic <br>
                           <input type="checkbox" name="" id="" wire:model='genClassical' value="Classical" class="mb-4"> &nbsp; Classical <br>
                       </div>


                       <div>
                           <select wire:model="bandLocation" class="form-select">
                               <option value="all">All Locations</option>
                               @foreach($locations as $location)
                                   <option value="{{ $location }}">{{ $location }}</option>
                               @endforeach
                           </select>
                       </div>




                      <div class="rate d-inline-block mt-2" style="transform: translateX(6px);">
                           <label for="">Rate:</label><br>
                           <input style="width: 350px;" type="range" id="sortRangeInput" name="sortRangeInput" min="0" max="100"
                           oninput="showSortValue(this.value)" wire:model='sortRate'> <br>

                           ₱ <output class="mb-4" id="sortRangeInput" for="sortRangeInput">{{ number_format(floatval($sortRate), 2) }}</output>

                      </div>
                      <br>
                           <select name="" id="" class="form-select" style="transform: translateX(6px);" wire:model='sortBy'>
                               <option value=''>Sort By</option>
                               <option value="Lowest to Highest Fee">Lowest to Highest Fee</option>
                               <option value="Highest to Lowest Fee">Highest to Lowest Fee</option>
                           </select>


                           <button class="btn btn-primary float-end mt-5" wire:click='resetFilter'><i class="fa-solid fa-rotate-right"></i> Reset Filter</button>

                   </div>
               </div>

               <div style="margin-top: -670px;">
                   <button class="btn btn-primary mt-5 float-end" style="margin-right: 75px; margin-bottom: -100px;"
                   data-bs-toggle="modal" data-bs-target="#addNew"> <i class="fa fa-plus"></i> Create New</button>


                   <div class="right" style="margin-left: 600px; margin-top: -725px;">
                       @if ($musicbands->count()>0)
                       @foreach ($musicbands as $musicbar)
                       <div class="mb-3 card-left card float-start me-lg-5" style="width: 600px; margin-top: 100px;">
                           <div class="card-body d-flex">


                               <img class="viewImg rounded" data-bs-toggle="modal" data-bs-target="#view"
                               wire:click='viewBar({{$musicbar->id}})' width="250"  src="" alt=""
                               style="background-image: url({{asset('uploads/image_uploads')}}/{{$musicbar->image}}); background-size:cover;">



                               <div class="fields ms-3">
                                   Name: {{$musicbar->name}}<br> <br>
                                   Location: {{$musicbar->location}}<br> <br>
                                   Rate: {{ number_format($musicbar->rate, 2) }}<br> <br>
                                   Genre: {{$musicbar->genre}}<br> <br>
                               </div>
                           </div>
                           <div class="action d-flex mb-3" style="margin-left: 475px; margin-top: -75px;">
                               <button class="btn btn-success m-2" data-bs-toggle="modal" data-bs-target="#edit" wire:click='editBar({{$musicbar->id}})'> <i class="fa fa-edit"></i></button>
                               <button class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#delete" wire:click='deleteConfirm({{$musicbar->id}})'> <i class="fa fa-trash"></i></button>

                           </div>
                       </div>
                       @endforeach
                       @endif
                   </div>




               </div>

   <footer>
       <div class="float-start" style="margin-top: 50px; margin-left: 1125px;">

           {{$musicbands->links()}}
       </div>
   </footer>

     <div wire:ignore.self style="margin-top: 100px;" class="modal text-black fade" id="addNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Bar</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">


               <form wire:submit.prevent='addBar'>
                   <div class="elements mb-3">
                       <input type="file" name="" id="" class="form-control" wire:model='image'>
                       @if ($image && $image instanceof \Illuminate\Http\UploadedFile)
                           <img src="{{$image->temporaryUrl()}}" width="200" alt="" class="mt-3 rounded">
                       @endif
                       @error('image')
                       <span class="text-danger text-lg">{{$message}}</span>
                       @enderror
                   </div>
                   <div class="elements">
                       <label for="name">Name:</label><br>
                       <input type="text" name="" id="name" class="form-control" wire:model='name'>
                       @error('name')
                       <span class="text-danger text-lg">{{$message}}</span>
                       @enderror
                   </div>
                   <div class="elements">
                       <label for="loc">Location:</label><br>
                       <input type="text" name="" id="loc" class="form-control" wire:model='location'>
                       @error('location')
                       <span class="text-danger text-lg">{{$message}}</span>
                       @enderror
                   </div>
                   <div class="rate d-inline-block mt-2" style="transform: translateX(6px);">
                       <label for="">Rate:</label><br>
                       <input style="width: 450px;" type="range" id="newRangeInput" name="newRangeInput" min="0" max="100"
                       oninput="showValue(this.value)" wire:model='rate'> <br>

                       ₱ <output id="newAmount" name="amount" for="newRangeInput">{{ number_format(floatval($rate), 2) }}</output>
                       @error('rate')
                       <span class="text-danger text-lg">{{$message}}</span>
                       @enderror
                  </div>

                   <div class="elements">
                       <label for="gen">Genre:</label><br>


                       <select name="" id="" wire:model='genre' class="form-select">
                           <option value="">Select Genre</option>
                           <option value="Rock">Rock</option>
                           <option value="Pop">Pop</option>
                           <option value="Reggae">Reggae</option>
                           <option value="Acoustic">Acoustic</option>
                           <option value="Classical">Classical</option>
                       </select>

                       @error('genre')
                           <span class="text-danger text-lg">{{ $message }}</span>
                       @enderror


                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="fa fa-close"></i> Close</button>
                       <button type="submit" class="btn btn-primary"> <i class="fa fa-add"></i> Create</button>
                     </div>
               </form>
           </div>

         </div>
       </div>
     </div>

     <div style="margin-top: 90px" wire:ignore.self class="modal fade text-black" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Bar</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <form wire:submit.prevent='updateBarData'>
                   <div class="elements mb-3">


                       @foreach ($musicbands as $musicbar)
                           @if ($musicbar->id === $selectedMusicBarId)
                               <img src="{{ asset('uploads/image_uploads/' . $musicbar->image) }}" width="250" class="rounded" alt="">
                           @endif
                       @endforeach

                       @if ($image && $image instanceof \Illuminate\Http\UploadedFile)

                           <img src="{{$image->temporaryUrl()}}" width="200" alt="" class="mt-3 rounded">
                       @endif

                       @error('image')
                       <span class="text-danger text-lg">{{$message}}</span>
                       @enderror
                   </div>
                   <div class="elements">
                       <label for="name">Name:</label><br>
                       <input type="text" name="" id="name" class="form-control" wire:model='name'>
                       @error('name')
                       <span class="text-danger text-lg">{{$message}}</span>
                       @enderror
                   </div>
                   <div class="elements">
                       <label for="loc">Location:</label><br>
                       <input type="text" name="" id="loc" class="form-control" wire:model='location'>
                       @error('location')
                       <span class="text-danger text-lg">{{$message}}</span>
                       @enderror
                   </div>
                   <div class="rate d-inline-block mt-2" style="transform: translateX(6px);">
                       <label for="">Rate</label><br>
                       <input style="width: 450px;" type="range" id="editRangeInput" name="editRangeInput" min="0" max="100"
                       oninput="editShowValue(this.value)" wire:model='rate'> <br>

                       ₱ <output id="newEditAmount" name="newEditAmount" for="editRangeInput">{{ number_format(floatval($rate), 2) }}</output>
                       @error('rate')
                       <span class="text-danger text-lg">{{$message}}</span>
                       @enderror
                  </div>

                   <div class="elements">
                       <label for="gen">Genre:</label><br>
                       <select name="" id="" wire:model='genre' class="form-select">
                           <option value="">Select Genre</option>
                           <option value="Rock">Rock</option>
                           <option value="Pop">Pop</option>
                           <option value="Reggae">Reggae</option>
                           <option value="Acoustic">Acoustic</option>
                           <option value="Classical">Classical</option>


                       </select>
                       @error('genre')
                       <span class="text-danger text-lg">{{$message}}</span>
                       @enderror
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-warning" data-bs-dismiss="modal"> <i class="fa fa-cancel"></i> Cancel</button>
                       <button type="submit" class="btn btn-primary"> <i class="fa fa-floppy-disk"></i> Update</button>
                     </div>
               </form>
           </div>

         </div>
       </div>
     </div>

     <div wire:ignore.self class="modal fade text-black mt-lg-5" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog" style="margin-top: 250px">
         <div class="modal-content">
           <div class="modal-header">
             <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Bar</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <h1 class="text-black">Are you sure you want to delete this Band?</h1>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="fa fa-close"></i> No</button>
             <button type="button" class="btn btn-danger" wire:click='deleteBardata' data-bs-dismiss="modal"> <i class="fa fa-trash"></i> Yes</button>
           </div>
         </div>
       </div>
     </div>


     <div wire:ignore.self class="modal mt-5 fade text-white" id="view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

       <div class="modal-dialog" style="max-width: 1000px;">
         <div class="modal-content"  style="background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);">
           <div class="modal-body p-5">

             <div class="imageView text-center">

               @foreach ($musicbands as $musicbar)
                 @if ($musicbar->id === $selectedMusicBarId)
                   <div style="display: flex; align-items: center; justify-content: center;">
                     <div class="rounded-circle" style="background-image: url('{{ asset('uploads/image_uploads/' . $musicbar->image) }}'); background-size: cover; background-repeat: no-repeat; width: 250px; height: 250px; background-position: center center;"></div>
                   </div>

                   <h3 class="text-white mt-3">{{$musicbar->name}}</h3>

                   <div class="d-flex justify-content-between text-white rounded shadow mb-3" style="background-color: rgba(19, 19, 19, 0.887)">
                     @if ($musicbar->id === $selectedMusicBarId)
                       <h6 class="text-white mt-3 p-3">₱ Talent Fee: {{$musicbar->rate}}</h6>
                       <h6 class="text-white mt-3 p-3">Total Transactions: {{$musicbar->bookings->count()}}</h6>
                     @endif
                   </div>
                 @endif
               @endforeach

               <h4>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo adipisci amet perferendis eos? Molestias adipisci maxime saepe enim officia sapiente molestiae dolore, necessitatibus aperiam excepturi veritatis doloribus, fugiat voluptate inventore.</h4>

               @if ($musicbands->count() > 0)
               @foreach ($musicbands as $musicband)
                   @if ($musicband->id === $selectedMusicBarId)
                       <div>
                           <a class="btn btn-outline-light border-1 border-secondary p-3 mt-2" href="{{ route('music-band.booking', ['id' => $musicband->id, 'musicband' => $musicband->name]) }}"> <i class="fa-solid fa-book"></i> Book now</a>
                       </div>
                       <hr>
                       @if ($musicband->bookings->count() > 0)
                           <h4 class="float-start">Gig History</h4><br><br>
                           @foreach($musicband->bookings as $booking)
                               @if($booking->status !== 'Canceled')
                               <div class="card mb-5" style="background-color: rgba(19, 19, 19, 0.887)">
                                   <div class="card-body">
                                       <div class="d-flex justify-content-between">
                                           <div>
                                               @if($booking->user->image)
                                                   <img class="mb-3" src="{{ asset('uploads/image_uploads/' . ($booking->user->image ? $booking->user->image : 'default_images/blank-profile.jpg')) }}" alt="User Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                               @endif
                                           </div>
                                           <h4 class="mt-2 ms-4"><b>{{ $booking->eventname }}</b></h4>
                                           <h6 class="mt-2">{{ $booking->eventdate }}</h6>
                                       </div>
                                       <div class="mt-2">
                                           @forelse($booking->user->feedbacks->where('booking_id', $booking->id) as $feedback)
                                               <h6 style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2">
                                                   <b>Feed back: {{ $feedback->feedback }}</b>
                                               </h6>
                                           @empty
                                               <p>No feedbacks found.</p>
                                           @endforelse

                                           @forelse($booking->user->feedbacks->where('booking_id', $booking->id) as $rating)
                                               @php
                                                   $total_stars = '';
                                                   for ($i = 1; $i <= $rating->rating; $i++) {
                                                       $total_stars .= '<i class="fa-solid fa-star text-warning"></i>';
                                                   }
                                                   for ($i = $rating->rating + 1; $i <= 5; $i++) {
                                                       $total_stars .= '<i class="far fa-star"></i>';
                                                   }
                                               @endphp
                                               <h6 style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2">
                                                   <b>Rating: {!! $total_stars !!}</b>
                                               </h6>
                                           @empty
                                               <p>No ratings found.</p>
                                           @endforelse


                                           <h6 style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2"><b>Rated By: {{ $booking->user->username }}</b></h6>
                                       </div>
                                   </div>
                               </div>

                               @endif
                           @endforeach
                       @endif
                   @endif
               @endforeach
           @else
               <p>No musicbands found.</p>
           @endif





             </div>

             <br> <br> <br>

             <div class="buttonView float-end">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
             </div>

           </div>
         </div>
       </div>

     </div>

     <style>
       .imageViewCss{
           cursor: pointer;
           width: 300px;
           transition: 0.5s;
       }
       .imageViewCss:hover{
           width: 350px;
           transition: 0.5s;
       }
       .viewImg{
           cursor: pointer;
           background-color: rgba(29, 29, 29, 0.403);
           width: 250px;
           transition: 0.5s;
           box-shadow: 3px 3px 0px 0px rgb(31, 31, 31)
       }
       .viewImg:hover{
           transform: translateY(-25px);
           background-color: rgba(57, 57, 57, 0.403);
           width: 250px;
           box-shadow: 25px 25px 0px 0px rgba(31, 31, 31, 0.718)
       }

       .card_data{
           width: 1000px;
       }
       .card-left{
           background-color: rgba(29, 29, 29, 0.403);
           width: 400px;
           transition: 0.5s;
           box-shadow: 3px 3px 0px 0px rgb(31, 31, 31)

       }
       .card-left:hover{
           transform: translateY(-10px);
           background-color: rgba(57, 57, 57, 0.403);
           width: 400px;
           box-shadow: 10px 10px 0px 0px rgb(31, 31, 31);


       }

       </style>

       <script>


   function showSortValue(val) {
       var sortdecimalPlaces = 2;

       var sortformattedVal = parseFloat(val).toFixed(sortdecimalPlaces);

       document.getElementById("newSortAmount").innerHTML = sortformattedVal;

       }


       function showValue(val) {
       var decimalPlaces = 2;

       var formattedVal = parseFloat(val).toFixed(decimalPlaces);

       document.getElementById("newAmount").innerHTML = formattedVal;

       }

       function editShowValue(val){
           var editDecimalPlaces = 2;

           var editFormattedVal = parseFloat(val).toFixed(editDecimalPlaces);

           document.getElementById("newEditAmount").innerHTML = editFormattedVal;
       }

       window.addEventListener('barSaved', function() {
       // close the modal
       var addNewModal = document.getElementById('edit');
       if (addNewModal) {
           var modal = bootstrap.Modal.getInstance(addNewModal);
           modal.hide();
           location.reload();
       }
   });

   window.addEventListener('barDeleted', function() {
       // close the modal
       var deleteModal = document.getElementById('delete');
       if (deleteModal) {
           var modal = bootstrap.Modal.getInstance(deleteModal);
           modal.hide();
           location.reload();
       }
   });

   window.addEventListener('barCreated', function() {
       // close the modal
       var deleteModal = document.getElementById('addNew');
       if (deleteModal) {
           var modal = bootstrap.Modal.getInstance(deleteModal);
           modal.hide();
           location.reload();
       }
   });
       </script>
   </div>
