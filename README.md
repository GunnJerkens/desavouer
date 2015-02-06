# desavouer

Converts a line seperated text file of urls into an output of just unique domains for Google's Disavow Tool.  

## usage

To display the help menu:

```
php desavouer.php help
```

To run the script:
```
php desavouer.php run
```

## input/output

### input

Sample input file, key to note is that there is 6 urls but only 2 unique domains

```
http://example1.com/this/path/right/here
http://example1.com/this/path/right/where
http://example1.com/this/path/right/there
http://example2.com/this/path/right/here
http://example2.com/this/path/right/here
http://example2.com/this/path/right/here
```

### ouput

```
domain:example1.com
domain:example2.com
```

In the directory an `output.txt` file will be created to upload to Google. Display in console will be stats about the run.

```
Process completed successfully.

/\/\/\/\/\/\/\/\/
Backlinks: 5784
Unique Domains: 571
Time: 0.068725109100342 seconds
/\/\/\/\/\/\/\/\/
```

Google's response to upload of output.txt:  

![Google Upload Screenshot](https://raw.githubusercontent.com/GunnJerkens/desavouer/master/disavow-screenshot.png)


## license

MIT