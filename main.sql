drop database if exists BookMyDoctor;
create database BookMyDoctor;
use BookMyDoctor;

create table Patient(
pid int UNSIGNED AUTO_INCREMENT NOT NULL,
fname varchar(25) NOT NULL,
lname varchar(25) NOT NULL,
dob date NOT NULL,
sex varchar(1),
phone_no varchar(20),
email varchar(30),
password varchar(25),
primary key (pid)
);

create table Doctor(
did int UNSIGNED AUTO_INCREMENT NOT NULL,
fname varchar(25) NOT NULL,
lname varchar(25) NOT NULL,
dob date NOT NULL,
sex varchar(1),
phone_no varchar(20),
email varchar(30),
password varchar(25),
fee int,
primary key(did)
);

create table Doc_Qualification(
doc_id int UNSIGNED NOT NULL,
degree varchar(50) NOT NULL,
date_of_pass date,
college varchar(100),
primary key (doc_id,degree),
foreign key (doc_id) references Doctor(did)
);

create table Doc_Experience(
doc_ide int UNSIGNED NOT NULL,
practicing_since date,
total_years int,
primary key(doc_ide),
foreign key (doc_ide) references Doctor(did)
);

create table Doc_MedReg(
doc_idm int UNSIGNED NOT NULL,
med_regNo varchar(20),
primary key(doc_idm),
foreign key (doc_idm) references Doctor(did)
);

create table Doc_Awards(
doc_ida int UNSIGNED NOT NULL,
award varchar(30),
primary key(doc_ida,award),
foreign key (doc_ida) references Doctor(did)
);

create table Doc_Workplace(
doc_idw int UNSIGNED NOT NULL,
workplace varchar(100),
primary key(doc_idw,workplace),
foreign key (doc_idw) references Doctor(did)
);

create table Specializations(
spec_id int UNSIGNED AUTO_INCREMENT NOT NULL,
spec_name varchar(60),
primary key (spec_id)
);

create table Symptoms(
symp_name varchar(30),
sp_name varchar(30),
primary key(symp_name)
);

create table Doc_Specializations(
doc_ids int UNSIGNED NOT NULL,
sp_ids int UNSIGNED NOT NULL,
primary key(doc_ids,sp_ids),
foreign key(doc_ids) references Doctor(did)
);


create table Doc_Spec_Name(
doc_ids int UNSIGNED NOT NULL,
sp_name varchar(30) NOT NULL,
primary key(doc_ids,sp_name),
foreign key(doc_ids) references Doctor(did)
);

create table Addresses(
aid int UNSIGNED AUTO_INCREMENT NOT NULL,
a_line1 varchar(50) NOT NULL,
a_line2 varchar(25),
a_line3 varchar(25),
city_town varchar(15),
postal_code varchar(30),
state varchar(30),
country varchar(25),
primary key (aid)
);

create table Patient_Addresses(
patient_id int UNSIGNED NOT NULL,
address_id int UNSIGNED NOT NULL,
primary key(patient_id),
foreign key (address_id) references Addresses(aid)
);

create table Doctor_Addresses(
doc_ida int UNSIGNED NOT NULL,
add_id int UNSIGNED NOT NULL,
primary key(doc_ida),
foreign key (add_id) references Addresses(aid)
);

-- drop table appointments;
CREATE TABLE `appointments` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `pid` int UNSIGNED,
  `did` int UNSIGNED,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  foreign key (`pid`) references Patient(pid),
  foreign key (`did`) references Doctor(did)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


create table Doc_Slots(
doc_idd int UNSIGNED NOT NULL,
open int,
close int,
slot_duration int,
primary key(doc_idd),
foreign key(doc_idd) references Doctor(did)
);

create table Doc_NA(
doc_idn int UNSIGNED NOT NULL,
date_na date,
day_na varchar(15),
primary key(doc_idn,date_na),
foreign key(doc_idn) references Doctor(did)
);

create table Patient_Report(
rep_id int UNSIGNED AUTO_INCREMENT NOT NULL,
patient_idr int UNSIGNED NOT NULL,
doc_idp int UNSIGNED NOT NULL,
rep_scan_loc text,
presc_scan_loc text,
primary key(rep_id),
foreign key(doc_idp) references Doctor(did),
foreign key (patient_idr) references Patient(pid)
);

create table Admin(
fname varchar(25) NOT NULL,
lname varchar(25) NOT NULL,
dob date NOT NULL,
sex varchar(10),
phone_no varchar(20),
email varchar(30),
password varchar(25),
primary key (fname)
);

