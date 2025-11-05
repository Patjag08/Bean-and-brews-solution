CREATE TABLE user (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  user_email VARCHAR(255) NOT NULL,
  user_name VARCHAR(255) NOT NULL,
  user_password VARCHAR(255) NOT NULL
);

CREATE TABLE past_orders (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  orders_json JSON,
  FOREIGN KEY (user_id) REFERENCES user(user_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE current_order (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  order_data JSON NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user(user_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE booked_lesson (
  lesson_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  tutor_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user(user_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE staff_accounts (
  staff_id INT AUTO_INCREMENT PRIMARY KEY,
  staff_user VARCHAR(255),
  staff_password VARCHAR(255)
);
