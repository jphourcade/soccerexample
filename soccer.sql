-- Get rid of any old data by resetting the table
DROP TABLE IF EXISTS hw4SoccerPlayer;
DROP TABLE IF EXISTS hw4ClubTeam;

CREATE TABLE hw4ClubTeam (
  id int unsigned NOT NULL AUTO_INCREMENT,
  name varchar(128) NOT NULL,
  country varchar(128) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE hw4SoccerPlayer (
  id int unsigned NOT NULL AUTO_INCREMENT,
  lname varchar(128) NOT NULL,
  fname varchar(128) DEFAULT NULL,
  clubteamid int DEFAULT NULL,
  nationalteam varchar(128) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

-- Add some sample data
INSERT INTO hw4ClubTeam (name, country) VALUES ('Barcelona', 'Spain');
INSERT INTO hw4ClubTeam (name, country) VALUES ('Real Madrid', 'Spain');
INSERT INTO hw4ClubTeam (name, country) VALUES ('Juventus', 'Italy');

INSERT INTO hw4SoccerPlayer(lname, fname, clubteamid, nationalteam) VALUES ('Messi', 'Lionel', 1, 'Argentina');
INSERT INTO hw4SoccerPlayer(lname, fname, clubteamid, nationalteam) VALUES ('Ronaldo', 'Cristiano', 2, 'Portugal');
INSERT INTO hw4SoccerPlayer(lname, fname, clubteamid, nationalteam) VALUES ('Buffon', 'Gianluigi', 3, 'Italy');
