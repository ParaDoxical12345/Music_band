<div class="container">


    <div class="card mt-3 text-white" style="background-color: rgba(25, 25, 25, 0.645); -webkit-backdrop-filter: blur(15px); backdrop-filter: blur(15px);">
        <div class="d-flex justify-content-between mb-5 " >
            <a href="/profile" class="btn w-50 text-white"><h5> <i class="fa-solid fa-user"></i> Profile</h5></a>
            <a href="/account" class="btn w-50 active-link text-white"><i class="fa-solid fa-lock"></i> Account</h5></a>
            <button class="btn w-50 delete-btn text-white" data-bs-toggle="modal" data-bs-target="#delete"><h5> <i class="fa fa-trash"></i> Delete</h5></button>
        </div>
        <div class="card-body" style="display: flex; place-content: center">


                    <div class="d-flex justify-content-center" style="width: 1500px">

                        <div class="card-left w-50 text-white float-right p-5" style="border-radius:20px; width: 700px; background-color: rgb(18, 18, 18)">


                            <form wire:submit.prevent='editUsername'>
                                <h1 class="text-white">Account</h1>
                                <hr>
                                <label for="username">User Name</label> <br>
                                <div class="d-flex">
                                    <input type="text" name="username" id="username"  style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2" value="{{ auth()->user()->username }}" wire:model="username">
                                    @if ($username !== auth()->user()->username)
                                      <button type="submit" class="btn btn-success" style="width: 150px; height: 40px;">Click Save!</button>
                                    @else
                                      <button type="submit" class="btn btn-success" style="width: 150px; height: 40px;" disabled>Click Save!</button>
                                    @endif
                                  </div>

                            </form>

                            <br> <br>

                            <form wire:submit.prevent='editAccount'>
                            <h6 style="font-size: 15px;">If you don't want to change your password, just leave it blank.</h6>
                            <label for="oldpassword">Current Password</label>
                            <input type="password" name="current_password" id="current_password" style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2 @error('current_password') is-invalid @enderror" wire:model="current_password">
                            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror <br>

                            <label for="newpassword">New Password</label>
                            <input type="password" name="newpassword" id="newpassword" style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2" wire:model.defer="password"> <br>

                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" style="background-color: rgb(52, 52, 52)" class="form-control border-0 text-white p-2 mb-2" wire:model.defer="password_confirmation"> <br>
                            <button type="submit" class="btn btn-primary mb-5"> <i class="fa-solid fa-floppy-disk"></i> Update </button>
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

