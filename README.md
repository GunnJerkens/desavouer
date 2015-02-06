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

# output

In the directory an `output.txt` file will be created to upload to Google. Display in console will be stats about the run.

```
Process completed successfully.

/\/\/\/\/\/\/\/\/
Backlinks: 5784
Unique Domains: 571
Time: 0.068725109100342 seconds
/\/\/\/\/\/\/\/\/
```

## license

MIT