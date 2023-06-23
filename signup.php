<?php
  session_start();
  include_once("connection.php");
?>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="css/styles.css">


<body>
    

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <?php
$action = isset($_GET['action']) ? $_GET['action'] : "";

if($action=='empty'){
echo "<div class='alert alert-danger'>All fields are mandatory.</div>";
}

if($action=='uname'){
echo "<div class='alert alert-danger'>Username already taken.</div>";
}

if($action=='pass'){
echo "<div class='alert alert-danger'>Password already taken.</div>";
}

if($action=='email'){
echo "<div class='alert alert-danger'>Email already taken.</div>";
}
?>
                        <form method="POST" action="signup_process.php" onsubmit="return Validate()" name="vform" class="register-form" id="register-form">
                          
                          <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="fname" id="name" placeholder="First Name"/>
                            </div>

                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="lname" id="name" placeholder="Last Name"/>
                            </div>

                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="name" placeholder="User-Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="text" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="address"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="texts" name="address" id="address" placeholder="Your address"/>
                            </div>
                            <div class="form-group">
                                <label for="mobile"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="mobile" id="mobile" placeholder="Your mobile number"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Enter password"/>
                            </div>
                        

<div class="form-group">
 <input type="radio" name="gender" value="male" class="agree-term" />
 <label class="label-agree-term"><span><span></span></span>Male</label>
 <input type="radio" name="gender" value="female" class="agree-term" />
 <label class="label-agree-term"><span><span></span></span>Female</label>
</div>

<div class="form-group">
 <input type="radio" name="rolelist" value="Admin" class="agree-term" />
 <label class="label-agree-term"><span><span></span></span>Admin</label>
 <input type="radio" name="rolelist" value="Customer" class="agree-term" />
 <label class="label-agree-term"><span><span></span></span>Customer</label>
</div>

                                     

                            <div class="form-group form-button">
                                <input type="submit" name="CREATE" id="SIGNUP" class="submit-btn" value="Register"/>
                            </div>
                        </form>
                    </div>
                     <div class="signup-image">
                        <figure><img src="img/register.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

 
</body>

<script>
    console.clear();

const loginBtn = document.getElementById('login');
const signupBtn = document.getElementById('signup');

loginBtn.addEventListener('click', (e) => {
    let parent = e.target.parentNode.parentNode;
    Array.from(e.target.parentNode.parentNode.classList).find((element) => {
        if(element !== "slide-up") {
            parent.classList.add('slide-up')
        }else{
            signupBtn.parentNode.classList.add('slide-up')
            parent.classList.remove('slide-up')
        }
    });
});

