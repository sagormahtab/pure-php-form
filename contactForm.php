<?php
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <style>
          h1{
              color: purple;
          }
          .contactForm{
              border: 1px solid #261cec;
              margin-top: 50px;
              border-radius: 15px;
          }
      </style>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10 contactForm">
                <h1>Contact us:</h1>
                <?php
                $missingName = "<p><strong>Please enter a name!</p></strong>";
                $missingEmail = "<p><strong>Please enter an Email!</p></strong>";
                $missingMessage = "<p><strong>Please enter a message!</p></strong>";
                $invalidEmail = "<p><strong>Please enter a valid Email!</p></strong>";
                $errors = "";
                
                    //if the user has submitted the form
                    if(isset($_POST["submit"])){
                        //check for errors
                        if(!$_POST["name"]){
                            $errors .= $missingName;
                        }else{
                            $_POST["name"] = filter_var($_POST["name"],FILTER_SANITIZE_STRING);
                        }
                        if(!$_POST["email"]){
                            $errors .= $missingEmail;
                        }else{
                            $_POST["email"] = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
                            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                                $errors .= $invalidEmail;
                            }
                        }
                        if(!$_POST["message"]){
                            $errors .= $missingMessage;
                        }else{
                            $_POST["message"] = filter_var($_POST["message"],FILTER_SANITIZE_STRING);
                        }
                
                  //if there are any errors
                  if($errors){
                      //print error message
                      $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
                  }
                      //no error
                      else{
                      $name = $_POST["name"];
                      $email = $_POST["email"];
                      $message = $_POST["message"];
                          
                      
                      $to = "sagormahtab2@gmail.com";
                      $subject = "Contact";
                      $message = "
                      <p>Name: $name.</p>
                      <p>Email: $email.</p>
                      <p>Message</p>
                      <p><strong>$message</strong></p>
                      ";
                      $headers="Content-type: text/html";
                      //send the email
                      if(mail($to, $subject, $message, $headers)){ //if success
                          //print success message
                          //$resultMessage = '<div class =  "alert alert-success">Thank you for your messages. We will get back to you as soon as possible!</div>';
                          header("Location: thanksforyourmessage.php");
                      }
                      //fail
                      else{
                          //print warning message
                          $resultMessage = '<div class="alert alert-warning">Unable to send Email. Please try again later!</div>';
                      }
                  }
                        
                  //print result message
                  echo $resultMessage;
                }
                ?>
                <form action="contactForm.php" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php if(isset($_POST["name"])){echo $_POST["name"];}; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php if(isset($_POST["email"])){echo $_POST["email"];}; ?>">
                    </div>
                    <textarea name="message" id="message" rows="5" class="form-control"><?php if(isset($_POST["message"])){echo $_POST["message"];}; ?></textarea>
                    <input type="submit" name="submit" class="btn btn-success btn-lg" value="Send a message">
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
<?php
    ob_flush();
?>