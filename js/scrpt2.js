let total = 0;

function addToBookedItems(button) {
    // Get the card element of the clicked button
    const card = button.closest('.card');

    // Get the name, price, and image source
    const name = card.querySelector('.card-title').innerText;
    const price = parseInt(card.querySelector('p').innerText.replace('TK:', '').trim());
    const imageUrl = card.querySelector('img').src;

    // Check if the item is already in the cart
    const existingItem = document.querySelector(`#bookedItemsContainer div[data-name="${name}"]`);
    if (existingItem) {
        // If the item exists, increase the quantity
        const quantityElement = existingItem.querySelector(".quantity");
        const quantity = parseInt(quantityElement.innerText) + 1;
        quantityElement.innerText = quantity;

        // Update the total price
        total += price;
        document.getElementById("totalPrice").innerText = `Total: TK ${total}`;
        return;
    }

    // Update the total price
    total += price;
    document.getElementById("totalPrice").innerText = `Total: TK ${total}`;

    // Create a container for the booked item
    const bookedItem = document.createElement("div");
    bookedItem.style.display = "flex";
    bookedItem.style.alignItems = "center";
    bookedItem.style.marginBottom = "10px";
    bookedItem.style.borderBottom = "1px solid #ccc";
    bookedItem.style.paddingBottom = "10px";
    bookedItem.setAttribute("data-name", name);

    // Create an image element
    const img = document.createElement("img");
    img.src = imageUrl;
    img.alt = name;
    img.style.width = "50px";
    img.style.height = "50px";
    img.style.borderRadius = "5px";
    img.style.marginRight = "10px";

    // Create a details container
    const details = document.createElement("div");
    details.innerHTML = `
        <strong>${name}</strong><br>TK ${price} x <span class="quantity">1</span>
    `;
    details.style.flex = "1";

    // Create add and minus buttons
    const controls = document.createElement("div");
    controls.style.display = "flex";
    controls.style.gap = "10px";

    const addButton = document.createElement("button");
    addButton.innerText = "+";
    addButton.style.padding = "5px 10px";
    addButton.style.cursor = "pointer";
    addButton.addEventListener("click", () => {
        const quantityElement = bookedItem.querySelector(".quantity");
        const quantity = parseInt(quantityElement.innerText) + 1;
        quantityElement.innerText = quantity;

        // Update the total price
        total += price;
        document.getElementById("totalPrice").innerText = `Total: TK ${total}`;
    });

    const minusButton = document.createElement("button");
    minusButton.innerText = "-";
    minusButton.style.padding = "5px 10px";
    minusButton.style.cursor = "pointer";
    minusButton.addEventListener("click", () => {
        const quantityElement = bookedItem.querySelector(".quantity");
        const quantity = parseInt(quantityElement.innerText) - 1;

        if (quantity === 0) {
            // Remove the item from the cart
            bookedItem.remove();
        } else {
            quantityElement.innerText = quantity;
        }

        // Update the total price
        total -= price;
        document.getElementById("totalPrice").innerText = `Total: TK ${total}`;
    });

    controls.appendChild(addButton);
    controls.appendChild(minusButton);

    // Append the image, details, and controls to the booked item container
    bookedItem.appendChild(img);
    bookedItem.appendChild(details);
    bookedItem.appendChild(controls);

    // Add the booked item container to the "booked items" section
    document.getElementById("bookedItemsContainer").appendChild(bookedItem);
}
