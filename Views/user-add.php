<?php
include('header.php');

?>
<section class="imgHuesitos">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <img class="logo"
                                         style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1">Not only kids need heros!</h4>
                                </div>
                                <?php if(isset($message)){echo $message;}?>
                                <form action="<?php echo  FRONT_ROOT . "User\Add "?>" method="post">
                                    <p>Please register and start looking for your pet keeper</p>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Your name" required/>
                                        <label class="form-label" >Name</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="lastname" class="form-control"
                                               placeholder="Your last name" required/>
                                        <label class="form-label" >Last name</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="userName" class="form-control"
                                               placeholder="User name" required/>
                                        <label class="form-label" >Username</label>
                                    </div>
                                
                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" class="form-control" required/>
                                        <label class="form-label" for="form2Example22">Password</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" name="eMail" class="form-control"
                                               placeholder="john@doe" required/>
                                        <label class="form-label" >E-mail</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="phoneNumer" class="form-control"
                                               placeholder="223-4111111" required/>
                                        <label class="form-label" for="form2Example22">Phone number</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="date" name="birthDate" class="form-control"
                                               size="10" min="1900-01-01" max="2022-12-31T00:00" required/>
                                        <label class="form-label" for="form2Example22">Birth date</label>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Register!</button>

                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2"></p>
                                        <button type="button" class="btn btn-outline-danger"
                                                onclick="location.href='<?php echo FRONT_ROOT . "Home/Index" ?>'">Back to Login</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">We are more than just website</h4>
                                <p class="small mb-0">connecting people to brighten the days of our little friends is our mission!
                                    Our pets deserve quality time and there are always people willing to dedicate them.<br>
                                    You can trust us to meet some!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
