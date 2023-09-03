<?php
//include '../config/userconfig.php';

if(isset($_POST['submit'])){
    $fname=$_POST['fname'];
    $fname=filter_var($fname,FILTER_SANITIZE_STRING);

    $lname=$_POST['lname'];
    $lname=filter_var($lname,FILTER_SANITIZE_STRING);

    $age=$_POST['age'];
    $age=filter_var($age,FILTER_SANITIZE_STRING);

    $email=$_POST['email'];
    $email=filter_var($email,FILTER_SANITIZE_STRING);

    $mobile=$_POST['mobile'];
    $mobile=filter_var($mobile,FILTER_SANITIZE_STRING);

    $date=$_POST['date'];
    $date=filter_var($date,FILTER_SANITIZE_STRING);

    $newp=$_POST['password'];
    $newp=filter_var($newp,FILTER_SANITIZE_STRING);

    $conf=$_POST['conf'];
    $conf=filter_var($conf,FILTER_SANITIZE_STRING);

    $select = $conn->prepare("SELECT * FROM 'users' WHERE (email =:usrem1");
    $select->execute([$email]);

    if($select->rowCount() > 0){
        $message[] ='user already exist!';
    }else{
        if($newp != $conf){
            $message[] ='confirm password not matched!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Form validation</title>
    <style>
        .message{
            h
        }
        </style>
</head>

<body>

    
    <?php
if(isset($message)){
    foreach($message as $message){
        echo '
        <div class ="alert alert-danger" style="display:none;" role="alert" id="alert">
        <span>'.$message.'</span>
        
        </div>
       ';
    }
}
?>
    <div class="container">
        <div style="width:1000px">
            <h1>Form validation</h1>
            <div class="alert alert-danger" style="display:none;" role="alert" id="alert">Alert!</div>

            <form action="" method="post" enctype="multipart/form-data" id="form">
                <div class="row">
                    <div class="col-sm-6 mt-3">
                        <label for="name">First Name:</label>
                        <input required placeholder="Enter your name" class="form-control" type="text" name="fname" id="name">
                    </div>
                    <div class="col-sm-6 mt-3">
      <label for="lname">Last Name:</label>
      <input required placeholder="Enter your last name" class="form-control" type="text" name="lname" id="lname">
  </div>
                    <div class="col-sm-6 mt-3">

                        <label for="age">Age:</label>
                        <input required placeholder="Enter your Age" class="form-control" type="number" name="age" id="age">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="email">Email Address :</label>
                        <input required placeholder="Enter your Email" class="form-control" type="email" name="email" id="email">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="phn">Mobile Number :</label>
                        <input required placeholder="Enter your phone number" class="form-control" type="number" name="mobile"
                            id="phn">
                    </div>
               <!--     <div class="col-sm-6 mt-3">
                            <label for="state">State:</label>
                        <input required placeholder="Enter your state" class="form-control" type="text" id="state" name="state"> 
                        </div>
                        <div class="col-sm-6 mt-3">
                                    <label for="city">City:</label>
                         <input required placeholder="Enter your city" class="form-control" type="text" id="city" name="city">
                     </div>-->
                     <div class="col-sm-6 mt-3">
        <label for="date">date:</label>
    <input required placeholder="Enter your date" class="form-control" type="date" id="date" name="date">
    </div>
                     <div class="col-sm-6 mt-3">
        <label for="newp">New Password:</label>
    <input required placeholder="Enter your new password" class="form-control" type="text" id="newp" name="password">
    </div>
    <div class="col-sm-6 mt-3">
        <label for="conf">Confirm Password:</label>
    <input required placeholder="Enter your confirm password" class="form-control" type="text" id="conf" name="conf">
    </div>
                </div>
                <div class="text-center mt-3">
                    <button onclick="formvalidate()" type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>

    </div>
    </div>
</body>
<!--<script>
    function formvalidate() {
        var alert = document.getElementById('alert');
        var form = document.getElementById('form');
        //Name validation
        var name = document.getElementById('name').value;
        if (name == '') {
            alert.style.display = "block";
            alert.innerHTML = "Please Enter the Full Name";
            return 0;
        }
        //Age validation

        var age = document.getElementById('age').value;
        if (age == '') {
            alert.style.display = "block";
            alert.innerHTML = "Please Enter the age ";
            return 0;
        }
        if (age >= 18) {
            alert.style.display = "none";
        } else {
            alert.style.display = "block";
            alert.innerHTML = "Please Enter age above of 18";
            return 0;
        }

        //email validation
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var email = document.getElementById('email').value;
        if (email == '') {
            alert.style.display = "block";
            alert.innerHTML = "Please Enter the Email address ";
            return 0;
        }
        if (email.match(mailformat)) {
            alert.style.display = "none";
        } else {
            alert.style.display = "block";
            alert.innerHTML = "Please Enter valid Email address";
            return 0;
        }

        //phone number validation
        var phoneformat = /^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/
        var phone = document.getElementById('phn').value;

        if (phone == '') {
            alert.style.display = "block";
            alert.innerHTML = "Please Enter the Phone number ";
            return 0;
        }
        if (phone.match(phoneformat)) {
            alert.style.display = "none";
        } else {
            alert.style.display = "block";
            alert.innerHTML = "Please Enter valid Phone number";
            return 0;
        }
        //image validation
        var img = document.getElementById('file').value;
        console.log(img);
        img=img.split('.');
        if (img == '') {
            alert.style.display = "block";
            alert.innerHTML = "Please Select image";
            return 0;
        } 
        var extension =img[1];
        if(extension == "jpg" || extension == "png"){
            alert.style.display = "none";
            form.submit();
        }else{
            alert.style.display = "block";
            alert.innerHTML = "Please Select JPG or PNG image";
            return 0;
        }

    }


</script>
-->
</html>