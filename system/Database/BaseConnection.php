<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace CodeIgniter\Database;

use Closure;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Events\Events;
use stdClass;
use Stringable;
use Throwable;

/**
 * @property-read array      $aliasedTables
 * @property-read string     $charset
 * @property-read bool       $compress
 * @property-read float      $connectDuration
 * @property-read float      $connectTime
 * @property-read string     $database
 * @property-read array      $dateFormat
 * @property-read string     $DBCollat
 * @property-read bool       $DBDebug
 * @property-read string     $DBDriver
 * @property-read string     $DBPrefix
 * @property-read string     $DSN
 * @property-read array|bool $encrypt
 * @property-read array      $failover
 * @property-read string     $hostname
 * @property-read Query      $lastQuery
 * @property-read string     $password
 * @property-read bool       $pConnect
 * @property-read int|string $port
 * @property-read bool       $pretend
 * @property-read string     $queryClass
 * @property-read array      $reservedIdentifiers
 * @property-read bool       $strictOn
 * @property-read string     $subdriver
 * @property-read string     $swapPre
 * @property-read int        $transDepth
 * @property-read bool       $transFailure
 * @property-read bool       $transStatus
 * @property-read string     $username
 *
 * @template TConnection
 * @template TResult
 *
 * @implements ConnectionInterface<TConnection, TResult>
 * @see \CodeIgniter\Database\BaseConnectionTest
 */
abstract class BaseConnection implements ConnectionInterface
{
    /**
     * Data Source Name / Connect string
     *
     * @var string
     */
    protected $DSN;

    /**
     * Database port
     *
     * @var int|string
     */
    protected $port = '';

    /**
     * Hostname
     *
     * @var string
     */
    protected $hostname;

    /**
     * Username
     *
     * @var string
     */
    protected $username;

    /**
     * Password
     *
     * @var string
     */
    protected $password;

    /**
     * Database name
     *
     * @var string
     */
    protected $database;

    /**
     * Database driver
     *
     * @var string
     */
    protected $DBDriver = 'MySQLi';

    /**
     * Sub-driver
     *
     * @used-by CI_DB_pdo_driver
     *
     * @var string
     */
    protected $subdriver;

    /**
     * Table prefix
     *
     * @var string
     */
    protected $DBPrefix = '';

    /**
     * Persistent connection flag
     *
     * @var bool
     */
    protected $pConnect = false;

    /**
     * Whether to throw Exception or not when an error occurs.
     *
     * @var bool
     */
    protected $DBDebug = true;

    /**
     * Character set
     *
     * This value must be updated by Config\Database if the driver use it.
     *
     * @var string
     */
    protected $charset = '';

    /**
     * Collation
     *
     * This value must be updated by Config\Database if the driver use it.
     *
     * @var string
     */
    protected $DBCollat = '';

    /**
     * Swap Prefix
     *
     * @var string
     */
    protected $swapPre = '';

    /**
     * Encryption flag/data
     *
     * @var array|bool
     */
    protected $encrypt = false;

    /**
     * Compression flag
     *
     * @var bool
     */
    protected $compress = false;

    /**
     * Strict ON flag
     *
     * Whether we're running in strict SQL mode.
     *
     * @var bool|null
     *
     * @deprecated 4.5.0 Will move to MySQLi\Connection.
     */
    protected $strictOn;

    /**
     * Settings for a failover connection.
     *
     * @var array
     */
    protected $failover = [];

    /**
     * The last query object that was executed
     * on this connection.
     *
     * @var Query
     */
    protected $lastQuery;

    /**
     * Connection ID
     *
     * @var         false|object|resource
     * @phpstan-var false|TConnection
     */
    public $connID = false;

    /**
     * Result ID
     *
     * @var         false|object|resource
     * @phpstan-var false|TResult
     */
    public $resultID = false;

    /**
     * Protect identifiers flag
     *
     * @var bool
     */
    public $protectIdentifiers = true;

    /**
     * List of reserved identifiers
     *
     * Identifiers that must NOT be escaped.
     *
     * @var array
     */
    protected $reservedIdentifiers = ['*'];

    /**
     * Identifier escape character
     *
     * @var array|string
     */
    public $escapeChar = '"';

    /**
     * ESCAPE statement string
     *
     * @var string
     */
    public $likeEscapeStr = " ESCAPE '%s' ";

    /**
     * ESCAPE character
     *
     * @var string
     */
    public $likeEscapeChar = '!';

    /**
     * RegExp used to escape identifiers
     *
     * @var array
     */
    protected $pregEscapeChar = [];

    /**
     * Holds previously looked up data
     * for performance reasons.
     *
     * @var array
     */
    public $dataCache = [];

    /**
     * Microtime when connection was made
     *
     * @var float
     */
    protected $connectTime = 0.0;

    /**
     * How long it took to establish connection.
     *
     * @var float
     */
    protected $connectDuration = 0.0;

    /**
     * If true, no queries will actually be
     * run against the database.
     *
     * @var bool
     */
    protected $pretend = false;

    /**
     * Transaction enabled flag
     *
     * @var bool
     */
    public $transEnabled = true;

    /**
     * Strict transaction mode flag
     *
     * @var bool
     */
    public $transStrict = true;

    /**
     * Transaction depth level
     *
     * @var int
     */
    protected $transDepth = 0;

    /**
     * Transaction status flag
     *
     * Used with transactions to determine if a rollback should occur.
     *
     * @var bool
     */
    protected $transStatus = true;

    /**
     * Transaction failure flag
     *
     * Used with transactions to determine if a transaction has failed.
     *
     * @var bool
     */
    protected $transFailure = false;

