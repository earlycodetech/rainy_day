const amount = document.querySelector("#amount");
const show = document.querySelector("#show");
const form = document.querySelector('form');
const real = document.querySelector("#real");
form.addEventListener('keyup',()=>{

    let value = 13.5;
    let userAmount = amount.value;

    let totalTax = (value * userAmount)/100;
    let totalWithdraw = userAmount - totalTax;

    show.innerText = totalWithdraw;
    real.value =totalWithdraw;
});