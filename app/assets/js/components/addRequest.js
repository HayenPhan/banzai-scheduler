// Default input starts at 1
let addInputNumber = 2;

const addRequest = () => {
    if (document.getElementById("add_request") !== null){
      document.getElementById("add_request").addEventListener("click", function(){

          document.getElementById("request").innerHTML += '<div class="requests__reason-wrapper"> <p class="requests__reason"> Reden aanvraag: </p> <br> <input type="text" name="request[]"  classname="requests__input"> </input> <br><br><br>  </div> <p class="requests__reason"> Kies een datum: </p> <br><input type="text" id="pick-date" class="requests__date-picker"> ';
          addInputNumber++;

            // 1. Everytime addRequest gets executed it will ++ the InputNumber, so this is how we get unique input numbers.


            // tinydatepicker

              const inputs = Array.prototype.slice.call(document.querySelectorAll('.requests__date-picker'));

              for (var i = 0; i < inputs.length; i++) {
                const bla = TinyDatePicker(inputs[i]);

                console.log(bla.state.selectedDate);

              }



      });
    }
}

// The reason why this code is in the Addrequest function and outside of the function, is becuase
// There is a default input field, it basically tries to look for existing .requests__date-picker classes.
// But default there's only 1. And when you add a request that's when you have a new .requests__date-picker class and it has
// to look for that existing class AGAIN>

  const inputs = Array.prototype.slice.call(document.querySelectorAll('.requests__date-picker'));

  for (var i = 0; i < inputs.length; i++) {
    const bla = TinyDatePicker(inputs[i]);

    console.log(bla.state.selectedDate);

  }



addRequest();
