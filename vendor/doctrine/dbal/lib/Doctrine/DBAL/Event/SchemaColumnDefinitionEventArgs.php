<?php
 namespace Doctrine\DBAL\Event; use Doctrine\DBAL\Connection; use Doctrine\DBAL\Schema\Column; class SchemaColumnDefinitionEventArgs extends SchemaEventArgs { private $_column = null; private $_tableColumn; private $_table; private $_database; private $_connection; public function __construct(array $tableColumn, $table, $database, Connection $connection) { $this->_tableColumn = $tableColumn; $this->_table = $table; $this->_database = $database; $this->_connection = $connection; } public function setColumn(Column $column = null) { $this->_column = $column; return $this; } public function getColumn() { return $this->_column; } public function getTableColumn() { return $this->_tableColumn; } public function getTable() { return $this->_table; } public function getDatabase() { return $this->_database; } public function getConnection() { return $this->_connection; } public function getDatabasePlatform() { return $this->_connection->getDatabasePlatform(); } } 