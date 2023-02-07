<style>


    body {
        background-image: url("<?php echo base_url()."Assets"?>/images/backlogin.png");
        font-family: 'Open Sans';
    }
    
    .main {
        background-color: #FFFFFF;
        width: 400px;
        height: 400px;
        margin: 7em auto;
        border-radius: 1.5em;
        box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
    }
    
    .sign {
        padding-top: 40px;
        color: #15253d;
        font-family: 'Open Sans';
        font-weight: bold;
        font-size: 23px;
    }
    
    .un {
        width: 76%;
        color: rgb(38, 50, 56);
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 1px;
        background: rgba(136, 126, 126, 0.04);
        padding: 10px 20px;
        border: none;
        border-radius: 20px;
        outline: none;
        box-sizing: border-box;
        border: 2px solid rgba(0, 0, 0, 0.02);
        margin-bottom: 50px;
        margin-left: 46px;
        text-align: center;
        margin-bottom: 27px;
        font-family: 'Open Sans';
    }
    
    form.form1 {
        padding-top: 40px;
    }
    
    .pass {
        width: 76%;
        color: rgb(38, 50, 56);
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 1px;
        background: rgba(136, 126, 126, 0.04);
        padding: 10px 20px;
        border: none;
        border-radius: 20px;
        outline: none;
        box-sizing: border-box;
        border: 2px solid rgba(0, 0, 0, 0.02);
        margin-bottom: 50px;
        margin-left: 46px;
        text-align: center;
        margin-bottom: 27px;
        font-family: 'Open Sans';
    }
    

    .un:focus, .pass:focus {
        border: 2px solid rgba(0, 0, 0, 0.18) !important;
        
    }
    
    .submit {
      cursor: pointer;
      border-radius: 5em;
      color: #fff;
      background: linear-gradient(to right, #15253d, #aab0ff);
      border: 0;
      padding-left: 40px;
      padding-right: 40px;
      padding-bottom: 10px;
      padding-top: 10px;
      font-family: 'Open Sans';
      margin-left: 35%;
      font-size: 13px;
      box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
  }

  a {
    text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
    color: #E1BEE7;
    text-decoration: none
}

@import url('https://fonts.googleapis.com/css?family=Quicksand&display=swap');
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
}
h3{
    font-family:Open Sans;
}
.alert{
  width:50%;
  margin:20px auto;
  padding:30px;
  position:relative;
  border-radius:5px;
  box-shadow:0 0 15px 5px #ccc;
  background-color: #f7a7a3;
  color: #FFFF;
}


</style>


<html>

<head>
  <link rel="stylesheet" href="css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
  <title>COVID-19 REPORT</title>
</head>

<body>
   <?php if($this->session->flashdata('message')){?>
       <div class="alert danger-alert">
          <h3><?php echo $this->session->flashdata('message');?></h3>
      </div>
  <?php } ?>
  <div class="main">

    <p class="sign" align="center">LOGIN</p>
    <form class="form1" action="<?php echo base_url('CC/AksiLogin'); ?>" method="post">
      <input class="un " type="text" align="center" placeholder="Username" name="username">
      <input class="pass" type="password" align="center" placeholder="Password" name="password">
      <input class="submit" align="center" value="LOGIN" type="submit">


  </div>

</body>

</html>




