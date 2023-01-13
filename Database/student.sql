use rec_hostel;
CREATE TABLE student (
  id INTEGER NOT NULL AUTO_INCREMENT,
  register_number VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  mail_id VARCHAR(255) NOT NULL,
  batch VARCHAR(255) NOT NULL,
  department VARCHAR(255) NOT NULL,
  section VARCHAR(255) NOT NULL,
  phone_number VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,

  PRIMARY KEY (id)
);
 