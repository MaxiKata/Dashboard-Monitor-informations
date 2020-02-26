# Dashboard to monitor selected information for free

It is a project that I developed myself to collect & monitor informations selected from Twitter or RSS by using IFTTT tools. You can use it for free at [https://dashboard.maximterior.com](https://dashboard.maximterior.com)

## How to install ?
After downloading the project you must install the project with composer.
  
  You will need to set few parameters:
  - The server setting in .env file
  - The API key from Google developer console
  - The Client ID from Google developer console
  
### Create a Google Project
  The API key and Client ID are needed in order to connect your application with Google Sheets and be able to get information from a Google Sheets.
  
  In order to do so, you need to connect on [Console Developer Google](https://console.developers.google.com) to create a new project.
  
  If you never did that just follow this Youtube tutorial: [Google Sheets read Data](https://www.youtube.com/watch?v=shctaaILCiU)
  
### Set Application
#### Google API settings
  Once you got your API key and Client ID, you will need to modify a part of the javascript situated in every view. In the function *initClient*, just modify:
  ```javascript
    var API_KEY = 'YOUR_API_KEY';  // TODO: Update placeholder with desired API key.
    
    var CLIENT_ID = 'YOUR_CLIENT_ID';  // TODO: Update placeholder with desired client ID.
  ```

For now, the Scope set is just about reading data from the Google Sheets, but you can also modify in the SCOPE value:
```javascript
    // TODO: Authorize using one of the following scopes:
    //   'https://www.googleapis.com/auth/drive'
    //   'https://www.googleapis.com/auth/drive.file'
    //   'https://www.googleapis.com/auth/drive.readonly'
    //   'https://www.googleapis.com/auth/spreadsheets'
    //   'https://www.googleapis.com/auth/spreadsheets.readonly'
    var SCOPE = 'https://www.googleapis.com/auth/spreadsheets.readonly'; // We set just as read. no need more
```
________________________________________
#### Customize View from Google Sheets

To customize the view in the post in dashboard you must go to **templates/Dashboard/mainView.html**. There you should go to the javascript function *populateSheet* :
```javascript
    function populateSheet(result){
        if(result.values.length === 1){
            $('.twitter').append("<p>There is no news yet</p>");
        } else {
            for( var row = (result.values.length) - 1; row >= 1; row--){
                if(result.values[row][0] === 'Twitter'){ // Filter Source from Twitter
                        $('.twitter').append(HtmlSanitizer.SanitizeHtml(result.values[row][5])+ "<script async src=\"https://platform.twitter.com/widgets.js\" charset=\"utf-8\"></" + "script>");

                } else if(result.values[row][0] === 'RSS') { // Filter Source from RSS
                    var date = HtmlSanitizer.SanitizeHtml(result.values[row][1]); // Source must be date or change the column
                    var author = HtmlSanitizer.SanitizeHtml(result.values[row][2]); // Source must be author or change the column
                    var content = HtmlSanitizer.SanitizeHtml(result.values[row][3]); // Source must be content or change the column
                    var url = HtmlSanitizer.SanitizeHtml(result.values[row][4]); // Source must be url or change the column
                    var title = HtmlSanitizer.SanitizeHtml(result.values[row][5]); // Source must title date or change the column
                    var image = HtmlSanitizer.SanitizeHtml(result.values[row][6]); // Source must be image url or change the column

                    // Front for post of RSS
                    $('.twitter').append("<div class=\"rss\" style=\"width: 500px;margin:10px auto;font: normal normal 16px/1.4 Helvetica, Roboto;\"> <div style=\"background-color: rgb(255, 255, 255);overflow: hidden;border-width:1px;border-style:solid;border-color: rgb(225, 232, 237);border-radius:5px;\"> <div style=\"padding:20px 20px 10px;\"> <div style=\"display: flex;\"> <h2 style=\"margin:0;font-size: 16px;\">"+author+" - "+title+"</h2> <img src=\"https://www.icone-png.com/png/1/1009.png\" alt=\"icone RSS\" id=\"IconRSS\"> </div> <hr><div>"+content+"</div> <img src=\""+image+"\" alt=\"IMG of the article\" id=\"ArticleRSSImg\"><div style=\"margin-top:10.4px;font-size: 14px;color: rgb(105, 120, 130);\">Published on "+date+"</div></div><a href=\""+url+"\" style=\"color: rgb(238, 128, 47);text-decoration: none;padding:9px 20px;display: block;font-size: 14px;border-color: rgb(225, 232, 237);border-style:solid;border-radius:0px 0px 4px 4px;border-width:1px 0px 0px;\">Check Source</a> </div> </div>");
                }
            }
        }
    }
```
________________________________________
#### How to use the tools ?
  You can check tutorial to use: 
[https://dashboard.maximterior.com](https://dashboard.maximterior.com) or after installation, you will have the tutorial on the homepage.

**Pay attention on local, the API Google might not work**

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Attributions

This tool use HTMLSanitizer : [https://github.com/jitbit/HtmlSanitizer](https://github.com/jitbit/HtmlSanitizer) developped by [@jitbit](https://github.com/alex-jitbit)

This tools is using Google Sheet Read Datas - thanks to Anthony Brunson [acbrunso](https://github.com/acbrunso) for his [Tutorial_Google_Sheets_Read_Data](https://github.com/acbrunso/Tutorial_Google_Sheets_Read_Data) also used for a part but quite customized to collect specific datas. Thanks to his very nice [Youtube tutorial](https://www.youtube.com/watch?v=shctaaILCiU)

## Legal & License
Let's be friendly :
[MIT](https://github.com/MaxiKata/Dashboard-Monitor-informations/blob/master/LICENCE.md)

![Permissions](https://img.shields.io/badge/Permissions-Commercial_use-green.svg) 
![Permissions](https://img.shields.io/badge/Permissions-Distribution-green.svg) 
![Permissions](https://img.shields.io/badge/Permissions-Modification-green.svg) 
![Permissions](https://img.shields.io/badge/Permissions-Private_use-green.svg)

![Conditions](https://img.shields.io/badge/Conditions-License_and_copyright_notice-blue.svg)

![Limitations](https://img.shields.io/badge/Limitations-Liability-red.svg)
![Limitations](https://img.shields.io/badge/Limitations-Warranty-red.svg)