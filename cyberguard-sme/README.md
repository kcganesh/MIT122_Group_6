# CyberGuard SME

**CyberGuard SME** is a web-based information system for **Small Business Cybersecurity Awareness and Incident Tracking**.  
It helps small businesses train staff, report incidents, and track responses — while giving admins tools to manage users, resources, and announcements.

---

## 📌 Features

### 👩‍💻 User (Staff)
- **Login/Logout** with secure password hashing.
- **Dashboard** with quick stats:
  - Open incidents
  - Total incidents
  - Training completed
- **Quick Actions**:
  - Report a new incident
  - Access Awareness Center (micro-learning videos)
  - Track incidents
- **Cybersecurity Awareness Center**
  - Watch training videos (embedded YouTube)
  - Mark trainings as complete
- **Incident Reporting**
  - Submit incidents with severity (Low/Medium/High)
- **Incident Tracker**
  - View incidents and their statuses (Open / In Progress / Closed)
- **Resource Repository**
  - Links to policies, guidelines, and checklists
- **Announcements**
  - See latest 3 announcements on Dashboard
  - Older announcements available in a dedicated page
  - “Mark as Read” button — once read, always green ✔️

### 🛠️ Admin
- **Manage Users**
  - Add staff/admin accounts
- **Manage Training Modules**
  - Add training video links + descriptions
- **Manage Resources**
  - Add policies, checklists, docs
- **Incident Management**
  - Change status of incidents (Open → In Progress → Closed)
- **Announcements**
  - Post new announcements with importance (Low/Medium/High)
  - View which users have read/unread each announcement

---

## 🗄️ Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP 8+
- **Database:** MySQL (MariaDB on InfinityFree)
- **Version Control:** GitHub
- **Hosting:** [InfinityFree](https://infinityfree.net/) (free PHP hosting)

---

## 📂 Project Structure
cyberguard-sme/
│
├── index.php # Login page
├── dashboard.php # User dashboard
├── admin.php # Admin panel
├── announcements.php # Older announcements
├── report_incident.php # Incident reporting form
├── cases.php # Incident tracker
├── training.php # Awareness Center
├── resources.php # Resources repo
├── profile.php # User profile
│
├── actions/ # Backend handlers (form submissions, status updates)
│ ├── mark_training.php
│ ├── mark_announcement.php
│ ├── report_handler.php
│ └── admin_actions.php
│
├── inc/ # Includes (shared functions, header/footer)
│ ├── functions.php
│ ├── header.php
│ └── footer.php
│
├── assets/
│ ├── css/style.css # Stylesheet
│ └── js/app.js # Frontend JS (trainings + announcements)
│
├── config.php # DB config (not in GitHub, only local/host)
├── config-sample.php # Example DB config
├── setup.php # Creates tables + demo data
└── create_tables.sql # Schema + seed data


---

## 🗃️ Database Schema

Tables:

- `users` → Staff/Admin login credentials  
- `incidents` → Incident reports with status & severity  
- `training_modules` → Cyber awareness training videos  
- `user_trainings` → User → Training completion records  
- `resources` → Policy & checklist links  
- `announcements` → Admin announcements  
- `announcement_reads` → Tracks who has read announcements  

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 8+ with MySQL support
- MySQL / MariaDB
- Git
- Free hosting account (InfinityFree or similar)

### Steps

1. **Clone repo:**
   ```bash
   git clone https://github.com/kcganesh/cyberguard-sme.git
   cd cyberguard-sme

