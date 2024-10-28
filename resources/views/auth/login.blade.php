<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>DSCMS</title>
    <link href="{{ asset('assets/auth/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #050516dd;
        } 
        a{
            text-decoration: none;
        }
        p{
            color: white;
            
        }
        .image-section {
            background-image: url("{% static 'images/mzumbee.jpg' %}");
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        .text-section {
            display: flex;
            align-items: center;
            justify-content: center;
            color: whitesmoke;
            height: 100vh;
        }
        .text-section p {
            font-size: 18px;
        }
        .text-section h1 {
            color: whitesmoke;
        }
        .golden-button {
            background-color: rgba(177, 137, 35, 0.967);
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 20px;
        }
        .golden-button:hover {
            background-color: #b38923;
        }
        .centered-link {
            display: block;
            margin: 0 auto;
            width: fit-content; /* Ensure the width fits the content */
        }
    </style>
</head>
<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row">
                        <!-- Left section with text -->
                        <div class="col-md-6 text-section">
                            <div>
                                <h1>DSCMS</h1>
                                <p>Doctor Specialist Consultation Management System (DSCMS) is a web-based application , streamlining and automating specialist Appointment booking, Automated Administarative tasks allowing health care providers to focus on patient care:</p></b>
                                <p><i class="fas fa-user"></i> User Registration</p></b>
                                <p><i class="fas fa-clipboard"></i> Appointment creation</p></b>
                                <p><i class="fas fa-check-circle"></i>Medical records management</p></b>
                                <p><i class="fas fa-search"></i> Appointment Tracking</p></b>
                                <p><i class="fas fa-lock"></i> Data privacy and security</p></b>
                                <p>By logging into this system, you will be able to use the system.</p></b>
                            </div>
                        </div>
                        <!-- Right section with login form -->
                        <div class="col-md-6">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header text-center">
                                <img  src="{{ asset('assets/auth/assets/img/dsc.png') }}" width="200px" height="100px">
                                    
                                </div>
                                <div class="card-header text-center">
                                    <h5>sign in with credentials</h5>
                                
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                    <div class="form-floating mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" />
                                        </div>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                        </div>
                                    </div>
                                        <!-- <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div> -->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-dark flex-grow-1" style="background-color: #DE5C6C; border-color: #CF5E6D;" type="submit" name="submit">Sign in</button>
                                        </div>
                                        <a class="small centered-link" href="{{ route('password.request') }}">Forgot Password?</a>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/auth/js/scripts.js') }}"></script>
</body>
</html>
