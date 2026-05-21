const carousel_s_form = document.getElementById("carousel_s_form");
const carousel_picture_inp = document.getElementById("carousel_picture_inp");

carousel_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_image();
});

/* ---------- ALERT ---------- */
function alert(type, msg) {
  let bs_class = type === "success" ? "alert-success" : "alert-danger";

  let alertBox = document.createElement("div");
  alertBox.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;

  document.body.append(alertBox);
  setTimeout(() => alertBox.remove(), 3000);
}

function add_image() {
  let data = new FormData();
  data.append("carousel_picture", carousel_picture_inp.files[0]);
  data.append("add_image", "1");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/carousel_curd.php", true);

  xhr.onload = function () {
    let modal = bootstrap.Modal.getOrCreateInstance(
      document.getElementById("carousel-s"),
    );
    modal.hide();

    if (this.responseText == "inv_img") {
      alert("error", "Only JPG And PNG Images Are Allowed!");
    } else if (this.responseText == "inv_size") {
      alert("error", "Image must be less than 2MB");
    } else if (this.responseText == "upd_failed") {
      alert("error", "Image upload failed");
    } else if (this.responseText == "1") {
      alert("success", "New Image Added");
      carousel_picture_inp.value = "";
      get_carousel();
    } else {
      alert("error", "Server error");
    }
  };

  xhr.send(data);
}

function get_carousel() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/carousel_curd.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    document.getElementById("carousel-data").innerHTML = this.responseText;
  };

  xhr.send("get_carousel=1");
}

function rem_image(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/carousel_curd.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Image Removed");
      get_carousel();
    } else {
      alert("error", "Server Down");
    }
  };

  xhr.send("rem_image=" + val);
}

/* ---------- ON LOAD ---------- */
window.onload = function () {
  get_carousel();
};
