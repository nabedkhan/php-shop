function showToast(message) {
  Toastify({
    text: message,
    duration: 2000,
    close: true,
    gravity: "top", // `top` or `bottom`
    position: "right", // `left`, `center` or `right`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: { background: "#20c997" },
  }).showToast();
}
