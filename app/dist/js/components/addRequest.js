"use strict";

// Default input starts at 1
var addInputNumber = 2;

var addRequest = function addRequest() {
  if (document.getElementById("add_request") !== null) {
    document.getElementById("add_request").addEventListener("click", function () {
      document.getElementById("request").innerHTML += '<div class="requests__date-reason-wrapper"><div class="requests__reason-wrapper"><p class="requests__reason"> Reden aanvraag: </p> <br><input type="text" name="request[]"  classname="requests__input"><br><br><br></div><p class="requests__reason"> Kies een datum: </p> <br><input type="text" id="pick-date" name="date[]" class="requests__date-picker"></div>';
      addInputNumber++; // 1. Everytime addRequest gets executed it will ++ the InputNumber, so this is how we get unique input numbers.
      // tinydatepicker

      var inputs = Array.prototype.slice.call(document.querySelectorAll('.requests__date-picker'));

      for (var i = 0; i < inputs.length; i++) {
        var bla = TinyDatePicker(inputs[i]);
        console.log(bla.state.selectedDate);
      }
    });
  }
}; // The reason why this code is in the Addrequest function and outside of the function, is becuase
// There is a default input field, it basically tries to look for existing .requests__date-picker classes.
// But default there's only 1. And when you add a request that's when you have a new .requests__date-picker class and it has
// to look for that existing class AGAIN>


var inputs = Array.prototype.slice.call(document.querySelectorAll('.requests__date-picker'));

for (var i = 0; i < inputs.length; i++) {
  var bla = TinyDatePicker(inputs[i]);
  console.log(bla.state.selectedDate);
}

addRequest();