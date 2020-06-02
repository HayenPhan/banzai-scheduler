<?php


 ?>

 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="UTF-8">
     <title> Requests </title>
       <link rel="stylesheet" type="text/css" href="../../../app/dist/css/main.css">

 </head>
 <body>

  <div class="requests__container">
      <div class="requests__top">
          <div class="requests__button-wrapper">
              <a class="current requests__button" href="requests.php" id="aanvraag">
                 Requests
              </a>
          </div>
          <div class="requests__button-wrapper">
              <a href="status.php" id="status" class="requests__button">
                Status
              </a>
          </div>

          <div class="requests__button-wrapper">
              <a href="overview.php" id="status" class="requests__button">
                Overview
              </a>
          </div>

          <a href="home.php" class="status__add">
              <div class="status__add-wrapper">
                  <img class="status__add-image" src="../../../app/assets/images/left-arrow.png" />
              </div>
          </a>

          <div class="requests-uitloggen__wrapper">
              <a class="requests-uitloggen" href="../../logout.php">
                 Log out
              </a>
          </div>

      </div>

       <form action="requests_succes.php" method="post">
         <div class="requests__wrapper">

           <div id="request">

             <div class="requests__date-reason-wrapper">
                  <div class="requests__reason-wrapper">
                      <p class="requests__reason"> Request: </p> <br>
                      <input type="text" name="request[]"  classname="requests__input">
                      <br><br><br>


                  </div>
                  <p class="requests__reason"> Pick a date: </p> <br>
                  <input type="text" name="date[]" id="pick-date" class="requests__date-picker">
              </div>

            </div>


            <div class="requests__button-wrapper">

                <button type="submit" class="requests__submit" name="submit">
                   Submit
               </button>
            </div>

        </div>

      </form>

  </div>

  <script src="../../assets/js/components/tinydatepicker.js"></script>
  <script src="../../assets/js/components/addRequest.js"></script>


 </body>
 </html>
