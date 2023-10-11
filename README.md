# Local SQL 🤖
  <img src="basic.jpeg" width="300" alt="LocalSQL example image" />
  
  LocalSQL is a lightweight framework 
  aimed to help php developers focus
  more on php when working with MySQL database,
  rather than to struggle with not 
  knowing the exact MySQL syntax to 
  achieving the secure coding experience 
  👷

***NOTE: With localSQL you also don't have 
to worry about SQL injections 💉 👎 💪***

# Installation 💻
  simply download the [localSQL.php](./localSQL.php) file
  and import it into your project.
  ```php
    <?php
      require_once("./localSQL.php");
  ```
 
# Using localSQL 📝
  This framework is very simple, easy 
  to grasps and the naming conversations
  are simply self explanatory 😎.
  ```php
    <?php
      $localSQL = new LocalSQL("DB_HOST", "DB_USER", "DB_PASSWORD");
  ```
## LocalSQL
 the `LocalSQL` is a global class part 
 of the [localSQL.php](./localSQL.php) framework, this
 class takes 3 parameters 💣
 
- parameter 1 (DB_HOST): Database host name
- parameter 2 (DB_USER): Database user name
- parameter 3 (DB_PASSWORD): Database user password

 here are the methods returned when
 the `LocalSQL` class is called 🎆
### **openDB**
   this method will attempt to create
   a database if the given name
   doesn't exist, else/then the database
   is then opened
   ```php
    <?php
      $database = $localSQL->openDB("DB_name");
  ```
  this method returns the [Table](#table)
  instance 😉
  
### **removeDB**
   this method will remove the database
   name given
   ```php
    <?php
      $result = $localSQL->removeDB("DB_name");
  ```
  this method returns TRUE | FALSE 😇
  
### **hasDB**
   this method will check for the database
   name given
   ```php
    <?php
      $result = $localSQL->hasDB("DB_name");
  ```
  this method returns TRUE | FALSE 😰
  
### **keys**
   this method will return list of all
   database names available
   ```php
    <?php
      $result = $localSQL->keys();
  ```
  this method returns an Array list 😉
  
### **removeAllDB**
   this method will delete all the databases
   available
   ```php
    <?php
      $result = $localSQL->removeAllDB();
  ```
  this method returns TRUE | FALSE 😇
  
### **localStorage**
   this method will automatically 
   open a [database](#opendb) with the 
   name `"localStorage"`, then open a 
   [table](#opentable) with the name 
   provided on the parameter 🤓
   ```php
    <?php
      $table = $localSQL->localStorage("TABLE_name");
  ```
  this method returns the [Item](#item)
  instance 😇
  
___

## Table
 here are the methods returned when
 the [openDB](#opendb) method is called 🤔
### **openTable**
   this method will attempt to create
   a database table if the given name
   doesn't exist, else/then the table
   is then opened
   ```php
    <?php
      $table = $database->openTable("TABLE_name");
  ```
  this method returns the [Item](#item)
  instance 😉
  
### **removeTable**
   this method will remove the table
   name given
   ```php
    <?php
      $result = $database->removeTable("TABLE_name");
  ```
  this method returns TRUE | FALSE 😇
  
### **hasTable**
   this method will check for the table
   name given
   ```php
    <?php
      $result = $database->hasTable("TABLE_name");
  ```
  this method returns TRUE | FALSE 😯
  
### **keys**
   this method will return list of all
   the table names available
   ```php
    <?php
      $result = $database->keys();
  ```
  this method returns an Array list 😱
  
### **removeAllTable**
   this method will delete all the
   available table from the database
   ```php
    <?php
      $result = $database->removeAllTable();
  ```
  this method returns TRUE | FALSE 😇

___
  
## Item
 here are the methods returned when
 the [openTable](#opentable) method is called 🙋
### **setItem**
   this method will create/set an item
   inside the database table
   ```php
    <?php
      $result = $table->setItem("name", "value");
  ```
  this method returns TRUE | FALSE 😋
  
### **getItem**
   this method will retrieve an item
   on the database table
   ```php
    <?php
      $item = $table->getItem("name");
  ```
  this method return the item value 😊
  
### **hasItem**
   this method will check for an item
   ```php
    <?php
      $result = $table->hasItem("name");
  ```
  this method returns TRUE | FALSE 😻
  
### **keys**
   this method will return list of all
   the items name available
   ```php
    <?php
      $result = $table->key();
  ```
  this method returns an Array list 😉
  
### **removeItem**
   this method will remove the item name
   given
   ```php
    <?php
      $result = $table->removeItem("name");
  ```
  this method returns TRUE | FALSE 👼
  
### **removeAllItem**
   this method will remove all the 
   available items from the table
   ```php
    <?php
      $result = $table->removeAllItem();
  ```
  this method returns TRUE | FALSE 👻
  
### **getAllItem**
   this method will retrieve all items
   on the database table
   ```php
    <?php
      $items = $table->getAllItem();
  ```
  this method returns an Array Object 🍻
  
 
# Php Version Support 🌠
 so far this framework works on
 `php` version `7.1.33` and previous php
 versions are yet to be tested 🎠
 
# Show Love 👌
 was this framework help 🤔? 
 
 wish to give me a shootout 🙌?
 
 wish to collaborate with me 👷?
 
 why don't you come hit me up 
 on [facebook📱](https://facebook.com/owens94819.me)
 