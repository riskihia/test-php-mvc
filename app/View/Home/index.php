<div class="container-fuild vh-100 pink p-5">
  <div class="container m-auto bg-white shadow h-100 p-5">
    <h1>Wellcome : <span class="text-primary text-capitalize"><?= $model['user']->username ?? '' ?></span></h1>
    <div class="border border-2 rounded border-warning w-50 p-2">
      <p class="P-0 m-1">ID = <span><?= $model['user']->id?></span></p>
      <p class="P-0 m-1">USERNAME = <span><?= $model['user']->username?></span></p>
      <p class="P-0 m-1">EMAIL = <span><?= $model['user']->email?></span></p>
      
      <a class="btn btn-primary" href="/users/edit/<?=$model['user']->id?>">Edit Yourself...</a>
      <form action="/users/delete/<?= $model['user']->id?>" method="POST">
        <input type="hidden" name="id" value="<?= $model['user']->id?>">
        <button type="submit" class="btn btn-danger mt-2">Delete Yourself...</button>
      </form>

    </div>
  </div>
</div>