insert into Specializations(spec_name) values
("Acupuncturist"),
("Allergist (Immunologist)"),
("Audiologist"),
("Cardiologist (Heart Doctor)"),
("Cardiothoracic Surgeon"),
("Chiropractor"),
("Colorectal Surgeon"),
("Dentist"),
("Dermatologist"),
("Dietitian / Nutritionist"),
("Ear, Nose & Throat Doctor (ENT)"),
("Endocrinologist (incl Diabetes Specialists)"),
("Eye Doctor"),
("Gastroenterologist"),
("Geriatrician"),
("Hearing Specialist"),
("Hematologist (Blood Specialist)"),
("Infectious Disease Specialist"),
("Infertility Specialist"),
("Midwife"),
("Naturopathic Doctor"),
("Nephrologist (Kidney Specialist)"),
("Neurologist (incl Headache Specialists)"),
("Neurosurgeon"),
("OB-GYN (Obstetrician-Gynecologist)"),
("Oncologist"),
("Ophthalmologist"),
("Optometrist"),
("Oral Surgeon"),
("Orthodontist"),
("Orthopedic Surgeon (Orthopedist)"),
("Pain Management Specialist"),
("Pediatric Dentist"),
("Pediatrician"),
("Physiatrist (Physical Medicine)"),
("Physical Therapist"),
("Plastic Surgeon"),
("Podiatrist (Foot and Ankle Specialist)"),
("Primary Care Doctor"),
("Prosthodontist"),
("Psychiatrist"),
("Psychologist"),
("Pulmonologist (Lung Doctor)"),
("Radiologist"),
("Rheumatologist"),
("Sleep Medicine Specialist"),
("Sports Medicine Specialist"),
("Surgeon"),
("Therapist / Counselor"),
("Urgent Care Doctor"), 
("Urological Surgeon"),
("Urologist"),
("Vascular Surgeon"),
("Homeopathic"),
("Hair Transplant"),
("Hair Removal Laser"),
("Veterinarian");

insert into Symptoms values('Abdominal Pain','Acupuncturist'),
('Chest pain','Cardiologist'),
('Constipation','Chiropractor'),
('Cough','Audiologist'),
('Diarrhea','Dermatologist'),
('Dizziness','Dentist');

insert into Admin values('Rao','Mujadad','1996-01-11','Male','03007204553','mujadadrao@ucp.edu.pk','123456');

 insert into Doctor(fname, lname, dob, sex, phone_no, email, password, fee) values
("Khurram", "Mirza", "1978/3/16", "M", "04235876743", "k.mirza@hameedlafif.com", "mirzamirza", "2000"),
("Iqbal", "Bhutta", "1970/3/12", "M", "04235675755", "iqbalbhutta@hotmail.com", "ibhutta", "1500"),
("Ghazala", "Bashir", "1965/1/3", "F", "04235875335", "ghazala@gmail.com", "gbashir", "2000"),
("Iqbal", "Ahmed", "1969/5/4", "M", "0518783431", "iqbalahmed@ymail.com", "iahmed", "1200"),
("Aqil", "Qazi", "1963/12/9", "M", "04235732312", "aqilqazi@hotmail.com", "aqazi", "1500"),
("Tariq", "Zafar", "1959/6/12", "M", "04235914456", "tariqzafar@fatimamem.com", "tzafar", "1500"),
("Gen (R) Javed", "Hassan", "1944/5/1", "M", "03224215413", "javed.hassan@hotmail.com", "jhassan", "10"),
("Irfana", "Razzaq", "1977/7/3", "F", "0218678355", "razzaq_irfana@hotmail.com", "irazzaq", "700"),
("Asim", "Hussain", "1953/11/28", "M", "0219745531", "asim.hussain@ppp.com", "igood", "500"),
("Col. Farhan", "Majeed", "1969/1/30", "M", "04299543542", "farhan_majeed@cmh.com", "ifarhan", "500");


insert into Doc_MedReg values
("1", "11194-P"),
("2", "1056-P"),
("3", "10567-P"),
("4", "11175-P"),
("5", "11198-P"),
("6", "11177-P"),
("7", "19631/7018-P/M"),
("8", "1122-P"),
("9", "11244-P"),
("10", "7008/20948-P/M");


