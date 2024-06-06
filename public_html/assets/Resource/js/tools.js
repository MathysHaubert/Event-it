
/**
 * @param {string} url url to send the request to, don't forget to add /ajax/ before the url
 * @param {string} method GET or POST
 * @param {string} data data to send to the server
 * @param {function} succes function to execute when the request is successful
 * @param {function} error function to execute when the request is not successful
 */
export const sendAjaxRequest = (url,method, data, succes, error) => {
    const xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(data)
    xhr.onreadystatechange = function() { 
        if (xhr.readyState === 4 && xhr.status >= 400) { 
            //error 
            error()
        } else if (xhr.status === 200){ 
            //success 
            succes()
        } else {
        console.log(xhr.status,xhr.log)
        }
    } 
}
