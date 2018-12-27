export const addRequest = () => {
  document.getElementById("add_request").addEventListener("click", function(){
      document.getElementById("request").innerHTML += '<div> Reden aanvraag: <br> <input type="text" name="request"> <br> <br> <br> </div>';
      console.log('click');
});

}