insert into Doc_Qualification values
("1", "FRCS", "2008/5/3", "Edin & Glasg."),
("2", "FRCS", "2004/5/2", "King Edward Medical College"),
("3", "BDS", "1989/7/5", "Allama Iqbal Medical College"),
("4", "FCPS", "2001/12/2", "UK"),
("5", "FRCS", "1999/1/1", "USA"),
("6", "FRCS", "1991/2/3", "UK"),
("7", "MRCOG", "1985/7/8", "Edin & Glasg."),
("8", "DPD", "2010/10/1", "Cardiff"),
("9", "MBBS", "1979/6/6", "Kings College London"),
("10", "MD", "1999/11/6", "Drexel University College of Medicine");


insert into Doc_Experience values
("1", "2009/3/4",12),
("2", "2004/12/30",13),
("3", "1990/12/30",14),
("4", "2002/12/23",15),
("5", "2000/12/31",16),
("6", "1991/12/9",7),
("7", "1985/12/12",5),
("8", "2007/12/31",2),
("9", "1979/12/13",26),
("10", "1999/12/15",21);

insert into Doc_Awards values
("1", "Sitara-e-Imtiaz"),
("1", "CMH Award"),
("2", "Sensation Award"),
("2", "Best Den."),
("3", "CMH Award"),
("3", "Sitara-e-Akhuwat"),
("4", "Best Den."),
("4", "CVX Award"),
("5", "Sitara-e-Jurrat"),
("5", "HKY Award"),
("6", "Cool Doctor"),
("6", "Tamgha-e-Imtiaz"),
("7", "Sitara-e-Akhuwat"),
("7", "Saudi Special Service Award "),
("8", "CVX Award"),
("8", "CMH Award"),
("9", "HKY Award"),
("9", "Sitara-e-Jurrat"),
("10", "Sitara-e-Basalat"),
("10", "Tamgha-e-Imtiaz");


insert into Doc_workplace values
("1", "Doctors Hospital"),
("1", "Ammar Hospital"),
("2", "National Hospital"),
("2", "Ammar Hospita"),
("3", "Ammar Hospital"),
("3", "Doctors Hospital"),
("4", "Fountain House"),
("4", "Ammar Hospita"),
("5", "Fatima Memorial"),
("5", "Ammar Hospita"),
("6", "Hameed Latif"),
("6", "Ammar Hospita"),
("7", "King Fahad Palace"),
("7", "Army Medical College"),
("8", "Fatima Memorial Hospital"),
("8", "American Hospital"),
("9", "Zia-ud-din group of Hospitals"),
("9", "Home"),
("10", "C.M.H."),
("10", "Army Medical College");


insert into Doc_Slots values
("1","0930", "1930", "30"),
("2","0930", "1930", "30"),
("3","0930", "1930", "30"),
("4","0930", "1930", "30"),
("5","0930", "1930", "30"),
("6","0930", "1930", "30"),
("7","0930", "1930", "30"),
("8","0930", "1930", "30"),
("9","0930", "1930", "30");

insert into Doc_NA values
("1", "2016/6/7", "Sunday"),
("2", "2016/6/7", "Sunday"),
("3", "2016/6/7", "Sunday"),
("4", "2016/6/7", "Sunday"),
("5", "2016/6/7", "Sunday"),
("6", "2016/6/7", "Sunday"),
("7", "2016/6/1", "Monday"),
("7", "2016/6/2", "Tuesday"),
("7", "2016/6/3", "Wednesday"),
("7", "2016/6/4", "Thursday"),
("7", "2016/6/5", "Friday"),
("8", "2016/6/7", "Sunday"),
("9", "2016/6/7", "Sunday"),
("10", "2016/6/7", "Sunday");


insert into Doc_Specializations values
("1", "31"),
("1", "13"),
("2", "31"),
("3", "36"),
("4", "16"),
("5", "31"),
("5", "13"),
("6", "34"),
("7", "4"),
("7", "5"),
("8", "9"),
("9", "39"),
("10", "5"),
("10", "49");


insert into Patient(fname, lname, dob, sex, phone_no, email, password) values
("Asif", "Zardari", "1955/7/26", "M", "0512282781", "president@gmail.com", "ithezardari"),
("Maulana Fazal", "Rehman", "1953/6/19", "M", "03008506684", "diesel@gmail.com", "imaulana"),
("Nawaz", "Sharif", "1949/12/25", "M", "0512281700", "nawaz_sharif@hotmail.com", "icorrupt"),
("Altaf", "Hussain", "1953/9/17", "M", "00447885013998", "altafbhai@mqm.uk", "ialtaf"),
("Zulfiqar", "Bhutto", "1928/1/5", "M", "051443421", "jiyebhutto@ppp.com", "ialive"),
("Usama", "Laden", "1977/11/30", "M", "03439151109", "usama@gmail.com", "isaint"),
("Uzair", "Baloch", "1979/1/11", "M", "03127678988", "uzair_baloch@ppp.com", "ibaloch"),
("Queen", "Elizabeth II", "1926/4/21", "F", "00442076361555", "queen@gmail.com", "irule");



