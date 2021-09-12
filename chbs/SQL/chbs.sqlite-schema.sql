BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "manager" (
	"manager_id"	INTEGER,
	"name"	TEXT,
	"phone"	TEXT,
	"email"	TEXT,
	PRIMARY KEY("manager_id")
);
CREATE TABLE IF NOT EXISTS "client" (
	"client_id"	INTEGER,
	"name"	TEXT,
	"phone"	TEXT,
	"address"	TEXT,
	"email"	TEXT,
	PRIMARY KEY("client_id")
);
CREATE TABLE IF NOT EXISTS "booking" (
	"booking_id"	INTEGER,
	"client_id"	INTEGER,
	"hall_id"	INTEGER,
	"slot"	TEXT,
	"date"	TEXT,
	PRIMARY KEY("booking_id"),
	FOREIGN KEY("client_id") REFERENCES client(client_id),
	FOREIGN KEY("hall_id") REFERENCES hall(hall_id)
);
CREATE TABLE IF NOT EXISTS "hall" (
	"hall_id"	INTEGER,
	"name"	TEXT,
	"phone"	TEXT,
	"address"	TEXT,
	"rent"	INTEGER,
	"size"	TEXT,
	"manager_id"	INTEGER,
	PRIMARY KEY("hall_id"),
	FOREIGN KEY("manager_id") REFERENCES manager(manager_id)
);
CREATE TABLE IF NOT EXISTS "users" (
	"username"	TEXT,
	"password"	TEXT,
	"type"	TEXT
);
COMMIT;
