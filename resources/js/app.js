/* ============================================================
   NEXPOS JAVASCRIPT
   Professional POS
   No Vite / No Modules
============================================================ */

document.addEventListener("DOMContentLoaded", function () {

    /* =========================================================
       SIDEBAR
    ========================================================= */

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
       CLOSE AFTER NAVIGATION
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
       POS
    ========================================================= */

    const productSearch =
        document.getElementById(
            "productSearch"
        );


    if (!productSearch) {
        return;
    }


    const productCards =
        Array.from(
            document.querySelectorAll(
                ".product-card"
            )
        );


    const productCount =
        document.getElementById(
            "productCount"
        );


    const noProducts =
        document.getElementById(
            "noProducts"
        );


    const cartItems =
        document.getElementById(
            "cartItems"
        );


    const cartCount =
        document.getElementById(
            "cartCount"
        );


    const subtotalElement =
        document.getElementById(
            "subtotal"
        );


    const taxElement =
        document.getElementById(
            "tax"
        );


    const totalElement =
        document.getElementById(
            "total"
        );


    const checkoutButton =
        document.getElementById(
            "checkoutButton"
        );


    const clearButton =
        document.getElementById(
            "clearButton"
        );


    const holdButton =
        document.getElementById(
            "holdButton"
        );


    const scanButton =
        document.getElementById(
            "scanButton"
        );


    const categoryButtons =
        document.querySelectorAll(
            ".category-btn"
        );


    const paymentButtons =
        document.querySelectorAll(
            ".payment-method"
        );


    let cart = [];

    let selectedPayment =
        "cash";

    let selectedCategory =
        "all";


    /* =========================================================
       MONEY
    ========================================================= */

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


    /* =========================================================
       INVOICE MODAL
    ========================================================= */

    function createInvoiceModal(data) {

        const oldModal =
            document.getElementById(
                "invoiceModal"
            );


        if (oldModal) {
            oldModal.remove();
        }


        const modal =
            document.createElement(
                "div"
            );


        modal.id =
            "invoiceModal";


        modal.className =
            "invoice-modal";


        const itemsHtml =
            data.items.map(
                function (item) {

                    return `
                        <div class="invoice-item">
                            <div>
                                <strong>
                                    ${escapeHtml(item.product_name)}
                                </strong>

                                <small>
                                    ${item.quantity} × ${money(item.price)}
                                </small>
                            </div>

                            <strong>
                                ${money(item.subtotal)}
                            </strong>
                        </div>
                    `;

                }
            ).join("");


        modal.innerHTML = `

            <div class="invoice-backdrop"></div>

            <div class="invoice-dialog">

                <div class="invoice-header">

                    <div class="invoice-brand">
                        <img
                            src="/images/NexPOSLogo.png"
                            alt="NexPOS"
                        >

                        <div>
                            <strong>NexPOS</strong>

                            <span>
                                Point of Sale System
                            </span>
                        </div>
                    </div>


                    <button
                        type="button"
                        class="invoice-close"
                        id="closeInvoiceButton"
                        aria-label="Close invoice"
                    >
                        ×
                    </button>

                </div>


                <div class="invoice-success">

                    <div class="invoice-check">
                        ✓
                    </div>

                    <h2>
                        Sale Completed
                    </h2>

                    <p>
                        Transaction successfully recorded.
                    </p>

                </div>


                <div class="invoice-number-box">

                    <span>
                        INVOICE NUMBER
                    </span>

                    <strong>
                        ${escapeHtml(data.invoice_number)}
                    </strong>

                </div>


                <div class="invoice-info">

                    <div>
                        <span>Date</span>

                        <strong>
                            ${escapeHtml(data.date)}
                        </strong>
                    </div>


                    <div>
                        <span>Payment</span>

                        <strong>
                            ${escapeHtml(
                                String(data.payment_method)
                                    .charAt(0)
                                    .toUpperCase() +
                                String(data.payment_method)
                                    .slice(1)
                            )}
                        </strong>
                    </div>

                </div>


                <div class="invoice-items">

                    <div class="invoice-items-title">
                        <span>Items</span>
                        <span>Amount</span>
                    </div>

                    ${itemsHtml}

                </div>


                <div class="invoice-summary">

                    <div>
                        <span>Subtotal</span>

                        <strong>
                            ${money(data.subtotal)}
                        </strong>
                    </div>


                    <div>
                        <span>Tax (12%)</span>

                        <strong>
                            ${money(data.tax)}
                        </strong>
                    </div>


                    <div class="invoice-total">

                        <span>
                            TOTAL
                        </span>

                        <strong>
                            ${money(data.total)}
                        </strong>

                    </div>

                </div>


                <div class="invoice-actions">

                    <button
                        type="button"
                        class="secondary-button"
                        id="printInvoiceButton"
                    >
                        🖨 Print Receipt
                    </button>


                    <button
                        type="button"
                        class="primary-button"
                        id="doneInvoiceButton"
                    >
                        Done
                    </button>

                </div>

            </div>
        `;


        document.body.appendChild(
            modal
        );


        /*
        |--------------------------------------------------------------------------
        | CLOSE
        |--------------------------------------------------------------------------
        */

        const closeButton =
            document.getElementById(
                "closeInvoiceButton"
            );


        const doneButton =
            document.getElementById(
                "doneInvoiceButton"
            );


        const backdrop =
            modal.querySelector(
                ".invoice-backdrop"
            );


        function closeInvoice() {

            modal.classList.remove(
                "show"
            );


            setTimeout(
                function () {

                    modal.remove();

                },
                200
            );
        }


        if (closeButton) {

            closeButton.addEventListener(
                "click",
                closeInvoice
            );
        }


        if (doneButton) {

            doneButton.addEventListener(
                "click",
                closeInvoice
            );
        }


        if (backdrop) {

            backdrop.addEventListener(
                "click",
                closeInvoice
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PRINT
        |--------------------------------------------------------------------------
        */

        const printButton =
            document.getElementById(
                "printInvoiceButton"
            );


        if (printButton) {

            printButton.addEventListener(
                "click",
                function () {

                    printInvoice(data);

                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SHOW MODAL
        |--------------------------------------------------------------------------
        */

        requestAnimationFrame(
            function () {

                modal.classList.add(
                    "show"
                );

            }
        );
    }


    /* =========================================================
       ESCAPE HTML
    ========================================================= */

    function escapeHtml(value) {

        const div =
            document.createElement(
                "div"
            );

        div.textContent =
            value ?? "";

        return div.innerHTML;
    }


    /* =========================================================
       PRINT INVOICE
    ========================================================= */

    function printInvoice(data) {

        const printWindow =
            window.open(
                "",
                "_blank",
                "width=450,height=700"
            );


        if (!printWindow) {

            alert(
                "Please allow pop-ups to print the receipt."
            );

            return;
        }


        const itemsHtml =
            data.items.map(
                function (item) {

                    return `
                        <tr>
                            <td>
                                ${escapeHtml(item.product_name)}
                                <br>
                                <small>
                                    ${item.quantity} × ${money(item.price)}
                                </small>
                            </td>

                            <td style="text-align:right">
                                ${money(item.subtotal)}
                            </td>
                        </tr>
                    `;

                }
            ).join("");


        printWindow.document.write(`

            <!DOCTYPE html>

            <html>

            <head>

                <title>
                    ${escapeHtml(data.invoice_number)}
                </title>

                <style>

                    body {
                        font-family: Arial, sans-serif;
                        width: 360px;
                        margin: 0 auto;
                        padding: 25px;
                        color: #111827;
                    }

                    .center {
                        text-align: center;
                    }

                    h1 {
                        margin: 0;
                        font-size: 24px;
                    }

                    p {
                        margin: 5px 0;
                        font-size: 13px;
                    }

                    .invoice {
                        margin: 20px 0;
                        padding: 12px 0;
                        border-top: 1px dashed #999;
                        border-bottom: 1px dashed #999;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    td {
                        padding: 8px 0;
                        vertical-align: top;
                        font-size: 13px;
                    }

                    .summary {
                        margin-top: 15px;
                        border-top: 1px solid #ddd;
                        padding-top: 10px;
                    }

                    .summary div {
                        display: flex;
                        justify-content: space-between;
                        margin: 7px 0;
                    }

                    .total {
                        font-size: 18px;
                        font-weight: bold;
                        border-top: 1px solid #111;
                        padding-top: 10px;
                    }

                    .footer {
                        margin-top: 25px;
                        text-align: center;
                        font-size: 12px;
                    }

                </style>

            </head>


            <body>

                <div class="center">

                    <h1>NexPOS</h1>

                    <p>
                        Point of Sale System
                    </p>

                </div>


                <div class="invoice">

                    <p>
                        <strong>Invoice:</strong>
                        ${escapeHtml(data.invoice_number)}
                    </p>

                    <p>
                        <strong>Date:</strong>
                        ${escapeHtml(data.date)}
                    </p>

                    <p>
                        <strong>Payment:</strong>
                        ${escapeHtml(data.payment_method)}
                    </p>

                </div>


                <table>

                    <tbody>

                        ${itemsHtml}

                    </tbody>

                </table>


                <div class="summary">

                    <div>
                        <span>Subtotal</span>
                        <span>${money(data.subtotal)}</span>
                    </div>

                    <div>
                        <span>Tax</span>
                        <span>${money(data.tax)}</span>
                    </div>

                    <div class="total">
                        <span>Total</span>
                        <span>${money(data.total)}</span>
                    </div>

                </div>


                <div class="footer">

                    <p>
                        Thank you for your purchase!
                    </p>

                    <p>
                        Powered by NexPOS
                    </p>

                </div>


                <script>

                    window.onload = function () {
                        window.print();
                    };

                <\/script>

            </body>

            </html>
        `);


        printWindow.document.close();
    }


    /* =========================================================
       RENDER CART
    ========================================================= */

    function renderCart() {

        if (!cartItems) {
            return;
        }


        cartItems.innerHTML = "";


        if (cart.length === 0) {

            const empty =
                document.createElement(
                    "div"
                );


            empty.className =
                "empty-cart";


            empty.innerHTML = `
                <div>🛒</div>

                <strong>
                    Your cart is empty
                </strong>

                <p>
                    Select a product to begin a sale.
                </p>
            `;


            cartItems.appendChild(
                empty
            );

        } else {

            cart.forEach(
                function (
                    item,
                    index
                ) {

                    const row =
                        document.createElement(
                            "div"
                        );


                    row.className =
                        "cart-item";


                    row.innerHTML = `

                        <div class="cart-item-top">

                            <span class="cart-item-name">
                                ${escapeHtml(item.name)}
                            </span>

                            <span class="cart-item-price">
                                ${money(
                                    item.price *
                                    item.quantity
                                )}
                            </span>

                        </div>


                        <div class="cart-item-bottom">

                            <div class="quantity-control">

                                <button
                                    type="button"
                                    class="quantity-minus"
                                >
                                    −
                                </button>

                                <span>
                                    ${item.quantity}
                                </span>

                                <button
                                    type="button"
                                    class="quantity-plus"
                                >
                                    +
                                </button>

                            </div>


                            <button
                                type="button"
                                class="remove-item"
                            >
                                Remove
                            </button>

                        </div>
                    `;


                    row.querySelector(
                        ".quantity-minus"
                    ).addEventListener(
                        "click",
                        function () {

                            changeQuantity(
                                index,
                                -1
                            );

                        }
                    );


                    row.querySelector(
                        ".quantity-plus"
                    ).addEventListener(
                        "click",
                        function () {

                            changeQuantity(
                                index,
                                1
                            );

                        }
                    );


                    row.querySelector(
                        ".remove-item"
                    ).addEventListener(
                        "click",
                        function () {

                            cart.splice(
                                index,
                                1
                            );

                            renderCart();

                        }
                    );


                    cartItems.appendChild(
                        row
                    );
                }
            );
        }


        updateTotals();
    }


    /* =========================================================
       CHANGE QUANTITY
    ========================================================= */

    function changeQuantity(
        index,
        amount
    ) {

        if (!cart[index]) {
            return;
        }


        const item =
            cart[index];


        const maxStock =
            Number(item.stock);


        const newQuantity =
            item.quantity +
            amount;


        if (newQuantity <= 0) {

            cart.splice(
                index,
                1
            );

        } else if (
            newQuantity <=
            maxStock
        ) {

            item.quantity =
                newQuantity;

        } else {

            alert(
                "You cannot add more than the available stock."
            );

            return;
        }


        renderCart();
    }


    /* =========================================================
       ADD PRODUCT
    ========================================================= */

    function addProduct(card) {

        const id =
            Number(
                card.dataset.id ||
                0
            );


        const name =
            card.dataset.name ||
            "Product";


        const price =
            Number(
                card.dataset.price ||
                0
            );


        const stock =
            Number(
                card.dataset.stock ||
                0
            );


        if (!id) {

            alert(
                "Product ID is missing."
            );

            return;
        }


        if (stock <= 0) {

            alert(
                name +
                " is currently out of stock."
            );

            return;
        }


        const existing =
            cart.find(
                function (item) {

                    return item.id === id;

                }
            );


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

                id:
                    id,

                name:
                    name,

                price:
                    price,

                stock:
                    stock,

                quantity:
                    1
            });
        }


        renderCart();
    }


    /* =========================================================
       PRODUCT CLICK
    ========================================================= */

    productCards.forEach(
        function (card) {

            card.addEventListener(
                "click",
                function () {

                    addProduct(card);

                }
            );
        }
    );


    /* =========================================================
       FILTER PRODUCTS
    ========================================================= */

    function filterProducts() {

        const search =
            productSearch.value
                .trim()
                .toLowerCase();


        let visible = 0;


        productCards.forEach(
            function (card) {

                const name =
                    (
                        card.dataset.name ||
                        ""
                    ).toLowerCase();


                const category =
                    (
                        card.dataset.category ||
                        ""
                    ).toLowerCase();


                const matchesSearch =
                    name.includes(search);


                const matchesCategory =
                    selectedCategory ===
                        "all" ||
                    category ===
                        selectedCategory;


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
            }
        );


        if (productCount) {

            productCount.textContent =
                visible +
                (
                    visible === 1
                        ? " product"
                        : " products"
                );
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


    /* =========================================================
       CATEGORIES
    ========================================================= */

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


                    button.classList.add(
                        "active"
                    );


                    selectedCategory =
                        button.dataset.category ||
                        "all";


                    filterProducts();
                }
            );
        }
    );


    /* =========================================================
       PAYMENT METHODS
    ========================================================= */

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


    /* =========================================================
       CLEAR CART
    ========================================================= */

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


    /* =========================================================
       HOLD ORDER
    ========================================================= */

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


    /* =========================================================
       CHECKOUT
    ========================================================= */

    if (checkoutButton) {

        checkoutButton.addEventListener(
            "click",
            async function () {

                if (cart.length === 0) {
                    return;
                }


                const subtotal =
                    cart.reduce(
                        function (
                            sum,
                            item
                        ) {

                            return (
                                sum +
                                item.price *
                                item.quantity
                            );

                        },
                        0
                    );


                const tax =
                    subtotal * 0.12;


                const grandTotal =
                    subtotal + tax;


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


                checkoutButton.disabled =
                    true;


                checkoutButton.textContent =
                    "Processing...";


                try {

                    /*
                    |--------------------------------------------------------------------------
                    | SEND SALE TO LARAVEL
                    |--------------------------------------------------------------------------
                    */

                    const response =
                        await fetch(
                            "/sales/store",
                            {
                                method:
                                    "POST",

                                headers: {

                                    "Content-Type":
                                        "application/json",

                                    "Accept":
                                        "application/json",

                                    "X-CSRF-TOKEN":
                                        document
                                            .querySelector(
                                                'meta[name="csrf-token"]'
                                            )
                                            .getAttribute(
                                                "content"
                                            )
                                },

                                body:
                                    JSON.stringify({

                                        payment_method:
                                            selectedPayment,

                                        items:
                                            cart.map(
                                                function (
                                                    item
                                                ) {

                                                    return {

                                                        product_id:
                                                            item.id,

                                                        quantity:
                                                            item.quantity

                                                    };
                                                }
                                            )
                                    })
                            }
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | READ RESPONSE
                    |--------------------------------------------------------------------------
                    */

                    const data =
                        await response.json();


                    if (!response.ok) {

                        throw new Error(
                            data.message ||
                            "Unable to complete the sale."
                        );
                    }


                    if (!data.success) {

                        throw new Error(
                            data.message ||
                            "Sale could not be completed."
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | SAVE CART DATA FOR INVOICE
                    |--------------------------------------------------------------------------
                    */

                    cart = [];


                    /*
                    |--------------------------------------------------------------------------
                    | UPDATE POS
                    |--------------------------------------------------------------------------
                    */

                    renderCart();


                    /*
                    |--------------------------------------------------------------------------
                    | RESET CHECKOUT BUTTON
                    |--------------------------------------------------------------------------
                    */

                    checkoutButton.disabled =
                        true;


                    checkoutButton.textContent =
                        "Complete Sale";


                    /*
                    |--------------------------------------------------------------------------
                    | SHOW INVOICE
                    |--------------------------------------------------------------------------
                    */

                    createInvoiceModal(
                        data
                    );


                } catch (error) {

                    console.error(
                        "Checkout error:",
                        error
                    );


                    alert(
                        error.message ||
                        "Something went wrong while completing the sale."
                    );


                    checkoutButton.disabled =
                        false;


                    checkoutButton.textContent =
                        "Complete Sale";
                }
            }
        );
    }


    /* =========================================================
       BARCODE
    ========================================================= */

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


    /* =========================================================
       INITIAL POS
    ========================================================= */

    renderCart();

    filterProducts();

});