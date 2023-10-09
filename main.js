tinymce.init({
    selector: "#commen",
    plugins: "emoticons autoresize importcss",
    toolbar: "emoticons",
    toolbar_location: "bottom",
    menubar: false,
    statusbar: false,

});

/*enter submit*/
let input = document.getElementById("input");
input.addEventListener("keypress", enter)

function enter(senden) {
    if (senden.key === "Enter") {
        senden.preventDefault();
        document.getElementById("btn").click();
    }
}
function openAnswer(btn)
{
    /*create iframe and set id as query string*/
    let id = btn.dataset.id;
    let popup = document.createElement('IFRAME');
    popup.setAttribute('id','iframe');
    popup.src = `answers.php?pid=${id}`;
    document.body.appendChild(popup);
    /*container blur*/
    let container = document.getElementById('containerid');
    container.style.filter = 'blur(5px)'
    container.style.pointerEvents = 'none';
    /*show the exit-button*/
    let exitbtn = document.getElementById('exit');
    exitbtn.style.visibility = 'visible';
}

let exitbtn = document.getElementById('exit');
exitbtn.addEventListener('click', closeanswer)
function closeanswer()
{
    // ToDo: Logik ändern remove statt hidden
    let popup = document.getElementById('iframe');
    popup.remove();
    document.getElementById('containerid').style.filter = 'none';
    document.getElementById('containerid').style.pointerEvents = 'auto';
    let exitbtn = document.getElementById('exit');
    exitbtn.style.visibility = 'hidden';
}

