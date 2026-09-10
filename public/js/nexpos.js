/* ============================================================
   NEXPOS JAVASCRIPT
   Global UI Only
============================================================ */

document.addEventListener("DOMContentLoaded", function () {

    const app =
        document.querySelector(".nexpos-app");

    const sidebar =
        document.getElementById("sidebar");

    const overlay =
        document.getElementById("mobileOverlay");

    const collapseButton =
        document.getElementById(
            "collapseSidebarButton"
        );

    const mobileMenuButton =
        document.getElementById(
            "mobileMenuButton"
        );


    /* =========================================================
       CLOSE MOBILE MENU
    ========================================================= */

    function closeMobileMenu() {

        if (!sidebar || !overlay) {
            return;
        }

        sidebar.classList.remove(
            "mobile-open"
        );

        overlay.classList.remove(
            "active"
        );
    }


    /* =========================================================
       RESTORE SIDEBAR
    ========================================================= */

    if (
        app &&
        window.innerWidth > 950 &&
        localStorage.getItem(
            "nexpos-sidebar-collapsed"
        ) === "1"
    ) {

        app.classList.add(
            "sidebar-collapsed"
        );
    }


    /* =========================================================
       COLLAPSE SIDEBAR
    ========================================================= */

    if (collapseButton) {

        collapseButton.addEventListener(
            "click",
            function () {

                if (window.innerWidth <= 950) {

                    closeMobileMenu();

                    return;
                }

                if (!app) {
                    return;
                }

                app.classList.toggle(
                    "sidebar-collapsed"
                );

                const collapsed =
                    app.classList.contains(
                        "sidebar-collapsed"
                    );

                localStorage.setItem(
                    "nexpos-sidebar-collapsed",
                    collapsed ? "1" : "0"
                );

                collapseButton.setAttribute(
                    "aria-expanded",
                    collapsed ? "false" : "true"
                );

            }
        );
    }


    /* =========================================================
       MOBILE MENU
    ========================================================= */

    if (mobileMenuButton) {

        mobileMenuButton.addEventListener(
            "click",
            function () {

                if (!sidebar || !overlay) {
                    return;
                }

                sidebar.classList.add(
                    "mobile-open"
                );

                overlay.classList.add(
                    "active"
                );

            }
        );
    }


    /* =========================================================
       MOBILE OVERLAY
    ========================================================= */

    if (overlay) {

        overlay.addEventListener(
            "click",
            closeMobileMenu
        );

    }


    /* =========================================================
       CLOSE SIDEBAR AFTER NAVIGATION
    ========================================================= */

    if (sidebar) {

        sidebar
            .querySelectorAll(".nav-item")
            .forEach(function (link) {

                link.addEventListener(
                    "click",
                    closeMobileMenu
                );

            });

    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    window.addEventListener(
        "resize",
        function () {

            if (window.innerWidth > 950) {

                closeMobileMenu();

            }

        }
    );

});