function updateValue(id){
    window.location = "?menu=catu&cid=" +id;
}
function deleteValue(id){
    let confirmation = window.confirm("Are you sure want to delete?");
    if(confirmation){
        window.location = "?menu=cat&cmd=del&cid=" + id;
    }
}

function ubahValue(id){
    window.location = "?menu=buku&cod=" +id;
}
function hapusValue(id){
    let confirmation = window.confirm("Are you sure want to delete?");
    if(confirmation){
        window.location = "?menu=book&cad=del&cod=" + id;
    }
}