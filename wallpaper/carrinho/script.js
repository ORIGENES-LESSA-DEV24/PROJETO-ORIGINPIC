// Variáveis para armazenar os itens do carrinho
let cart = [];

// Função para atualizar o carrinho na interface
function updateCart() {
    const cartItemsList = document.getElementById("cart-items");
    const totalPriceElement = document.getElementById("total-price");

    // Limpar a lista atual de itens
    cartItemsList.innerHTML = "";

    // Atualizar os itens no carrinho
    let total = 0;
    cart.forEach(item => {
        const listItem = document.createElement("li");
        listItem.textContent = `${item.name} - R$ ${item.price}`;
        cartItemsList.appendChild(listItem);
        total += item.price;
    });

    // Atualizar o preço total
    totalPriceElement.textContent = `Total: R$ ${total.toFixed(2)}`;
}

// Função para adicionar item ao carrinho
function addToCart(productId, productName, productPrice) {
    const item = { id: productId, name: productName, price: parseFloat(productPrice) };
    cart.push(item);
    updateCart();
}

// Evento de clique nos botões de "Adicionar ao Carrinho"
document.querySelectorAll(".add-to-cart").forEach(button => {
    button.addEventListener("click", function() {
        const product = this.closest(".product");
        const productId = product.getAttribute("data-id");
        const productName = product.getAttribute("data-name");
        const productPrice = product.getAttribute("data-price");

        addToCart(productId, productName, productPrice);
    });
});

// Função para enviar o carrinho para o PHP
document.getElementById("checkout").addEventListener("click", function() {
    if (cart.length === 0) {
        alert("Seu carrinho está vazio!");
        return;
    }

    // Enviar os dados do carrinho para o PHP via POST
    fetch("checkout.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(cart)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Compra realizada com sucesso!");
            cart = [];
            updateCart();
        } else {
            alert("Erro ao realizar a compra.");
        }
    });
});
