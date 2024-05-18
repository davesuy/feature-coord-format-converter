import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
  ],
  build: {
    rollupOptions: {
      input: './src/main.js', // Adjust this path to your entry JavaScript file
      output: {
        entryFileNames: 'assets/bundle.js', // Output file name
        dir: 'dist', // Output directory
      }
    }
  },
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  }
})
