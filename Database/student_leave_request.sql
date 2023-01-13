use rec_hostel;
CREATE TABLE student_leave_request (
  id INTEGER NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  register_number VARCHAR(255) NOT NULL,
  batch VARCHAR(255) NOT NULL,
  department VARCHAR(255) NOT NULL,
  section VARCHAR(255) NOT NULL,
  room_number VARCHAR(255) NOT NULL,
  leave_type VARCHAR(255) NOT NULL,
  reason VARCHAR(255) NOT NULL,
  apply_date DATE NOT NULL,
  apply_time Time NOT NULL,
  start_date DATE NOT NULL,
  start_time TIME NOT NULL,
  end_date DATE NOT NULL,
  end_time TIME NOT NULL,
  address VARCHAR(255) NOT NULL,
  fphone_number VARCHAR(255) NOT NULL,
  mphone_number VARCHAR(255) NOT NULL,
  classincharge_status VARCHAR(255) NOT NULL,
  hostelwarden_status VARCHAR(255) NOT NULL,
  hod_status VARCHAR(255) NOT NULL,
  principal_status VARCHAR(255) NOT NULL,
  security_status VARCHAR(255) NOT NULL,
  
  PRIMARY KEY (id)
);
