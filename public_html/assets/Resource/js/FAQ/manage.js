function deletedButton() {
  document.querySelectorAll("button[data-delete]").forEach(function (element){
    element.addEventListener('click',function(evt){
      let el = evt.currentTarget
      el.parentElement.parentElement.querySelectorAll("input[type='text']") .forEach(function (element2){
        element2.value = ""
      })
    })
  })
}
document.addEventListener('DOMContentLoaded', function() {
  deletedButton();
});
