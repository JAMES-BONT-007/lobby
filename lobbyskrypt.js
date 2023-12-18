document.addEventListener("DOMContentLoaded", function () {

    function cookie(name) {
        const cookies = document.cookie.split('; ');
        for (const cookie of cookies) {
            const [cookieName, cookieValue] = cookie.split('=');
            if (cookieName === name) {
                return decodeURIComponent(cookieValue);
            }
        }
        return null;
    }

    login = cookie("konto")

    function getCurrentDate() {
        const now = new Date();
        const dzien = String(now.getDate()).padStart(2, '0');
        const msc = String(now.getMonth() + 1).padStart(2, '0');
        const rok = String(now.getFullYear()).slice(2);
        const godz = String(now.getHours()).padStart(2, '0');
        const min = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
      
        return `${dzien}-${msc}-${rok} ${godz}:${min}:${seconds}`;
    }      

    let redirect = false; 

    function lobbychk() {
        czas = getCurrentDate();

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if(xhr.readyState == 4 && xhr.status == 200){
                response = JSON.parse(xhr.responseText);
                console.log(response)
                
                
                
            }
        };

        xhr.open('POST', 'lobbyskrypt.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('nazwa=' + encodeURIComponent(login) + '&czas=' + encodeURIComponent(czas));

    }

    setInterval(lobbychk, 475);
});