// This is the service worker with the Cache-first network

const CACHE = "pwabuilder-precache";
const precacheFiles = [
  "/build/bundle.js",
  "/build/bundle.css",
  "/favicon.png",
  "/images/42993da4-a930-a5d1-03f2-8e250dbd68b4.webPlatform.png",
  "/images/1414146c-8d17-94e7-077b-425a4a565c01.webPlatform.png",
  "/images/374160fe-d961-a9a5-a6e1-fb08d9dfb2fa.webPlatform.png",
  "/images/a0c647a6-56ad-748e-9ef1-d4d9b20cc540.webPlatform.png",
  "/images/ec9fc0e1-b831-1f62-62c5-a6985a50255b.webPlatform.png",
  "/images/3ce7ad79-452f-a9d9-a26e-b8a74adce8fd.webPlatform.png",
  "/images/b1aba853-73b6-573e-c234-0753efe89951.webPlatform.png",
  "/images/755f7f3c-3397-7c00-7060-5bd8ccd8b051.webPlatform.png",
  "/images/da804e2c-afc7-6991-2c11-baec974c3012.webPlatform.png",
  "/images/88860047-8ba4-6bd4-e138-b0dda8c37c00.webPlatform.png",
  "/images/7fffee45-2769-9e82-c7b5-6aefe844f4da.webPlatform.png",
  "/images/43b9149d-949f-516d-66cf-60369f73fb73.webPlatform.png",
  "/images/e466316f-9486-4396-de5e-127502140773.webPlatform.png",
  "/images/0fc1996c-5e69-2d60-74a3-87149f78fd72.webPlatform.png",
  "/images/ced4f858-b31d-be12-b8f9-5aafe2d334b3.webPlatform.png",
  "/images/ecccd8be-da9d-8ece-50db-f0b69d34c8f0.webPlatform.png",
  "/images/4e07027d-571d-2d8c-4cdd-1c31381b77d6.webPlatform.png",
  "/images/b3891671-c497-7880-5a4d-1d639d9c62e5.webPlatform.png",
  "/images/6d821e2f-1a6c-1756-dfde-530a71834804.webPlatform.png",
];

self.addEventListener("install", function (event) {
  console.log("[PWA Builder] Install Event processing");

  console.log("[PWA Builder] Skip waiting on install");
  self.skipWaiting();

  event.waitUntil(
    caches.open(CACHE).then(function (cache) {
      console.log("[PWA Builder] Caching pages during install");
      return cache.addAll(precacheFiles);
    })
  );
});

// Allow sw to control of current page
self.addEventListener("activate", function (event) {
  console.log("[PWA Builder] Claiming clients for current page");
  event.waitUntil(self.clients.claim());
});

// If any fetch fails, it will look for the request in the cache and serve it from there first
self.addEventListener("fetch", function (event) {
  if (event.request.method !== "GET") return;

  event.respondWith(
    fromCache(event.request).then(
      function (response) {
        // The response was found in the cache so we responde with it and update the entry

        // This is where we call the server to get the newest version of the
        // file to use the next time we show view
        event.waitUntil(
          fetch(event.request).then(function (response) {
            return updateCache(event.request, response);
          })
        );

        return response;
      },
      function () {
        // The response was not found in the cache so we look for it on the server
        return fetch(event.request)
          .then(function (response) {
            // If request was success, add or update it in the cache
            event.waitUntil(updateCache(event.request, response.clone()));

            return response;
          })
          .catch(function (error) {
            console.log(
              "[PWA Builder] Network request failed and no cache." + error
            );
          });
      }
    )
  );
});

function fromCache(request) {
  // Check to see if you have it in the cache
  // Return response
  // If not in the cache, then return
  return caches.open(CACHE).then(function (cache) {
    return cache.match(request).then(function (matching) {
      if (!matching || matching.status === 404) {
        return Promise.reject("no-match");
      }

      return matching;
    });
  });
}

function updateCache(request, response) {
  return caches.open(CACHE).then(function (cache) {
    return cache.put(request, response);
  });
}
