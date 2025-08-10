-- Drop tables if they exist (order matters if there are dependencies)
DROP TABLE IF EXISTS amenities;
DROP TABLE IF EXISTS registration;
/*DROP TABLE IF EXISTS images;*/
DROP TABLE IF EXISTS notices;
DROP TABLE IF EXISTS payrecords;
DROP TABLE IF EXISTS combox;
DROP TABLE IF EXISTS admins;


CREATE  TABLE admins(
	id SERIAL PRIMARY KEY,
	username VARCHAR(50) UNIQUE NOT NULL,
	admin_code VARCHAR(50) NOT NULL
);
INSERT INTO admins(username, admin_code)
VALUES('Admin','100');
SELECT * from admins WHERE username = 'Admin';
-- Create table for complaints (combox)
CREATE TABLE combox (
    id SERIAL PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    complaint VARCHAR(500) NOT NULL
);
/*
INSERT INTO combox (id, title, complaint) VALUES
(12, 'Leakage problem', 'This is to inform that is leakage in my flat due to the society water tank leaking. The tank is placed right above our flat and i request society to change the tank and do take neccessary actions on that.
c-005,Shubham'),
(2, 'clubhouse complaint', 'This is to inform that electricity switch board near door of clubhouse is not working i request to fix it as soon as possible.'),
(3, 'garden problem', 'there is repairs in garden area'),
(4, 'Leakage problem', 'there is issue in leakage');
 */
SELECT * from combox;

-- Create table for payments (payrecords)
CREATE TABLE payrecords (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    flatno INTEGER NOT NULL,
    amount INTEGER NOT NULL,
    status VARCHAR(100) NOT NULL
);

INSERT INTO payrecords (id, name, flatno, amount, status) VALUES
(1, 'Shubham', 8, 1000, 'Success'),
(2, 'Sonali', 7, 1000, 'Success');
SELECT * FROM payrecords;
-- Create table for notices (noticeboard)
CREATE TABLE notices (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(20) NOT NULL,
    noticedate DATE NOT NULL,
    message VARCHAR(500) NOT NULL
);
/*
INSERT INTO notices (id, name, type, noticedate, message) VALUES
(1, 'Lack of water Supply', 'Announcements', '2021-10-04', 'This is to inform you that there is a shortage of drinking & domestic water “due to breakage of water pipeline near our society”. Please make necessary arrangement to store water as per your requirement till Tommorow Evening 6pm. Avoid wastage of water, save drops of water.
Inconvenience is regretted.'),
(2, 'Ganpati celebration Discusssion', 'Events', '2021-10-04', 'On the auspicious occasion of Ganesh chaturti, the Society has organized a event followed by activities. All members of the society are requested to attend the event discussion in the clubhouse of the society at 8:00 pm on the 2nd of September.
Thank You,
Thanekar Parkland.'),
(3, 'meeting regarding water problem', 'Announcements', '2021-10-05', 'today there is meeting in clubhouse at 8.00 pm evening all are requested to attend the meeting.'),
(4, 'Diwali celebration Discusssion', 'Events', '2022-07-12', 'dicussion on event');
*/
SELECT * FROM notices;
-- Create table for images (userimage)
/*CREATE TABLE images (
    id SERIAL PRIMARY KEY,
    image_url TEXT NOT NULL
);

INSERT INTO images (id, image_url) VALUES
(1,' IMG-617627ff778ad9.82682524.jpg',
  2,' IMG-6176280bb21e86.75353156.jpg',
  5,' IMG-62cd7d0a2e28c2.83360011.jpg');
SELECT * FROM images;*/
-- Create table for user registration (usersregister)
CREATE TABLE registration (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    flatno INTEGER NOT NULL,
    mobileno BIGINT NOT NULL,
    "nno of family members" INTEGER NOT NULL,
    password VARCHAR(20) NOT NULL,
    active INTEGER NOT NULL
);

INSERT INTO registration (id, username, email, flatno, mobileno, "nno of family members", password, active) VALUES
/*(2, 'Sonali', 'sonali01@gmail.com', 9, 8779635233, 4, '56ddud', 1),
(3, 'Shubham', 'shubhamvartak01@gmail.com', 8, 8779635279, 4, 'sgssjs', 1),
(9, 'ankita', 'ankita@gmail.com', 5, 8927393932, 2, 'shubhu123', 1),
(10, 'sheffer', 'sheffer@gmail.com', 4, 2344567393, 2, 'shubu123', 0),*/
(12, 'jithin', 'jithin@gmail.com', 1, 8779635278, 3, 'shubhu123', 1);
SELECT * FROM registration;

CREATE TABLE amenities (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL
);

INSERT INTO amenities (name, description) VALUES
('Swimming Pool', 'Enjoy our outdoor swimming pool available for residents.'),
('Gym', 'Our fully equipped gym is available 24/7 for all members.'),
('Park', 'A beautiful park area for relaxation and outdoor activities.'),
('Clubhouse', 'A community clubhouse for events and gatherings.');
SELECT*FROM amenities;


/*ALTER TABLE users ADD COLUMN reset_token VARCHAR(64);
ALTER TABLE users ADD COLUMN reset_expires TIMESTAMP;*/
