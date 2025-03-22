if ("serviceWorker" in navigator) {
  navigator.serviceWorker
    .register("/service-worker.js")
    .then((registration) => {
      console.log("Service Worker registered with scope:", registration.scope);

      // Check if service worker is already controlling the page
      if (navigator.serviceWorker.controller) {
        console.log("Service Worker is controlling the page.");
      } else {
        console.log(
          "Service Worker is not yet controlling the page. Redirecting to index.html..."
        );
        window.location.href = "/";
      }
    })
    .catch((error) => {
      console.error("Service Worker registration failed:", error);
    });
}
