// Default input starts at 1
let addInputNumber = 2;

const addRequest = () => {
    if (document.getElementById("add_request") !== null){
      document.getElementById("add_request").addEventListener("click", function(){

          document.getElementById("request").innerHTML += '<div> Reden aanvraag: <br> <input type="text" name="request[]"> <br> <br> <br> </div>';
          addInputNumber++;

            // 1. Everytime addRequest gets executed it will ++ the InputNumber, so this is how we get unique input numbers.

      });
    }
}

// tinydatepicker

TinyDatePicker('.requests__date-picker');

addRequest();
