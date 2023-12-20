<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../../Public/css/register.css">
    <title>register</title>
</head>
<body>
<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form method="post" action="../../App/Controllers/AuthController.php">
           
                <div class="form-outline mb-4">
                <label class="form-label text-white">categorie</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="genre">
                           <?php
                              $sql = "SELECT * FROM `role`";
                               $result = mysqli_query($connexion, $sql);
                                   if ($result) {
                              
                                        while ($row = mysqli_fetch_array($result)) {
                                  ?>
                           <option value="<?=$row['id']?>"><?=$row['name']?></option>
                           <?php
                              }
                              
                              }
                              ?>
                        </select>
                <!-- <label class="form-label" for="form3Example4cdg">Role</label>
                  <input type="password" name='role' id="form3Example4cdg" class="form-control form-control-lg" /> -->

                </div>

                <div class="d-flex justify-content-center">
                  <button   name='edit' class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Update</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>