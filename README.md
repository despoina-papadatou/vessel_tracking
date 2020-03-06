# Vessels Tracks API

http://localhost:8000/vessel_track/list?mmsi=311040700,247039300&dateFrom=2013-07-01T05:33:00Z&dateTo=2013-07-01T08:39:00Z&minLat=30&maxLat=35&minLon=1&maxLon=45&format=xml

* Logging: symfony/monolog
* Limit requests per user to **10/hour**: maba/gentle-force-bundle
* Supported content types: application/json,  application/hal+json, application/xml,text/csv.
Valid format parameter values: xml, csv, hal, json