insert into Addresses(a_line1, a_line2, a_line3, city_town, postal_code, state, country) values
("D-30", "Block 3", "Clifton", "Karachi",  NULL, "Sindh", "Pakistan"),
("G-209", "Parliament Lodges",  NULL, "Islamabad",  NULL, "Capital", "Pakistan"),
("Raiwand Palace", "Jatti Umrah", "Raiwand Road", "Lahore",  NULL, "Punjab", "Pakistan"),
("12-Abbey Road", "Mill Hill", "Edgeware", "London", "HA8", "Greater London", "UK"),
("D-30", "Block 3", "Clifton", "Karachi",  NULL, "Sindh", "Pakistan"),
("31-Bilal Town",  NULL,  NULL, "Abbottabad",  NULL, "Khyber Pakhtunkha", "Pakistan"),
("2013", "The Greens", "Al-Ghaf", "Dubai",  NULL, "Dubai", "UAE"),
("1AA", "Buckingham Palace",  NULL, "London", "SW1A", "Central London", "England"),
("Hameed Latif Hospital", "33-Abu Bakr Block", "New Garden Town", "Lahore", "54606", "Punjab", "Pakistan"),
("King Edward Medical College",  NULL,  NULL, "Lahore",  NULL, "Punjab", "Pakistan"),
("269-B STREET NO.6", " OFFICER'S COLONY", "CAVALRY GROUND", "Lahore", "NULL", "Punjab", "Pakistan"),
("7 MASJID ROAD", "F-6/3",  NULL, "Islamabad",  NULL, "Capital", "Pakistan"),
("37-TARIQ BLOCK", "NEW GARDEN TOWN", "N/A", "Lahore", "54606", "Punjab", "Pakistan"),
("Fatima Memorial Hospital", "Shadman Road",  NULL, "Lahore",  NULL, "Punjab", "Pakistan"),
("17 Peshawar Road", "Nur Khan Air Base",  NULL, "Rawalpindi",  NULL, "Punjab", "Pakistan"),
("C.M.H.", " MALIR CANTT.",  NULL, "Karachi",  NULL, "Sindh", "Pakistan"),
("4/B Shahrah-e-Ghalib", "Block 6", "Clifton", "Karachi", "75600", "Sindh", "Pakistan");


insert into Patient_Addresses values
("1", "1"),
("2", "2"),
("3", "3"),
("4", "4"),
("5", "5"),
("6", "6"),
("7", "7"),
("8", "8");

insert into Doctor_Addresses values
("1", "9"),
("2", "10"),
("3", "11"),
("4", "12"),
("5", "13"),
("6", "14"),
("7", "15"),
("8", "16"),
("9", "17");

insert into Doc_Spec_name values(1,'Acupuncturist'),
(2,'Allergist (Immunologist)'),
(3,'Audiologist'),
(4,'Cardiologist (Heart Doctor)'),
(5,'Chiropractor'),
(6,'Colorectal Surgeon'),
(7,'Dentist'),
(8,'Dermatologist'),
(9,'Dietitian / Nutritionist'),
(1,'Audiologist');



/*
insert into Symptoms values('Abdominal Pain','Acupuncturist'),
('Chest pain','Cardiologist'),
('Constipation','Chiropractor'),
('Cough','Audiologist'),
('Diarrhea','Dermatologist'),
('Dizziness','Dentist');





select * from Patient;

select * from Doctor_Addresses DA join Addresses A ON DA.add_id = A.aid where DA.doc_ida=3;

select * from Doc_Awards;

select * from Patient;

select * from Addresses;

select * from Doc_Workplace;

select * from Doctor_Addresses;

select * from Doctor_Addresses DA join Addresses A ON DA.add_id = A.aid where DA.doc_ida = 10;

select * from Patient_Addresses;

select * from Doc_Experience;

select * from Doc_Awards;

select * from Doc_Spec_name;

select * from Symptoms;

select * from Doctor;