signupBtn.addEventListener('click', (e) => {
    let parent = e.target.parentNode;
    Array.from(e.target.parentNode.classList).find((element) => {
        if(element !== "slide-up") {
            parent.classList.add('slide-up')
        }else{
            loginBtn.parentNode.parentNode.classList.add('slide-up')
            parent.classList.remove('slide-up')
        }
    });
});
</script>
 <script>
    var username = document.forms['vform']['username'];
    var email = document.forms['vform']['email'];
    var password = document.forms['vform']['password'];
    var password_confirm = document.forms['vform']['password_confirm'];
    var mobile = document.forms['vform']['mobile'];
    var address = document.forms['vform']['address'];
    var check = document.forms['vform']['chk'].checked;



    // SELECTING ALL ERROR DISPLAY ELEMENTS
    var name_error = document.getElementById('name_error');
    var email_error = document.getElementById('email_error');
    var password_error = document.getElementById('password_error');
    var mobile_error = document.getElementById('mobile_error');
    var address_error = document.getElementById('address_error');
    //var x= document.getElementById("chk").checked;

    // SETTING ALL EVENT LISTENERS
    username.addEventListener('blur', nameVerify, true);
    email.addEventListener('blur', emailVerify, true);
    password.addEventListener('blur', passwordVerify, true);
    mobile.addEventListener('blur', mobileVerify, true);
    address.addEventListener('blur', addressVerify, true);

    // validation function
    function Validate() {

        // validate username
        if (username.value == "") {
            username.style.border = "1px solid red";
            document.getElementById('username_div').style.color = "red";
            name_error.textContent = "Username is required";
            username.focus();
            return false;
        }


        // validate username
        if (username.value.length < 3) {
            username.style.border = "1px solid red";
            document.getElementById('username_div').style.color = "red";
            name_error.textContent = "Username must be at least 3 characters";
            username.focus();
            return false;
        }

        if (!isNaN(username.value)) {
            username.style.border = "1px solid red";
            document.getElementById('username_div').style.color = "red";
            name_error.textContent = "Username should not be a number";
            username.focus();
            return false;
        }


        // validate email
        if (email.value == "") {
            email.style.border = "1px solid red";
            document.getElementById('email_div').style.color = "red";
            email_error.textContent = "Email is required";
            email.focus();
            return false;
        }

        if (email.value.indexOf('@') <= 0) {
            email.style.border = "1px solid red";
            document.getElementById('email_div').style.color = "red";
            email_error.textContent = "@ position invalid";
            email.focus();
            return false;
        }

        if ((email.value.charAt(email.value.length - 4) != '.') && (email.value.charAt(email.value.length - 3) !=
                '.')) {
            email.style.border = "1px solid red";
            document.getElementById('email_div').style.color = "red";
            email_error.textContent = ". position invalid";
            email.focus();
            return false;
        }

        // validate password
        if (password.value == "") {
            password.style.border = "1px solid red";
            document.getElementById('password_div').style.color = "red";
            //password_confirm.style.border = "1px solid red";
            password_error.textContent = "Password is required";
            password.focus();
            return false;
        }

        // check if the two passwords match
        if (password.value != password_confirm.value) {
            password.style.border = "1px solid red";
            document.getElementById('pass_confirm_div').style.color = "red";
            password_confirm.style.border = "1px solid red";
            pass_confirm_error.innerHTML = "The two passwords do not match";
            password.focus();
            return false;
        }

        //check if mobile
        if (mobile.value == "") {
            mobile.style.border = "1px solid red";
            document.getElementById('mobile_div').style.color = "red";
            mobile_error.textContent = "Mobile number is required";
            mobile.focus();
            return false;
        }

        //check if mobile number is number
        if (isNaN(mobile.value)) {
            mobile.style.border = "1px solid red";
            document.getElementById('mobile_div').style.color = "red";
            mobile_error.textContent = "Character is not a mobile number";
            mobile.focus();
            return false;
        }

        if (mobile.value.length != 10) {
            mobile.style.border = "1px solid red";
            document.getElementById('mobile_div').style.color = "red";
            mobile_error.textContent = "Mobile number should be 10 digit";
            mobile.focus();
            return false;
        }

        if (address.value == "") {
            address.style.border = "1px solid red";
            document.getElementById('address_div').style.color = "red";
            address_error.textContent = "Address is required";
            address.focus();
            return false;
        }

    }
    // event handler functions
    function nameVerify() {
        if (username.value != "") {
            username.style.border = "1px solid #5e6e66";
            document.getElementById('username_div').style.color = "#5e6e66";
            name_error.innerHTML = "";
            return true;
        }
    }

    function emailVerify() {
        if (email.value != "") {
            email.style.border = "1px solid #5e6e66";
            document.getElementById('email_div').style.color = "#5e6e66";
            email_error.innerHTML = "";
            return true;
        }
    }

    function mobileVerify() {
        if (mobile.value != "") {
            mobile.style.border = "1px solid #5e6e66";
            document.getElementById('mobile_div').style.color = "#5e6e66";
            mobile_error.innerHTML = "";
            return true;
        }
    }




    function passwordVerify() {
        if (password.value != "") {
            password.style.border = "1px solid #5e6e66";
            document.getElementById('pass_confirm_div').style.color = "#5e6e66";
            document.getElementById('password_div').style.color = "#5e6e66";
            password_error.innerHTML = "";
            return true;
        }
        if (password.value == password_confirm.value) {
            password_confirm.style.border = "1px solid #5e6e66";
            password.style.border = "1px solid #5e6e66";

            document.getElementById('pass_confirm_div').style.color = "#5e6e66";
            document.getElementById('password_confirm').style.color = "#5e6e66";
            pass_confirm_error.innerHTML = "";
            return true;
        }
    }

    function addressVerify() {
        if (mobile.value != "") {
            address.style.border = "1px solid #5e6e66";
            document.getElementById('address_div').style.color = "#5e6e66";
            address_error.innerHTML = "";
            return true;
        }
    }
    </script>
  

    <!-- JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
</html>