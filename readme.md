# fbLikes
fbLikes is an extra for MODX Revolution that returns the number of fans for a facebook page and caches the results for specific time.


## Download / Installation

You can download the extra via MODX Package Management inside your Manager (search for "fbLikes") or grap it from http://modx.com/extras/package/fblikes


## Manual Installation Instructions

(If you don't like to install the extra via MODX Package Management...)
1. Copy the contents of the snippet file (fblikes.snippet.php) from github
2. Go to your MODX Revolution Manager, create a new snippet, paste the content from your clipboard and save it
3. Open a resource or chunk (or wherever you want to display your fan number) and add the snippet call:
    ```[[!fbLikes? &pageid=`19110642979` &expiretime=`10800`]]```

## Parameters

* pageid - the id of your facebook fanpage (username is also possible)
* expiretime - lifetime of the cache in seconds (default 10800, 3 hours)


## License
fbLikes has been released as open source under the GPL v2 (or later) license. This means that while I hope this is useful,
I am not responsible for the effects of using it and can not be held liable for any (financial) damage incurred from using it.

I welcome people taking this addon and customizing it to their needs. A pull request for any improvements would be great!


## Developed by
**chsmedien**  
Christian Seel  
E-Mail: hello@chsmedien.com  
Website: www.chsmedien.com  