
        let add_room_form = document.getElementById('add_room_form');

        add_room_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_room();
        });


        function add_room() {
            let data = new FormData();
            data.append("add_room", "");
            data.append("name", add_room_form.elements["name"].value);
            data.append("area", add_room_form.elements["area"].value);
            data.append("price", add_room_form.elements["price"].value);
            data.append("quantity", add_room_form.elements["quantity"].value);
            data.append("adult", add_room_form.elements["adult"].value);
            data.append("children", add_room_form.elements["children"].value);
            data.append("desc", add_room_form.elements["desc"].value);

            let features = [];
            // UPDATED SELECTOR
            add_room_form.querySelectorAll('input[name="features"]:checked').forEach(el => {
                features.push(el.value);
            });

            let facilities = [];
            // UPDATED SELECTOR
            add_room_form.querySelectorAll('input[name="facilities"]:checked').forEach(el => {
                facilities.push(el.value);
            });

            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('add-room');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', 'New Room Added!');
                    add_room_form.reset();
                    get_all_rooms();
                } else {
                    alert('error', 'Server Error!');
                }
            }
            xhr.send(data);
        }


        function get_all_rooms() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                document.getElementById('room-data').innerHTML = this.responseText;
            }
            // Fixed: Added =1 to ensure isset($_POST['get_all_rooms']) returns true
            xhr.send('get_all_rooms=1');
        }

        function toggle_status(id, val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert('success', 'Status Toggled');
                    get_all_rooms();
                } else {
                    alert('error', 'Server Down');
                }
            }
            xhr.send('toggle_status=' + id + '&value=' + val);

        }

        let edit_room_form = document.getElementById('edit_room_form');
        edit_room_form.addEventListener('submit', function(e) {
            e.preventDefault();
            submit_edit_room();
        });

        function submit_edit_room() {
            let data = new FormData();
            data.append("edit_room", "");
            data.append("room_id", edit_room_form.elements['room_id'].value);
            data.append("name", edit_room_form.elements["name"].value);
            data.append("area", edit_room_form.elements["area"].value);
            data.append("price", edit_room_form.elements["price"].value);
            data.append("quantity", edit_room_form.elements["quantity"].value);
            data.append("adult", edit_room_form.elements["adult"].value);
            data.append("children", edit_room_form.elements["children"].value);
            data.append("desc", edit_room_form.elements["desc"].value);

            let features = [];
            edit_room_form.querySelectorAll('input[name="features"]:checked')
                .forEach(el => features.push(el.value));

            let facilities = [];
            edit_room_form.querySelectorAll('input[name="facilities"]:checked')
                .forEach(el => facilities.push(el.value));

            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                let myModal = document.getElementById('edit-room');
                let modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', 'Room Data Edited!');
                    edit_room_form.reset();
                    get_all_rooms();
                } else {
                    alert('error', 'Server Error!');
                }
            };

            xhr.send(data);
        }

        function edit_details(id) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                let data = JSON.parse(this.responseText);

                edit_room_form.elements['name'].value = data.roomdata.name;
                edit_room_form.elements['area'].value = data.roomdata.area;
                edit_room_form.elements['price'].value = data.roomdata.price;
                edit_room_form.elements['quantity'].value = data.roomdata.quantity;
                edit_room_form.elements['adult'].value = data.roomdata.adult;
                edit_room_form.elements['children'].value = data.roomdata.children;

                // Fixed: Ensure key matches your database column name (usually 'desc' or 'description')
                edit_room_form.elements['desc'].value = data.roomdata.desc;
                edit_room_form.elements['room_id'].value = data.roomdata.id;

                // FIX: Use == instead of includes for looser type matching
                edit_room_form.querySelectorAll('input[name="facilities"]').forEach(el => {
                    el.checked = data.facilities.some(f_id => f_id == el.value);
                });

                edit_room_form.querySelectorAll('input[name="features"]').forEach(el => {
                    el.checked = data.features.some(feat_id => feat_id == el.value);
                });
            };

            xhr.send('get_room=' + id);
        }

        let add_image_form = document.getElementById('add_image_form');

        add_image_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_image();
        });

        function add_image() {
            let data = new FormData();
            data.append("image", add_image_form.elements['image'].files[0]);
            data.append("room_id", add_image_form.elements['room_id'].value);
            data.append("add_image", "1");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {

                if (this.responseText == "inv_img") {
                    alert("error", "Only JPG And PNG Images Are Allowed!", "image-alert");
                } else if (this.responseText == "inv_size") {
                    alert("error", "Image must be less than 2MB", "image-alert");
                } else if (this.responseText == "upd_failed") {
                    alert("error", "Image upload failed", "image-alert");
                } else if (this.responseText == "1") {
                    add_image_form.reset();
                    room_images(add_image_form.elements['room_id'].value, document.querySelector('#room-images .modal-title').innerText);
                    alert("success", "New Image Added", "image-alert");
                } else {
                    alert("error", "Server error");
                }
            };

            xhr.send(data);
        }

        function room_images(id, rname) {
            document.querySelector('#room-images .modal-title').innerText = rname;
            add_image_form.elements['room_id'].value = id;
            add_image_form.elements['image'].value = '';

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                document.getElementById('room-image-data').innerHTML = this.responseText;
            }
            xhr.send('get_room_images=' + id);
        }

        function rem_image(img_id, room_id) {
            let data = new FormData();
            data.append("image_id", img_id);
            data.append("room_id", room_id);
            data.append("rem_image", "1");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {

                if (this.responseText == 1) {
                    alert("success", "Image Removed", "image-alert");
                    room_images(room_id, document.querySelector('#room-images .modal-title').innerText);
                } else {
                    alert("error", "Image Removel failed", "image-alert");
                }
            };

            xhr.send(data);

        }


        function thumb_image(img_id, room_id) {
            let data = new FormData();
            data.append("image_id", img_id);
            data.append("room_id", room_id);
            data.append("thumb_image", "1");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {

                if (this.responseText == 1) {
                    alert("success", "Thumbnail Changed", "image-alert");
                    room_images(room_id, document.querySelector('#room-images .modal-title').innerText);
                } else {
                    alert("error", "Failed", "image-alert");
                }
            };

            xhr.send(data);

        }

        function remove_room(room_id) {
            if (!confirm("Are You Sure You Want To Delete This Room?")) return;

            let data = new FormData();
            data.append("room_id", room_id);
            data.append("remove_room", "1");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("success", "Room Removed");
                    get_all_rooms();
                } else {
                    alert("error", "Failed");
                }
            };

            xhr.send(data);
        }


        window.onload = function() {
            get_all_rooms();
        }