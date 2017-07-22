
load data local infile '/Users/abhigup4/Documents/Abhishek/IU/I590_SQL/project/projects/flight-report/outputfiles/la_airport_cargo_volume.xml.csv' into table la_airport_cargo_volume
 fields terminated by ','
 enclosed by '"'
 lines terminated by '\n'
 IGNORE 1 LINES
 (dataextractdate,reportperiod,arrival_departure,domestic_international,cargotype,aircargotons)
 ;

 load data local infile '/Users/abhigup4/Documents/Abhishek/IU/I590_SQL/project/projects/flight-report/outputfiles/la_flight_op_by_month.xml.csv' into table la_flight_op_by_month
 fields terminated by ','
 enclosed by '"'
 lines terminated by '\n'
 IGNORE 1 LINES
 (dataextractdate,reportperiod,flighttype,arrival_departure,domestic_international,flightopscount)
 ;

 load data local infile '/Users/abhigup4/Documents/Abhishek/IU/I590_SQL/project/projects/flight-report/outputfiles/la_flight_pessenger_count_by_carriertype.xml.csv' 
into table la_flight_pessenger_count_by_carriertype
 fields terminated by ','
 enclosed by '"'
 lines terminated by '\n'
 IGNORE 1 LINES
 (dataextractdate,reportperiod,arrival_departure,domestic_international,flighttype,passenger_count)
 ;

load data local infile '/Users/abhigup4/Documents/Abhishek/IU/I590_SQL/project/projects/flight-report/outputfiles/la_flight_pessenger_trafic_by_term.xml.csv' 
into table la_flight_pessenger_trafic_by_term
 fields terminated by ','
 enclosed by '"'
 lines terminated by '\n'
 IGNORE 1 LINES
 (dataextractdate,reportperiod,terminal,arrival_departure,domestic_international,passenger_count)
;

load data local infile '/Users/abhigup4/Documents/Abhishek/IU/I590_SQL/project/projects/flight-report/outputfiles/sfo_airtraffic_landing_stats.xml.csv' 
into table sfo_airtraffic_landing_stats
 fields terminated by ','
 enclosed by '"'
 lines terminated by '\n'
 IGNORE 1 LINES
 (@activity_period,operating_airline,operating_airline_iata_code,published_airline,published_airline_iata_code,geo_summary,geo_region,landing_aircraft_type,aircraft_body_type,aircraft_manufacturer,aircraft_model,aircraft_version,landing_count,total_landed_weight)
 SET activity_period = STR_TO_DATE(@activity_period,'%d%m%y');
;


load data local infile '/Users/abhigup4/Documents/Abhishek/IU/I590_SQL/project/projects/flight-report/outputfiles/SFO_noise_excedence.xml.csv' 
into table SFO_noise_excedence
 fields terminated by ','
 enclosed by '"'
 lines terminated by '\n'
 IGNORE 1 LINES
 (year,month,airline_code,airline,total_noise_exceedances,total_operations_per_month,exceedances_per_1000_operations,noise_exceedance_quality_rating_score);
;

load data local infile '/Users/abhigup4/Documents/Abhishek/IU/I590_SQL/project/projects/flight-report/outputfiles/sfo_pessenger_stats.xml.csv' 
into table sfo_pessenger_stats
 fields terminated by ','
 enclosed by '"'
 lines terminated by '\n'
 IGNORE 1 LINES
 (@activity_period, operating_airline,operating_airline_iata_code,published_airline,published_airline_iata_code,geo_summary,geo_region,activity_type_code,price_category_code,terminal,boarding_area, passenger_count)
 SET activity_period = STR_TO_DATE(@activity_period,'%d%m%y');
;



