function deletedButton() {
  document.querySelectorAll("button[data-delete]").forEach(function (element){
    element.addEventListener('click',function(evt){
      let el = evt.currentTarget
      el.parentElement.parentElement.remove()
    })
  })
}

function addButton() {
  document.querySelector("button[data-add]").addEventListener('click',function (ev) {
    let el = ev.currentTarget
    var form = document.querySelector('form');
    el.parentElement.parentElement.querySelectorAll("input[type='text']").forEach(function (element){
      element.setAttribute("value",element.value)
    })
    form.submit()
  })
}
document.addEventListener('DOMContentLoaded', function() {
  addButton()
  deletedButton();
});
