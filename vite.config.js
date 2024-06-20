import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";
import { viteStaticCopy } from "vite-plugin-static-copy";
import path from "path";
const asssetsFolder = path.resolve(
    __dirname,
    "node_modules/@patientus/videolib-wc/assets"
);

export default defineConfig({
    // base: "https://crm.vip-vitalisten.de/build/",
    plugins: [
        laravel({
            input: "resources/js/app.jsx",
            refresh: true,
        }),
        react(),
        viteStaticCopy({
            targets: [
                {
                    src: asssetsFolder,
                    dest: "assets",
                },
            ],
        }),
    ],
});
