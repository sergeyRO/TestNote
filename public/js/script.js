/**
 * Created by Fear on 29.08.2024.
 */
function alert_mess(typeMess,textMess) {
    var el = document.getElementById("alert");
    el.style.display='block';
    el.innerHTML=textMess;

    if(typeMess=='update' || typeMess=='add') {
        el.classList.add('alert-success');
    }
    else if (typeMess=='error'){
            el.classList.add('alert-danger');
        }

    setTimeout(function() {
        el.style.display='none';

        el.classList.remove('alert-success');
        el.classList.remove('alert-danger');
    }, 2000);
}

function noteAttr(token, title, content) {
    const note = {
        title: title,
        content: content,
        _token: token
    };
    return note;
}

function updateNote(id) {
    var title = document.getElementById("titleUpdate"+id).value;
    var content = document.getElementById("contentUpdate"+id).value;
    var token = document.getElementById("token").value;

    note = noteAttr(token, title, content);

    const req = new XMLHttpRequest();
    req.open('PUT', '/notes/'+id);
    req.setRequestHeader("Content-Type", "application/json");
    req.addEventListener('load', function() {
        if (req.readyState === 4 && req.status === 200) {
            const res = JSON.parse(req.responseText);

            textMess = 'Заметка с Id='+res.id+' обновлена';
            alert_mess('update',textMess);

        } else {
            alert_mess('error','Request error')
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
        if (req.readyState === 4 && req.status === 201) {
            const res = JSON.parse(req.responseText);

            textMess = 'Заметка с Id='+res.id+' создана';
            alert_mess('add',textMess);

            var tr = document.createElement("tr");

            var thId = document.createElement("th");
            thId.innerHTML = res.id;

            var tdTitle = document.createElement("td");
            tdTitle.innerHTML = '<input type="text" id="titleUpdate'+res.id+'" value="'+res.title+'">';

            var tdContent = document.createElement("td");
            tdContent.innerHTML = '<input type="text" id="contentUpdate'+res.id+'" value="'+res.content+'">';

            var tdAction = document.createElement("td");
            tdAction.innerHTML = '<button onclick="updateNote('+res.id+')">Сохранить изменения</button>';

            tr.appendChild(thId);
            tr.appendChild(tdTitle);
            tr.appendChild(tdContent);
            tr.appendChild(tdAction);
            var tbody = document.getElementById("tableNotes");
            tbody.appendChild(tr);
        } else {
            alert_mess('error','Request error')
        }
    });
    req.send(JSON.stringify(note));
}