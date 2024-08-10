let btnAdd = document.querySelector("#add");

let table = document.querySelector("#mytab");
let itemInput = document.querySelector("#item");
let quantityInput = document.querySelector("#quantity");
let priceInput = document.querySelector("#price");
let i = 0;

btnAdd.addEventListener('click', () => {
    let name = itemInput.value;
    let quantity = quantityInput.value;
    let price = priceInput.value;

    let template = `<tr>
    <td>${i = i + 1}</td>
    <td>${name}</td>
    <td>${quantity}</td>
    <td>${price}</td>
    </tr>`;
    table.innerHTML += template;
})