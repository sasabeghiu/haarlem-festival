<!doctype html>
<html lang="en">

<head>
    <title>Haarlem Festival - Reset password</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main class="container">
        <div class="container mt-4">
            <h2>Verify Account</h2>
            <p>Enter your username and you will receive a verification code in the email associated with the account.</p>
            <form method="post" action="/login/createCode">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Send Verification Code</button>
                <a href="/login" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
        <!-- <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <br />
                <div class="card">
                    <div class="card-header">
                        Email verification
                    </div>
                    <div class="card-body">
                    </div>
                    <form action="/login/passwordReset" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Enter your username and you will receive a verification code in the email associated with the account.</label>
                            <input type="text" class="form-control" name="username" id="username" aria-describedby="username" placeholder="enter your username" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col"><button type="submit" class="btn btn-primary">Send verification code</button></div>
                            <div class="col"><a name="" id="" class="btn btn-secondary" href="/login/index" role="button">Cancel</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>