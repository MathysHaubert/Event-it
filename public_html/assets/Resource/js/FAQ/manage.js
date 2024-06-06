function deletedButton() {
  document.querySelectorAll("button[data-delete]").forEach(function (element){
    element.addEventListener('click',function(evt){
      let el = evt.currentTarget
      el.parentElement.parentElement.remove()
    })
  })
}
document.addEventListener('DOMContentLoaded', function() {
  deletedButton();
});
