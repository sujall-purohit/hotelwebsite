const feature_s_form = document.getElementById("feature_s_form");
const facility_s_form = document.getElementById("facility_s_form");

feature_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_feature();
});

function add_feature() {
  let data = new FormData();
  data.append("name", feature_s_form.elements["feature_name"].value);
  data.append("add_feature", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities.php", true);

  xhr.onload = function () {
    let modal = bootstrap.Modal.getOrCreateInstance(
      document.getElementById("feature-s"),
    );
    modal.hide();

    if (this.responseText == 1) {
      alert("success", "New Feature Added");
      feature_s_form.elements["feature_name"].value = "";
      get_feature();
    } else {
      alert("error", "Server error");
    }
  };

  xhr.send(data);
}

function get_features() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    document.getElementById("features-data").innerHTML = this.responseText;
  };

  xhr.send("get_features=1");
}

function rem_feature(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Feature Removed");
      get_features();
    } else if (this.responseText == "room_added") {
      alert("error", "Feature Is Added In Room");
    } else {
      alert("error", "Server Down");
    }
  };

  xhr.send("rem_feature=" + val);
}

facility_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_facility();
});

function add_facility() {
  let data = new FormData();
  data.append("name", facility_s_form.elements["facility_name"].value);
  data.append("icon", facility_s_form.elements["facility_icon"].files[0]);
  data.append("desc", facility_s_form.elements["facility_desc"].value);
  data.append("add_facility", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities.php", true);

  xhr.onload = function () {
    let modal = bootstrap.Modal.getOrCreateInstance(
      document.getElementById("facility-s"),
    );
    modal.hide();

    if (this.responseText == "inv_img") {
      alert("error", "Only SVG Images Are Allowed!");
    } else if (this.responseText == "inv_size") {
      alert("error", "Image must be less than 1MB");
    } else if (this.responseText == "upd_failed") {
      alert("error", "Image upload failed");
    } else {
      alert("success", "New Facility added");
      facility_s_form.reset();
      get_facilities();
    }
  };

  xhr.send(data);
}

function get_facilities() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    document.getElementById("facilities-data").innerHTML = this.responseText;
  };

  xhr.send("get_facilities=1");
}

function rem_facility(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Facility Removed");
      get_features();
    } else if (this.responseText == "room_added") {
      alert("error", "Facility Is Added In Room");
    } else {
      alert("error", "Server Down");
    }
  };

  xhr.send("rem_facility=" + val);
}

window.onload = function () {
  get_features();
  get_facilities();
};
