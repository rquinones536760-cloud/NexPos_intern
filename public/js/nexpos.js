/* ============================================================
   NEXPOS JAVASCRIPT
   No Vite / No Modules
============================================================ */

document.addEventListener("DOMContentLoaded", function () {

    /*
    |--------------------------------------------------------------------------
    | SIDEBAR
    |--------------------------------------------------------------------------
    */

    const app = document.querySelector(".nexpos-app");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("mobileOverlay");

    const collapseButton =
        document.getElementById("collapseSidebar");

    const collapseIcon =
        document.getElementById("collapseIcon");

    const mobileMenuButton =
        document.getElementById("mobileMenuButton");


    function updateCollapseIcon() {

        if (!app || !collapseIcon) {
            return;
        }

        if (app.classList.contains("sidebar-collapsed")) {
            collapseIcon.textContent = "›";
        } else {
            collapseIcon.textContent = "‹";
        }
    }


    function closeMobileMenu() {

        if (!sidebar || !overlay) {
            return;
        }

        sidebar.classList.remove("mobile-open");
        overlay.classList.remove("active");
    }


    /*
    |--------------------------------------------------------------------------
    | Restore Sidebar State
    |--------------------------------------------------------------------------
    */

    if (
        app &&
        window.innerWidth > 950 &&
        localStorage.getItem("nexpos-sidebar-collapsed") === "1"
    ) {
        app.classList.add("sidebar-collapsed");
    }

    updateCollapseIcon();


    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    */

    if (collapseButton) {

        collapseButton.addEventListener("click", function () {

            if (window.innerWidth <= 950) {
                return;
            }

            app.classList.toggle("sidebar-collapsed");

            if (
                app.classList.contains("sidebar-collapsed")
            ) {
                localStorage.setItem(
                    "nexpos-sidebar-collapsed",
                    "1"
                );
            } else {
                localStorage.setItem(
                    "nexpos-sidebar-collapsed",
                    "0"
                );
            }

            updateCollapseIcon();
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Mobile Menu
    |--------------------------------------------------------------------------
    */

    if (mobileMenuButton) {

        mobileMenuButton.addEventListener(
            "click",
            function () {

                if (!sidebar || !overlay) {
                    return;
                }

                sidebar.classList.add("mobile-open");
                overlay.classList.add("active");
            }
        );
    }


    if (overlay) {
        overlay.addEventListener(
            "click",
            closeMobileMenu
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Close Mobile Menu After Navigation
    |--------------------------------------------------------------------------
    */

    if (sidebar) {

        const navLinks =
            sidebar.querySelectorAll(".nav-item");

        navLinks.forEach(function (link) {

            link.addEventListener(
                "click",
                closeMobileMenu
            );

        });
    }


    /*
    |--------------------------------------------------------------------------
    | Resize
    |--------------------------------------------------------------------------
    */

    window.addEventListener("resize", function () {

        if (window.innerWidth > 950) {
            closeMobileMenu();
        }

        updateCollapseIcon();
    });


    /*
    |--------------------------------------------------------------------------
    | POS
    |--------------------------------------------------------------------------
    */

    const productSearch =
        document.getElementById("productSearch");

    /*
     * If we are not on the POS page,
     * stop here.
     */
    if (!productSearch) {
        return;
    }


    const productCards =
        Array.from(
            document.querySelectorAll(".product-card")
        );

    const productGrid =
        document.getElementById("productGrid");

    const productCount =
        document.getElementById("productCount");

    const noProducts =
        document.getElementById("noProducts");

    const cartItems =
        document.getElementById("cartItems");

    const cartCount =
        document.getElementById("cartCount");

    const subtotalElement =
        document.getElementById("subtotal");

    const taxElement =
        document.getElementById("tax");

    const totalElement =
        document.getElementById("total");

    const checkoutButton =
        document.getElementById("checkoutButton");

    const clearButton =
        document.getElementById("clearButton");

    const holdButton =
        document.getElementById("holdButton");

    const scanButton =
        document.getElementById("scanButton");


    let cart = [];

    let selectedPayment = "cash";


    /*
    |--------------------------------------------------------------------------
    | Money Formatter
    |--------------------------------------------------------------------------
    */

    function money(value) {

        return new Intl.NumberFormat(
            "en-PH",
            {
                style: "currency",
                currency: "PHP",
                minimumFractionDigits: 2
            }
        ).format(value);

    }


    /*
    |--------------------------------------------------------------------------
    | Render Cart
    |--------------------------------------------------------------------------
    */

    function renderCart() {

        if (!cartItems) {
            return;
        }

        cartItems.innerHTML = "";


        /*
        | Empty Cart
        */

        if (cart.length === 0) {

            const empty = document.createElement("div");

            empty.className = "empty-cart";

            empty.innerHTML = `
                <div>🛒</div>
                <strong>Your cart is empty</strong>
                <p>Select a product to begin a sale.</p>
            `;

            cartItems.appendChild(empty);

        } else {

            /*
            | Cart Items
            */

            cart.forEach(function (item, index) {

                const row =
                    document.createElement("div");

                row.className = "cart-item";


                const top =
                    document.createElement("div");

                top.className = "cart-item-top";


                const name =
                    document.createElement("span");

                name.className = "cart-item-name";

                name.textContent = item.name;


                const price =
                    document.createElement("span");

                price.className = "cart-item-price";

                price.textContent =
                    money(item.price * item.quantity);


                top.appendChild(name);
                top.appendChild(price);


                const bottom =
                    document.createElement("div");

                bottom.className = "cart-item-bottom";


                /*
                | Quantity
                */

                const quantity =
                    document.createElement("div");

                quantity.className =
                    "quantity-control";


                const minus =
                    document.createElement("button");

                minus.type = "button";

                minus.textContent = "−";

                minus.setAttribute(
                    "aria-label",
                    "Decrease quantity"
                );


                minus.addEventListener(
                    "click",
                    function () {

                        changeQuantity(
                            index,
                            -1
                        );

                    }
                );


                const quantityNumber =
                    document.createElement("span");

                quantityNumber.textContent =
                    item.quantity;


                const plus =
                    document.createElement("button");

                plus.type = "button";

                plus.textContent = "+";

                plus.setAttribute(
                    "aria-label",
                    "Increase quantity"
                );


                plus.addEventListener(
                    "click",
                    function () {

                        changeQuantity(
                            index,
                            1
                        );

                    }
                );


                quantity.appendChild(minus);
                quantity.appendChild(quantityNumber);
                quantity.appendChild(plus);


                /*
                | Remove
                */

                const remove =
                    document.createElement("button");

                remove.type = "button";

                remove.className = "remove-item";

                remove.textContent = "Remove";


                remove.addEventListener(
                    "click",
                    function () {

                        cart.splice(index, 1);

                        renderCart();

                    }
                );


                bottom.appendChild(quantity);
                bottom.appendChild(remove);


                row.appendChild(top);
                row.appendChild(bottom);

                cartItems.appendChild(row);

            });

        }


        updateTotals();

    }


    /*
    |--------------------------------------------------------------------------
    | Change Quantity
    |--------------------------------------------------------------------------
    */

    function changeQuantity(index, amount) {

        if (!cart[index]) {
            return;
        }

        const item = cart[index];

        const maxStock =
            Number(item.stock);


        const newQuantity =
            item.quantity + amount;


        if (newQuantity <= 0) {

            cart.splice(index, 1);

        } else if (
            newQuantity <= maxStock
        ) {

            item.quantity = newQuantity;

        } else {

            alert(
                "You cannot add more than the available stock."
            );

        }


        renderCart();

    }


    /*
    |--------------------------------------------------------------------------
    | Add Product
    |--------------------------------------------------------------------------
    */

    function addProduct(card) {

        const name =
            card.dataset.name || "Product";

        const price =
            Number(card.dataset.price || 0);

        const stock =
            Number(card.dataset.stock || 0);


        if (stock <= 0) {

            alert(
                name + " is currently out of stock."
            );

            return;
        }


        const existing =
            cart.find(function (item) {
                return item.name === name;
            });


        if (existing) {

            if (
                existing.quantity >=
                existing.stock
            ) {

                alert(
                    "You have reached the available stock for " +
                    name +
                    "."
                );

                return;
            }

            existing.quantity++;

        } else {

            cart.push({
                name: name,
                price: price,
                stock: stock,
                quantity: 1
            });

        }


        renderCart();

    }


    /*
    |--------------------------------------------------------------------------
    | Product Click
    |--------------------------------------------------------------------------
    */

    productCards.forEach(function (card) {

        card.addEventListener(
            "click",
            function () {
                addProduct(card);
            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | Search + Category
    |--------------------------------------------------------------------------
    */

    const categoryButtons =
        document.querySelectorAll(
            ".category-btn"
        );

    let selectedCategory = "all";


    function filterProducts() {

        const search =
            productSearch.value
                .trim()
                .toLowerCase();


        let visible = 0;


        productCards.forEach(function (card) {

            const name =
                (card.dataset.name || "")
                    .toLowerCase();

            const category =
                (card.dataset.category || "")
                    .toLowerCase();


            const matchesSearch =
                name.includes(search);

            const matchesCategory =
                selectedCategory === "all" ||
                category === selectedCategory;


            const shouldShow =
                matchesSearch &&
                matchesCategory;


            if (shouldShow) {

                card.classList.remove(
                    "is-hidden"
                );

                visible++;

            } else {

                card.classList.add(
                    "is-hidden"
                );

            }

        });


        if (productCount) {

            productCount.textContent =
                visible +
                (visible === 1
                    ? " product"
                    : " products");

        }


        if (noProducts) {

            noProducts.hidden =
                visible !== 0;

        }

    }


    productSearch.addEventListener(
        "input",
        filterProducts
    );


    categoryButtons.forEach(
        function (button) {

            button.addEventListener(
                "click",
                function () {

                    categoryButtons.forEach(
                        function (item) {
                            item.classList.remove(
                                "active"
                            );
                        }
                    );


                    button.classList.add("active");


                    selectedCategory =
                        button.dataset.category ||
                        "all";


                    filterProducts();

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Payment Methods
    |--------------------------------------------------------------------------
    */

    const paymentButtons =
        document.querySelectorAll(
            ".payment-method"
        );


    paymentButtons.forEach(
        function (button) {

            button.addEventListener(
                "click",
                function () {

                    paymentButtons.forEach(
                        function (item) {
                            item.classList.remove(
                                "active"
                            );
                        }
                    );


                    button.classList.add(
                        "active"
                    );


                    selectedPayment =
                        button.dataset.payment ||
                        "cash";

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Update Totals
    |--------------------------------------------------------------------------
    */

    function updateTotals() {

        let subtotal = 0;


        cart.forEach(function (item) {

            subtotal +=
                item.price *
                item.quantity;

        });


        const tax =
            subtotal * 0.12;

        const total =
            subtotal + tax;


        if (subtotalElement) {
            subtotalElement.textContent =
                money(subtotal);
        }


        if (taxElement) {
            taxElement.textContent =
                money(tax);
        }


        if (totalElement) {
            totalElement.textContent =
                money(total);
        }


        if (cartCount) {

            const totalItems =
                cart.reduce(
                    function (sum, item) {
                        return sum + item.quantity;
                    },
                    0
                );


            cartCount.textContent =
                totalItems +
                (
                    totalItems === 1
                        ? " Item"
                        : " Items"
                );
        }


        if (checkoutButton) {

            checkoutButton.disabled =
                cart.length === 0;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Clear Cart
    |--------------------------------------------------------------------------
    */

    if (clearButton) {

        clearButton.addEventListener(
            "click",
            function () {

                if (cart.length === 0) {
                    return;
                }


                const confirmed =
                    confirm(
                        "Are you sure you want to clear the cart?"
                    );


                if (!confirmed) {
                    return;
                }


                cart = [];

                renderCart();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Hold Order
    |--------------------------------------------------------------------------
    */

    if (holdButton) {

        holdButton.addEventListener(
            "click",
            function () {

                if (cart.length === 0) {

                    alert(
                        "There are no items to hold."
                    );

                    return;
                }


                alert(
                    "Order has been placed on hold."
                );

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Checkout
    |--------------------------------------------------------------------------
    */

    if (checkoutButton) {

        checkoutButton.addEventListener(
            "click",
            function () {

                if (cart.length === 0) {
                    return;
                }


                const total =
                    cart.reduce(
                        function (sum, item) {
                            return (
                                sum +
                                item.price *
                                item.quantity
                            );
                        },
                        0
                    );


                const tax =
                    total * 0.12;

                const grandTotal =
                    total + tax;


                const confirmed =
                    confirm(
                        "Complete this sale?\n\n" +
                        "Payment: " +
                        selectedPayment.toUpperCase() +
                        "\n" +
                        "Total: " +
                        money(grandTotal)
                    );


                if (!confirmed) {
                    return;
                }


                alert(
                    "Sale completed successfully!"
                );


                cart = [];

                renderCart();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Scan Barcode
    |--------------------------------------------------------------------------
    */

    if (scanButton) {

        scanButton.addEventListener(
            "click",
            function () {

                alert(
                    "Barcode scanner integration can be connected here."
                );

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Initial POS Render
    |--------------------------------------------------------------------------
    */

    renderCart();

    filterProducts();

});