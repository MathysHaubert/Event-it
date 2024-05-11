async function strHashPromise(a, b) {
  b = b || 'SHA-256';
  var c = new TextEncoder().encode(a),
    d = await crypto.subtle.digest(b, c),
    e = Array.from(new Uint8Array(d)),
    f = e.map(function(c) {
      return c.toString(16).padStart(2, '0');
    }).join('');
  return f;
}

function strHash(a,b) {
  return strHashPromise(a,b).then(function(hash){return hash})
}
console.log(strHash("message"))

document.querySelector("#password[name='_password']").addEventListener('click',(el)=>{
  el = el.currentTarget
  el.innerHTML
})
