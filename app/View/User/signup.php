<div class="container-fuild vh-100 pink p-5">
    <div class="container m-auto row bg-white shadow h-100 p-5">
      <div class="col position-relative">
        <img src="http://localhost:8888/asset/image1.jpg" alt="people.jpg"
            class="img-style ms-5 mt-2 position-absolute top-0 start-0 z-2">

        <div class="square border border-3 position-absolute top-50 start-50 w-50 h-75 translate-middle z-0">
          <p class="invisible">square</p>
        </div>

        <img src="http://localhost:8888/asset/image2.jpg" alt="people.jpg" class="img-style mb-2 me-5 position-absolute bottom-0 end-0">
      </div>
      <div class="col">
        <h1 class="text-center">Sign Up</h1>
        
        <?php if(isset($model['error'])) { ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    <?= $model['error'] ?>
                </div>
            </div>
        <?php } ?>

        <form method="post" action="/users/signup">

          <div class="d-flex flex-column my-4 ">
  
            <div class="mb-3 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-user fa-2xl me-4 cpink"></i>
              <input type="email" class="form-control w-75 p-3 rounded-pill" id="username" name="username" placeholder="Username">
            </div>
  
            <div class="mb-3 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-envelope fa-2xl me-4 cpink"></i>
              <input type="email" class="form-control w-75 p-3 rounded-pill" id="email" name="email" placeholder="Email">
            </div>
  
            <div class="mb-3 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-lock fa-2xl me-4 cpink"></i>
              <input type="email" class="form-control w-75 p-3 rounded-pill" id="password" name="password" placeholder="Password">
            </div>
  
          </div>
          <div class="d-flex flex-row mt-2 justify-content-center align-items-center">
          
            <button type="submit" class="btn dpink text-white inline text-center py-3 w-25 rounded-pill">SIGN UP</button>
            <a href="/users/signin" class="ms-4">Already sign up? login here</a>
          </div>
        </form>
      </div>
    </div>
</div>