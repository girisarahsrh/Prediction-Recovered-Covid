# 🦠 Prediction of Recovered COVID-19 Cases using Backpropagation Neural Network

<p align="center">
  <img src="https://img.shields.io/badge/PHP-7.x-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/CodeIgniter-3.x-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/Bootstrap-4-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" />
</p>

---

## 📖 About

**Prediction of Recovered COVID-19 Cases** is a web-based application built to predict the number of COVID-19 recovered cases across multiple countries using the **Backpropagation Neural Network** algorithm. The system processes historical COVID-19 data, performs data normalization, trains a neural network model, and forecasts future recovery numbers — providing accuracy metrics such as **MAD**, **MAPE**, and **Accuracy percentage**.

This application was developed as part of an academic research project to demonstrate the implementation of Artificial Neural Networks (ANN) for time-series disease prediction.

---

## ✨ Features

- 🔐 **User Authentication** — Secure login system with session management
- 🌍 **Multi-Country Support** — View and analyze COVID-19 data per country using country codes
- 📊 **Dashboard Overview** — Summary of total confirmed cases, deaths, and recoveries
- 📈 **Interactive Charts** — Dynamic visualization of COVID-19 trends per country
- 🗃️ **Master Data Management** — CRUD operations for COVID-19 dataset with pagination
- 🔢 **Data Normalization** — Automatic min-max normalization of input features (x1–x5)
- 🧠 **Backpropagation Training** — Neural network training with:
  - 4 input neurons (Confirmed, Death, Daily Confirmed, Daily Death)
  - 4 hidden layer neurons
  - 1 output neuron (Recovered)
  - Learning rate: 0.9
  - 10,000 epochs
- 🎯 **Prediction / Forecasting** — Denormalized prediction output for recovered cases
- 📉 **Accuracy Evaluation** — Reports MAD, MAPE, and Accuracy metrics
- 📋 **Report Page** — Tabular view of prediction results compared to actual values
- 📤 **Excel Export** — Export data using the Spout library

---

## 🛠️ Technology Stack

| Layer        | Technology                        |
|--------------|-----------------------------------|
| Language     | PHP 7.x                           |
| Framework    | CodeIgniter 3.x                   |
| Database     | MySQL                             |
| Frontend     | Bootstrap 4, jQuery, Chart.js     |
| Excel Export | Box/Spout Library                 |
| Server       | Apache (XAMPP)                    |

---

## 🧠 Neural Network Architecture

The application implements a **Feed-Forward Backpropagation Neural Network** with the following structure:

```
Input Layer (4 neurons)          Hidden Layer (4 neurons)       Output Layer (1 neuron)
─────────────────────────────────────────────────────────────────────────────────────
  x1 (Confirmed Cases)    ──┐
  x2 (Deaths)             ──┼──► Z1, Z2, Z3, Z4 (sigmoid) ──► Y (Recovered Prediction)
  x3 (Daily Confirmed)    ──┤
  x4 (Daily Deaths)       ──┘
```

**Activation Function:** Sigmoid  
**Training Algorithm:** Gradient Descent Backpropagation  
**Learning Rate (α):** 0.9  
**Epochs:** 10,000  
**Error Metric:** MSE (Mean Squared Error)

---

## 📂 Project Structure

```
Prediction-Recovered-Covid/
│
├── application/
│   ├── controllers/
│   │   ├── CC.php              # Main controller (auth, pages, normalization, training)
│   │   ├── HITUNGAN.php        # Alternative backpropagation implementation
│   │   └── back.php            # Utility/helper controller
│   │
│   ├── models/
│   │   └── MData.php           # Data access model (queries for all features)
│   │
│   └── views/
│       ├── LoginPage.php       # Login interface
│       ├── HomePage.php        # Dashboard with statistics & chart
│       ├── MasterDataPage.php  # COVID-19 dataset table
│       ├── NormalisasiPage.php # Normalized data view
│       ├── ProcessPage.php     # Training process overview
│       ├── FinalPage.php       # Prediction output
│       ├── AllAlgoritmaPage.php# All-country algorithm page
│       ├── BackpropagationPage.php # Detailed backpropagation steps
│       ├── ReportPage.php      # Final report: accuracy, MAPE, MAD
│       ├── Header/ & Footer/   # Shared layout components
│       └── ...
│
├── Assets/                     # CSS, JS, images
├── dbcovid19.sql               # MySQL database dump
├── composer.json               # Composer dependencies
└── index.php                   # Application entry point
```

