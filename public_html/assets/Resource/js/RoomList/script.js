function addRoom() {
  document.querySelector("button[data-add]").addEventListener('click',function (el){
    el.currentTarget.style.display = "none"
    const input = document.querySelector("input[data-add-input]")
    input.style.visibility = "visible"
    const button = document.querySelector("button[data-add-input]")
    button.style.visibility = "visible"
  })
}
document.addEventListener("DOMContentLoaded",function (){
  addRoom()
})
