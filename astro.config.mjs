// @ts-check
import { defineConfig, fontProviders } from 'astro/config';
import react from '@astrojs/react';
import mdx from '@astrojs/mdx';

// https://astro.build/config
export default defineConfig({
  site: "https://studio.cassigs.com",
  integrations: [react(), mdx()],
  vite: {
    build: {
      rollupOptions: {
        external: ['@astrojs/rss'],
      },
    },
  },
  fonts: [{
    provider: fontProviders.local(),
    name: "TayBarro",
    cssVariable: "--font-tay-barro",
    options: {
      variants: [{
        src: ['./src/assets/fonts/TAYBarro.woff2'],
        weight: 'normal',
        style: 'normal'
      }]
    }
  }]
});
