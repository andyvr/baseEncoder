baseEncoder
===========

Base encoder is the Codeigniter library to encode and decode integers to/from a base-encoded string. Base-encoding allows you to mask a numeric id (which often is the id of a record in a database) by converting it to a string based representation. Base conversion is often used by URL-shortener services (http://goo.gl), catalog-based websites etc. Base-encoding prevents web-scrapers from scraping your data by incrementing the database record id, because unless you know the correct base you can't recreate the numeric id out of the base-encoded string.

### Quick start

Load the library:
```
$this->load->library('baseintencoder');
```
Arbitarry you can define your own base when loading the library:
```
$this->load->library('baseintencoder', array("0123456789abcdef"));
```
Encode an integer to the base-encoded string:
```
$this->baseintencoder->encode(2752);  //will produce Si4
```
Decode base-encoded sting to the integer: 
```
$this->baseintencoder->decode("Si4"); //will produce 2752
```