    /**
     * Whether to throw exceptions during transaction
     */
    protected bool $transException = false;

    /**
     * Array of table aliases.
     *
     * @var list<string>
     */
    protected $aliasedTables = [];

    /**
     * Query Class
     *
     * @var string
     */
    protected $queryClass = Query::class;

    /**
     * Default Date/Time formats
     *
     * @var array<string, string>
     */
    protected array $dateFormat = [
        'date'        => 'Y-m-d',
        'datetime'    => 'Y-m-d H:i:s',
        'datetime-ms' => 'Y-m-d H:i:s.v',
        'datetime-us' => 'Y-m-d H:i:s.u',
        'time'        => 'H:i:s',
    ];

    /**
     * Saves our connection settings.
     */
    public function __construct(array $params)
    {
        if (isset($params['dateFormat'])) {
            $this->dateFormat = array_merge($this->dateFormat, $params['dateFormat']);
            unset($params['dateFormat']);
        }

        foreach ($params as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        $queryClass = str_replace('Connection', 'Query', static::class);

        if (class_exists($queryClass)) {
            $this->queryClass = $queryClass;
        }

        if ($this->failover !== []) {
            // If there is a failover database, connect now to do failover.
            // Otherwise, Query Builder creates SQL statement with the main database config
            // (DBPrefix) even when the main database is down.
            $this->initialize();
        }
    }

    /**
     * Initializes the database connection/settings.
     *
     * @return void
     *
     * @throws DatabaseException
     */
    public function initialize()
    {
        /* If an established connection is available, then there's
         * no need to connect and select the database.
         *
         * Depending on the database driver, connID can be either
         * boolean TRUE, a resource or an object.
         */
        if ($this->connID) {
            return;
        }

        $this->connectTime = microtime(true);
        $connectionErrors  = [];

        try {
            // Connect to the database and set the connection ID
            $this->connID = $this->connect($this->pConnect);
        } catch (Throwable $e) {
            $this->connID       = false;
            $connectionErrors[] = sprintf(
                'Main connection [%s]: %s',
                $this->DBDriver,
                $e->getMessage(),
            );
            log_message('error', 'Error connecting to the database: ' . $e);
        }

        // No connection resource? Check if there is a failover else throw an error
        if (! $this->connID) {
            // Check if there is a failover set
            if (! empty($this->failover) && is_array($this->failover)) {
                // Go over all the failovers
                foreach ($this->failover as $index => $failover) {
                    // Replace the current settings with those of the failover
                    foreach ($failover as $key => $val) {
                        if (property_exists($this, $key)) {
                            $this->{$key} = $val;
                        }
                    }

                    try {
                        // Try to connect
                        $this->connID = $this->connect($this->pConnect);
                    } catch (Throwable $e) {
                        $connectionErrors[] = sprintf(
                            'Failover #%d [%s]: %s',
                            ++$index,
                            $this->DBDriver,
                            $e->getMessage(),
                        );
                        log_message('error', 'Error connecting to the database: ' . $e);
                    }

                    // If a connection is made break the foreach loop
                    if ($this->connID) {
                        break;
                    }
                }
            }

            // We still don't have a connection?
            if (! $this->connID) {
                throw new DatabaseException(sprintf(
                    'Unable to connect to the database.%s%s',
                    PHP_EOL,
                    implode(PHP_EOL, $connectionErrors),
                ));
            }
        }

        $this->connectDuration = microtime(true) - $this->connectTime;
    }

    /**
     * Close the database connection.
     *
     * @return void
     */
    public function close()
    {
        if ($this->connID) {
            $this->_close();
            $this->connID = false;
        }
    }

    /**
     * Platform dependent way method for closing the connection.
     *
     * @return void
     */
    abstract protected function _close();

    /**
     * Create a persistent database connection.
     *
     * @return         false|object|resource
     * @phpstan-return false|TConnection
     */
    public function persistentConnect()
    {
        return $this->connect(true);
    }

    /**
     * Returns the actual connection object. If both a 'read' and 'write'
     * connection has been specified, you can pass either term in to
     * get that connection. If you pass either alias in and only a single
     * connection is present, it must return the sole connection.
     *
     * @return         false|object|resource
     * @phpstan-return TConnection
     */
    public function getConnection(?string $alias = null)
    {
        // @todo work with read/write connections
        return $this->connID;
    }

    /**
     * Returns the name of the current database being used.
     */
    public function getDatabase(): string
    {
        return empty($this->database) ? '' : $this->database;
    }

    /**
     * Set DB Prefix
     *
     * Set's the DB Prefix to something new without needing to reconnect
     *
     * @param string $prefix The prefix
     */
    public function setPrefix(string $prefix = ''): string
    {
        return $this->DBPrefix = $prefix;
    }

    /**
     * Returns the database prefix.
     */
    public function getPrefix(): string
    {
        return $this->DBPrefix;
    }

    /**
     * The name of the platform in use (MySQLi, Postgre, SQLite3, OCI8, etc)
     */
    public function getPlatform(): string
    {
        return $this->DBDriver;
    }

    /**
     * Sets the Table Aliases to use. These are typically
     * collected during use of the Builder, and set here
     * so queries are built correctly.
     *
     * @return $this
     */
    public function setAliasedTables(array $aliases)
    {
        $this->aliasedTables = $aliases;

        return $this;
    }

    /**
     * Add a table alias to our list.
     *
     * @return $this
     */
    public function addTableAlias(string $alias)
    {
        if ($alias === '') {
            return $this;
        }

        if (! in_array($alias, $this->aliasedTables, true)) {
            $this->aliasedTables[] = $alias;
        }

        return $this;
    }

    /**
     * Executes the query against the database.
     *
     * @return         false|object|resource
     * @phpstan-return false|TResult
     */
    abstract protected function execute(string $sql);

    /**
     * Orchestrates a query against the database. Queries must use
     * Database\Statement objects to store the query and build it.
     * This method works with the cache.
     *
     * Should automatically handle different connections for read/write
     * queries if needed.
     *
     * @param array|string|null $binds
     *
     * @return         BaseResult|bool|Query                       BaseResult when “read” type query, bool when “write” type query, Query when prepared query
     * @phpstan-return BaseResult<TConnection, TResult>|bool|Query
     *
     * @todo BC set $queryClass default as null in 4.1
     */
    public function query(string $sql, $binds = null, bool $setEscapeFlags = true, string $queryClass = '')
    {
        $queryClass = $queryClass !== '' && $queryClass !== '0' ? $queryClass : $this->queryClass;

        if (empty($this->connID)) {
            $this->initialize();
        }

        /**
         * @var Query $query
         */
        $query = new $queryClass($this);

        $query->setQuery($sql, $binds, $setEscapeFlags);

        if (! empty($this->swapPre) && ! empty($this->DBPrefix)) {
            $query->swapPrefix($this->DBPrefix, $this->swapPre);
        }

        $startTime = microtime(true);

        // Always save the last query so we can use
        // the getLastQuery() method.
        $this->lastQuery = $query;

        // If $pretend is true, then we just want to return
        // the actual query object here. There won't be
        // any results to return.
        if ($this->pretend) {
            $query->setDuration($startTime);

            return $query;
        }

        // Run the query for real
        try {
            $exception      = null;
            $this->resultID = $this->simpleQuery($query->getQuery());
        } catch (DatabaseException $exception) {
            $this->resultID = false;
        }

        if ($this->resultID === false) {
            $query->setDuration($startTime, $startTime);

            // This will trigger a rollback if transactions are being used
            if ($this->transDepth !== 0) {
                $this->transStatus = false;
            }

            if (
                $this->DBDebug
                && (
                    // Not in transactions
                    $this->transDepth === 0
                    // In transactions, do not throw exception by default.
                    || $this->transException
                )
            ) {
                // We call this function in order to roll-back queries
                // if transactions are enabled. If we don't call this here
                // the error message will trigger an exit, causing the
                // transactions to remain in limbo.
                while ($this->transDepth !== 0) {
                    $transDepth = $this->transDepth;
                    $this->transComplete();

                    if ($transDepth === $this->transDepth) {
                        log_message('error', 'Database: Failure during an automated transaction commit/rollback!');
                        break;
                    }
                }

                // Let others do something with this query.
                Events::trigger('DBQuery', $query);

                if ($exception instanceof DatabaseException) {
                    throw new DatabaseException(
                        $exception->getMessage(),
                        $exception->getCode(),
                        $exception,
                    );
                }

                return false;
            }

            // Let others do something with this query.
            Events::trigger('DBQuery', $query);

            return false;
        }

        $query->setDuration($startTime);

        // Let others do something with this query
        Events::trigger('DBQuery', $query);

        // resultID is not false, so it must be successful
        if ($this->isWriteType($sql)) {
            return true;
        }

        // query is not write-type, so it must be read-type query; return QueryResult
        $resultClass = str_replace('Connection', 'Result', static::class);

        return new $resultClass($this->connID, $this->resultID);
    }

    /**
     * Performs a basic query against the database. No binding or caching
     * is performed, nor are transactions handled. Simply takes a raw
     * query string and returns the database-specific result id.
     *
     * @return         false|object|resource
     * @phpstan-return false|TResult
     */
    public function simpleQuery(string $sql)
    {
        if (empty($this->connID)) {
            $this->initialize();
        }

        return $this->execute($sql);
    }

    /**
     * Disable Transactions
     *
     * This permits transactions to be disabled at run-time.
     *
     * @return void
     */
    public function transOff()
    {
        $this->transEnabled = false;
    }

    /**
     * Enable/disable Transaction Strict Mode
     *
     * When strict mode is enabled, if you are running multiple groups of
     * transactions, if one group fails all subsequent groups will be
     * rolled back.
     *
     * If strict mode is disabled, each group is treated autonomously,
     * meaning a failure of one group will not affect any others
     *
     * @param bool $mode = true
     *
     * @return $this
     */
    public function transStrict(bool $mode = true)
    {
        $this->transStrict = $mode;

        return $this;
    }

    /**
     * Start Transaction
     */
    public function transStart(bool $testMode = false): bool
    {
        if (! $this->transEnabled) {
            return false;
        }

        return $this->transBegin($testMode);
    }

    /**
     * If set to true, exceptions are thrown during transactions.
     *
     * @return $this
     */
    public function transException(bool $transException)
    {
        $this->transException = $transException;

        return $this;
    }

    /**
     * Complete Transaction
     */
    public function transComplete(): bool
    {
        if (! $this->transEnabled) {
            return false;
        }

        // The query() function will set this flag to FALSE in the event that a query failed
        if ($this->transStatus === false || $this->transFailure === true) {
            $this->transRollback();

            // If we are NOT running in strict mode, we will reset
            // the _trans_status flag so that subsequent groups of
            // transactions will be permitted.
            if ($this->transStrict === false) {
                $this->transStatus = true;
            }

            return false;
        }

        return $this->transCommit();
    }

    /**
     * Lets you retrieve the transaction flag to determine if it has failed
     */
    public function transStatus(): bool
    {
        return $this->transStatus;
    }

    /**
     * Begin Transaction
     */
    public function transBegin(bool $testMode = false): bool
    {
        if (! $this->transEnabled) {
            return false;
        }

        // When transactions are nested we only begin/commit/rollback the outermost ones
        if ($this->transDepth > 0) {
            $this->transDepth++;

            return true;
        }

        if (empty($this->connID)) {
            $this->initialize();
        }

        // Reset the transaction failure flag.
        // If the $testMode flag is set to TRUE transactions will be rolled back
        // even if the queries produce a successful result.
        $this->transFailure = $testMode;

        if ($this->_transBegin()) {
            $this->transDepth++;

            return true;
        }

        return false;
    }

    /**
     * Commit Transaction
     */
    public function transCommit(): bool
    {
        if (! $this->transEnabled || $this->transDepth === 0) {
            return false;
        }

        // When transactions are nested we only begin/commit/rollback the outermost ones
        if ($this->transDepth > 1 || $this->_transCommit()) {
            $this->transDepth--;

            return true;
        }

        return false;
    }

    /**
     * Rollback Transaction
     */
    public function transRollback(): bool
    {
        if (! $this->transEnabled || $this->transDepth === 0) {
            return false;
        }

        // When transactions are nested we only begin/commit/rollback the outermost ones
        if ($this->transDepth > 1 || $this->_transRollback()) {
            $this->transDepth--;

            return true;
        }

        return false;
    }

    /**
     * Reset transaction status - to restart transactions after strict mode failure
     */
    public function resetTransStatus(): static
    {
        $this->transStatus = true;

        return $this;
    }

    /**
     * Begin Transaction
     */
    abstract protected function _transBegin(): bool;

    /**
     * Commit Transaction
     */
    abstract protected function _transCommit(): bool;

    /**
     * Rollback Transaction
     */
    abstract protected function _transRollback(): bool;

    /**
     * Returns a non-shared new instance of the query builder for this connection.
     *
     * @param array|string|TableName $tableName
     *
     * @return BaseBuilder
     *
     * @throws DatabaseException
     */
    public function table($tableName)
    {
        if (empty($tableName)) {
            throw new DatabaseException('You must set the database table to be used with your query.');
        }

        $className = str_replace('Connection', 'Builder', static::class);

        return new $className($tableName, $this);
    }

    /**
     * Returns a new instance of the BaseBuilder class with a cleared FROM clause.
     */
    public function newQuery(): BaseBuilder
    {
        // save table aliases
        $tempAliases         = $this->aliasedTables;
        $builder             = $this->table(',')->from([], true);
        $this->aliasedTables = $tempAliases;

        return $builder;
    }

    /**
     * Creates a prepared statement with the database that can then
     * be used to execute multiple statements against. Within the
     * closure, you would build the query in any normal way, though
     * the Query Builder is the expected manner.
     *
     * Example:
     *    $stmt = $db->prepare(function($db)
     *           {
     *             return $db->table('users')
     *                   ->where('id', 1)
     *                     ->get();
     *           })
     *
     * @param Closure(BaseConnection): mixed $func
     *
     * @return BasePreparedQuery|null
     */
    public function prepare(Closure $func, array $options = [])
    {
        if (empty($this->connID)) {
            $this->initialize();
        }

        $this->pretend();

        $sql = $func($this);

        $this->pretend(false);

        if ($sql instanceof QueryInterface) {
           $sql = $sql->getOriginalQuery();
        }

        $class = str_ireplace('Connection', 'PreparedQuery', static::class);
        /** @var BasePreparedQuery $class */
        $class = new $class($this);

        return $class->prepare($sql, $options);
    }

    /**
     * Returns the last query's statement object.
     *
     * @return Query
     */
    public function getLastQuery()
    {
        return $this->lastQuery;
    }

    /**
     * Returns a string representation of the last query's statement object.
     */
    public function showLastQuery(): string
    {
        return (string) $this->lastQuery;
    }

    /**
     * Returns the time we started to connect to this database in
     * seconds with microseconds.
     *
     * Used by the Debug Toolbar's timeline.
     */
    public function getConnectStart(): ?float
    {
        return $this->connectTime;
    }

    /**
     * Returns the number of seconds with microseconds that it took
     * to connect to the database.
     *
     * Used by the Debug Toolbar's timeline.
     */
    public function getConnectDuration(int $decimals = 6): string
    {
        return number_format($this->connectDuration, $decimals);
    }

    /**
     * Protect Identifiers
     *
     * This function is used extensively by the Query Builder class, and by
     * a couple functions in this class.
     * It takes a column or table name (optionally with an alias) and inserts
     * the table prefix onto it. Some logic is necessary in order to deal with
     * column names that include the path. Consider a query like this:
     *
     * SELECT hostname.database.table.column AS c FROM hostname.database.table
     *
     * Or a query with aliasing:
     *
     * SELECT m.member_id, m.member_name FROM members AS m
     *
     * Since the column name can include up to four segments (host, DB, table, column)
     * or also have an alias prefix, we need to do a bit of work to figure this out and
     * insert the table prefix (if it exists) in the proper position, and escape only
     * the correct identifiers.
     *
     * @param array|int|string|TableName $item
     * @param bool                       $prefixSingle       Prefix a table name with no segments?
     * @param bool                       $protectIdentifiers Protect table or column names?
     * @param bool                       $fieldExists        Supplied $item contains a column name?
     *
     * @return         array|string
     * @phpstan-return ($item is array ? array : string)
     */
    public function protectIdentifiers($item, bool $prefixSingle = false, ?bool $protectIdentifiers = null, bool $fieldExists = true)
    {
        if (! is_bool($protectIdentifiers)) {
            $protectIdentifiers = $this->protectIdentifiers;
        }

        if (is_array($item)) {
            $escapedArray = [];

            foreach ($item as $k => $v) {
                $escapedArray[$this->protectIdentifiers($k)] = $this->protectIdentifiers($v, $prefixSingle, $protectIdentifiers, $fieldExists);
            }

            return $escapedArray;
        }

        if ($item instanceof TableName) {
            /** @psalm-suppress NoValue I don't know why ERROR. */
            return $this->escapeTableName($item);
        }

        // If you pass `['column1', 'column2']`, `$item` will be int because the array keys are int.
        $item = (string) $item;

        // This is basically a bug fix for queries that use MAX, MIN, etc.
        // If a parenthesis is found we know that we do not need to
        // escape the data or add a prefix. There's probably a more graceful
        // way to deal with this, but I'm not thinking of it
        //
        // Added exception for single quotes as well, we don't want to alter
        // literal strings.
        if (strcspn($item, "()'") !== strlen($item)) {
            /** @psalm-suppress NoValue I don't know why ERROR. */
            return $item;
        }

        // Do not protect identifiers and do not prefix, no swap prefix, there is nothing to do
        if ($protectIdentifiers === false && $prefixSingle === false && $this->swapPre === '') {
            /** @psalm-suppress NoValue I don't know why ERROR. */
            return $item;
        }

        // Convert tabs or multiple spaces into single spaces
        /** @psalm-suppress NoValue I don't know why ERROR. */
        $item = preg_replace('/\s+/', ' ', trim($item));

        // If the item has an alias declaration we remove it and set it aside.
        // Note: strripos() is used in order to support spaces in table names
        if ($offset = strripos($item, ' AS ')) {
            $alias = ($protectIdentifiers) ? substr($item, $offset, 4) . $this->escapeIdentifiers(substr($item, $offset + 4)) : substr($item, $offset);
            $item  = substr($item, 0, $offset);
        } elseif ($offset = strrpos($item, ' ')) {
            $alias = ($protectIdentifiers) ? ' ' . $this->escapeIdentifiers(substr($item, $offset + 1)) : substr($item, $offset);
            $item  = substr($item, 0, $offset);
        } else {
            $alias = '';
        }

        // Break the string apart if it contains periods, then insert the table prefix
        // in the correct location, assuming the period doesn't indicate that we're dealing
        // with an alias. While we're at it, we will escape the components
        if (str_contains($item, '.')) {
            return $this->protectDotItem($item, $alias, $protectIdentifiers, $fieldExists);
        }

        // In some cases, especially 'from', we end up running through
        // protect_identifiers twice. This algorithm won't work when
        // it contains the escapeChar so strip it out.
        $item = trim($item, $this->escapeChar);

        // Is there a table prefix? If not, no need to insert it
        if ($this->DBPrefix !== '') {
            // Verify table prefix and replace if necessary
            if ($this->swapPre !== '' && str_starts_with($item, $this->swapPre)) {
                $item = preg_replace('/^' . $this->swapPre . '(\S+?)/', $this->DBPrefix . '\\1', $item);
            }
            // Do we prefix an item with no segments?
            elseif ($prefixSingle && ! str_starts_with($item, $this->DBPrefix)) {
                $item = $this->DBPrefix . $item;
            }
        }

        if ($protectIdentifiers === true && ! in_array($item, $this->reservedIdentifiers, true)) {
            $item = $this->escapeIdentifiers($item);
        }

        return $item . $alias;
    }

    private function protectDotItem(string $item, string $alias, bool $protectIdentifiers, bool $fieldExists): string
    {
        $parts = explode('.', $item);

        // Does the first segment of the exploded item match
        // one of the aliases previously identified? If so,
        // we have nothing more to do other than escape the item
        //
        // NOTE: The ! empty() condition prevents this method
        // from breaking when QB isn't enabled.
        if (! empty($this->aliasedTables) && in_array($parts[0], $this->aliasedTables, true)) {
            if ($protectIdentifiers) {
                foreach ($parts as $key => $val) {
                    if (! in_array($val, $this->reservedIdentifiers, true)) {
                        $parts[$key] = $this->escapeIdentifiers($val);
                    }
                }

                $item = implode('.', $parts);
            }

            return $item . $alias;
        }

        // Is there a table prefix defined in the config file? If not, no need to do anything
        if ($this->DBPrefix !== '') {
            // We now add the table prefix based on some logic.
            // Do we have 4 segments (hostname.database.table.column)?
            // If so, we add the table prefix to the column name in the 3rd segment.
            if (isset($parts[3])) {
                $i = 2;
            }
            // Do we have 3 segments (database.table.column)?
            // If so, we add the table prefix to the column name in 2nd position
            elseif (isset($parts[2])) {
                $i = 1;
            }
            // Do we have 2 segments (table.column)?
            // If so, we add the table prefix to the column name in 1st segment
            else {
                $i = 0;
            }

            // This flag is set when the supplied $item does not contain a field name.
            // This can happen when this function is being called from a JOIN.
            if ($fieldExists === false) {
                $i++;
            }

            // Verify table prefix and replace if necessary
            if ($this->swapPre !== '' && str_starts_with($parts[$i], $this->swapPre)) {
                $parts[$i] = preg_replace('/^' . $this->swapPre . '(\S+?)/', $this->DBPrefix . '\\1', $parts[$i]);
            }
            // We only add the table prefix if it does not already exist
            elseif (! str_starts_with($parts[$i], $this->DBPrefix)) {
                $parts[$i] = $this->DBPrefix . $parts[$i];
            }

            // Put the parts back together
            $item = implode('.', $parts);
        }

        if ($protectIdentifiers) {
            $item = $this->escapeIdentifiers($item);
        }

        return $item . $alias;
    }

    /**
     * Escape the SQL Identifier
     *
     * This function escapes single identifier.
     *
     * @param non-empty-string|TableName $item
     */
    public function escapeIdentifier($item): string
    {
        if ($item === '') {
            return '';
        }

        if ($item instanceof TableName) {
            return $this->escapeTableName($item);
        }

        return $this->escapeChar
            . str_replace(
                $this->escapeChar,
                $this->escapeChar . $this->escapeChar,
                $item,
            )
            . $this->escapeChar;
    }

    /**
     * Returns escaped table name with alias.
     */
    private function escapeTableName(TableName $tableName): string
    {
        $alias = $tableName->getAlias();

        return $this->escapeIdentifier($tableName->getActualTableName())
            . (($alias !== '') ? ' ' . $this->escapeIdentifier($alias) : '');
    }

    /**
     * Escape the SQL Identifiers
     *
     * This function escapes column and table names
     *
     * @param array|string $item
     *
     * @return         array|string
     * @phpstan-return ($item is array ? array : string)
     */
    public function escapeIdentifiers($item)
    {
        if ($this->escapeChar === '' || empty($item) || in_array($item, $this->reservedIdentifiers, true)) {
            return $item;
        }

        if (is_array($item)) {
            foreach ($item as $key => $value) {
                $item[$key] = $this->escapeIdentifiers($value);
            }

            return $item;
        }

        // Avoid breaking functions and literal values inside queries
        if (ctype_digit($item)
            || $item[0] === "'"
            || ($this->escapeChar !== '"' && $item[0] === '"')
            || str_contains($item, '(')) {
            return $item;
        }

        if ($this->pregEscapeChar === []) {
            if (is_array($this->escapeChar)) {
                $this->pregEscapeChar = [
                    preg_quote($this->escapeChar[0], '/'),
                    preg_quote($this->escapeChar[1], '/'),
                    $this->escapeChar[0],
                    $this->escapeChar[1],
                ];
            } else {
                $this->pregEscapeChar[0] = $this->pregEscapeChar[1] = preg_quote($this->escapeChar, '/');
                $this->pregEscapeChar[2] = $this->pregEscapeChar[3] = $this->escapeChar;
            }
        }

        foreach ($this->reservedIdentifiers as $id) {
            /** @psalm-suppress NoValue I don't know why ERROR. */
            if (str_contains($item, '.' . $id)) {
                return preg_replace(
                    '/' . $this->pregEscapeChar[0] . '?([^' . $this->pregEscapeChar[1] . '\.]+)' . $this->pregEscapeChar[1] . '?\./i',
                    $this->pregEscapeChar[2] . '$1' . $this->pregEscapeChar[3] . '.',
                    $item,
                );
            }
        }

        /** @psalm-suppress NoValue I don't know why ERROR. */
        return preg_replace(
            '/' . $this->pregEscapeChar[0] . '?([^' . $this->pregEscapeChar[1] . '\.]+)' . $this->pregEscapeChar[1] . '?(\.)?/i',
            $this->pregEscapeChar[2] . '$1' . $this->pregEscapeChar[3] . '$2',
            $item,
        );
    }

    /**
     * Prepends a database prefix if one exists in configuration
     *
     * @throws DatabaseException
     */
    public function prefixTable(string $table = ''): string
    {
        if ($table === '') {
            throw new DatabaseException('A table name is required for that operation.');
        }

        return $this->DBPrefix . $table;
    }

    /**
     * Returns the total number of rows affected by this query.
     */
    abstract public function affectedRows(): int;

    /**
     * "Smart" Escape String
     *
     * Escapes data based on type.
     * Sets boolean and null types
     *
     * @param array|bool|float|int|object|string|null $str
     *
     * @return         array|float|int|string
     * @phpstan-return ($str is array ? array : float|int|string)
     */
    public function escape($str)
    {
        if (is_array($str)) {
            return array_map($this->escape(...), $str);
        }

        if ($str instanceof Stringable) {
            if ($str instanceof RawSql) {
                return $str->__toString();
            }

            $str = (string) $str;
        }

        if (is_string($str)) {
            return "'" . $this->escapeString($str) . "'";
        }

        if (is_bool($str)) {
            return ($str === false) ? 0 : 1;
        }

        return $str ?? 'NULL';
    }

    /**
     * Escape String
     *
     * @param list<string|Stringable>|string|Stringable $str  Input string
     * @param bool                                      $like Whether the string will be used in a LIKE condition
     *
     * @return list<string>|string
     */
    public function escapeString($str, bool $like = false)
    {
        if (is_array($str)) {
            foreach ($str as $key => $val) {
                $str[$key] = $this->escapeString($val, $like);
            }

            return $str;
        }

        if ($str instanceof Stringable) {
            if ($str instanceof RawSql) {
                return $str->__toString();
            }

            $str = (string) $str;
        }

        $str = $this->_escapeString($str);

        // escape LIKE condition wildcards
        if ($like) {
            return str_replace(
                [
                    $this->likeEscapeChar,
                    '%',
                    '_',
                ],
                [
                    $this->likeEscapeChar . $this->likeEscapeChar,
                    $this->likeEscapeChar . '%',
                    $this->likeEscapeChar . '_',
                ],
                $str,
            );
        }

        return $str;
    }

    /**
     * Escape LIKE String
     *
     * Calls the individual driver for platform
     * specific escaping for LIKE conditions
     *
     * @param list<string|Stringable>|string|Stringable $str
     *
     * @return list<string>|string
     */
    public function escapeLikeString($str)
    {
        return $this->escapeString($str, true);
    }

    /**
     * Platform independent string escape.
     *
     * Will likely be overridden in child classes.
     */
    protected function _escapeString(string $str): string
    {
        return str_replace("'", "''", remove_invisible_characters($str, false));
    }

    /**
     * This function enables you to call PHP database functions that are not natively included
     * in CodeIgniter, in a platform independent manner.
     *
     * @param array ...$params
     *
     * @throws DatabaseException
     */
    public function callFunction(string $functionName, ...$params): bool
    {
        $driver = $this->getDriverFunctionPrefix();

        if (! str_contains($driver, $functionName)) {
            $functionName = $driver . $functionName;
        }

        if (! function_exists($functionName)) {
            if ($this->DBDebug) {
                throw new DatabaseException('This feature is not available for the database you are using.');
            }

            return false;
        }

        return $functionName(...$params);
    }

    /**
     * Get the prefix of the function to access the DB.
     */
    protected function getDriverFunctionPrefix(): string
    {
        return strtolower($this->DBDriver) . '_';
    }

    // --------------------------------------------------------------------
    // META Methods
    // --------------------------------------------------------------------

    /**
     * Returns an array of table names
     *
     * @return false|list<string>
     *
     * @throws DatabaseException
     */
    public function listTables(bool $constrainByPrefix = false)
    {
        if (isset($this->dataCache['table_names']) && $this->dataCache['table_names']) {
            return $constrainByPrefix
                ? preg_grep("/^{$this->DBPrefix}/", $this->dataCache['table_names'])
                : $this->dataCache['table_names'];
        }

        $sql = $this->_listTables($constrainByPrefix);

        if ($sql === false) {
            if ($this->DBDebug) {
                throw new DatabaseException('This feature is not available for the database you are using.');
            }

            return false;
        }

        $this->dataCache['table_names'] = [];

        $query = $this->query($sql);

        foreach ($query->getResultArray() as $row) {
            /** @var string $table */
            $table = $row['table_name'] ?? $row['TABLE_NAME'] ?? $row[array_key_first($row)];

            $this->dataCache['table_names'][] = $table;
        }

        return $this->dataCache['table_names'];
    }

    /**
     * Determine if a particular table exists
     *
     * @param bool $cached Whether to use data cache
     */
    public function tableExists(string $tableName, bool $cached = true): bool
    {
        if ($cached) {
            return in_array($this->protectIdentifiers($tableName, true, false, false), $this->listTables(), true);
        }

        if (false === ($sql = $this->_listTables(false, $tableName))) {
            if ($this->DBDebug) {
                throw new DatabaseException('This feature is not available for the database you are using.');
            }

            return false;
        }

        $tableExists = $this->query($sql)->getResultArray() !== [];

        // if cache has been built already
        if (! empty($this->dataCache['table_names'])) {
            $key = array_search(
                strtolower($tableName),
                array_map(strtolower(...), $this->dataCache['table_names']),
                true,
            );

            // table doesn't exist but still in cache - lets reset cache, it can be rebuilt later
            // OR if table does exist but is not found in cache
            if (($key !== false && ! $tableExists) || ($key === false && $tableExists)) {
                $this->resetDataCache();
            }
        }

        return $tableExists;
    }

    /**
     * Fetch Field Names
     *
     * @param string|TableName $tableName
     *
     * @return false|list<string>
     *
     * @throws DatabaseException
     */
    public function getFieldNames($tableName)
    {
        $table = ($tableName instanceof TableName) ? $tableName->getTableName() : $tableName;

        // Is there a cached result?
        if (isset($this->dataCache['field_names'][$table])) {
            return $this->dataCache['field_names'][$table];
        }

        if (empty($this->connID)) {
            $this->initialize();
        }

        if (false === ($sql = $this->_listColumns($tableName))) {
            if ($this->DBDebug) {
                throw new DatabaseException('This feature is not available for the database you are using.');
            }

            return false;
        }

        $query = $this->query($sql);

        $this->dataCache['field_names'][$table] = [];

        foreach ($query->getResultArray() as $row) {
            // Do we know from where to get the column's name?
            if (! isset($key)) {
                if (isset($row['column_name'])) {
                    $key = 'column_name';
                } elseif (isset($row['COLUMN_NAME'])) {
                    $key = 'COLUMN_NAME';
                } else {
                    // We have no other choice but to just get the first element's key.
                    $key = key($row);
                }
            }

            $this->dataCache['field_names'][$table][] = $row[$key];
        }

        return $this->dataCache['field_names'][$table];
    }

    /**
     * Determine if a particular field exists
     */
    public function fieldExists(string $fieldName, string $tableName): bool
    {
        return in_array($fieldName, $this->getFieldNames($tableName), true);
    }

    /**
     * Returns an object with field data
     *
     * @return list<stdClass>
     */
    public function getFieldData(string $table)
    {
        return $this->_fieldData($this->protectIdentifiers($table, true, false, false));
    }

    /**
     * Returns an object with key data
     *
     * @return array<string, stdClass>
     */
    public function getIndexData(string $table)
    {
        return $this->_indexData($this->protectIdentifiers($table, true, false, false));
    }

    /**
     * Returns an object with foreign key data
     *
     * @return array<string, stdClass>
     */
    public function getForeignKeyData(string $table)
    {
        return $this->_foreignKeyData($this->protectIdentifiers($table, true, false, false));
    }

    /**
     * Converts array of arrays generated by _foreignKeyData() to array of objects
     *
     * @return array<string, stdClass>
     *
     * array[
     *    {constraint_name} =>
     *        stdClass[
     *            'constraint_name'     => string,
     *            'table_name'          => string,
     *            'column_name'         => string[],
     *            'foreign_table_name'  => string,
     *            'foreign_column_name' => string[],
     *            'on_delete'           => string,
     *            'on_update'           => string,
     *            'match'               => string
     *        ]
     * ]
     */
    protected function foreignKeyDataToObjects(array $data)
    {
        $retVal = [];

        foreach ($data as $row) {
            $name = $row['constraint_name'];

            // for sqlite generate name
            if ($name === null) {
                $name = $row['table_name'] . '_' . implode('_', $row['column_name']) . '_foreign';
            }

            $obj                      = new stdClass();
            $obj->constraint_name     = $name;
            $obj->table_name          = $row['table_name'];
            $obj->column_name         = $row['column_name'];
            $obj->foreign_table_name  = $row['foreign_table_name'];
            $obj->foreign_column_name = $row['foreign_column_name'];
            $obj->on_delete           = $row['on_delete'];
            $obj->on_update           = $row['on_update'];
            $obj->match               = $row['match'];

            $retVal[$name] = $obj;
        }

        return $retVal;
    }

    /**
     * Disables foreign key checks temporarily.
     *
     * @return bool
     */
    public function disableForeignKeyChecks()
    {
        $sql = $this->_disableForeignKeyChecks();

        if ($sql === '') {
            // The feature is not supported.
            return false;
        }

        return $this->query($sql);
    }

    /**
     * Enables foreign key checks temporarily.
     *
     * @return bool
     */
    public function enableForeignKeyChecks()
    {
        $sql = $this->_enableForeignKeyChecks();

        if ($sql === '') {
            // The feature is not supported.
            return false;
        }

        return $this->query($sql);
    }

    /**
     * Allows the engine to be set into a mode where queries are not
     * actually executed, but they are still generated, timed, etc.
     *
     * This is primarily used by the prepared query functionality.
     *
     * @return $this
     */
    public function pretend(bool $pretend = true)
    {
        $this->pretend = $pretend;

        return $this;
    }

    /**
     * Empties our data cache. Especially helpful during testing.
     *
     * @return $this
     */
    public function resetDataCache()
    {
        $this->dataCache = [];

        return $this;
    }

    /**
     * Determines if the statement is a write-type query or not.
     *
     * @param string $sql
     */
    public function isWriteType($sql): bool
    {
        return (bool) preg_match('/^\s*(WITH\s.+(\s|[)]))?"?(SET|INSERT|UPDATE|DELETE|REPLACE|CREATE|DROP|TRUNCATE|LOAD|COPY|ALTER|RENAME|GRANT|REVOKE|LOCK|UNLOCK|REINDEX|MERGE)\s(?!.*\sRETURNING\s)/is', $sql);
    }

    /**
     * Returns the last error code and message.
     *
     * Must return an array with keys 'code' and 'message':
     *
     * @return         array<string, int|string|null>
     * @phpstan-return array{code: int|string|null, message: string|null}
     */
    abstract public function error(): array;

    /**
     * Insert ID
     *
     * @return int|string
     */
    abstract public function insertID();

    /**
     * Generates the SQL for listing tables in a platform-dependent manner.
     *
     * @param string|null $tableName If $tableName is provided will return only this table if exists.
     *
     * @return false|string
     */
    abstract protected function _listTables(bool $constrainByPrefix = false, ?string $tableName = null);

    /**
     * Generates a platform-specific query string so that the column names can be fetched.
     *
     * @param string|TableName $table
     *
     * @return false|string
     */
    abstract protected function _listColumns($table = '');

    /**
     * Platform-specific field data information.
     *
     * @see getFieldData()
     *
     * @return list<stdClass>
     */
    abstract protected function _fieldData(string $table): array;

    /**
     * Platform-specific index data.
     *
     * @see    getIndexData()
     *
     * @return array<string, stdClass>
     */
    abstract protected function _indexData(string $table): array;

    /**
     * Platform-specific foreign keys data.
     *
     * @see    getForeignKeyData()
     *
     * @return array<string, stdClass>
     */
    abstract protected function _foreignKeyData(string $table): array;

    /**
     * Platform-specific SQL statement to disable foreign key checks.
     *
     * If this feature is not supported, return empty string.
     *
     * @TODO This method should be moved to an interface that represents foreign key support.
     *
     * @return string
     *
     * @see disableForeignKeyChecks()
     */
    protected function _disableForeignKeyChecks()
    {
        return '';
    }

    /**
     * Platform-specific SQL statement to enable foreign key checks.
     *
     * If this feature is not supported, return empty string.
     *
     * @TODO This method should be moved to an interface that represents foreign key support.
     *
     * @return string
     *
     * @see enableForeignKeyChecks()
     */
    protected function _enableForeignKeyChecks()
    {
        return '';
    }

    /**
     * Accessor for properties if they exist.
     *
     * @return array|bool|float|int|object|resource|string|null
     */
    public function __get(string $key)
    {
        if (property_exists($this, $key)) {
            return $this->{$key};
        }

        return null;
    }

    /**
     * Checker for properties existence.
     */
    public function __isset(string $key): bool
    {
        return property_exists($this, $key);
    }
}
