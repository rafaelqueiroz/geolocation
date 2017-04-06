## Geolocation

Develop geolocation service based on user IP address.

### Requirements

- Silex
- MySQL
- jQuery

### Domain

- Frontend contains one page which shows IP address of current user and button "Get geo location". 
- When user clicks the button, we load location info (city and country) via Ajax request to backend.
- Backend retrieves information from JSON service of ipinfo.io with caching into database. So for each request from frontend, we first check if there is information for such ip address in database, if not — request it from ipinfo.io (and cache for following requests), otherwise return cached information.
