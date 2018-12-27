// Default input starts at 1
let inputNumber = 2;

export const addRequest = () => {

  document.getElementById("add_request").addEventListener("click", function(){

      document.getElementById("request").innerHTML += '<div> Reden aanvraag: <br> <input type="text" name="request' + inputNumber + '"> <br> <br> <br> </div>';
      inputNumber++;

      console.log('click');

      // 1. Everytime addRequest gets executed it will ++ the InputNumber, so this is how we get unique input numbers.

});

}
