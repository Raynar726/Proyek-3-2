<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Stateless Shopping Cart</title>
</head>
<body>
    <h1>Toko Online</h1>

    <h2>Daftar Produk</h2>
    <button onclick="add(1)">Buku Tulis - Rp5.000</button>
    <button onclick="add(2)">Pulpen - Rp3.000</button>
    <button onclick="add(3)">Penggaris - Rp4.000</button>

    <h2>Keranjang Belanja</h2>
    <div id="items">Keranjang kosong.</div>

    <h3 id="total">Total: Rp0</h3>

    <button onclick="recalculate()">Hitung Ulang</button>
    <button onclick="clearCart()">Kosongkan Keranjang</button>

    <h3>Respons Laravel</h3>
    <pre id="response">Belum ada request.</pre>

    <script>
        let cart = {};

        async function post(url, payload) {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                },
                body: JSON.stringify(payload)
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(JSON.stringify(data));
            }

            return data;
        }

        async function add(id) {
            try {
                const data = await post('/cart/add', {
                    cart: cart,
                    product_id: id
                });

                cart = Object.fromEntries(
                    data.items.map(item => [
                        item.id,
                        item.quantity
                    ])
                );

                render(data);
            } catch (error) {
                alert(error.message);
            }
        }

        async function recalculate() {
            if (Object.keys(cart).length === 0) {
                alert('Keranjang kosong.');
                return;
            }

            try {
                render(
                    await post('/cart/update', {
                        cart: cart
                    })
                );
            } catch (error) {
                alert(error.message);
            }
        }

        function render(data) {
            const container = document.getElementById('items');

            container.replaceChildren();

            if (data.items.length === 0) {
                container.textContent = 'Keranjang kosong.';
            }

            data.items.forEach(item => {
                const row = document.createElement('p');

                row.textContent = `${item.name} x ${item.quantity} = Rp${
                    item.subtotal.toLocaleString('id-ID')
                }`;

                container.appendChild(row);
            });

            document.getElementById('total').textContent =
                'Total: Rp' + data.total.toLocaleString('id-ID');

            document.getElementById('response').textContent =
                JSON.stringify(data, null, 2);
        }

        function clearCart() {
            cart = {};

            render({
                items: [],
                total: 0
            });
        }
    </script>
</body>
</html>