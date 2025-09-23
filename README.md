# CyberGuard SME
Small Business Cybersecurity Awareness & Incident Tracking
Built with HTML5/CSS3/JavaScript (frontend) + PHP (backend) + MySQL.

## Features
- Staff and Admin roles.
- Login / Registration.
- Microlearning Awareness Center (YouTube videos).
- Incident reporting form (staff).
- Incident tracker / case management (staff & admin).
- Resource repository (downloadable docs).
- Admin panel (manage users, incidents, trainings).
- Example seed data included.

## Quick local setup (recommended)
1. Install XAMPP (Windows) or MAMP (macOS) or LAMP (Linux).
2. Start Apache & MySQL.
3. Create a new MySQL database (e.g. `cyberguard_db`).
4. Import SQL: `sql/cyberguard_schema_seed.sql` (via phpMyAdmin or `mysql` CLI).
5. Copy `public/` contents into your webserver's document root (e.g. `C:\xampp\htdocs\cyberguard-sme\`).
6. Edit `public/api/config.php` to set DB credentials (DB_NAME / DB_USER / DB_PASS / DB_HOST).
7. Visit `http://localhost/cyberguard-sme/login.php`.
   - Example accounts from seed:
     - Admin: `admin@example.com` / `admin123`
     - Staff: `staff1@example.com` / `staff123`

## Hosting for free (two options)
### Option A (recommended): Host entire site (PHP + MySQL) on a free PHP host
- Providers: InfinityFree, 000WebHost, GoogieHost. These support PHP and MySQL databases. See:
  - InfinityFree (free PHP+MySQL). :contentReference[oaicite:2]{index=2}
  - 000WebHost (free, beginner-friendly). :contentReference[oaicite:3]{index=3}
- Steps:
  1. Sign up for InfinityFree or 000WebHost.
  2. Create a new site and MySQL database.
  3. Upload the `public/` folder files using the host file manager or FTP.
  4. Import SQL into the remote DB via phpMyAdmin.
  5. Update `api/config.php` with the remote DB credentials and domain.
  6. Open your site in the browser.

### Option B: Host frontend on GitHub Pages (static) + backend on free PHP host
- GitHub Pages serves static front-end only (no PHP). Use a separate free PHP host for API endpoints. GitHub Actions can auto-deploy code to your PHP host. :contentReference[oaicite:4]{index=4}

## Important notes
- GitHub Pages is static — it cannot run PHP.
- For security, don't keep production DB credentials in public repos.
- This project is an educational demo — for production, use prepared statements, HTTPS, stronger password policy, CSRF protection.

## File list
See `/public` and `/public/api` folders.

