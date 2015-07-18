
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test SMS</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
       


        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- Scripts -->
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
       

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        <div class="container-fluid">
        <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form role="form" method="get" action=" http://sms.vnet.vn:8082/api/sent" id="add-form">
                <div class="form-group required">

                    <label for="username" class="control-label">
                        Username
                    </label>
                    <input type="text" class="form-control" id="username" name="username" value="condovn" />
                    <div class="help-block with-errors"></div>
                </div>
               
                <div class="form-group required">

                    <label for="password" class="control-label">
                        Password
                    </label>
                    <input type="text" class="form-control" id="password" name="password" value="co$D0vn"/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group required">

                    <label for="source_addr" class="control-label">
                        source_addr
                    </label>
                    <input type="text" class="form-control" id="source_addr" name="source_addr" value="841663578000"/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group required">

                    <label for="dest_addr" class="control-label">
                        dest_addr
                    </label> <br>
                    <input type="text" class="form-control" id="dest_addr" name="dest_addr" value="841679263615"/>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group required">

                    <label for="message" class="control-label">
                        message
                    </label>
                    <input type="text" class="form-control" id="message" name="message" value="Test"/>
                    <div class="help-block with-errors"></div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>




    </body>
</html>
