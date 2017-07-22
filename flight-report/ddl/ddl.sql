
USE I590;

DROP TABLE IF EXISTS sfo_pessenger_stats
;

CREATE TABLE sfo_pessenger_stats(
	activity_period date,
    Operating_airline varchar(20),
    Operating_Airline_IATA_Code varchar(20),
    Published_Airline varchar(20),
    Published_Airline_IATA_Code varchar(20),
    GEO_Summary varchar(20),
    GEO_Region varchar(20),
    Activity_Type_Code varchar(20),
    Price_Category_Code varchar(20),
    Terminal varchar(20),
    Boarding_Area varchar(20),
    passenger_count int
);

-- select * from  sfo_pessenger_stats
-- ;


DROP TABLE IF EXISTS SFO_noise_excedence
;

CREATE TABLE SFO_noise_excedence(
	year int,
    month varchar(20),
    airline_code varchar(20),
    airline varchar(20),
    total_noise_exceedances int,
    total_operations_per_month int,
    exceedances_per_1000_operations int,
    noise_exceedance_quality_rating_score float
);

-- select * from  SFO_noise_excedence
-- ;

DROP TABLE IF EXISTS sfo_airtraffic_landing_stats
;

CREATE TABLE sfo_airtraffic_landing_stats(
	activity_period date,
    operating_airline varchar(20),
    operating_airline_iata_code varchar(20),
    published_airline varchar(20),
    published_airline_iata_code varchar(20),
    geo_summary varchar(20),
    geo_region varchar(20),
    landing_aircraft_type varchar(20),
    aircraft_body_type varchar(20),
    aircraft_manufacturer varchar(20),
    aircraft_model varchar(20),
    aircraft_version varchar(20),
    landing_count int,
    total_landed_weight int
);

-- select * from  sfo_airtraffic_landing_stats
-- ;

DROP TABLE IF EXISTS la_flight_pessenger_trafic_by_term
;

CREATE TABLE la_flight_pessenger_trafic_by_term(
	dataextractdate datetime,
    reportperiod datetime,
    terminal varchar(20),
    arrival_departure varchar(20),
    domestic_international varchar(20),
    passenger_count int
);
 
-- select * from  la_flight_pessenger_trafic_by_term
-- ;
-- 

DROP TABLE IF EXISTS la_flight_pessenger_count_by_carriertype
;

CREATE TABLE la_flight_pessenger_count_by_carriertype(
	dataextractdate datetime,reportperiod datetime,
    arrival_departure varchar(20),
    domestic_international varchar(20),
    flighttype varchar(20),
    passenger_count int
);
 
-- select * from  la_flight_pessenger_count_by_carriertype
-- ;
-- 
DROP TABLE IF EXISTS la_airport_cargo_volume
;

CREATE TABLE la_airport_cargo_volume(
	dataextractdate datetime,
    reportperiod datetime,
    arrival_departure datetime,
    domestic_international varchar(20),
    cargotype varchar(20),
    aircargotons int
);

DROP TABLE IF EXISTS la_flight_op_by_month
;

CREATE TABLE la_flight_op_by_month(
	dataextractdate datetime, 
    reportperiod datetime,
    flighttype varchar(20),
    arrival_departure varchar(20),
    domestic_international varchar(20),
    flightopscount varchar(20)
);

-- select * from la_flight_op_by_month
-- ;
-- 