---

## ⚙️ Installation & Setup

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (PHP 7.x + MySQL + Apache)
- Web browser (Chrome / Firefox)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/girisarahmustika/Prediction-Recovered-Covid.git
   ```

2. **Move to XAMPP htdocs**
   ```bash
   mv Prediction-Recovered-Covid /Applications/XAMPP/xamppfiles/htdocs/
   # or on Windows: C:\xampp\htdocs\
   ```

3. **Import the database**
   - Open [phpMyAdmin](http://localhost/phpmyadmin)
   - Create a new database: `dbcovid19`
   - Import the file: `dbcovid19.sql`

4. **Configure the database connection**  
   Edit `application/config/database.php`:
   ```php
   $db['default'] = array(
       'hostname' => 'localhost',
       'username' => 'root',
       'password' => '',
       'database' => 'dbcovid19',
       ...
   );
   ```

5. **Configure base URL**  
   Edit `application/config/config.php`:
   ```php
   $config['base_url'] = 'http://localhost/Prediction-Recovered-Covid/';
   ```

6. **Start XAMPP** and open in browser:
   ```
   http://localhost/Prediction-Recovered-Covid/
   ```

---

## 🔄 Application Workflow

```
Login
  │
  ▼
Dashboard (Home)
  │  ── View total confirmed, death, recovered per country
  │  ── Interactive time-series chart
  │
  ▼
Master Data
  │  ── View raw COVID-19 dataset
  │
  ▼
Normalization
  │  ── Min-max normalization of x1, x2, x3, x4, x5
  │
  ▼
Training Process (Backpropagation)
  │  ── Random weight initialization
  │  ── Feed-forward computation
  │  ── Backpropagation weight update
  │  ── 10,000 epochs
  │
  ▼
Final Prediction
  │  ── Denormalize output
  │  ── Calculate MAD, MAPE, Accuracy
  │
  ▼
Report
     ── Table of predicted vs actual recovered cases
```

---

## 📊 Evaluation Metrics

| Metric | Description |
|--------|-------------|
| **MAD** | Mean Absolute Deviation |
| **MAPE** | Mean Absolute Percentage Error |
| **Accuracy** | `100% - MAPE` |

---

## 🗄️ Database Tables

| Table         | Description                                      |
|---------------|--------------------------------------------------|
| `datagrafik`  | Raw COVID-19 data (confirmed, death, recovered)  |
| `normalisasi` | Normalized feature values (x1–x5)               |
| `bobotbaru`   | Updated neural network weights after training    |
| `bobotrandom` | Initial random weights                           |
| `final`       | Prediction results per country                   |
| `users`       | Authentication data                              |

---

## 📌 Notes

- The dataset is focused on COVID-19 data starting from early 2020.
- Training uses data up to a cutoff date and predicts the next time step.
- Country data is referenced by **country code** (e.g., `CHN` for China).
- The system supports per-country individual training as well as bulk "All Algorithm" processing.

---

## 👩‍💻 Author

**Giri Sarah Mustika**  
📧 [GitHub Profile](https://github.com/girisarahmustika)

---

## 📄 License

This project is licensed under the [MIT License](license.txt).

---

> ⚠️ **Disclaimer:** This application is built for academic research purposes. Prediction results are based on historical data and neural network modeling and should not be used as a substitute for official health guidance.
