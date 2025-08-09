# Laravel Project Setup

This project includes a custom Artisan command to automate the installation process.

---

## 📦 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/your-repo.git
cd your-repo
Copy .env.example to .env and configure your database, Pusher, and other environment variables:

cp .env.example .env
```
### 2.Run this commend to insall all project and Run migration
```bash
php artisan install:project my-app
```
### 3. project uses Laravel Echo + Pusher for real-time events, add your credentials to .env:
```bash
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=eu
```
