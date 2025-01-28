# Sylhet IT Shop E-commerce System

Sylhet IT Shop is a dynamic web-based e-commerce platform designed to simulate real-world online shopping experiences. The system enables customers, administrators,suppliers and banks to collaborate seamlessly for product purchases, order tracking, and transaction management.

## **Features**

### **1. Customer Module**
- **Sign-Up and Login**: Secure account creation and login system.
- **Profile Management**: Customers can view and update personal details, including account information.
- **Shopping**: Browse and purchase products (Laptop, Mobile, Calculator) with an intuitive interface.
- **Order Tracking**: Monitor current and past orders with detailed information.

### **2. Admin Module**
- **Product Management**: Track and manage product stock and shortages.
- **Transaction Monitoring**: View detailed transaction histories.
- **Order Management**: Approve orders and monitor their statuses.

### **3. Supplier Module**
- **Supply Product**: Track and manage product to admin.

### **4. Bank Integration**
- **Payment Processing**: Handle secure payments between customers, the system, and external parties.
- **Transaction History**: Real-time updates of payment statuses.

### **5. Responsive Design**
- Optimized for both desktop and mobile devices with a clean, user-friendly interface.

### **5. Real-Time Features**
- Dynamic updates for orders and transactions using AJAX.
- Notifications for payment and inventory updates.

---

## **Technology Stack**
- **Frontend**: HTML, CSS, JavaScript, and AJAX
- **Backend**: PHP
- **Database**: MySQL
- **Development Tools**: VS Code, XAMPP

---

## **Installation Instructions**

1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   ```

2. **Set Up Environment**:
   - Install [XAMPP](https://www.apachefriends.org/index.html) to run a local server and MySQL.
   - Place the project folder in the `htdocs` directory.

3. **Configure the Database**:
   - Import the `database.sql` file into the phpmyadmin o XAMPP server to set up required database and tables.

4. **Update Configuration**:
   - Modify the `config.php` file with your database credentials.

5. **Run the Application**:
   - Start Apache and MySQL from the XAMPP control panel.
   - Open the browser and navigate to `http://localhost/<project_folder>`.

---

## **Usage**

1. **Customer Workflow**:
   - Register and log in as a customer.
   - Browse available products and place orders.
   - Track current and past orders from the profile page.

2. **Admin Workflow**:
   - Log in as an admin to manage inventory and monitor transactions.
   - View and address product shortages.
   
3. **Supplier Workflow**:
   - Log in as an supplier to supply products ordered by Admin.
   - Reduce product-shortage of admin.

4. **Bank Integration**:
   - Process payments securely through the integrated bank system.
   - Track transaction histories in real-time.
   
---

## **Future Enhancements**
- Expand the product catalog.
- Implement advanced search and filtering options.
- Add AI-based recommendations for customers.
- Integrate email notifications for order updates.

---

## **Contributors**
- **Md. Sazim Mahmudur Rahman**

---

## **License**
This project is licensed under the MIT License. Feel free to modify and distribute it as needed.
