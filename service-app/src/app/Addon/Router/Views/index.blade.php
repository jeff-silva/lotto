<!doctype html>

<head>
    <meta charset="utf-8">
    <title>Laravel | Swagger UI</title>
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">
    <link rel="icon" type="image/png" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/favicon-32x32.png"
        sizes="32x32" />
    <link rel="icon" type="image/png" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/favicon-16x16.png"
        sizes="16x16" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/swagger-ui.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swagger-themes@1.4.3/themes/dark.min.css">
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div id="swagger-ui"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/swagger-ui-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/swagger-ui-standalone-preset.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            window.ui = SwaggerUIBundle({
                dom_id: "#swagger-ui",
                deepLinking: true,
                presets: [SwaggerUIBundle.presets.apis, SwaggerUIStandalonePreset],
                plugins: [SwaggerUIBundle.plugins.DownloadUrl],
                layout: "StandaloneLayout",
                // apisSorter: "alpha",
                // operationsSorter: "alpha",
                url: 'https://petstore3.swagger.io/api/v3/openapi.json',
                // spec: [],
            });
        });
    </script>
</body>

</html>
