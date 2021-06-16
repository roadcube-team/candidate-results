<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <title>Weather Forecast API HTML Documentation</title>
      <link href="default.css" rel="stylesheet">
      <link href="docs_main.css" rel="stylesheet">
      <link href="monokai_sublime.css" rel="stylesheet">
      <style>.hljs{background:transparent;}</style>
      <script src="highlight.js"></script>
      <script>$('.hljs').initHighlightingOnLoad();</script>
      <script src="jquery-2.js"></script>
      <script>
         $(document).ready(function() {
           $('.c-Response-Menu a').click(function() {
             var target = $('#' + this.href.split('#')[1]);
             console.log(target);
             target.addClass('u-Visible').siblings().removeClass('u-Visible');
             $(this).addClass('u-Selected').siblings().removeClass('u-Selected');
             return false;
           });
         
           var topMenu = $(".c-Nav"),
             topMenuHeight = topMenu.outerHeight() + 15,
             // All list items
             menuItems = topMenu.find("a"),
             // Anchors corresponding to menu items
             scrollItems = menuItems.map(function() {
               var item = $($(this).attr("href"));
               if (item.length) {
                 return item;
               }
             });
         
           // Bind to scroll
           $(window).scroll(function() {
             // Get container scroll position
             var fromTop = $(this).scrollTop() + topMenuHeight - $(window).height() + 150;
         
             // Get id of current scroll item
             var cur = scrollItems.map(function() {
               if ($(this).offset().top < fromTop){
                 return this;
               }
             });
             // Get the id of the current element
             cur = cur[cur.length - 1];
             var id = cur && cur.length ? cur[0].id : "";
             // Set/remove active class
             menuItems.removeClass("u-Active").filter("[href=#" + id + "]").addClass("u-Active");
           });
         
         });
      </script>
      <style type="text/css">
         .hljs {
         background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
         }
         .c-Details .c-Content p {
         padding-bottom: 10px;
         }
         .c-Details .c-Content a {
         color: #4096ee;
         }
         #api-reference h5 {
         color: #939da3;
         }
         #api-reference h4, #api-reference h5 {
         font-size: 12px;
         font-weight: 500;
         line-height: 18px;
         text-transform: uppercase;
         }
         #api-reference h1, #api-reference h2, #api-reference h3, #api-reference h4, .c-Details .c-Content h5 {
         color: #292e31;
         font-family: Helvetica,Arial,sans-serif;
         margin: 0;
         }
         .c-Details .c-Content .method-list-group {
         border-top: 1px solid #e1e8ed;
         margin-top: 8px;
         }
         .c-Details .c-Content .method-list-item {
         border-bottom: 1px solid #f0f4f7;
         line-height: 24px;
         padding: 17px 0;
         }
         .c-Details .c-Content code, .c-Details .c-Content tt {
         background: #fafcfc none repeat scroll 0 0;
         border: 1px solid #f0f4f7;
         border-radius: 4px;
         box-sizing: border-box;
         color: #b93d6a;
         display: inline-block;
         font-family: Source Code Pro,Menlo,monospace;
         font-size: 13px;
         line-height: 20px;
         padding: 0 5px;
         }
         .method-list-item-label {
         float: left;
         padding: 0;
         text-align: right;
         text-transform: none;
         width: 30%;
         }
         .method-list-item-description {
         float: right;
         width: 65%;
         }
         .method-list-item::after {
         clear: both;
         content: "";
         display: block;
         }
         .method-list-item-label-details {
         color: #939da3;
         display: block;
         text-transform: uppercase;
         }
         .method-list-title {
         color: #939da3 !important;
         padding-top: 15px;
         text-transform: uppercase;
         }
         .c-Nav {
         overflow: auto;
         }
      </style>
   </head>
   <body>
      <nav class="c-Nav-Outer">
         <div class="c-Nav">
            <header>
               <h2>APIs</h2>
            </header>
            <menu>
               <ol>
                  <li>
                     <h3><a href="#about" class="c-Link u-Active">• About Weather Forecast APIs</a></h3>
                  </li>
                  <li>
                     <h3><a href="#http-status-codes" class="c-Link">• HTTP Status Codes</a></h3>
                  </li>
                  <li>
                     <h3><a href="#weather-info" class="c-Link">• Weather Information</a></h3>
                  </li>
               </ol>
            </menu>
         </div>
      </nav>
      <main>
         <article>
            <div class="c-Section">
            <div class="c-Section" id="about">
               <section class="c-Code">
                  <div class="c-Content">
                     <h2>Weather Forecast </h2>
                     <p><em>This documention provides us about Weather Forecast APIs requests and response.In this APIs, authentication process is done with laravel passport authencticatication.</em></p>
                  </div>
               </section>
               <section class="c-Details">
                  <div class="c-Content">
                     <h2>Weather Forecast  HTML Documentation</h2>
                     <p>Weather Forecast  APIs are constructed around REST. URLs represent resources and the actions to be taken with those resources. JSON is the expected format for a request and JSON will be returned as a response.</p>
                  </div>
               </section>
            </div>
            <div class="c-Section" id="http-status-codes">
               <section class="c-Code">
                  <div class="c-Content">
                     <h2>HTTP Status Codes</h2>
                     <p><code><b>200 OK</b> - Everything worked as expected.</code></p>
                     <p><code><b>400 Bad Request</b> - Often missing a required parameter.</code></p>
                     <p><code><b>401 Unauthorized</b> - No valid API key provided.</code></p>
                     <p><code><b>402 Request Failed</b> - Parameters were valid but request failed.</code></p>
                     <p><code><b>404 Not Found</b> - The requested item doesn't exist.</code></p>
                     <p><code><b>406 Not Acceptable</b> - The requested item not acceptable.</code></p>
                     <p><code><b>409 Conflict</b> - The requested item conflict with a stored item.</code></p>
                     <p><code><b>422 Insufficient information supplied</b> - Insufficient information supplied.</code></p>
                     <p><code><b>500, 502, 503, 504 Server errors</b> - Something went wrong on Weather Forecast APIs's end.</code></p>
                  </div>
               </section>
               <section class="c-Details">
                  <div class="c-Content">
                     <h2>Errors</h2>
                     <p>Weather Forecast  uses conventional HTTP response codes to indicate success or failure of an API request. In general, codes in the 2xx range indicate success, codes in the 4xx range indicate an error that resulted from the provided information (e.g. a required parameter was missing), and codes in the 5xx range indicate an error with Weather Forecast's servers.</p>
                     <p>Not all errors map cleanly onto HTTP response codes, however. When a request is valid but does not complete successfully, we return a 402 error code.</p>
                  </div>
               </section>
            </div>
            <div class="c-Section" id="grant-token">
               <section class="c-Code">
                  <div class="c-Content">
                     <div class="c-RequestResponse">
                        <div class="c-RequestResponse-Response">
                           <div class="c-Response-Menu">
                              <menu>
                                 <a href="#grant-token-200" class="u-Selected">Success</a>
                                 <a href="#grant-token-400">400</a>
                                 <a href="#grant-token-401">401</a>
                                 <a href="#grant-token-404">404</a>
                                 <a href="#grant-token-406">406</a>
                                 <a href="#grant-token-409">409</a>
                                 <a href="#grant-token-422">422</a>
                              </menu>
                           </div>
                           <div class="c-Response-JSONs">
                              <div class="c-Response-200 c-Response-JSON u-Visible" id="grant-token-200">
                                 <h3>Response</h3>
                                 <pre>
