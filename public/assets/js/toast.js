function toastalert() {//alert('1')
    const toast = document.querySelector(".toast");
    const progress = document.querySelector(".progress");

    let timer1, timer2;

    toast.classList.add("active");
    progress.classList.add("active");

    timer1 = setTimeout(() => {
        toast.classList.remove("active");
    }, 3000); //1s = 1000 milliseconds

    timer2 = setTimeout(() => {
        progress.classList.remove("active");
    }, 3000);
}
