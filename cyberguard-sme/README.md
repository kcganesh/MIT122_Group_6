# CyberGuard SME
Small Business Cybersecurity Awareness & Incident Tracking (MIT122)

## Overview
CyberGuard SME is a simple web information system for:
- Staff login, view dashboard, complete microlearning training, report incidents.
- Admins manage users, incidents, and training modules.
Built with HTML5, CSS3, JavaScript (front-end), PHP (backend), and MySQL.

## Quick local setup (XAMPP / WAMP / LAMP)
1. Clone this repo to your webserver (e.g. `htdocs/cyberguard-sme` for XAMPP).
2. Copy `config-sample.php` -> `config.php`. Edit DB credentials.
3. Create an empty MySQL database (name referenced in `config.php`) OR run `create_tables.sql` manually.
4. Open `http://localhost/cyberguard-sme/setup.php` once — this will create tables and seed example data.
5. After seeing "setup complete", delete or rename `setup.php` for security.
6. Login:
   - Admin: `admin@cyberguard.local` / `Admin123!`
   - Staff: `staff@cyberguard.local` / `Staff123!`

## Deploying online
- Push the repo to GitHub (store code only). Do NOT push `config.php` with real credentials — add to `.gitignore`.
- GitHub Pages only hosts static sites (no PHP). Use a free PHP+MySQL host (e.g., InfinityFree, HelioHost, 000webhost). See `Hosting_Guide.md` steps in the repo.

## Security notes
- Passwords use `password_hash` (bcrypt). All DB queries use prepared statements.
- Keep `config.php` private. Remove `setup.php` after initial run.
