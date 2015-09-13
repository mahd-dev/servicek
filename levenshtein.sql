DELIMITER $$
CREATE FUNCTION approximate( s1 VARCHAR(21844), s2 VARCHAR(21844) )
RETURNS INT
DETERMINISTIC
BEGIN
  DECLARE s1_len, s2_len, i, total, ind, maxind INT;
  DECLARE print, str, sub, rslt VARCHAR(21844);
  SET s1_len = CHAR_LENGTH(s1), s2_len = CHAR_LENGTH(s2);
  SET i = 0, ind = 1, maxind = 0;
  IF s1_len > s2_len THEN
    SET str = s1, total = s2_len, print = s2;
  ELSE
    SET str = s2, total = s1_len, print = s1;
  END IF;
  WHILE i <= total DO
    SET sub = substr(print,1,ind);
    SET i = i+1;
    IF IFNULL(sub, '') <> '' THEN
      IF str LIKE CONCAT('%', sub, '%') THEN
        SET ind = ind+1;
        IF ind > maxind THEN
          SET maxind = ind, rslt = sub;
        END IF;
      ELSE
        SET ind = 1;
      END IF;
    ELSE
      SET ind = 1;
    END IF;
  END WHILE;
  RETURN (CHAR_LENGTH(rslt)/total)*100;
END $$
DELIMITER ;

-- SELECT id, name, approximate('hachem',name) FROM `company` ORDER BY approximate('hachem',name)





DELIMITER ;;

DROP FUNCTION IF EXISTS `jaro_winkler_similarity` ;;
-- SET SESSION SQL_MODE="";;
CREATE FUNCTION `jaro_winkler_similarity`(
in1 VARCHAR(21844),
in2 VARCHAR(21844)
) RETURNS float
    DETERMINISTIC
BEGIN
#finestra:= search window, curString:= scanning cursor for the original string, curSub:= scanning cursor for the compared string
DECLARE finestra, curString, curSub, maxSub, trasposizioni, prefixlen, maxPrefix INT;
DECLARE char1, char2 CHAR(1);
DECLARE common1, common2, old1, old2 VARCHAR(21844);
DECLARE trovato BOOLEAN;
DECLARE returnValue, jaro FLOAT;
SET maxPrefix=6; #from the original jaro - winkler algorithm
SET common1="";
SET common2="";
SET finestra=(length(in1)+length(in2)-abs(length(in1)-length(in2))) DIV 4
+ ((length(in1)+length(in2)-abs(length(in1)-length(in2)))/2) MOD 2;
SET old1=in1;
SET old2=in2;
#calculating common letters vectors
SET curString=1;
WHILE curString<=length(in1) AND (curString<=(length(in2)+finestra)) DO
SET curSub=curstring-finestra;
IF (curSub)<1 THEN
SET curSub=1;
END IF;
SET maxSub=curstring+finestra;
IF (maxSub)>length(in2) THEN
SET maxSub=length(in2);
END IF;
SET trovato = FALSE;
WHILE curSub<=maxSub AND trovato=FALSE DO
IF substr(in1,curString,1)=substr(in2,curSub,1) THEN
SET common1 = concat(common1,substr(in1,curString,1));
SET in2 = concat(substr(in2,1,curSub-1),concat("0",substr(in2,curSub+1,length(in2)-curSub+1)));
SET trovato=TRUE;
END IF;
SET curSub=curSub+1;
END WHILE;
SET curString=curString+1;
END WHILE;
#back to the original string
SET in2=old2;
SET curString=1;
WHILE curString<=length(in2) AND (curString<=(length(in1)+finestra)) DO
SET curSub=curstring-finestra;
IF (curSub)<1 THEN
SET curSub=1;
END IF;
SET maxSub=curstring+finestra;
IF (maxSub)>length(in1) THEN
SET maxSub=length(in1);
END IF;
SET trovato = FALSE;
WHILE curSub<=maxSub AND trovato=FALSE DO
IF substr(in2,curString,1)=substr(in1,curSub,1) THEN
SET common2 = concat(common2,substr(in2,curString,1));
SET in1 = concat(substr(in1,1,curSub-1),concat("0",substr(in1,curSub+1,length(in1)-curSub+1)));
SET trovato=TRUE;
END IF;
SET curSub=curSub+1;
END WHILE;
SET curString=curString+1;
END WHILE;
#back to the original string
SET in1=old1;
#calculating jaro metric
IF length(common1)<>length(common2)
THEN SET jaro=0;
ELSEIF length(common1)=0 OR length(common2)=0
THEN SET jaro=0;
ELSE
#calcolo la distanza di winkler
#passo 1: calcolo le trasposizioni
SET trasposizioni=0;
SET curString=1;
WHILE curString<=length(common1) DO
IF(substr(common1,curString,1)<>substr(common2,curString,1)) THEN
SET trasposizioni=trasposizioni+1;
END IF;
SET curString=curString+1;
END WHILE;
SET jaro=
(
length(common1)/length(in1)+
length(common2)/length(in2)+
(length(common1)-trasposizioni/2)/length(common1)
)/3;
END IF; #end if for jaro metric
#calculating common prefix for winkler metric
SET prefixlen=0;
WHILE (substring(in1,prefixlen+1,1)=substring(in2,prefixlen+1,1)) AND (prefixlen<6) DO
SET prefixlen= prefixlen+1;
END WHILE;
#calculate jaro-winkler metric
RETURN jaro+(prefixlen*0.1*(1-jaro));
END ;;

