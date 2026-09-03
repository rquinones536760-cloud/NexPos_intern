import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {

    /* =====================================================
       SIDEBAR
    ===================================================== */

    const sidebar = document.getElementById('sidebar');
    const mainArea = document.getElementById('mainArea');

    const collapseButton =
        document.getElementById('collapseSidebar');

    const collapseIcon =
        document.getElementById('collapseIcon');

    const mobileMenuButton =
        document.getElementById('mobileMenuButton');

    const mobileOverlay =
        document.getElementById('mobileOverlay');


    function closeMobileSidebar() {

        sidebar?.classList.remove('mobile-open');

        mobileOverlay?.classList.remove('active');

    }


    collapseButton?.addEventListener('click', () => {

        if (window.innerWidth <= 1024) {

            closeMobileSidebar();

            return;

        }

        sidebar?.classList.toggle('collapsed');

        mainArea?.classList.toggle('expanded');


        const collapsed =
            sidebar?.classList.contains('collapsed');


        if (collapseIcon) {

            collapseIcon.textContent =
                collapsed ? '›' : '‹';

        }

    });


    mobileMenuButton?.addEventListener('click', () => {

        sidebar?.classList.add('mobile-open');

        mobileOverlay?.classList.add('active');

    });


    mobileOverlay?.addEventListener(
        'click',
        closeMobileSidebar
    );


    document
        .querySelectorAll('.nav-item')
        .forEach(item => {

            item.addEventListener('click', () => {

                if (window.innerWidth <= 1024) {
                    closeMobileSidebar();
                }

            });

        });


    window.addEventListener('resize', () => {

        if (window.innerWidth > 1024) {

            closeMobileSidebar();

        }

    });


    /* =====================================================
       POS ELEMENTS
    ===================================================== */

    const productCards =
        document.querySelectorAll('.product-card');

    const productSearch =
        document.getElementById('productSearch');

    const categoryButtons =
        document.querySelectorAll('.category-btn');

    const cartItems =
        document.getElementById('cartItems');

    const cartCount =
        document.getElementById('cartCount');

    const subtotalElement =
        document.getElementById('subtotal');

    const taxElement =
        document.getElementById('tax');

    const totalElement =
        document.getElementById('total');

    const checkoutButton =
        document.getElementById('checkoutButton');

    const clearButton =
        document.getElementById('clearButton');

    const productCount =
        document.getElementById('productCount');


    /*
     * Stop here when we are not on POS.
     */

    if (!productCards.length) {
        return;
    }


    let cart = [];

    let selectedCategory = 'all';


    /* =====================================================
       MONEY
    ===================================================== */

    function money(value) {

        return '₱' + Number(value).toLocaleString(
            'en-PH',
            {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }
        );

    }


    /* =====================================================
       PRODUCT ICON
    ===================================================== */

    function getProductEmoji(name) {

        const product = name.toLowerCase();

        if (product.includes('laptop')) {
            return '💻';
        }

        if (product.includes('headset')) {
            return '🎧';
        }

        if (product.includes('keyboard')) {
            return '⌨️';
        }

        if (product.includes('mouse')) {
            return '🖱️';
        }

        if (product.includes('smartphone')) {
            return '📱';
        }

        if (product.includes('monitor')) {
            return '🖥️';
        }

        return '📦';

    }


    /* =====================================================
       ADD PRODUCT
    ===================================================== */

    productCards.forEach(card => {

        card.addEventListener('click', () => {

            const name = card.dataset.name;

            const price =
                Number(card.dataset.price);


            const existing =
                cart.find(item => item.name === name);


            if (existing) {

                existing.quantity++;

            } else {

                cart.push({
                    name: name,
                    price: price,
                    quantity: 1
                });

            }


            renderCart();

        });

    });


    /* =====================================================
       RENDER CART
    ===================================================== */

    function renderCart() {

        if (!cartItems) {
            return;
        }


        cartItems.innerHTML = '';


        if (cart.length === 0) {

            cartItems.innerHTML = `
                <div class="empty-cart">

                    <div>🛒</div>

                    <strong>
                        Your cart is empty
                    </strong>

                    <p>
                        Select a product to begin a sale.
                    </p>

                </div>
            `;


            cartCount.textContent = '0 Items';

            subtotalElement.textContent = money(0);

            taxElement.textContent = money(0);

            totalElement.textContent = money(0);

            checkoutButton.disabled = true;

            return;

        }


        let subtotal = 0;

        let totalQuantity = 0;


        cart.forEach((item, index) => {

            subtotal +=
                item.price * item.quantity;

            totalQuantity +=
                item.quantity;


            const element =
                document.createElement('div');


            element.className =
                'cart-item';


            element.innerHTML = `
                <div class="cart-item-top">

                    <div class="cart-item-icon">
                        ${getProductEmoji(item.name)}
                    </div>

                    <div class="cart-item-content">

                        <div class="cart-item-name">

                            <strong>
                                ${item.name}
                            </strong>

                            <button
                                type="button"
                                class="remove-item"
                                data-remove="${index}"
                                aria-label="Remove ${item.name}"
                            >
                                ×
                            </button>

                        </div>

                        <div class="cart-item-price">
                            ${money(item.price)}
                        </div>

                        <div class="cart-item-bottom">

                            <div class="quantity-control">

                                <button
                                    type="button"
                                    data-minus="${index}"
                                >
                                    −
                                </button>

                                <span>
                                    ${item.quantity}
                                </span>

                                <button
                                    type="button"
                                    data-plus="${index}"
                                >
                                    +
                                </button>

                            </div>

                            <strong class="cart-item-total">
                                ${money(
                                    item.price *
                                    item.quantity
                                )}
                            </strong>

                        </div>

                    </div>

                </div>
            `;


            cartItems.appendChild(element);

        });


        const tax =
            subtotal * 0.12;

        const total =
            subtotal + tax;


        cartCount.textContent =
            `${totalQuantity} ${
                totalQuantity === 1
                    ? 'Item'
                    : 'Items'
            }`;


        subtotalElement.textContent =
            money(subtotal);

        taxElement.textContent =
            money(tax);

        totalElement.textContent =
            money(total);

        checkoutButton.disabled = false;


        attachCartEvents();

    }


    /* =====================================================
       CART EVENTS
    ===================================================== */

    function attachCartEvents() {

        document
            .querySelectorAll('[data-remove]')
            .forEach(button => {

                button.addEventListener('click', () => {

                    const index =
                        Number(button.dataset.remove);

                    cart.splice(index, 1);

                    renderCart();

                });

            });


        document
            .querySelectorAll('[data-minus]')
            .forEach(button => {

                button.addEventListener('click', () => {

                    const index =
                        Number(button.dataset.minus);


                    if (cart[index].quantity > 1) {

                        cart[index].quantity--;

                    } else {

                        cart.splice(index, 1);

                    }


                    renderCart();

                });

            });


        document
            .querySelectorAll('[data-plus]')
            .forEach(button => {

                button.addEventListener('click', () => {

                    const index =
                        Number(button.dataset.plus);

                    cart[index].quantity++;

                    renderCart();

                });

            });

    }


    /* =====================================================
       SEARCH
    ===================================================== */

    function filterProducts() {

        const search =
            productSearch?.value
                .toLowerCase()
                .trim() || '';


        let visible = 0;


        productCards.forEach(card => {

            const name =
                card.dataset.name
                    .toLowerCase();

            const category =
                card.dataset.category;


            const matchesSearch =
                name.includes(search);


            const matchesCategory =
                selectedCategory === 'all' ||
                category === selectedCategory;


            const visibleCard =
                matchesSearch &&
                matchesCategory;


            card.classList.toggle(
                'hidden',
                !visibleCard
            );


            if (visibleCard) {
                visible++;
            }

        });


        if (productCount) {

            productCount.textContent =
                `${visible} ${
                    visible === 1
                        ? 'product'
                        : 'products'
                }`;

        }

    }


    productSearch?.addEventListener(
        'input',
        filterProducts
    );


    /* =====================================================
       CATEGORY
    ===================================================== */

    categoryButtons.forEach(button => {

        button.addEventListener('click', () => {

            selectedCategory =
                button.dataset.category;


            categoryButtons.forEach(item => {

                item.classList.remove('active');

            });


            button.classList.add('active');

            filterProducts();

        });

    });


    /* =====================================================
       PAYMENT
    ===================================================== */

    document
        .querySelectorAll('.payment-method')
        .forEach(button => {

            button.addEventListener('click', () => {

                document
                    .querySelectorAll('.payment-method')
                    .forEach(item => {

                        item.classList.remove('active');

                    });


                button.classList.add('active');

            });

        });


    /* =====================================================
       CLEAR CART
    ===================================================== */

    clearButton?.addEventListener('click', () => {

        if (!cart.length) {
            return;
        }


        cart = [];

        renderCart();

    });


    /* =====================================================
       HOLD ORDER
    ===================================================== */

    document
        .querySelector('.secondary-action')
        ?.addEventListener('click', () => {

            if (!cart.length) {

                alert('There is no order to hold.');

                return;

            }


            alert('Order has been placed on hold.');

        });


    /* =====================================================
       CHECKOUT
    ===================================================== */

    checkoutButton?.addEventListener(
        'click',
        () => {

            if (!cart.length) {
                return;
            }


            const subtotal =
                cart.reduce(
                    (sum, item) => {

                        return sum +
                            (
                                item.price *
                                item.quantity
                            );

                    },
                    0
                );


            const tax =
                subtotal * 0.12;

            const total =
                subtotal + tax;


            alert(
                'Sale completed successfully!\n\n' +
                'Total: ' +
                money(total)
            );


            cart = [];

            renderCart();

        }
    );


    /* =====================================================
       INITIALIZE
    ===================================================== */

    renderCart();

    filterProducts();

});