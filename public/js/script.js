/**
 * Created by Fear on 29.08.2024.
 */
function noteAttr(token, title, content) {
    const note = {
        title: title,
        content: content,
        _token: token
    };
    return note;
}

function updateNote(id) {
    var title = document.getElementById("titleUpdate").value;
    var content = document.getElementById("contentUpdate").value;
    var token = document.getElementById("token").value;

    note = noteAttr(token, title, content);

    const req = new XMLHttpRequest();
    req.open('PUT', '/notes/'+id);
    req.setRequestHeader("Content-Type", "application/json");
    req.addEventListener('load', function() {
        console.log(req);
        if (req.readyState === 4 && req.status === 200) {
            const res = JSON.parse(req.responseText);
            console.log(res);
        } else {
            console.log("Request error");
        }
    });
    req.send(JSON.stringify(note));
}

function createNote(){
    var title = document.getElementById("titleAdd").value;
    var content = document.getElementById("contentAdd").value;
    var token = document.getElementById("token").value;

    note = noteAttr(token, title, content);

    const req = new XMLHttpRequest();
    req.open('POST', '/notes');
    req.setRequestHeader("Content-Type", "application/json");
    req.addEventListener('load', function() {
        console.log(req);
        if (req.readyState === 4 && req.status === 200) {
            const res = JSON.parse(req.responseText);
            console.log(res);
        } else {
            console.log("Request error");
        }
    });
    req.send(JSON.stringify(note));
}