-- SET SESSION SQL_MODE=@OLD_SQL_MODE ;;
DELIMITER ;




DELIMITER $$
CREATE FUNCTION levenshtein( s1 VARCHAR(21843), s2 VARCHAR(21843) )
RETURNS INT
DETERMINISTIC
BEGIN
  DECLARE s1_len, s2_len, i, j, c, c_temp, cost, max_len INT;
  DECLARE s1_char CHAR;
  -- max strlen=255
  DECLARE cv0, cv1 VARBINARY(21844);
  SET s1_len = CHAR_LENGTH(s1), s2_len = CHAR_LENGTH(s2), cv1 = 0x00, j = 1, i = 1, c = 0;
  IF s1 = s2 THEN
    RETURN 0;
  ELSEIF s1_len = 0 THEN
    RETURN s2_len;
  ELSEIF s2_len = 0 THEN
    RETURN s1_len;
  ELSE
    WHILE j <= s2_len DO
      SET cv1 = CONCAT(cv1, UNHEX(HEX(j))), j = j + 1;
    END WHILE;
    WHILE i <= s1_len DO
      SET s1_char = SUBSTRING(s1, i, 1), c = i, cv0 = UNHEX(HEX(i)), j = 1;
      WHILE j <= s2_len DO
        SET c = c + 1;
        IF s1_char = SUBSTRING(s2, j, 1) THEN
          SET cost = 0; ELSE SET cost = 1;
        END IF;
        SET c_temp = CONV(HEX(SUBSTRING(cv1, j, 1)), 16, 10) + cost;
        IF c > c_temp THEN SET c = c_temp; END IF;
          SET c_temp = CONV(HEX(SUBSTRING(cv1, j+1, 1)), 16, 10) + 1;
          IF c > c_temp THEN
            SET c = c_temp;
          END IF;
          SET cv0 = CONCAT(cv0, UNHEX(HEX(c))), j = j + 1;
      END WHILE;
      SET cv1 = cv0, i = i + 1;
    END WHILE;
  END IF;
  IF s1_len > s2_len THEN
    SET max_len = s1_len;
  ELSE
    SET max_len = s2_len;
  END IF;
  RETURN ROUND((1 - c / max_len) * 100);
END;
DELIMITER ;

DELIMITER ;;
CREATE FUNCTION levenshtein_ratio( s1 VARCHAR(21844), s2 VARCHAR(21844) )
RETURNS INT
DETERMINISTIC
BEGIN
  DECLARE s1_len, s2_len, max_len INT;
  SET s1_len = CHAR_LENGTH(s1), s2_len = CHAR_LENGTH(s2);
  IF s1_len > s2_len THEN
    SET max_len = s1_len;
  ELSE
    SET max_len = s2_len;
  END IF;
  RETURN ROUND((1 - levenshtein(s1, s2) / max_len) * 100);
END;
DELIMITER ;
