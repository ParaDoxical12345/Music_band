<div style="display: grid; place-content: center; margin-top: -25px">
    <div class="card text-dark" style="width: 500px">
        <div class="card-header">
            <h2>Register</h2>
        </div>
        <form wire:submit.prevent='register'>
            <div class="card-body">

              <br>


                <div class="mb-1">


                    <label for="name" ><b>Name</b></label>
                    <div class="d-flex">

                        <label for="name" style="width: 20px"> </label>
                        <input type="text" name="" id="name" class="form-control " wire:model='name'>

                    </div>

                    @error('name')
                    <span class="text-danger text-lg">{{$message}}</span>
                    @enderror

                </div>


                <div class="mb-1">

                    <label for="email" ><b>Email</b></label>
                    <div class="d-flex">

                        <label for="email" style="width: 20px"> </label>
                        <input type="email" name="" id="email" class="form-control " wire:model='email'>

                    </div>

                    @error('email')
                    <span class="text-danger text-lg">{{$message}}</span>
                    @enderror

                </div>

                <div class="mb-1">

                    <label for="password" ><b>Password</b></label>
                    <div class="d-flex">

                        <label for="password"  style="width: 20px"> </label>
                        <input type="password" name="" id="password" class="form-control " wire:model='password'>

                    </div>

                    @error('password')
                    <span class="text-danger text-lg">{{$message}}</span>
                    @enderror

                </div>


                <div class="mb-1">
                    <label for="confirmPassword" ><b>Confirm Password</b></label>
                    <div class="d-flex">
                        <label for="confirmPassword"  style="width: 20px"> </label>
                        <input type="password" name="password_confirmation" id="confirmPassword" class="form-control " wire:model='password_confirmation'>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger text-lg">{{$message}}</span>
                    @enderror
                </div>





                <div class="mb-3 mt-3 d-flex w-100">
                    <a href="/login" class=""> <button type="button">Make an account?</button> </a>
                    <button class="btn btn-primary" style="margin-left: 203px" type="submit">  Register</button>
                </div>

            </div>
        </form>
    </div>
</div>

