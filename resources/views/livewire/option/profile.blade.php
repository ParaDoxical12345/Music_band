<div class="container">

    <div class="card mt-3 text-white" style="background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);">
        <div class="d-flex justify-content-between mb-5 shadow">
            <a href="/profile" class="btn w-50 active-link text-white"><h5> <i class="fa-solid fa-user"></i> Profile</h5></a>
            <a href="/account" class="btn w-50 text-white"><i class="fa-solid fa-lock"></i> Account</h5></a>
            <button class="btn w-50 delete-btn text-white" data-bs-toggle="modal" data-bs-target="#delete"><h5> <i class="fa fa-trash"></i> Delete</h5></button>
        </div>
        <div class="card-body" style="display: flex; place-content: center">


            <form wire:submit.prevent='editProfile'>
                <div class="card-left d-flex justify-content-between p-5" style="border-radius:20px;  width: 1000px; background-color: rgb(18, 18, 18)">
                    <div class="float-start">
                        @if(auth()->check())
                            <div class="image-upload position-relative mt-5">
                                <input type="file" class="form-control position-absolute top-0 start-0 opacity-0" wire:model="image" id="image" name="image">
                                <label for="image" class="upload-label d-flex align-items-center justify-content-center">

                                    <img width="275" height="275" src="{{ $image ? $image->temporaryUrl() : (auth()->user()->image ? asset('uploads/image_uploads/' . auth()->user()->image) : asset('default_images/blank-profile.jpg')) }}" alt="Profile Image" class="preview-image rounded-circle bg-dark"  style="object-fit: cover;">

                                </label>
                            </div>

                            <h4 class=" p-3 w-100 rounded mt-4 text-center">{{auth()->user()->name}}</h4>
                        @endif

                    </div>
                    <div class="w-50  float-right">

                        <h1 class="">Profile</h1>
                        <hr>

                        <label for="name" >Name</label> <br>
                        <input type="text" name="" id="name" style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2" value="{{ auth()->user()->name }}" wire:model="name"> <br>

                        <label for="" >Location</label>
                        <input type="text" name="" id="name" style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2" value="{{ auth()->user()->location }}" wire:model="location"> <br>

                        <label for="">Description</label>
                        <textarea name="" id="description" style="background-color: rgb(52, 52, 52); height: 150px" class="form-control border-0 text-white p-2 mb-2" placeholder="Description" wire:model='description'>
                            {{ auth()->user()->description }}"</textarea>
                        <br>
                        @if ($name !== auth()->user()->name || $location !== auth()->user()->location || $description !== auth()->user()->description ||($image && $image->getClientOriginalName() !== auth()->user()->image))
                                      <button type="submit" class="btn btn-success mb-5" style="width: 150px;">Click Save!</button>
                                    @else
                                      <button type="submit" class="btn btn-success mb-5" style="width: 150px;" disabled>Click Save!</button>
                                    @endif

                    </div>
                </div>
            </form>


                </div>
            </div>

            <div wire:ignore.self class="modal fade text-white mt-lg-5" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" style="margin-top: 250px">
                  <div class="modal-content" style="background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete User <i class="fa-solid fa-user"></i> {{auth()->user()->username}}</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-white">Are you sure you want to delete this User?</h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="fa fa-close"></i> No</button>
                      <button type="button" class="btn btn-danger" wire:click="deleteUser" data-bs-dismiss="modal"> <i class="fa fa-trash"></i> Yes</button>
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

    .active-link{
        border-bottom: 1px solid rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.448);
        border-radius: 0px;

    }
</style>


