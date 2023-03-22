let number = document.getElementById("inputNumber");
let price = document.getElementById("inputPrice");
let allprice = document.getElementById("inputAllPrice");

number.addEventListener("change", (event) => {
    allprice.setAttribute("value", event.target.value);
});

price.addEventListener("change", (event) => {
    let firstValue = allprice.getAttribute("value");
    let lastValue = event.target.value;
    allprice.setAttribute("value", firstValue * lastValue);
});
