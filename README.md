# TWEB - Web Technologies
Laboratory of Web Technologies, Computer Science Course - A.Y. 2022/2023  
Department of Computer Science, University of Turin  
Teacher: Marco Botta

## Lab project
The **theme of the site is free and chosen by the student**. Nonetheless, the site must be structured in such a way as to follow the specifications indicated. An important part of the creation of the site is the accompanying report which technically describes the way in which the various functions have been implemented , the structure of the back end, the structure of the front end and the way in which the communication was managed between the various levels of architecture.

The student will be able to use **all the technologies seen during the course:** HTML(5), CSS(3), PHP5 (web connection, web service), JavaScript (JS Events, DOM), JS libraries (Ajax, data exchange (XML or JSON) , web services, etc. The problems that have been analyzed and for which solutions have been discussed (separation presentation/content/behavior, web security, etc.) will need to be addressed: the aim of the final work is to allow the connection of all the topics discussed with the aim of creating a professional website.

Tools that we did not get to explore during the course will also be considered eligible, such as: Bootstrap, PHP Object Oriented, PHP 7.4, MVC patterns, Angular.js, etc. However, it should be considered that these technologies will only be evaluated as **optional** and not mandatory and **complementary** to the use of the basic technologies, which must in any case be demonstrated to be able to master even without resorting to more or less advanced frameworks.

## Requirements
The general description of the general functions that must be integrated into the final site follows; then, it will be explained what is expected of the report to be jointly delivered to the site.

### The Web site
As previously clarified, the theme of the site is up to you to decide. You can simulate an e-commerce site, a simple entertainment site, an informative and interactive site, an extension/revisitation of one of the many exercises seen during the laboratory, etc.

The important thing is that the site has a certain architectural structure and that it has certain certain functionalities. In this document we will present the requirements regarding these aspects.

#### Structure - The site architecture must be structured as follows:
* **front end:** The user accesses the site via a **home page** which corresponds to the folder index **"project"** The entire site must be stylistically consistent with what is shown on the main page. At this level you have to be very careful to split presentation (content (and behavior) (JQuery) as much as possible. Use of Boostrap, jQuery library, etc. is allowed. It is important to organize dependencies well (consider including style sheets and JS functions via external files and not embedded directly in the html file).The files, in turn, must be organized by folder (for example all the images inside an **img** folder the style sheets inside a folder **css** just like javascript code would go under a folder **js** etc.) Avoid redundant code: plan on using separate files for pieces of code that repeat on different pages (footers, menus, etc. As much as possible, avoid html pages containing php code. Therefore, use a 'web service' approach for communication between client and server (see further on). Likewise, avoid mixing html code with js code : an **unobtrusive** use of the js code is therefore recommended.

* **back end:** Everything that the user doesn't see directly on the browser has been developed and maintained on the server side. Logically separate the parts that need server-side intelligence. Use PHP and maintain the data with MySQL (possibly with the help of the phpMyAdmin tool). It is very probable that the number of php pages outnumber the html ones: in principle you need a few html files, which define the structure of the pages (header, footer, index while the content can be inserted dynamically. Try not to mix php and HTML code, as much as possible Finally, also organize the folders where you are going to store the php files well: even if you don't follow an MVC approach to the letter (which you are free to adopt anyway), it would be good to store the functions and classes php into files that have meaningful names and that are also organized according to their functional logic. For example, the files that concern the management of user profiles could be stored in a folder **users** those that concern the management of shopping cart in a **shop** folder etc. if instead you follow the MVC pattern it would be better to use the folder names **model view controller** and then create subfolders with the names of the php classes you define for each of the MVC categories .

* 
