# 题目O
## 第一题
### 使用php连接mysql：
    $dbhost = "localhost";  //MySQL服务器主机地址
    $dbuser = "root";      //MySQL用户名
    $dbpass = ""; //MySQL用户名密码
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    
输出为：

    $sql = "SELECT * FROM term WHERE en_US LIKE '$searchterm'";}
    $huoqu = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($huoqu, MYSQLI_ASSOC)) {  
        echo "<tr>";
    echo "<td>".$row['en_ACR']."</td>";
        echo "<td>".$row['zh_CN']."</td>";
        echo "<td>".$row['en_US']."</td>";
        echo "</tr>";
        }  

   
   ### 使用php连接sqlite3：
具体请看图片一

## 第二题
### 使用php与python连接同一个数据库：
python与上一题相同
php请看图片二


# 题目一

CREATE TABLE IF NOT EXISTS `homework`.`accquaintance` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `friend1` VARCHAR(45) NULL DEFAULT NULL,
  `friend2` VARCHAR(45) NULL DEFAULT NULL,
  `class` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

# 题目二
# 1.

with t as (

select friend1 m from acquaintance

union 

select friend2 from acquaintance

)

select t1.m m1, t2.m m2

from t t1, t t2

where t1.m<>t2.m

and not exists (select * from acquaintance where (friend1=t1.m and friend2=t2.m) or (friend2=t1.m and friend1=t2.m));

 

# 2.

with t as (

select friend1 m, class from acquaintance

union 

select friend2, class from acquaintance

)

select m from t t1 where not exists(select * from t where m=t1.m and class<>t1.class);



# 3.

select friend1,friend2,class from acquaintance t1

where not exists (select * from acquaintance t2

where not exists(select * from acquaintance where class=t2.class 

and ((friend1=t1.friend1 and friend2=t1.friend2) or (friend1=t1.friend2 and friend2=t1.friend1))));



# 4.

**with** cte **as** (

**select** **name**,class,sum(cn) count **from** 

(**select** friend1 **as** **name**,class,count(*) cn **from** acquaintance **group** **by** friend1,class

**union** all

**select** friend2 **as** **name**,class,count(*) cn **from** acquaintance **group** **by** friend1,class)t)

 

**select** * **from** cte t **where** count=(**select** **max**(count) **from** cte **where** class=t.class

 

# 6.

**with** cte **as** (

**select** t1.friend2 **as** name1, t2.friend2 **as** name2,t1.friend1 **as** mid

**from** acquaintance t1 **inner** join acquaintance t2 **on** t1.friend1=t2.friend1

**union** all

**select** t1.friend2 **as** name1, t2.friend1 **as** name2,t1.friend1 **as** mid

**from** acquaintance t1 **inner** join acquaintance t2 **on** t1.friend1=t2.friend2

**union** all

**select** t1.friend1 **as** name1, t2.friend2 **as** name2,t1.friend1 **as** mid

**from** acquaintance t1 **inner** join acquaintance t2 **on** t1.friend2=t2.friend1

**union** all

**select** t1.friend1 **as** name1, t2.friend1 **as** name2,t1.friend1 **as** mid

**from** acquaintance t1 **inner** join acquaintance t2 **on** t1.friend2=t2.friend2)

 

**select** **top** 1 mid **from** (

**select** mid,count(*) cn **from** (**select** * **from** cte t **where** not exists (**select** 1 **from** acquaintance 

**where** (friend1=t.name1 and friend2=t.name2) or (friend2=t.name1 and friend1=t.name2) )) t

**group** **by** mid **order** **by** cn **desc**)t
