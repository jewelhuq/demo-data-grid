<?php namespace Laravel\DB\Query;

use Laravel\DB\Query;
use Laravel\DB\Compiler;
use Laravel\DB\Connection;

class Factory {

	/**
	 * Create a new query instance for a given driver.
	 *
	 * @param  string  $table
	 * @param  Connection  $connection
	 * @return Query
	 */
	public static function make($table, Connection $connection)
	{
		$query = (isset($connection->config['query'])) ? $connection->config['query'] : $connection->driver();

		switch ($query)
		{
			case 'pgsql':
				return new Postgres($table, $connection, new Compiler);

			case 'mysql':
				return new MySQL($table, $connection, new Compiler);

			default:
				return new Query($table, $connection, new Compiler);
		}
	}

}