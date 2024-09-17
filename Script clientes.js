document.addEventListener('DOMContentLoaded', () => {
    const botonesAgregarCarrito = document.querySelectorAll('.agregar-carrito');

    botonesAgregarCarrito.forEach(boton => {
        boton.addEventListener('click', agregarProductoAlCarrito);
    });

    function agregarProductoAlCarrito(event) {
        const boton = event.target;
        const producto = {
            nombre: boton.dataset.nombre,
            precio: parseFloat(boton.dataset.precio)
        };

        agregarProductoAlLocalStorage(producto);
    }

    function agregarProductoAlLocalStorage(producto) {
        let carrito = obtenerCarritoLocalStorage();

        carrito.push(producto);

        localStorage.setItem('carrito', JSON.stringify(carrito));

        calcularTotalCarrito(carrito);

        mostrarCarrito();
    }

    function obtenerCarritoLocalStorage() {
        return JSON.parse(localStorage.getItem('carrito')) || [];
    }

    function mostrarCarrito() {
        const carrito = obtenerCarritoLocalStorage();

        const listaCarrito = document.getElementById('lista-carrito');
        listaCarrito.innerHTML = '';

        carrito.forEach(producto => {
            const li = document.createElement('li');
            li.textContent = `${producto.nombre} - $${producto.precio}`;
            listaCarrito.appendChild(li);
        });

        calcularTotalCarrito(carrito); // Asegúrate de recalcular el total cuando se muestra el carrito
    }

    function calcularTotalCarrito(carrito) {
        const total = carrito.reduce((total, producto) => total + producto.precio, 0);

        const totalCarritoElemento = document.getElementById('total-carrito');
        totalCarritoElemento.textContent = `Total: $${total.toFixed(2)}`;
    }

    function vaciarCarrito() {
        localStorage.removeItem('carrito');
        mostrarCarrito();
    }

    const botonVaciarCarrito = document.getElementById('vaciar-carrito');
    botonVaciarCarrito.addEventListener('click', vaciarCarrito);

    // Maneja la confirmación de la compra
    const botonConfirmarCompra = document.getElementById('confirmar-compra');
    botonConfirmarCompra.addEventListener('click', () => {
        const carrito = obtenerCarritoLocalStorage();

        if (carrito.length > 0) {
            // Aquí puedes enviar el carrito al servidor o procesar el pedido
            alert('Compra confirmada. Gracias por tu compra!');
            vaciarCarrito(); // Opcional: vaciar el carrito después de confirmar la compra
        } else {
            alert('Tu carrito está vacío.');
        }
    });

    mostrarCarrito();
});
