<?php

use Illuminate\Database\Seeder;

class ArticleInfosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_infos')->insert([
            [
                'article_id' => 3,
                'contents' => 'json,jsonb 详解
 区别在于效率,json是对输入的完整拷贝，使用时再去解析，所以它会保留输入的空格，重复键以及顺序等。
 而jsonb是解析输入后保存的二进制，它在解析时会删除不必要的空格和重复的键，顺序和输入可能也不相同。
 使用时不用再次解析。两者对重复键的处理都是保留最后一个键值对
 1）json存储快，使用慢； 存的时候不做处理，使用时再解析
 2）jsonb存储稍慢，存储时就做了解析，使用时速度较快
 3）两者的部分函数很相似，稍有区别

 json和jsonb共同操作符：
 
  ->,->>,#>,#>>区别不大，只是返回的数据类型不同，->,#>返回json,而->>,#>>返回文本text

  -> // 右边传入整数（针对纯数组）
  例： select \'[{"a":"foo"},{"b":"bar"},{"c":"baz"}]\'::json->2 // 输出 {"c":"baz"}

  -> // 右边传入键值（针对关联数组）
  例： select \'{"a": {"b":"foo"}, "c":{"a": "aaa"}}\'::json->\'a\' // 输出 {"b":"foo"}

  ->> // 右边传入整数（针对纯数组）
  例： select \'[{"a":"foo"},{"b":"bar"},{"c":"baz"}]\'::json->>2 // 输出 {"c":"baz"}

  ->> // 右边传入键值（针对关联数组）
  例： select \'{"a": {"b":"foo"}, "c":{"a": "aaa"}}\'::json->>\'a\' // 输出 {"b":"foo"}

  #> // 获取json子对象，传入数组，返回json
  例： select \'{"a": {"b":{"c": "foo"}}}\'::json#> \'{a,b}\' // 输出 {"c": "foo"}

  #>> // 获取json子对象并转换为文本
  例： select \'{"a": {"b":{"c": "foo"}}}\'::json#>> \'{a,b}\' // 输出 {"c": "foo"}


相关函数： 
  json_each 和 jsonb_each ， json_array_elements 和 jsonb_array_elements 。
  json_object_keys  // 返回json的键（多层只返回第一层），该函数不能用于纯数组.
  json_array_elements  // 提取转换纯数组元素
  json_extract_path   // 返回JSON值所指向的某个键元素（相当于 #> 操作符），该函数不能直接操作纯数组。
  array_to_json //把数组json转换为数组 ,参数可以直接写表名称
  row_to_json  把一行数据按Json字符串形式返回
  to_json  就是字符串，但是要加类型 \'Fred said "Hi"\'::text
  json_array_length 获取数组的长度
  json_each  遍历json数据
  json_each_text  遍历json数据,值类型是text
  json_populate_recordset  将json数据转化为表


jsonb额外操作符:
  ~~操作符	右操作数类型	    描述	     例子~~ 
  @>	jsonb	左边的 JSON 值是否包含顶层右边JSON路径/值项?	\'{"a":1, "b":2}\'::jsonb @> \'{"b":2}\'::jsonb
  <@	jsonb	左边的JSON路径/值是否包含在顶层右边JSON值中？	\'{"b":2}\'::jsonb <@ \'{"a":1, "b":2}\'::jsonb
  ?	    text	字符串是否作为顶层键值存在于JSON值中？	\'{"a":1, "b":2}\'::jsonb ? \'b\'
  ?|	text[]	这些数组字符串中的任何一个是否作为顶层键值存在？	\'{"a":1, "b":2, "c":3}\'::jsonb ?|array[\'b\',c\']
  ?&	text[]	这些数组字符串是否作为顶层键值存在？	\'["a", "b"]\'::jsonb ?& array[\'a\', \'b\']
  ||	jsonb	连接两个jsonb值到新的jsonb值	\'["a", "b"]\'::jsonb|| \'["c", "d"]\'::jsonb
  -	    text	从左操作数中删除键/值对或字符串元素。基于键值匹配键/值对。	\'{"a": "b"}\'::jsonb - \'a\'
  -     integer	删除指定索引的数组元素（负整数结尾）。如果顶层容器不是一个数组，那么抛出错误。	\'["a", "b"]\'::jsonb - 1
  #-	text[]	删除指定路径的域或元素（JSON数组，负整数结尾）	\'["a", {"b":1}]\'::jsonb #- \'{1,b}\'



[官网的json,jsonb可能比较详细](https://www.postgresql.org/docs/11/functions-json.html)(需要英语水平)，如下：
 json，jsonb 都有
  ~~操作符	右操作数类型	    描述	     例子~~ 
	->	int	Get JSON array element (indexed from zero, negative integers count from the end)	\'[{"a":"foo"},{"b":"bar"},{"c":"baz"}]\'::json->2	{"c":"baz"}
	->	text	Get JSON object field by key	\'{"a": {"b":"foo"}}\'::json->\'a\'	{"b":"foo"}
	->>	int	Get JSON array element as text	\'[1,2,3]\'::json->>2	3
	->>	text	Get JSON object field as text	\'{"a":1,"b":2}\'::json->>\'b\'	2
	#>	text[]	Get JSON object at specified path	\'{"a": {"b":{"c": "foo"}}}\'::json#>\'{a,b}\'	{"c": "foo"}
	#>>	text[]	Get JSON object at specified path as text	\'{"a":[1,2,3],"b":[4,5,6]}\'::json#>>\'{a,2}\'	3


 jsonb:特有的
  ~~操作符	右操作数类型	    描述	     例子~~ 
   @>	jsonb	Does the left JSON value contain the right JSON path/value entries at the top level?	\'{"a":1, "b":2}\'::jsonb @> \'{"b":2}\'::jsonb
   <@	jsonb	Are the left JSON path/value entries contained at the top level within the right JSON value?	\'{"b":2}\'::jsonb <@ \'{"a":1, "b":2}\'::jsonb
   ?	text	Does the string exist as a top-level key within the JSON value?	\'{"a":1, "b":2}\'::jsonb ? \'b\'
   ?|	text[]	Do any of these array strings exist as top-level keys?	\'{"a":1, "b":2, "c":3}\'::jsonb ?| array[\'b\', \'c\']
   ?&	text[]	Do all of these array strings exist as top-level keys?	\'["a", "b"]\'::jsonb ?& array[\'a\', \'b\']
   ||	jsonb	Concatenate two jsonb values into a new jsonb value	\'["a", "b"]\'::jsonb || \'["c", "d"]\'::jsonb
   -	text	Delete key/value pair or string element from left operand. Key/value pairs are matched based on their key value.	\'{"a": "b"}\'::jsonb - \'a\'
   -	text[]	Delete multiple key/value pairs or string elements from left operand. Key/value pairs are matched based on their key value.	\'{"a": "b", "c": "d"}\'::jsonb - \'{a,c}\'::text[]
   -	integer	Delete the array element with specified index (Negative integers count from the end). Throws an error if top level container is not an array.	\'["a", "b"]\'::jsonb - 1
   #-	text[]	Delete the field or element with specified path (for JSON arrays, negative integers count from the end)	\'["a", {"b":1}]\'::jsonb #- \'{1,b}\'
    ```
',
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
            ],
            [
                'article_id' => 4,
                'contents' => '1、函数参数类型
function typeInt(int $a)
{
    echo $a;
}

2、返回值类型声明
<?php
function returnArray(): array
{
    return [1, 2, 3, 4];
}
print_r(returnArray());
/*Array
(
    [0] => 1
    [1] => 2
    [2] => 3
    [3] => 4
)

3、null合并运算符
<?php
$username = $_GET[\'user\'] ?? \'nobody\';
//这两个是等效的  当不存在user 则返回?? 后面的参数
$username = isset($_GET[\'user\']) ? $_GET[\'user\'] : \'nobody\';
?>

4、太空船操作符
// 整数
echo 1 <=> 1; // 0 当左边等于右边的时候，返回0
echo 1 <=> 2; // -1  当左边小于右边，返回-1
echo 2 <=> 1; // 1  当左边大于右边，返回1

// 浮点数
echo 1.5 <=> 1.5; // 0
echo 1.5 <=> 2.5; // -1
echo 2.5 <=> 1.5; // 1

// 字符串
echo "a" <=> "a"; // 0
echo "a" <=> "b"; // -1
echo "b" <=> "a"; // 1

5、define 定义数组
在php7 以前的版本 define 是不能够定义数组的 现在是可以的 比如

define(\'ANIMALS\', [
    \'dog\',
    \'cat\',
    \'bird\'
]);

echo ANIMALS[1]; // 输出 "cat"

6、use方法 批量导入
/ PHP 7 之前的代码
use some\namespace\ClassA;
use some\namespace\ClassB;
use some\namespace\ClassC as C;

use function some\namespace\fn_a;
use function some\namespace\fn_b;
use function some\namespace\fn_c;

use const some\namespace\ConstA;
use const some\namespace\ConstB;
use const some\namespace\ConstC;


// PHP 7+ 及更高版本的代码
use some\namespace\{ClassA, ClassB, ClassC as C};
use function some\namespace\{fn_a, fn_b, fn_c};
use const some\namespace\{ConstA, ConstB, ConstC};

7、匿名类
<?php
interface Logger {
    public function log(string $msg);
}

class Application {
    private $logger;

    public function getLogger(): Logger {
         return $this->logger;
    }

    public function setLogger(Logger $logger) {
         $this->logger = $logger;
    }
}

$app = new Application;
$app->setLogger(new class implements Logger {  //这里就是匿名类
    public function log(string $msg) {
        echo $msg;
    }
});

8、php7.1 可为空类型
参数以及返回值的类型现在可以通过在类型前加上一个问号使之允许为空。 当启用这个特性时，传入的参数或者函数返回的结果要么是给定的类型，要么是 null 。

<?php

function testReturn(): ?string
{
    return \'elePHPant\';
}

var_dump(testReturn()); //string(10) "elePHPant"

function testReturn(): ?string
{
    return null;
}

var_dump(testReturn()); //NULL

function test(?string $name)
{
    var_dump($name);
}

test(\'elePHPant\'); //string(10) "elePHPant"
test(null); //NULL
test(); //Uncaught Error: Too few arguments to function test(), 0 passed in...

9 、void 增加了一个返回void的类型，比如
<?php
function swap(&$left, &$right) : void
{
    if ($left === $right) {
        return;
    }

    $tmp = $left;
    $left = $right;
    $right = $tmp;
}

$a = 1;
$b = 2;
var_dump(swap($a, $b), $a, $b);

10多异常捕获处理
这个功能还是比较常用的，在日常开发之中

<?php
try {
    // some code
} catch (FirstException | SecondException $e) {  //用 | 来捕获FirstException异常，或者SecondException 异常


11允许分组命名空间的尾部逗号
<?php

use Foo\Bar\{
    Foo,
    Bar,
    Baz,
};

12允许重写抽象方法
<?php

abstract class A
{
    abstract function test(string $s);
}
abstract class B extends A
{
    // overridden - still maintaining contravariance for parameters and covariance for return
    abstract function test($s) : int;
}

13新的对象类型
<?php

function test(object $obj) : object  //这里 可以输入对象
{
    return new SplQueue();
}

test(new StdClass());',
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
            ],
            [
                'article_id' => 5,
                'contents' => '<?php
namespace think\cache\driver;

use think\Cache;
use think\Exception;
use think\Log;

/**
配置参数:
\'cache\' => [
    \'type\'       => \'Redisd\'
    \'host\'       => \'A:6379,B:6379\', //redis服务器ip，多台用逗号隔开；读写分离开启时，默认写A，当A主挂时，再尝试写B
    \'slave\'      => \'B:6379,C:6379\', //redis服务器ip，多台用逗号隔开；读写分离开启时，所有IP随机读，其中一台挂时，尝试读其它节点，可以配置权重
    \'port\'       => 6379,    //默认的端口号
    \'password\'   => \'\',      //AUTH认证密码，当redis服务直接暴露在外网时推荐
    \'timeout\'    => 10,      //连接超时时间
    \'expire\'     => false,   //默认过期时间，默认为永不过期
    \'prefix\'     => \'\',      //缓存前缀，不宜过长
    \'persistent\' => false,   //是否长连接 false=短连接，推荐长连接
],

单例获取:
    $redis = \think\Cache::connect(Config::get(\'cache\'));
    $redis->master(true)->setnx(\'key\');
    $redis->master(false)->get(\'key\');
 */

/**
 * ThinkPHP Redis简单主从实现的高可用方案
 *
 * 扩展依赖：https://github.com/phpredis/phpredis
 *
 * 一主一从的实践经验
 * 1, A、B为主从，正常情况下，A写，B读，通过异步同步到B（或者双写，性能有损失）
 * 2, B挂，则读写均落到A
 * 3, A挂，则尝试升级B为主，并断开主从尝试写入(要求开启slave-read-only no)
 * 4, 手工恢复A，并加入B的从
 *
 * 优化建议
 * 1，key不宜过长，value过大时请自行压缩
 * 2，gzcompress在php7下有兼容问题
 *
 * @todo
 * 1, 增加对redisCluster的兼容
 * 2, 增加tp5下的单元测试
 *
 * @author 尘缘 <130775@qq.com>
 */
class Redisd
{
    protected static $redis_rw_handler;
    protected static $redis_err_pool;
    protected $handler = null;

    protected $options = [
        \'host\'       => \'127.0.0.1\',
        \'slave\'      => \'\',
        \'port\'       => 6379,
        \'password\'   => \'\',
        \'timeout\'    => 10,
        \'expire\'     => false,
        \'persistent\' => false,
        \'length\'     => 0,
        \'prefix\'     => \'\',
        \'serialize\'  => \Redis::SERIALIZER_PHP,
    ];

    /**
     * 为了在单次php请求中复用redis连接，第一次获取的options会被缓存，第二次使用不同的$options，将会无效
     *
     * @param  array $options 缓存参数
     * @access public
     */
    public function __construct($options = [])
    {
        if (!extension_loaded(\'redis\')) {
            throw new Exception(\'_NOT_SUPPERT_:redis\');
        }

        $this->options         = $options         = array_merge($this->options, $options);
        $this->options[\'func\'] = $options[\'persistent\'] ? \'pconnect\' : \'connect\';

        $host  = explode(",", trim($this->options[\'host\'], ","));
        $host  = array_map("trim", $host);
        $slave = explode(",", trim($this->options[\'slave\'], ","));
        $slave = array_map("trim", $slave);

        $this->options["server_slave"]           = empty($slave) ? $host : $slave;
        $this->options["servers"]                = count($slave);
        $this->options["server_master"]          = array_shift($host);
        $this->options["server_master_failover"] = $host;
    }

    /**
     * 主从选择器，配置多个Host则自动启用读写分离，默认主写，随机从读
     * 随机从读的场景适合读频繁，且php与redis从位于单机的架构，这样可以减少网络IO
     * 一致Hash适合超高可用，跨网络读取，且从节点较多的情况，本业务不考虑该需求
     *
     * @access public
     * @param  bool $master true 默认主写
     * @return Redisd
     */
    public function master($master = true)
    {
        if (isset(self::$redis_rw_handler[$master])) {
            $this->handler = self::$redis_rw_handler[$master];
            return $this;
        }

        //如果不为主，则从配置的host剔除主，并随机读从，失败以后再随机选择从
        //另外一种方案是根据key的一致性hash选择不同的node，但读写频繁的业务中可能打开大量的文件句柄
        if (!$master && $this->options["servers"] > 1) {
            shuffle($this->options["server_slave"]);
            $host = array_shift($this->options["server_slave"]);
        } else {
            $host = $this->options["server_master"];
        }

        $this->handler = new \Redis();
        $func          = $this->options[\'func\'];

        $parse = parse_url($host);
        $host  = isset($parse[\'host\']) ? $parse[\'host\'] : $host;
        $port  = isset($parse[\'host\']) ? $parse[\'port\'] : $this->options[\'port\'];

        //发生错误则摘掉当前节点
        try {
            $result = $this->handler->$func($host, $port, $this->options[\'timeout\']);
            if($result === false) {
                $this->handler->getLastError();
            }

            if (null != $this->options[\'password\']) {
                $this->handler->auth($this->options[\'password\']);
            }

            $this->handler->setOption(\Redis::OPT_SERIALIZER, $this->options[\'serialize\']);
            if(strlen($this->options[\'prefix\'])) {
                $this->handler->setOption(\Redis::OPT_PREFIX, $this->options[\'prefix\']);
            }

            APP_DEBUG && Log::record("[ CACHE ] INIT Redisd : {$host}:{$port} master->" . var_export($master, true), Log::ALERT);
        } catch (\RedisException $e) {
            //phpredis throws a RedisException object if it can\'t reach the Redis server.
            //That can happen in case of connectivity issues, if the Redis service is down, or if the redis host is overloaded.
            //In any other problematic case that does not involve an unreachable server
            //(such as a key not existing, an invalid command, etc), phpredis will return FALSE.

            Log::record(sprintf("redisd->%s:%s:%s:%s", $master ? "master" : "salve", $host, $port, $e->getMessage()), Log::ALERT);

            //主节点挂了以后，尝试连接主备，断开主备的主从连接进行升主
            if ($master) {
                if (!count($this->options["server_master_failover"])) {
                    throw new Exception("redisd master: no more server_master_failover. {$host}:{$port} : " . $e->getMessage());
                    return false;
                }

                $this->options["server_master"] = array_shift($this->options["server_master_failover"]);
                $this->master();

                Log::record(sprintf("master is down, try server_master_failover : %s", $this->options["server_master"]), Log::ERROR);

                //如果是slave，断开主从升主，需要手工同步新主的数据到旧主上
                //目前这块的逻辑未经过严格测试
                //$this->handler->slaveof();
            } else {
                //尝试failover，如果有其它节点则进行其它节点的尝试
                foreach ($this->options["server_slave"] as $k => $v) {
                    if (trim($v) == trim($host)) {
                        unset($this->options["server_slave"][$k]);
                    }
                }

                //如果无可用节点，则抛出异常
                if (!count($this->options["server_slave"])) {
                    Log::record("已无可用Redis读节点", Log::ERROR);
                    throw new Exception("redisd slave: no more server_slave. {$host}:{$port} : " . $e->getMessage());
                    return false;
                } else {
                    Log::record("salve {$host}:{$port} is down, try another one.", Log::ALERT);
                    return $this->master(false);
                }
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

        self::$redis_rw_handler[$master] = $this->handler;
        return $this;
    }

    /**
     * 读取缓存
     *
     * @access public
     * @param  string $name 缓存key
     * @param  bool   $master 指定主从节点，可以从主节点获取结果
     * @return mixed
     */
    public function get($name, $master = false)
    {
        $this->master($master);

        try {
            $value = $this->handler->get($name);
        } catch (\RedisException $e) {
            unset(self::$redis_rw_handler[0]);

            $this->master();
            return $this->get($name);
        } catch (\Exception $e) {
            Log::record($e->getMessage(), Log::ERROR);
        }

        return isset($value) ? $value : null;
    }

    /**
     * 写入缓存
     *
     * @access public
     * @param  string  $name   缓存key
     * @param  mixed   $value  缓存value
     * @param  integer $expire 过期时间，单位秒
     * @return boolen
     */
    public function set($name, $value, $expire = null)
    {
        $this->master(true);

        if (is_null($expire)) {
            $expire = $this->options[\'expire\'];
        }

        try {
            if (null === $value) {
                return $this->handler->delete($name);
            }

            if (is_int($expire) && $expire) {
                $result = $this->handler->setex($name, $expire, $value);
            } else {
                $result = $this->handler->set($name, $value);
            }
        } catch (\RedisException $e) {
            unset(self::$redis_rw_handler[1]);

            $this->master(true);
            return $this->set($name, $value, $expire);
        } catch (\Exception $e) {
            Log::record($e->getMessage());
        }

        return $result;
    }

    /**
     * 删除缓存
     *
     * @access public
     * @param  string $name 缓存变量名
     * @return boolen
     */
    public function rm($name)
    {
        $this->master(true);
        return $this->handler->delete($name);
    }

    /**
     * 清除缓存
     *
     * @access public
     * @return boolen
     */
    public function clear()
    {
        $this->master(true);
        return $this->handler->flushDB();
    }

    /**
     * 返回句柄对象，可执行其它高级方法
     * 需要先执行 $redis->master() 连接到 DB
     *
     * @access public
     * @param  bool   $master 指定主从节点，可以从主节点获取结果
     * @return \Redis
     */
    public function handler($master = true)
    {
        $this->master($master);
        return $this->handler;
    }

    /**
     * 析构释放连接
     *
     * @access public
     */
    public function __destruct()
    {
        //该方法仅在connect连接时有效
        //当使用pconnect时，连接会被重用，连接的生命周期是fpm进程的生命周期，而非一次php的执行。
        //如果代码中使用pconnect， close的作用仅是使当前php不能再进行redis请求，但无法真正关闭redis长连接，连接在后续请求中仍然会被重用，直至fpm进程生命周期结束。

        try {
            if (method_exists($this->handler, "close")) {
                $this->handler->close();
            }

        } catch (\Exception $e) {
        }
    }
}',
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
            ],
            [
                'article_id' => 6,
                'contents' => 'PHP经典面试题汇总，包括PHP基础部分、数据库部分、面向对象部分、ThinkPHP部分部分、smarty模板引擎、二次开发系统（DEDE、ecshop）、微信公众平台开发、对于自身掌握的技术描述等几部分PHP面试题。
2018PHP经典面试题大全汇总（更新）-PHP面试题

2018PHP经典面试题汇总大全

目录：
一：PHP基础部分
二：数据库部分
三：面向对象部分
四：ThinkPHP部分
五：smarty模板引擎
六、二次开发系统（DEDE、ecshop）
七、微信公众平台开发
八、对于自身掌握的技术描述
题库大全下载：PHP面试题汇总大全网盘下载
一：PHP基础部分

返回顶部
1、PHP语言的一大优势是跨平台，什么是跨平台？

PHP的运行环境最优搭配为Apache+MySQL+PHP，此运行环境可以在不同操作系统（例如windows、Linux等）上配置，不受操作系统的限制，所以叫跨平台

2、WEB开发中数据提交方式有几种？有什么区别？百度使用哪种方式？

Get与post两种方式
区别：
1. Get从服务器获取数据，post向服务器传送数据
2. Get传值在url中可见，post在url中不可见
3. Get传值一般在2KB以内，post传值大小可以在php.ini中进行设置
4. get安全性非低，post安全性较高，执行效率却比Post高
建议：
1、get式安全性较Post式要差些包含机密信息建议用Post数据提交式；
2、做数据查询建议用Get式；做数据添加、修改或删除建议用Post方式；
百度使用的get方式，因为可以从它的URL中看出

3、掌握PHP的哪些框架、模板引擎、系统等

框架：框架有很多，例如zendframe、CI、Yii等等，咱们学过的是thinkphp
模板引擎：也有很多，在课本中有，咱们学过的是smarty
系统：有很多，例如：康盛的产品（uchome、supesite、discuzX等），帝国系统、DEDE（织梦）、ecshop等，咱们学过的是DEDECMS、Ecshop
4、说一下你所掌握的网页前端技术有哪些？

熟练掌握DIV+CSS网页布局，JavaScript，jQuery框架、photoshop图片处理
5、AJAX的优势是什么？

ajax是异步传输技术，可以通过javascript实现，也可以通过JQuery框架实现，实现局部刷新，减轻了服务器的压力，也提高了用户体验
6、安全对一套程序来说至关重要，请说说在开发中应该注意哪些安全机制？

①防远程提交；②防SQL注入，对特殊代码进行过滤；③防止注册机灌水，使用验证码；
7、在程序的开发中，如何提高程序的运行效率？

①优化SQL语句，查询语句中尽量不使用select *，用哪个字段查哪个字段；少用子查询可用表连接代替；少用模糊查询；②数据表中创建索引；③对程序中经常用到的数据生成缓存；
8、PHP可否与其它的数据库搭配使用？

PHP与MYSQL数据库是最优搭配，当然PHP也可以去其它的数据库搭配使用，例如MSSQL等，PHP中预留了操作MSSQL的函数，只要开启就可以使用

9、现在编程中经常采取MVC三层结构，请问MVC分别指哪三层，有什么优点？

MVC三层分别指：业务模型、视图、控制器，由控制器层调用模型处理数据，然后将数据映射到视图层进行显示，优点是：①可以实现代码的重用性，避免产生代码冗余；②M和V的实现代码分离，从而使同一个程序可以使用不同的表现形式
10、对json数据格式的理解？

JSON(JavaScript Object Notation)是一种轻量级的数据交换格式，json数据格式固定，可以被多种语言用作数据的传递
PHP中处理json格式的函数为json_decode( string json[,boolassoc ] ) ，接受一个 JSON格式的字符串并且把它转换为PHP变量，参数json待解码的json string格式的字符串。assoc当该参数为TRUE时，将返回array而非object；
Json_encode：将PHP变量转换成json格式
11、Print、echo、print_r有什么区别？

① echo和print都可以做输出，不同的是，echo不是函数，没有返回值，而print是一个函数有返回值，所以相对而言如果只是输出echo会更快，而print_r通常用于打印变量的相关信息，通常在调试中使用。
② print 是打印字符串
③ print_r 则是打印复合类型 如数组 对象
12、SESSION与COOKIE的区别？

①存储位置：session存储于服务器，cookie存储于浏览器
②安全性：session安全性比cookie高
③session为‘会话服务’，在使用时需要开启服务，cookie不需要开启，可以直接用
13、PHP处理数组的常用函数？（重点看函数的‘参数’和‘返回值’）

①array()创建数组；②count()返回数组中元素的数目；③array_push()将一个或多个元素插入数组的末尾（入栈）；④array_column()返回输入数组中某个单一列的值；⑤array_combine()通过合并两个数组来创建一个新数组；⑥array_reverse()以相反的顺序返回数组；⑦array_unique()删除数组中的重复值；⑧in_array()检查数组中是否存在指定的值；
14、PHP处理字符串的常用函数？（重点看函数的‘参数’和‘返回值’）

①trim()移除字符串两侧的空白字符和其他字符；
②substr_replace()把字符串的一部分替换为另一个字符串；
③substr_count()计算子串在字符串中出现的次数；
④substr()返回字符串的一部分；
⑤strtolower()把字符串转换为小写字母；
⑥strtoupper()把字符串转换为大写字母；
⑦strtr()转换字符串中特定的字符；
⑧strrchr()查找字符串在另一个字符串中最后一次出现；
⑨strstr()查找字符串在另一字符串中的第一次出现（对大小写敏感）；strrev()反转字符串；strlen()返回字符串的长度；str_replace()替换字符串中的一些字符（对大小写敏感）；print()输出一个或多个字符串；explode()把字符串打散为数组；is_string()检测变量是否是字符串；strip_tags()从一个字符串中去除HTML标签；mb_substr()用来截中文与英文的函数
15、PHP处理时间的常用函数？（重点看函数的‘参数’和‘返回值’）

date_default_timezone_get()返回默认时区。
date_default_timezone_set()设置默认时区。
date()格式化本地时间／日期。
getdate()返回日期／时间信息。
gettimeofday()返回当前时间信息。
microtime()返回当前时间的微秒数。
mktime()返回一个日期的 Unix时间戳。
strtotime()将任何英文文本的日期或时间描述解析为 Unix时间戳。
time()返回当前时间的 Unix时间戳。
16、PHP处理数据库的常用函数？（重点看函数的‘参数’和‘返回值’）

请参照php手册，认真查看，此项非常重要
17、PHP操作文件的常用函数？（重点看函数的‘参数’和‘返回值’）

①打开文件；②删除文件；③读取文件；④写入文件；⑤修改文件；⑥关闭文件；⑦创建文件等等，此项非常重要，在工作中经常用来生成缓存或者静态文件，请参照php手册，认真查看
18、PHP操作目录（文件夹）的常用函数？（重点看函数的‘参数’和‘返回值’）

①打开目录；②删除目录；③读取目录；④创建目录；⑤修改目录；⑥关闭目录等等，此项非常重要，在工作中经常用来创建或者删除上传文件的目录，创建或者删除缓存、静态页面的目录，请参照php手册，认真查看
二：数据库部分

返回顶部
1. 常见的关系型数据库管理系统产品有？

答：Oracle、SQL Server、MySQL、Sybase、DB2、Access等。
2. SQL语言包括哪几部分？每部分都有哪些操作关键字？

答：SQL语言包括数据定义(DDL)、数据操纵(DML),数据控制(DCL)和数据查询（DQL）四个部分。
数据定义：Create Table,Alter Table,Drop Table, Craete/Drop Index等
数据操纵：Select ,insert,update,delete,
数据控制：grant,revoke
数据查询：select
3. 完整性约束包括哪些？

答：数据完整性(Data Integrity)是指数据的精确(Accuracy)和可靠性(Reliability)。
分为以下四类：
1) 实体完整性：规定表的每一行在表中是惟一的实体。
2) 域完整性：是指表中的列必须满足某种特定的数据类型约束，其中约束又包括取值范围、精度等规定。
3) 参照完整性：是指两个表的主关键字和外关键字的数据应一致，保证了表之间的数据的一致性，防止了数据丢失或无意义的数据在数据库中扩散。
4) 用户定义的完整性：不同的关系数据库系统根据其应用环境的不同，往往还需要一些特殊的约束条件。用户定义的完整性即是针对某个特定关系数据库的约束条件，它反映某一具体应用必须满足的语义要求。
与表有关的约束：包括列约束(NOT NULL（非空约束）)和表约束(PRIMARY KEY、foreign key、check、UNIQUE) 。
4. 什么是事务？及其特性？

答：事务：是一系列的数据库操作，是数据库应用的基本逻辑单位。
事务特性：
（1）原子性：即不可分割性，事务要么全部被执行，要么就全部不被执行。
（2）一致性或可串性。事务的执行使得数据库从一种正确状态转换成另一种正确状态
（3）隔离性。在事务正确提交之前，不允许把该事务对数据的任何改变提供给任何其他事务，
（4） 持久性。事务正确提交后，其结果将永久保存在数据库中，即使在事务提交后有了其他故障，事务的处理结果也会得到保存。
或者这样理解：
事务就是被绑定在一起作为一个逻辑工作单元的SQL语句分组，如果任何一个语句操作失败那么整个操作就被失败，以后操作就会回滚到操作前状态，或者是上有个节点。为了确保要么执行，要么不执行，就可以使用事务。要将有组语句作为事务考虑，就需要通过ACID测试，即原子性，一致性，隔离性和持久性。
5. 什么是锁？

答：数据库是一个多用户使用的共享资源。当多个用户并发地存取数据时，在数据库中就会产生多个事务同时存取同一数据的情况。若对并发操作不加控制就可能会读取和存储不正确的数据，破坏数据库的一致性。
加锁是实现数据库并发控制的一个非常重要的技术。当事务在对某个数据对象进行操作前，先向系统发出请求，对其加锁。加锁后事务就对该数据对象有了一定的控制，在该事务释放锁之前，其他的事务不能对此数据对象进行更新操作。
基本锁类型：锁包括行级锁和表级锁
6. 什么叫视图？游标是什么？

答：视图是一种虚拟的表，具有和物理表相同的功能。可以对视图进行增，改，查，操作，视图通常是有一个表或者多个表的行或列的子集。对视图的修改不影响基本表。它使得我们获取数据更容易，相比多表查询。
游标：是对查询出来的结果集作为一个单元来有效的处理。游标可以定在该单元中的特定行，从结果集的当前行检索一行或多行。可以对结果集当前行做修改。一般不使用游标，但是需要逐条处理数据的时候，游标显得十分重要。
7. 什么是存储过程？用什么来调用？

答：存储过程是一个预编译的SQL语句，优点是允许模块化的设计，就是说只需创建一次，以后在该程序中就可以调用多次。如果某次操作需要执行多次SQL，使用存储过程比单纯SQL语句执行要快。可以用一个命令对象来调用存储过程。
8. 索引的作用？和它的优点缺点是什么？

答：索引就一种特殊的查询表，数据库的搜索引擎可以利用它加速对数据的检索。它很类似与现实生活中书的目录，不需要查询整本书内容就可以找到想要的数据。索引可以是唯一的，创建索引允许指定单个列或者是多个列。缺点是它减慢了数据录入的速度，同时也增加了数据库的尺寸大小。
9. 如何通俗地理解三个范式？

答：第一范式：1NF是对属性的原子性约束，要求属性具有原子性，不可再分解；
第二范式：2NF是对记录的惟一性约束，要求记录有惟一标识，即实体的惟一性； 第三范式：3NF是对字段冗余性的约束，即任何字段不能由其他字段派生出来，它要求字段没有冗余。。
10. 什么是基本表？什么是视图？

答：基本表是本身独立存在的表，在 SQL 中一个关系就对应一个表。 视图是从一个或几个基本表导出的表。视图本身不独立存储在数据库中，是一个虚表
11. 试述视图的优点？

答：(1) 视图能够简化用户的操作 (2) 视图使用户能以多种角度看待同一数据； (3) 视图为数据库提供了一定程度的逻辑独立性； (4) 视图能够对机密数据提供安全保护。
12. NULL是什么意思

答：NULL这个值表示UNKNOWN(未知):它不表示“”(空字符串)。对NULL这个值的任何比较都会生产一个NULL值。您不能把任何值与一个 NULL值进行比较，并在逻辑上希望获得一个答案。
使用IS NULL来进行NULL判断
13. 主键、外键和索引的区别？

主键、外键和索引的区别
定义：
主键–唯一标识一条记录，不能有重复的，不允许为空
外键–表的外键是另一表的主键, 外键可以有重复的, 可以是空值
索引–该字段没有重复值，但可以有一个空值
作用：
主键–用来保证数据完整性
外键–用来和其他表建立联系用的
索引–是提高查询排序的速度
个数：
主键–主键只能有一个
外键–一个表可以有多个外键
索引–一个表可以有多个唯一索引
14. 你可以用什么来确保表格里的字段只接受特定范围里的值?

答：Check限制，它在数据库表格里被定义，用来限制输入该列的值。
触发器也可以被用来限制数据库表格里的字段能够接受的值，但是这种办法要求触发器在表格里被定义，这可能会在某些情况下影响到性能。
15. 说说对SQL语句优化有哪些方法？（选择几条）

（1）Where子句中：where表之间的连接必须写在其他Where条件之前，那些可以过滤掉最大数量记录的条件必须写在Where子句的末尾.HAVING最后。
（2）用EXISTS替代IN、用NOT EXISTS替代NOT IN。
（3） 避免在索引列上使用计算
（4）避免在索引列上使用IS NULL和IS NOT NULL
（5）对查询进行优化，应尽量避免全表扫描，首先应考虑在 where 及 order by 涉及的列上建立索引。
（6）应尽量避免在 where 子句中对字段进行 null 值判断，否则将导致引擎放弃使用索引而进行全表扫描
（7）应尽量避免在 where 子句中对字段进行表达式操作，这将导致引擎放弃使用索引而进行全表扫描
16. SQL语句中‘相关子查询’与‘非相关子查询’有什么区别？

答：子查询：嵌套在其他查询中的查询称之。
子查询又称内部，而包含子查询的语句称之外部查询（又称主查询）。
所有的子查询可以分为两类，即相关子查询和非相关子查询
（1）非相关子查询是独立于外部查询的子查询，子查询总共执行一次，执行完毕后将值传递给外部查询。
（2）相关子查询的执行依赖于外部查询的数据，外部查询执行一行，子查询就执行一次。
故非相关子查询比相关子查询效率高
17. char和varchar的区别？

答：是一种固定长度的类型，varchar则是一种可变长度的类型，它们的区别是：
char(M)类型的数据列里，每个值都占用M个字节，如果某个长度小于M，MySQL就会在它的右边用空格字符补足．（在检索操作中那些填补出来的空格字符将被去掉）在varchar(M)类型的数据列里，每个值只占用刚好够用的字节再加上一个用来记录其长度的字节（即总长度为L+1字节）．
18. Mysql 的存储引擎,myisam和innodb的区别。

答：简单的表达：
MyISAM 是非事务的存储引擎；适合用于频繁查询的应用；表锁，不会出现死锁；适合小数据，小并发
innodb是支持事务的存储引擎；合于插入和更新操作比较多的应用；设计合理的话是行锁（最大区别就在锁的级别上）；适合大数据，大并发。
19. 数据表类型有哪些

答：MyISAM、InnoDB、HEAP、BOB,ARCHIVE,CSV等。
MyISAM：成熟、稳定、易于管理，快速读取。一些功能不支持（事务等），表级锁。
InnoDB：支持事务、外键等特性、数据行锁定。空间占用大，不支持全文索引等。
20. MySQL数据库作发布系统的存储，一天五万条以上的增量，预计运维三年,怎么优化？

a. 设计良好的数据库结构，允许部分数据冗余，尽量避免join查询，提高效率。
b. 选择合适的表字段数据类型和存储引擎，适当的添加索引。
c. mysql库主从读写分离。
d. 找规律分表，减少单表中的数据量提高查询速度。
e.添加缓存机制，比如memcached，apc等。
f. 不经常改动的页面，生成静态页面。
g. 书写高效率的SQL。比如 SELECT * FROM TABEL 改为 SELECT field_1, field_2, field_3 FROM TABLE.
21. 对于大流量的网站,您采用什么样的方法来解决各页面访问量统计问题？

答：
a. 确认服务器是否能支撑当前访问量。
b. 优化数据库访问。
c. 禁止外部访问链接（盗链）, 比如图片盗链。
d. 控制文件下载。
e. 使用不同主机分流。
f. 使用浏览统计软件，了解访问量，有针对性的进行优化。
三：面向对象部分

返回顶部
1、什么是面向对象?（理解着回答）

答：面向对象OO = 面向对象的分析OOA + 面向对象的设计OOD + 面向对象的编程OOP；通俗的解释就是“万物皆对象”，把所有的事物都看作一个个可以独立的对象(单元)，它们可以自己完成自己的功能，而不是像C那样分成一个个函数。

现在纯正的OO语言主要是Java和C#，PHP、C++也支持OO，C是面向过程的。
2、简述 private、 protected、 public修饰符的访问权限。

答：private : 私有成员, 在类的内部才可以访问。

protected : 保护成员，该类内部和继承类中可以访问。

public : 公共成员，完全公开，没有访问限制。
3、堆和栈的区别？

答：栈是编译期间就分配好的内存空间，因此你的代码中必须就栈的大小有明确的定义；

堆是程序运行期间动态分配的内存空间，你可以根据程序的运行情况确定要分配的堆内存的大小。
4、XML 与 HTML 的主要区别

答：（1） XML是区分大小写字母的，HTML不区分。
（2） 在HTML中，如果上下文清楚地显示出段落或者列表键在何处结尾，那么你可以省略
或者
之类的结束 标记。在XML中，绝对不能省略掉结束标记。
（3） 在XML中，拥有单个标记而没有匹配的结束标记的元素必须用一个 / 字符作为结尾。这样分析器就知道不用 查找结束标记了。
（4） 在XML中，属性值必须分装在引号中。在HTML中，引号是可用可不用的。
（5） 在HTML中，可以拥有不带值的属性名。在XML中，所有的属性都必须带有相应的值。
5、面向对象的特征有哪些方面?

答：主要有封装,继承,多态。如果是4个方面则加上：抽象。
下面的解释为理解：
封装：
封装是保证软件部件具有优良的模块性的基础,封装的目标就是要实现软件部件的高内聚,低耦合,防止程序相互依赖性而带来的变动影响.
继承：
在定义和实现一个类的时候，可以在一个已经存在的类的基础之上来进行，把这个已经存在的类所定义的内容作为自己的内容，并可以加入若干新的内容，或修改原来的方法使之更适合特殊的需要，这就是继承。继承是子类自动共享父类数据和方法的机制，这是类之间的一种关系，提高了软件的可重用性和可扩展性。
多态：
多态是指程序中定义的引用变量所指向的具体类型和通过该引用变量发出的方法调用在编程时并不确定，而是在程序运行期间才确定，即一个引用变量倒底会指向哪个类的实例对象，该引用变量发出的方法调用到底是哪个类中实现的方法，必须在由程序运行期间才能决定。
抽象：
抽象就是找出一些事物的相似和共性之处，然后将这些事物归为一个类，这个类只考虑这些事物的相似和共性之处，并且会忽略与当前主题和目标无关的那些方面，将注意力集中在与当前目标有关的方面。例如，看到一只蚂蚁和大象，你能够想象出它们的相同之处，那就是抽象。
6、抽象类和接口的概念以及区别？

答：抽象类：它是一种特殊的，不能被实例化的类，只能作为其他类的父类使用。使用abstract关键字声明。
它是一种特殊的抽象类，也是一个特殊的类，使用interface声明。
（1）抽象类的操作通过继承关键字extends实现，而接口的使用是通过implements关键字来实现。
（2）抽象类中有数据成员，可以实现数据的封装，但是接口没有数据成员。
（3）抽象类中可以有构造方法，但是接口没有构造方法。
（4）抽象类的方法可以通过private、protected、public关键字修饰（抽象方法不能是private），而接口中的方法只能使用public关键字修饰。
（5）一个类只能继承于一个抽象类，而一个类可以同时实现多个接口。
（6）抽象类中可以有成员方法的实现代码，而接口中不可以有成员方法的实现代码。
7、什么是构造函数，什么是析构函数，作用是什么？

答：构造函数（方法）是对象创建完成后第一个被对象自动调用的方法。它存在于每个声明的类中，是一个特殊的成员方法。作用是执行一些初始化的任务。Php中使用__construct()声明构造方法，并且只能声明一个。
析构函数（方法）作用和构造方法正好相反，是对象被销毁之前最后一个被对象自动调用的方法。是PHP5中新添加的内容作用是用于实现在销毁一个对象之前执行一些特定的操作，诸如关闭文件和释放内存等。
8、如何重载父类的方法，举例说明

答：重载，即覆盖父类的方法，也就是使用子类中的方法替换从父类中继承的方法，也叫方法的重写。
覆盖父类方法的关键是在子类中创建于父类中相同的方法包括方法的名称、参数和返回值类型。PHP中只要求方法的名称相同即可。
9、常用的魔术方法有哪些？举例说明

答：php规定以两个下划线（）开头的方法都保留为魔术方法，所以建议大家函数名最好不用开头，除非是为了重载已有的魔术方法。
__construct() 实例化类时自动调用。
__destruct() 类对象使用结束时自动调用。
__set() 在给未定义的属性赋值的时候调用。
__get() 调用未定义的属性时候调用。
__isset() 使用isset()或empty()函数时候会调用。
__unset() 使用unset()时候会调用。
__sleep() 使用serialize序列化时候调用。
__wakeup() 使用unserialize反序列化的时候调用。
__call() 调用一个不存在的方法的时候调用。
__callStatic()调用一个不存在的静态方法是调用。
__toString() 把对象转换成字符串的时候会调用。比如 echo。
__invoke() 当尝试把对象当方法调用时调用。
__set_state() 当使用var_export()函数时候调用。接受一个数组参数。
__clone() 当使用clone复制一个对象时候调用。
10、$this和self、parent这三个关键词分别代表什么？在哪些场合下使用？

答：this当前对象self当前类parent当前类的父类this在当前类中使用,使用->调用属性和方法。
self也在当前类中使用，不过需要使用::调用。
parent在类中使用。
11、类中如何定义常量、如何类中调用常量、如何在类外调用常量。

答：类中的常量也就是成员常量，常量就是不会改变的量，是一个恒值。
定义常量使用关键字const.
例如：const PI = 3.1415326;
无论是类内还是类外，常量的访问和变量是不一样的，常量不需要实例化对象，
访问常量的格式都是类名加作用域操作符号（双冒号）来调用。
即：类名 :: 类常量名;
12、作用域操作符::如何使用？都在哪些场合下使用？

答：调用类常量
调用静态方法
13、__autoload()方法的工作原理是什么？

答：使用这个魔术函数的基本条件是类文件的文件名要和类的名字保持一致。
当程序执行到实例化某个类的时候，如果在实例化前没有引入这个类文件，那么就自动执行__autoload()函数。
这个函数会根据实例化的类的名称来查找这个类文件的路径，当判断这个类文件路径下确实存在这个类文件后
就执行include或者require来载入该类，然后程序继续执行，如果这个路径下不存在该文件时就提示错误。
使用自动载入的魔术函数可以不必要写很多个include或者require函数。
四：ThinkPHP部分

返回顶部
1、常见的PHP框架

答：thinkPHP、yii、ZendFramework、CakePhp、sy
2、如何理解TP中的单一入口文件？

答：ThinkPHP采用单一入口模式进行项目部署和访问，无论完成什么功能，一个项目都有一个统一（但不一定是唯一）的入口。应该说，所有项目都是从入口文件开始的，并且所有的项目的入口文件是类似的，入口文件中主要包括：
定义框架路径、项目路径和项目名称（可选）
定义调试模式和运行模式的相关常量（可选）
载入框架入口文件（必须）
3、ThinkPHP中的MVC分层是什么？（理解）

答：MVC 是一种将应用程序的逻辑层和表现层进行分离的方法。ThinkPHP 也是基于MVC设计模式的。MVC只是一个抽象的概念，并没有特别明确的规定，ThinkPHP中的MVC分层大致体现在：
模型（M）：模型的定义由Model类来完成。
控制器（C）：应用控制器（核心控制器App类）和Action控制器都承担了控制器的角色，Action控制器完成业务过程控制，而应用控制器负责调度控制。
视图（V）：由View类和模板文件组成，模板做到了100％分离，可以独立预览和制作。
但实际上，ThinkPHP并不依赖M或者V ，也就是说没有模型或者视图也一样可以工作。甚至也不依赖C，这是因为ThinkPHP在Action之上还有一个总控制器，即App控制器，负责应用的总调度。在没有C的情况下，必然存在视图V，否则就不再是一个完整的应用。
总而言之，ThinkPHP的MVC模式只是提供了一种敏捷开发的手段，而不是拘泥于MVC本身。
4、如何进行SQL优化？（关于后边的解释同学们可以进行理解，到时根据自己的理解把大体意思说出来即可）

答：（1）选择正确的存储引擎
以 MySQL为例，包括有两个存储引擎 MyISAM 和 InnoDB，每个引擎都有利有弊。
MyISAM 适合于一些需要大量查询的应用，但其对于有大量写操作并不是很好。甚至你只是需要update一个字段，整个表都会被锁起来，而别的进程，就算是读进程都无法操作直到读操作完成。另外，MyISAM 对于 SELECT COUNT(*) 这类的计算是超快无比的。
InnoDB 的趋势会是一个非常复杂的存储引擎，对于一些小的应用，它会比 MyISAM 还慢。但是它支持“行锁” ，于是在写操作比较多的时候，会更优秀。并且，他还支持更多的高级应用，比如：事务。
（2）优化字段的数据类型
记住一个原则，越小的列会越快。如果一个表只会有几列罢了（比如说字典表，配置表），那么，我们就没有理由使用 INT 来做主键，使用 MEDIUMINT, SMALLINT 或是更小的 TINYINT 会更经济一些。如果你不需要记录时间，使用 DATE 要比 DATETIME 好得多。当然，你也需要留够足够的扩展空间。
（3）为搜索字段添加索引
索引并不一定就是给主键或是唯一的字段。如果在你的表中，有某个字段你总要会经常用来做搜索，那么最好是为其建立索引，除非你要搜索的字段是大的文本字段，那应该建立全文索引。
（4）避免使用Select 从数据库里读出越多的数据，那么查询就会变得越慢。并且，如果你的数据库服务器和WEB服务器是两台独立的服务器的话，这还会增加网络传输的负载。即使你要查询数据表的所有字段，也尽量不要用通配符，善用内置提供的字段排除定义也许能给带来更多的便利。
（5）使用 ENUM 而不是 VARCHAR
ENUM 类型是非常快和紧凑的。在实际上，其保存的是 TINYINT，但其外表上显示为字符串。这样一来，用这个字段来做一些选项列表变得相当的完美。例如，性别、民族、部门和状态之类的这些字段的取值是有限而且固定的，那么，你应该使用 ENUM 而不是 VARCHAR。
（6）尽可能的使用 NOT NULL
除非你有一个很特别的原因去使用 NULL 值，你应该总是让你的字段保持 NOT NULL。 NULL其实需要额外的空间，并且，在你进行比较的时候，你的程序会更复杂。 当然，这里并不是说你就不能使用NULL了，现实情况是很复杂的，依然会有些情况下，你需要使用NULL值。
（7）固定长度的表会更快
如果表中的所有字段都是“固定长度”的，整个表会被认为是 “static” 或 “fixed-length”。 例如，表中没有如下类型的字段： VARCHAR，TEXT，BLOB。只要你包括了其中一个这些字段，那么这个表就不是“固定长度静态表”了，这样，MySQL 引擎会用另一种方法来处理。
固定长度的表会提高性能，因为MySQL搜寻得会更快一些，因为这些固定的长度是很容易计算下一个数据的偏移量的，所以读取的自然也会很快。而如果字段不是定长的，那么，每一次要找下一条的话，需要程序找到主键。
并且，固定长度的表也更容易被缓存和重建。不过，唯一的副作用是，固定长度的字段会浪费一些空间，因为定长的字段无论你用不用，他都是要分配那么多的空间。
5、如何理解 ThinkPHP 3.0 架构三（核心 + 行为 + 驱动）中的行为？

答：核心 + 行为 + 驱动
TP官方简称为：CBD
核心（Core）：就是框架的核心代码，不可缺少的东西，TP本身是基于MVC思想开发的框架。
行为（Behavior） ：行为在新版ThinkPHP的架构里面起着举足轻重的作用，在系统核心之上，设置了很多标签扩展位，而每个标签位置可以依次执行各自的独立行为。行为扩展就因此而诞生了，而且很多系统功能也是通过内置的行为扩展完成的，所有行为扩展都是可替换和增加的，由此形成了底层框架可组装的基础。
驱动（ Driver ）：数据库驱动、缓存驱动、标签库驱动和模板引擎驱动，以及外置的类扩展。
框架，即framework。其实就是某种应用的半成品，就是一组组件，供你选用完成你自己的系统。简单说就是使用别人搭好的舞台，你来做表演。而且，框架一般是成熟的，不断升级的软件。
6、什么是惯例配置？

答：惯例配置上一页下一页惯例重于配置是系统遵循的一个重要思想，系统内置有一个惯例配置文件（位于系统目录下面的Conf\convention.php），按照大多数的使用对常用参数进行了默认配置。所以，对应用项目的配置文件，往往只需要配置和惯例配置不同的或者新增的配置参数，如果你完全采用默认配置，甚至可以不需要定义任何配置文件。
惯例配置文件会被系统自动加载，无需在项目中进行加载。
7、什么是SQL注入？（理解）

答：SQL注入攻击是黑客对数据库进行攻击的常用手段之一。一部分程序员在编写代码的时候，没有对用户输入数据的合法性进行判断，注入者可以在表单中输入一段数据库查询代码并提交，程序将提交的信息拼凑生成一个完整sql语句，服务器被欺骗而执行该条恶意的SQL命令。注入者根据程序返回的结果，成功获取一些敏感数据，甚至控制整个服务器，这就是SQL注入。
8、ThinkPHP如何防止SQL注入？（理解）

答：（1）查询条件尽量使用数组方式，这是更为安全的方式；
（2）如果不得已必须使用字符串查询条件，使用预处理机制；
（3）开启数据字段类型验证，可以对数值数据类型做强制转换；（3.1版本开始已经强制进行字段类型验证了）
（4）使用自动验证和自动完成机制进行针对应用的自定义过滤；
（5）使用字段类型检查、自动验证和自动完成机制等避免恶意数据的输入。
9、如何开启调试模式？调试模式有什么好处？

答：开启调试模式很简单，只需要在入口文件中增加一行常量定义代码：
2018PHP经典面试题大全汇总（更新）-PHP面试题

开启调试模式

在完成开发阶段部署到生产环境后，只需要删除调试模式定义代码即可切换到部署模式。开启调试模式后，系统会首先加载系统默认的调试配置文件，然后加载项目的调试配置文件，调试模式的优势在于： 开启日志记录，任何错误信息和调试信息都会详细记录，便于调试； 关闭模板缓存，模板修改可以即时生效； 记录SQL日志，方便分析SQL； 关闭字段缓存，数据表字段修改不受缓存影响； 严格检查文件大小写（即使是Windows平台），帮助你提前发现Linux部署问题； 可以方便用于开发过程的不同阶段，包括开发、测试和演示等任何需要的情况，不同的应用模式可以配置独立的项目配置文件。
10、TP中支持哪些配置模式？优先级？

答：ThinkPHP在项目配置上面创造了自己独有的分层配置模式，其配置层次体现在： 惯例配置->项目配置->调试配置->分组配置->扩展配置->动态配置
以上是配置文件的加载顺序，因为后面的配置会覆盖之前的同名配置（在没有生效的前提下），所以优先顺序从右到左。
11、TP中的URL模式有哪几种？默认是哪种？

答：ThinkPHP支持四种URL模式，可以通过设置URL_MODEL参数来定义，包括普通模式、PATHINFO、REWRITE和兼容模式。
默认模式为：PATHINFO模式，设置URL_MODEL 为1
12、TP中系统变量有哪些？如何获取系统变量？

答：获取系统变量的方法：
只需要在Action中调用下面方法：
$this->方法名(“变量名”,[“过滤方法”],[“默认值”])
13、ThinkPHP框架中D函数与M函数的区别是什么？

答：M方法实例化模型无需用户为每个数据表定义模型类，D方法可以自动检测模型类，如果存在自定义的模型类，则实例化自定义模型类，如果不存在，则会自动调用M方法去实例化Model基类。同时对于已实例化过的模型，不会重复去实例化（单例模式）。
五：smarty模板引擎',
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
            ],
            [
                'article_id' => 7,
                'contents' => '1.把包含数据的二进制字符串转换为十六进制值的函数是什么？

 答：bin2hex($string),例如bin2hex(\'ab\') = 6162
1
2.ASCII码转字符，字符转ASCII码的函数分别是什么？

答：chr(int $ascii),ord(string $string)
1
3.将十六进制字符串转换成二进制字符串的函数是什么？

答：hex2bin()
1
4.将HTML代码转换成特殊的HTML实体和相反的函数分别是什么？

答：htmlspecialchars(),htmlspecialchars_decode()
1
5.join是哪个函数的别名？

答：implode()
1
6.使字符串首字母小写,首字母大写,所有字母小写,所有字母大写,每个单词首字母大写的函数分别是什么？

答lcfirst(),ucfirst(),strtolower(),strtoupper(),ucwords()
1
7.计算指定文件的 MD5 散列值的函数是什么？

答：md5_file($filename)
1
8.以千位分隔符方式格式化一个数字的函数是什么？

答：string number_format ( float $number [, int $decimals = 0 ] )
1
9.将字符串解析成多个变量的函数是什么？

答：parse_str($string [,$array])
1
10.重复一个字符串次数的函数是什么？

答：str_repeat($str,$count)
1
11.使用另一个字符串填充字符串为指定长度的函数是什么？

答：str_pad ($string , $length [,$ps = " " [, STR_PAD_RIGHT|STR_PAD_LEFT |STR_PAD_BOTH ] )
1
12.随机打乱一个字符串的函数是什么？

答：str_shuffle($string)
1
13.按照固定长度将字符串转换成数组的函数是什么？

答：array str_split ( string $string [, int $split_length = 1 ] )
1
14.查找字符串首次出现的位置的区分大小写和不区分大小写的函数分别是什么？

答：strpos($haystack,$needle),stripos($haystack,$needle)
1
15.查找字符串最后出现的位置的区分大小写和不区分大小写的函数分别是什么？
答：strrpos(haystack,haystack,needle),strripos(haystack,haystack,needle)

16.查找字符串的首次出现的结果区分大小写和不区分大小写的函数分别是什么？

答：strstr($haystack,$needle),stristr($haystack,$needle)
1
17.获取字符串长度的函数是什么？

答：strlen()
1
18.计算字符串出现的次数的函数是什么？

答：substr_count($haystack,$needle)
1
19.指定起始点获取字符串的内容的函数是什么？

答：substr($string,$start [,$length])
1
20.str_replace()和substr_replace()函数的区别

答：str_replace()函数是查找替换,substr_replace()是按照长度替换
',
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
