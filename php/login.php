<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="https://firebasestorage.googleapis.com/v0/b/ffff-dc41c.appspot.com/o/Login.png?alt=media&token=880a22ba-a5f2-4c5b-afc8-499e1479798b" class="brand_logo" alt="Logo">
                </div>
            </div>
            <div class="d-flex justify-content-center form_container">
                <form>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="user" class="form-control input_user" value="" placeholder="username" autocomplete="off" >
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
                    </div>
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="button" name="button" value="button" class="btn login_btn" onclick="Login()">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function Login(){
        let user = document.getElementsByName("user")[0];
        let password = document.getElementsByName("password")[0];

        if ( user.value == "admin" && password.value == "admin") {
            alert('Bienvenido Administrador')
            sessionStorage.setItem('Logueado', 'true');
        }
        window.location.replace("./php/user/user.php");
    }
</script>