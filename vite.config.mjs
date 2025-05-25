import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/assets-admin/style.css'],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '@': '/resources'
    }
  },
  optimizeDeps: {
    include: ['@fortawesome/fontawesome-free']
  }
})