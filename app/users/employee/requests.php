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
              <button type="button" id="aanvraag" class="requests__button">
                 Aanvragen
              </button>
          </div>
          <div class="requests__button-wrapper">
              <button type="button" id="status" class="requests__button">
                Status 
              </button>
          </div>
      </div>

       <form action="requests_succes.php" method="post">
           <div id="request">

                <div>
                    Reden aanvraag: <br>
                    <input type="text" name="request[]"  classname="inputje">
                    <br><br><br>
                </div>

            </div>
            <button name="submit"> Submit </input>
      </form>

      <button id="add_request"> Add  </button>

  </div>

  <script src="../../assets/js/components/addRequest.js"></script>

 </body>
 </html>
