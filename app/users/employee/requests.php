<?php

 ?>

 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="UTF-8">
     <title> Aanvragen </title>
       <link rel="stylesheet" type="text/css" href="../../../app/assets/styles/css/main.css">

 </head>
 <body>

  <div class="requests__container">
      <div class="requests__top">
          <div class="requests__button-wrapper">
              <a class="current requests__button" href="requests.php" id="aanvraag">
                 Aanvragen
              </a>
          </div>
          <div class="requests__button-wrapper">
              <a href="status.php" id="status" class="requests__button">
                Status
              </a>
          </div>
      </div>

       <form action="requests_succes.php" method="post">
           <div id="request">

                <div>
                    Reden aanvraag: <br>
                    <input type="text" name="request[]"  classname="inputje">
                    <br><br><br>
                </div>
                <button type="button" class="requests__date-picker"> Prik een datum </button>

            </div>
            <button name="submit"> Submit </input>
      </form>

      <button id="add_request"> Add  </button>

  </div>

  <script src="../../assets/js/components/tinydatepicker.js"></script>
  <script src="../../assets/js/components/addRequest.js"></script>


 </body>
 </html>
