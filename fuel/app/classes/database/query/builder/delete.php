<?php
/**
 * Database query builder for DELETE statements.
 *
 * @package    Fuel/Classes/Database
 * @category   Query
 * @author     Ernaelsten Gérard
 * @copyright  (c) 2010-2013 MaitrePylos Team
 * @license    http://kohanaphp.com/license
 */



class Database_Query_Builder_Delete extends \Database_Query_Builder_Where
{

    // DELETE FROM ...
    protected $_table;

    /**
     * Set the table for a delete.
     *
     * @param   mixed  table name or array($table, $alias) or object
     * @return  void
     */
    public function __construct($table = NULL)
    {
        if ($table) {
            // Set the inital table name
            $this->_table = $table;
        }

        // Start the query with no SQL
        return parent::__construct('', \DB::DELETE);
    }

    /**
     * Sets the table to delete from.
     *
     * @param   mixed  table name or array($table, $alias) or object
     * @return  $this
     */
    public function table($table)
    {
        $this->_table = $table;

        return $this;
    }

    /**
     * Compile the SQL query and return it.
     *
     * @param   mixed  Database instance or instance name
     * @return  string
     */
    public function compile($db = null)
    {
        if (!$db instanceof \Database_Connection) {
            // Get the database instance
            $db = \Database_Connection::instance($db);
        }

        // Start a deletion query
        $query = 'DELETE FROM ' . $db->quote_table($this->_table);

        if (!empty($this->_where)) {
            // Add deletion conditions
            $query .= ' WHERE ' . $this->_compile_conditions($db, $this->_where);
        }

        if (!empty($this->_order_by)) {
            // Add sorting
            $query .= ' ' . $this->_compile_order_by($db, $this->_order_by);
        }
        /**
         * Cette portion de code n'est nullement nécéssaire quelque soit la DB, y compris MySQL
         * Cela permet de faire fonctionner PostgreSQL correctement.
         *
         * This portion of code is necessary by no means whatever is the DB, including MySQL
         * It allows to put on PostgreSQL correctly
         */
        /*if ($this->_limit !== NULL && substr($db->_db_type, 0, 6) !== 'sqlite') {
            // Add limiting
            $query .= ' LIMIT ' . $this->_limit;
        }*/

        return $query;
    }

    public function reset()
    {
        $this->_table = NULL;

        $this->_where = array();
        $this->_order_by = array();

        $this->_parameters = array();

        $this->_limit = NULL;

        return $this;
    }

} // End Database_Query_Builder_Delete
