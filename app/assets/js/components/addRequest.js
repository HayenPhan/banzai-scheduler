export const addRequest = () => {
  document.getElementById("add_request").addEventListener("click", function(){
      document.getElementById("requests").innerHTML += 'Reden aanvraag: <br> <input type="text" name="request"> <br> <br> <br> <button id="add_request"> Add </button> <br>';
});
}
