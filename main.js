tinymce.init({
    selector: "#commen",
    plugins: "emoticons autoresize importcss",
    toolbar: "emoticons",
    toolbar_location: "bottom",
    menubar: false,
    statusbar: false,

});

let input = document.getElementById("input");
input.addEventListener("keypress", enter)

function enter(senden) {
    if (senden.key === "Enter") {
        senden.preventDefault();
        document.getElementById("btn").click();
    }
}

function iframeshow()
{
    let iframe = document.getElementById("iframe-hidden");
    let exitbtn = document.getElementById('exit');
    let container = document.getElementById('containerid');

    iframe.style.visibility = 'hidden';
    exitbtn.style.visibility = 'hidden';
    container.style.filter = 'blur(5px)'
    container.style.pointerEvents = 'none';
    if (iframe.style.visibility === 'hidden' && exitbtn.style.visibility === 'hidden' )
    {
        iframe.style.visibility = 'visible';
        exitbtn.style.visibility = 'visible';
    }
}

let exitbtn = document.getElementById('exit');
exitbtn.addEventListener('click', iframeclose)
function iframeclose()
{
    document.getElementById("iframe-hidden").style.visibility = 'hidden';
    document.getElementById("exit").style.visibility = 'hidden';
    document.getElementById('containerid').style.filter = 'none';
    document.getElementById('containerid').style.pointerEvents = 'auto';
}

/*
Query String for Parent ID (pid) example*/

/*let myIframe = document.getElementById("myIframe");
let url_string = "https://ads.mrvirk.com/";
let width = "728";
let height = "90";
let geo = "uk";

let adsURL = url_string+"?geo="+geo+"&size="+width+"x"+height;
console.log(adsURL);
myIframe.src = adsURL;*/