<code class="hljs json">
{ 
  "message" : "Ok" 
}
</code>
</pre>
                              </div>
                              <div class="c-Response-406 c-Response-JSON" id="grant-token-400">
                                 <h3>Response</h3>
                                 <pre>
<code class="hljs json">
{
 "message" : "Bad Request" 
}
</code>
</pre>
                              </div>
                              <div class="c-Response-406 c-Response-JSON" id="grant-token-401">
                                 <h3>Response</h3>
                                 <pre>
<code class="hljs json">
{ 
  "message" : "Unauthorised" 
}
</code>
</pre>
                              </div>
                              <div class="c-Response-406 c-Response-JSON" id="grant-token-404">
                                 <h3>Response</h3>
                                 <pre>
<code class="hljs json">
{ 
  "message" : "Not found" 
}
</code>
</pre>
                              </div>
                              <div class="c-Response-406 c-Response-JSON" id="grant-token-406">
                                 <h3>Response</h3>
                                 <pre>
<code class="hljs json">
{ 
  "message" : "The requested item not acceptable" 
}
</code>
</pre>
                              </div>
                              <div class="c-Response-406 c-Response-JSON" id="grant-token-409">
                                 <h3>Response</h3>
                                 <pre>
<code class="hljs json">
{ 
  "message" : "Conflict" 
}
</code>
</pre>
                              </div>
                              <div class="c-Response-406 c-Response-JSON" id="grant-token-422">
                                 <h3>Response</h3>
                                 <pre>
<code class="hljs json">
{ 
  "message" : "Unauthorised" 
}
</code>
</pre>
                              </div>
                           </div>
                        </div>
                     </div>
               </section>
               </div> 
               <div class="c-Section" id="weather-info">
                  <section class="c-Code">
                     <div class="c-Content">
                        <h2>Weather Information</h2>
                        <br>
                        <h3>API URL</h3>
                        <br>
                        <p class="c-EndPoint"><a href="http://127.0.0.1/forecast/public/api/forecast/daily" target="_blank">http://127.0.0.1/forecast/public/api/forecast/daily</a></p>
                        <div class="c-RequestResponse">
                           <div class="c-RequestResponse-Request">
                              <h3>API Request</h3>
                              <pre>
                <code class="http hljs"><span clas="hljs-attribute">Method</span> : <span class="hljs-value">POST</code>
                </pre>
                              <h3>Parameters</h3>
                              <pre>
<code class="hljs json">
{
  "<span class="hljs-attribute">city</span>" : "Ahmedabad",
  "<span class="hljs-attribute">temperature</span>" : "Fahrenheit"
}
</code>
</pre>
                           </div>
                           <div class="c-RequestResponse-Response">
                              <div class="c-Response-Menu">
                                 <menu>
                                    <a href="#weather-info-200" class="u-Selected">200</a>
                                    <a href="#weather-info-400">400</a>
                                 </menu>
                              </div>
                              <div class="c-Response-JSONs">
                                 <div class="c-Response-200 c-Response-JSON u-Visible" id="weather-info-200">
                                    <h3>Response</h3>
                                    <pre>
<code class="hljs json">
[
  {
    "success": true,
    "data": {
        "description": "Broken clouds",
        "temp": 91.2
    }
}
]  
</code>
</pre>
                                 </div>
                                 <div class="c-Response-401 c-Response-JSON" id="weather-info-400">
                                    <h3>Response</h3>
                                    <pre>
<code class="hljs json">
{
    "error": {
        "city": [
            "The city field is required."
        ],
        "temperature": [
            "The temperature field is required."
        ]
    }
}
</code>
</pre>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                  <section class="c-Details">
                     <div class="c-Content">
                        <h2>Weather Information</h2>
                        <p>This will return weather information.</p>
                     </div>
                  </section>
               </div>
            </div>
         </article>
      </main>
   </body>
</html>