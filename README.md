Tugas Mata Kuliah Probabilitas dan Statistika

# LiverCare

LiverCare is a web-based application designed to analyze liver conditions using two machine learning models: **K-Means** and **Naive Bayes**. The application helps visualize confusion matrices, calculate performance metrics (accuracy, precision, recall), and compare the predictions of these algorithms with the actual results.

## Features

- **Compare K-Means and Naive Bayes**: The app allows for side-by-side comparisons of True Positive (TP), True Negative (TN), False Positive (FP), and False Negative (FN) values.
- **Confusion Matrix Visualization**: Displays confusion matrices for both K-Means and Naive Bayes.
- **Performance Metrics**: Calculates and displays accuracy, precision, and recall for both models.
- **Liver Condition Testing**: Users can test and view liver condition results based on various medical parameters (Alkphos, SGPT, SGOT).

## Tech Stack

- **PHP**: Backend logic and connection to MySQL database.
- **MySQL**: Database storing liver condition testing data.
- **HTML/CSS**: Frontend for displaying results and tables.
- **Bootstrap**: Styling framework for responsive design.

## Table Overview

- **Testing Table**: Contains actual liver test results and predictions by K-Means and Naive Bayes models.
- **Confusion Matrix Table**: Shows a comparison of model performance metrics like accuracy, precision, and recall for both K-Means and Naive Bayes.

## Installation

### Prerequisites

- PHP 7.4 or later
- MySQL
- Web server (Apache, Nginx)

### Steps to Run the Project

1. Clone the repository:
   ```bash
   git clone https://github.com/silvarsta/LiverCare.git
   ```
   
2. Navigate to the project folder:
   ```bash
   cd LiverCare
   ```

3. Import the database:
   - Find the database file (`livercare.sql`) in the `database/` folder and import it into your MySQL server.

4. Configure your database connection:
   - Edit the `koneksi.php` file with your MySQL credentials.

5. Start your PHP server:
   ```bash
   php -S localhost:8000
   ```

6. Open your browser and go to `http://localhost:8000`.

## Usage

- Navigate to the "Confusion Matrix" section to view the performance metrics of K-Means and Naive Bayes.
- Use the "Check up List" to test new liver condition data and see predictions.

Let me know if you need further adjustments!
