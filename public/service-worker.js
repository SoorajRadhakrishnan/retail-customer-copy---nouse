self.addEventListener("install", function(event) {
    event.waitUntil(
        caches.open("sw-cache").then(function(cache) {
            return cache.addAll([
                "index.html",
                "assets/img/favicon.png",
                "assets/lib/fontawesome-free/css/all.min.css",
                "assets/lib/ionicons/css/ionicons.min.css",
                "assets/lib/typicons.font/typicons.min.css",
                "assets/lib/jquery/jquery.min.js",
                "assets/lib/bootstrap/js/bootstrap.bundle.min.js",
                "assets/lib/ionicons/ionicons.js",
                "assets/js/azia.js",
                "assets/img/zaadDocs.png",
                "assets/img/zaadDocs-m.png",
                "/offline.html",
            ]);
        })
    );
});

// with request network
self.addEventListener("fetch", function(event) {
    event.respondWith(
        // Try the cache
        caches.match(event.request).then(function(response) {
            // return it if there is a response, or else fetch again
            return response || fetch(event.request);
        }).catch(() => caches.match('/offline.html'))
    );
});

self.addEventListener('push', (event) => {
    const json = JSON.parse(event.data.text())
    console.log('Push Data', event.data.text())
    self.registration.showNotification(json.header, json.options)
});
