function loadTable() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "http://localhost/ProjectCIT3514/api/read.php");
  xhttp.send();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      var trHTML = "";
      const objects = JSON.parse(this.responseText);
      for (let object of objects) {
        trHTML += "<tr>";
        trHTML += "<td>" + object["id"] + "</td>";
        trHTML +=
          '<td><img width="50px" src="' +
          object["photo"] +
          '" class="photo"></td>';
        trHTML += "<td>" + object["Name"] + "</td>";
        trHTML += "<td>" + object["details"] + "</td>";
        trHTML += "<td>" + object["province"] + "</td>";
        trHTML += "<td>" + object["latitude"] + "</td>";
        trHTML += "<td>" + object["longitude"] + "</td>";
        trHTML +=
          '<td><button type="button" class="btn btn-outline-secondary" onclick="showUserEditBox(' +
          object["id"] +
          ')">Edit</button>';
        trHTML +=
          '<button type="button" class="btn btn-outline-danger" onclick="userDelete(' +
          object["id"] +
          ')">Del</button></td>';
        trHTML += "</tr>";
      }
      document.getElementById("mytable").innerHTML = trHTML;
    }
  };
}
function showUserCreateBox() {
  Swal.fire({
    title: "Create user",
    html:
      '<div class="row">' +
      '<div class="col-12"><input id="id" type="hidden"></div>' +
      '<div class="col-12"><input id="Name" class="form-control my-2" placeholder="ชื่อสถานที่"></div>' +
      '<div class="col-12"><textarea id="details" class="form-control my-2" placeholder="รายละเอียด" rows="5"></textarea></div>' +
      '<div class="col-12"><input id="province" type="text" class="form-control my-2" placeholder="จังหวัด"></div>' +
      '<div class="col-12"><input id="photo" type="text" class="form-control my-2" placeholder="รูป" ></div>' +
      '<div class="col-12"><input id="latitude" type="text" class="form-control my-2" placeholder="ละติจูด"></div>' +
      '<div class="col-12"><input id="longitude" type="text" class="form-control my-2" placeholder="ลองติจูด"></div>' +
      "</div>",
    focusConfirm: false,
    preConfirm: () => {
      userCreate();
    },
  });
}

function userCreate() {
  const Name = document.getElementById("Name").value;
  const details = document.getElementById("details").value;
  const province = document.getElementById("province").value;
  const photo = document.getElementById("photo").value;
  const latitude = document.getElementById("latitude").value;
  const longitude = document.getElementById("longitude").value;

  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "http://localhost/ProjectCIT3514/api/create.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(
    JSON.stringify({
      Name: Name,
      details: details,
      province: province,
      photo: photo,
      latitude: latitude,
      longitude: longitude,
    })
  );
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const objects = JSON.parse(this.responseText);
      Swal.fire(objects["message"]);
      loadTable();
    }
  };
}
function showUserEditBox(id) {
  console.log(id);
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "http://localhost/ProjectCIT3514/api/readone.php?id=" + id);
  xhttp.send();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const objects = JSON.parse(this.responseText);
      // const user = objects["users"];
      console.log(objects);
      Swal.fire({
        title: "Edit User",
        html:
          '<div class="row">' +
          '<div class="col-12"><input id="id" type="hidden" value='+objects["id"]+'></div> ' +
          '<div class="col-12"><input id="Name" class="form-control my-2" placeholder="ชื่อสถานที่" value=' +
          objects["Name"] +
          '></div>' +
          '<div class="col-12"><textarea id="details" class="form-control my-2" placeholder="รายละเอียด" rows="5" ">' +objects["details"] +'</textarea></div>' +
          '<div class="col-12"><input id="province" type="text" class="form-control my-2" placeholder="จังหวัด" value=' +
          objects["province"] +
          '></div>' +
          '<div class="col-12"><input id="photo" type="text" class="form-control my-2" placeholder="รูป" value=' +
          objects["photo"] +
          '></div>' +
          '<div class="col-12"><input id="latitude" type="text" class="form-control my-2" placeholder="ละติจูด" value=' +
          objects["latitude"] +
          '></div>' +
          '<div class="col-12"><input id="longitude" type="text" class="form-control my-2" placeholder="ลองติจูด" value=' +
          objects["longitude"] +
          '></div>' +
          "</div>",
        focusConfirm: false,
        preConfirm: () => {
          userEdit();
        },
      });
    }
  };
}
////Edit
function userEdit() {
  const id = document.getElementById("id").value;
  const Name = document.getElementById("Name").value;
  const details = document.getElementById("details").value;
  const province = document.getElementById("province").value;
  const photo = document.getElementById("photo").value;
  const latitude = document.getElementById("latitude").value;
  const longitude = document.getElementById("longitude").value;

  const xhttp = new XMLHttpRequest();
  xhttp.open("PATCH", "http://localhost/ProjectCIT3514/api/update.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(
    JSON.stringify({
      "id": id,
      "Name": Name,
      "details": details,
      "province": province,
      "photo": photo,
      "latitude": latitude,
      "longitude": longitude
    })
    
  );
  // xhttp.send(JSON.stringify({ 
  //   "id": id, "fname": fname, "lname": lname, "username": username, "email": email, 
  //   "avatar": "https://www.mecallapi.com/users/cat.png"
  // }));
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const objects = JSON.parse(this.responseText);
      Swal.fire(objects["message"]);
      loadTable();
    }
  };
}
function userDelete(id) {
  const xhttp = new XMLHttpRequest();
  xhttp.open("DELETE", "http://localhost/ProjectCIT3514/api/delete.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(
    JSON.stringify({
      id: id,
    })
  );
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      const objects = JSON.parse(this.responseText);
      Swal.fire(objects["message"]);
      loadTable();
    }
  };
}
loadTable();
