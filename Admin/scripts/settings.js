let general_data, contacts_data;

const site_title_inp = document.getElementById("site_title_inp");
const site_about_inp = document.getElementById("site_about_inp");

const general_s_form = document.getElementById("general_s_form");
const contacts_s_form = document.getElementById("contacts_s_form");

const team_s_form = document.getElementById("team_s_form");
const member_name_inp = document.getElementById("member_name_inp");
const member_picture_inp = document.getElementById("member_picture_inp");

general_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  upd_general(site_title_inp.value, site_about_inp.value);
});

contacts_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  upd_contacts();
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

/* ---------- GET GENERAL ---------- */
function get_general() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_curd.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    general_data = JSON.parse(this.responseText);

    site_title.innerText = general_data.site_title;
    site_about.innerText = general_data.site_about;

    site_title_inp.value = general_data.site_title;
    site_about_inp.value = general_data.site_about;

    shutdown_toggle.checked = general_data.shutdown == 1;
  };

  xhr.send("get_general=1");
}

/* ---------- UPDATE GENERAL ---------- */
function upd_general(title, about) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_curd.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    let modalEl = document.getElementById("general-s");
    let modal = bootstrap.Modal.getInstance(modalEl);

    if (modal) {
      modal.hide();
    }

    if (parseInt(this.responseText) >= 0) {
      alert("success", "Changes Saved!");
      get_general();
    } else {
      alert("error", "No Changes Made!");
    }
  };

  xhr.send(
    "site_title=" +
    encodeURIComponent(title) +
    "&site_about=" +
    encodeURIComponent(about) +
    "&upd_general=1",
  );
}

/* ---------- SHUTDOWN ---------- */
function upd_shutdown(isChecked) {
  let val = isChecked ? 1 : 0;

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_curd.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.responseText.trim() == "1") {
      alert(
        "success",
        val ? "Site has been Shutdown!" : "Shutdown mode Off!",
      );
    }
    get_general();
  };

  xhr.send("upd_shutdown=" + val);
}

/* ---------- GET CONTACTS ---------- */
function get_contacts() {
  let ids = ["address", "gmap", "pn1", "pn2", "email", "fb", "ins", "tw"];
  let iframe = document.getElementById("iframe");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_curd.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    contacts_data = JSON.parse(this.responseText);
    let data = Object.values(contacts_data);

    for (let i = 0; i < ids.length; i++) {
      document.getElementById(ids[i]).innerText = data[i + 1];
    }

    iframe.src = data[9];
    fill_contacts_inputs(data);
  };

  xhr.send("get_contacts=1");
}

function fill_contacts_inputs(data) {
  let inp_ids = [
    "address_inp",
    "gmap_inp",
    "pn1_inp",
    "pn2_inp",
    "email_inp",
    "fb_inp",
    "ins_inp",
    "tw_inp",
    "iframe_inp",
  ];

  for (let i = 0; i < inp_ids.length; i++) {
    document.getElementById(inp_ids[i]).value = data[i + 1];
  }
}

/* ---------- UPDATE CONTACTS ---------- */
function upd_contacts() {
  let index = [
    "address",
    "gmap",
    "pn1",
    "pn2",
    "email",
    "fb",
    "ins",
    "tw",
    "iframe",
  ];
  let inp_ids = [
    "address_inp",
    "gmap_inp",
    "pn1_inp",
    "pn2_inp",
    "email_inp",
    "fb_inp",
    "ins_inp",
    "tw_inp",
    "iframe_inp",
  ];

  let data_str = "";

  for (let i = 0; i < index.length; i++) {
    data_str +=
      index[i] +
      "=" +
      encodeURIComponent(document.getElementById(inp_ids[i]).value) +
      "&";
  }
  data_str += "upd_contacts=1";

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_curd.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    let modalEl = document.getElementById("contacts-s");
    let modal = bootstrap.Modal.getInstance(modalEl);

    if (modal) {
      modal.hide();
    }

    if (parseInt(this.responseText) >= 0) {
      alert("success", "Changes Saved!");
      get_contacts();
    } else {
      alert("error", "No Changes Made!");
    }
  };

  xhr.send(data_str);
}

function add_member() {
  let data = new FormData();
  data.append("member_name", member_name_inp.value);
  data.append("member_picture", member_picture_inp.files[0]);
  data.append("add_member", "1");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_curd.php", true);

  xhr.onload = function () {
    let modal = bootstrap.Modal.getOrCreateInstance(
      document.getElementById("team-s"),
    );
    modal.hide();

    if (this.responseText == "inv_img") {
      alert("error", "Only JPG And PNG Images Are Allowed!");
    } else if (this.responseText == "inv_size") {
      alert("error", "Image must be less than 2MB");
    } else if (this.responseText == "upd_failed") {
      alert("error", "Image upload failed");
    } else if (this.responseText == "1") {
      alert("success", "New member added");
      member_name_inp.value = "";
      member_picture_inp.value = "";
      get_member();
    } else {
      alert("error", "Server error");
    }
  };

  xhr.send(data);
}

function get_member() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_curd.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    document.getElementById("team-data").innerHTML = this.responseText;
  };

  xhr.send("get_member=1");
}

function rem_member(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_curd.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Member Removed");
      get_member();
    } else {
      alert("error", "Server Down");
    }
  };

  xhr.send("rem_member=" + val);
}

team_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_member();
});

/* ---------- ON LOAD ---------- */
window.onload = function () {
  get_general();
  get_contacts();
  get_member();
};
