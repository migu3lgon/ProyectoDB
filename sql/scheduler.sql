SET GLOBAL event_scheduler = ON;


CREATE EVENT e_desdestacar
    ON SCHEDULE
      EVERY 1 day
    STARTS '2018-10-23 00:00:00' ON COMPLETION PRESERVE ENABLE 
    DO
      call desdestacar();