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

                <div class="requests__reason-wrapper">
                    <p class="requests__reason"> Reden aanvraag: </p> <br>
                    <input type="text" name="request[]"  classname="requests__input">
                    <br><br><br>
                </div>
                <button type="button" class="requests__date-picker"> Prik een datum </button>

            </div>

            <div class="requests__button-wrapper">
                <button type="button" class="requests__add" id="add_request">
                    <div class="requests__add-wrapper">
                        <img class="requests__add-image" src="../../../app/assets/images/plus.png" />
                    </div>
                </button>

                <button type="submit" class="requests__submit" name="submit">
                   Submit
               </button>
            </div>

      </form>

  </div>

  <script src="../../assets/js/components/tinydatepicker.js"></script>
  <script src="../../assets/js/components/addRequest.js"></script>


 </body>
 </html>
