<style>
    .custom-alert-box {
        border: none;
        border-radius: 14px;
        padding: 16px 20px;
        animation: slideDown .4s ease;
    }

    @keyframes slideDown {

        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function alert(type, msg, position = "body") {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');

        element.innerHTML = `
<div class="alert ${bs_class} alert-dismissible fade show shadow custom-alert-box" role="alert">

    <strong class="me-3">${msg}</strong>

    <button type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close">
    </button>

</div>
`;
        if (position == "body") {
            document.body.append(element);
            element.classList.add('custom-alert')
        } else {
            document.getElementById(position).appendChild(element);
        }
        setTimeout(remAlert, 2500);
    }

    function remAlert() {

        let alert = document.getElementsByClassName('alert')[0];

        if (alert) {
            alert.remove();
        }

    }
</script>


<script>
    function setActive() {
        let navbar = document.getElementById('dashboard-menu');
        let a_tags = navbar.getElementsByTagName('a');

        for (let i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();

            let current_file =
                window.location.pathname.split('/').pop();

            if (current_file == file) {
                a_tags[i].classList.add('active');
            }
        }
    }
    setActive();
</script>