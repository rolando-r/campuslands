let myHeader = new Headers({ "Content-Type": "application/json; charset:utf8" });
let myform = document.querySelector("#frmDataRegion");
let idBorrar;
document.addEventListener('DOMContentLoaded', (e) => {

});

myform.addEventListener("submit", async (e) => {
    e.preventDefault();
    let data = Object.fromEntries(new FormData(e.target));
    postData(data).then(r => {
        document.querySelector("pre").innerHTML = r;
    });
})

const postData = async (data) => {
    let config = {
        method: "POST",
        headers: myHeader,
        body: JSON.stringify(data)
    };
    let res = await (await fetch("controllers/Region/insert_data.php", config)).json();
    return res;
}
const borrarData = async (id) => {
    let config = {
        method: "DELETE",
    };
    let res = await (await fetch(`controllers/Region/delete_data.php?${id}`, config)).text();
    return res;
}
const loadAllData = async () => {
    let res = await (await fetch("controllers/Region/select_data.php")).json();
    return res;
}

export {
    postData
}