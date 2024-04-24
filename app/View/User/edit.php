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
        <h1 class="text-center text-primary">Edit User : <span class="text-uppercase"><?= $model['user']->username?></span></h1>
        
        
        <?php if(isset($model['error'])) { ?>
            <div class="row">
                <div class="alert alert-danger p-2 m-0" role="alert">
                    <?= $model['error'] ?>
                </div>
            </div>
        <?php } ?>

        <form method="post" action="/users/edit/<?=$model['user']->id?>">

          <div class="d-flex flex-column my-4 ">
  
            <div class="mb-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-user fa-xl me-4 cpink"></i>
              <input type="text" class="form-control w-75 p-2 rounded-pill" id="username" name="oldUsername" placeholder="Username" value="<?= $model['user']->username?>">
            </div>
  
            <div class="mb-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-envelope fa-xl me-4 cpink"></i>
              <input type="email" class="form-control w-75 p-2 rounded-pill" id="email" name="oldEmail" placeholder="Email" value="<?= $model['user']->email?>">
            </div>
  
            <div class="mb-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-lock fa-xl me-4 cpink"></i>
              <input type="password" class="form-control w-75 p-2 rounded-pill" id="newPassword" name="newPassword" placeholder="New Password">
            </div>

            <div class="mb-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-lock fa-xl me-4 cpink"></i>
              <input type="password" class="form-control w-75 p-2 rounded-pill" id="password" name="oldPassword" placeholder="Old Password">
            </div>
  
          </div>
          <div class="d-flex flex-row mt-2 justify-content-center align-items-center">
            <button type="submit" class="btn dpink text-white inline text-center py-3 w-25 rounded-pill">UPDATE</button>
            <a href="/" class="btn btn-secondary ms-4 text-white inline text-center py-3 w-25 rounded-pill">Back</a>
          
          </div>
        </form>
      </div>
    </div>
</div>