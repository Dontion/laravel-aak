<?php include "header.php" ; ?>

<body id="page-top">

<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Register Form</h4>
                    <p class="card-description">  Register Form </p>
                    <form class="forms-sample" method="post" action="proses_register.php">
                      <div class="form-group">
                        <label for="exampleInputName1">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Name" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Re-Password</label>
                        <input type="password" class="form-control" id="password2"  name="password2" placeholder="Please input password again" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName5">Name account</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="input ur acc name" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Pilih Hak Akses</label>
                        <select class="form-control" id="hakakses" name="akses" required>
                          <option value="operator">Operator</option>
                          <option value="admin">Admin</option>
                        </select>
                      
                      <button type="submit" name="regis" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>


<script>
    function validateForm() {
        var nama = document.getElementById("nama").value;
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("Password").value;
        var repeatPassword = document.getElementById("RepeatPassword").value;
        var hakakses = document.getElementById("hakakses").value;

        if (nama === "" || username === "" || email === "" || password === "" || repeatPassword === "" || hakakses === "") {
            alert("Please fill in all fields");
            return false;
        }
        return true;
    }
</script>
<?php include "footer.php" ; ?>              