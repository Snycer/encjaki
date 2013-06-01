<?php


/**
 * Base class that represents a row from the 'news' table.
 *
 * 
 *
 * @package    propel.generator.encjakiPropel.om
 */
abstract class BaseDbNews extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'DbNewsPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        DbNewsPeer
	 */
	protected static $peer;

	/**
	 * The value for the newsid field.
	 * @var        string
	 */
	protected $newsid;

	/**
	 * The value for the userid field.
	 * @var        string
	 */
	protected $userid;

	/**
	 * The value for the ctime__ field.
	 * @var        string
	 */
	protected $ctime__;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the text field.
	 * @var        string
	 */
	protected $text;

	/**
	 * The value for the published field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $published;

	/**
	 * The value for the type field.
	 * Note: this column has a database default value of: 'normal'
	 * @var        string
	 */
	protected $type;

	/**
	 * The value for the language field.
	 * Note: this column has a database default value of: 'pl'
	 * @var        string
	 */
	protected $language;

	/**
	 * @var        DbUser
	 */
	protected $aDbUser;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->published = false;
		$this->type = 'normal';
		$this->language = 'pl';
	}

	/**
	 * Initializes internal state of BaseDbNews object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [newsid] column value.
	 * 
	 * @return     string
	 */
	public function getNewsid()
	{
		return $this->newsid;
	}

	/**
	 * Get the [userid] column value.
	 * 
	 * @return     string
	 */
	public function getUserid()
	{
		return $this->userid;
	}

	/**
	 * Get the [optionally formatted] temporal [ctime__] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCtime($format = 'Y-m-d H:i:s')
	{
		if ($this->ctime__ === null) {
			return null;
		}


		if ($this->ctime__ === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->ctime__);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ctime__, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [text] column value.
	 * 
	 * @return     string
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * Get the [published] column value.
	 * 
	 * @return     boolean
	 */
	public function getPublished()
	{
		return $this->published;
	}

	/**
	 * Get the [type] column value.
	 * 
	 * @return     string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Get the [language] column value.
	 * 
	 * @return     string
	 */
	public function getLanguage()
	{
		return $this->language;
	}

	/**
	 * Set the value of [newsid] column.
	 * 
	 * @param      string $v new value
	 * @return     DbNews The current object (for fluent API support)
	 */
	public function setNewsid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->newsid !== $v) {
			$this->newsid = $v;
			$this->modifiedColumns[] = DbNewsPeer::NEWSID;
		}

		return $this;
	} // setNewsid()

	/**
	 * Set the value of [userid] column.
	 * 
	 * @param      string $v new value
	 * @return     DbNews The current object (for fluent API support)
	 */
	public function setUserid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->userid !== $v) {
			$this->userid = $v;
			$this->modifiedColumns[] = DbNewsPeer::USERID;
		}

		if ($this->aDbUser !== null && $this->aDbUser->getUserid() !== $v) {
			$this->aDbUser = null;
		}

		return $this;
	} // setUserid()

	/**
	 * Sets the value of [ctime__] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     DbNews The current object (for fluent API support)
	 */
	public function setCtime($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->ctime__ !== null || $dt !== null) {
			$currentDateAsString = ($this->ctime__ !== null && $tmpDt = new DateTime($this->ctime__)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->ctime__ = $newDateAsString;
				$this->modifiedColumns[] = DbNewsPeer::CTIME__;
			}
		} // if either are not null

		return $this;
	} // setCtime()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     DbNews The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = DbNewsPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [text] column.
	 * 
	 * @param      string $v new value
	 * @return     DbNews The current object (for fluent API support)
	 */
	public function setText($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->text !== $v) {
			$this->text = $v;
			$this->modifiedColumns[] = DbNewsPeer::TEXT;
		}

		return $this;
	} // setText()

	/**
	 * Sets the value of the [published] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     DbNews The current object (for fluent API support)
	 */
	public function setPublished($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->published !== $v) {
			$this->published = $v;
			$this->modifiedColumns[] = DbNewsPeer::PUBLISHED;
		}

		return $this;
	} // setPublished()

	/**
	 * Set the value of [type] column.
	 * 
	 * @param      string $v new value
	 * @return     DbNews The current object (for fluent API support)
	 */
	public function setType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = DbNewsPeer::TYPE;
		}

		return $this;
	} // setType()

	/**
	 * Set the value of [language] column.
	 * 
	 * @param      string $v new value
	 * @return     DbNews The current object (for fluent API support)
	 */
	public function setLanguage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->language !== $v) {
			$this->language = $v;
			$this->modifiedColumns[] = DbNewsPeer::LANGUAGE;
		}

		return $this;
	} // setLanguage()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->published !== false) {
				return false;
			}

			if ($this->type !== 'normal') {
				return false;
			}

			if ($this->language !== 'pl') {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->newsid = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->userid = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ctime__ = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->title = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->text = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->published = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->type = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->language = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 8; // 8 = DbNewsPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating DbNews object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aDbUser !== null && $this->userid !== $this->aDbUser->getUserid()) {
			$this->aDbUser = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DbNewsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = DbNewsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aDbUser = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DbNewsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = DbNewsQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DbNewsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				DbNewsPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aDbUser !== null) {
				if ($this->aDbUser->isModified() || $this->aDbUser->isNew()) {
					$affectedRows += $this->aDbUser->save($con);
				}
				$this->setDbUser($this->aDbUser);
			}

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				$this->resetModified();
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Insert the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @throws     PropelException
	 * @see        doSave()
	 */
	protected function doInsert(PropelPDO $con)
	{
		$modifiedColumns = array();
		$index = 0;

		$this->modifiedColumns[] = DbNewsPeer::NEWSID;
		if (null !== $this->newsid) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . DbNewsPeer::NEWSID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(DbNewsPeer::NEWSID)) {
			$modifiedColumns[':p' . $index++]  = '`NEWSID`';
		}
		if ($this->isColumnModified(DbNewsPeer::USERID)) {
			$modifiedColumns[':p' . $index++]  = '`USERID`';
		}
		if ($this->isColumnModified(DbNewsPeer::CTIME__)) {
			$modifiedColumns[':p' . $index++]  = '`CTIME__`';
		}
		if ($this->isColumnModified(DbNewsPeer::TITLE)) {
			$modifiedColumns[':p' . $index++]  = '`TITLE`';
		}
		if ($this->isColumnModified(DbNewsPeer::TEXT)) {
			$modifiedColumns[':p' . $index++]  = '`TEXT`';
		}
		if ($this->isColumnModified(DbNewsPeer::PUBLISHED)) {
			$modifiedColumns[':p' . $index++]  = '`PUBLISHED`';
		}
		if ($this->isColumnModified(DbNewsPeer::TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`TYPE`';
		}
		if ($this->isColumnModified(DbNewsPeer::LANGUAGE)) {
			$modifiedColumns[':p' . $index++]  = '`LANGUAGE`';
		}

		$sql = sprintf(
			'INSERT INTO `news` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`NEWSID`':
						$stmt->bindValue($identifier, $this->newsid, PDO::PARAM_INT);
						break;
					case '`USERID`':
						$stmt->bindValue($identifier, $this->userid, PDO::PARAM_INT);
						break;
					case '`CTIME__`':
						$stmt->bindValue($identifier, $this->ctime__, PDO::PARAM_STR);
						break;
					case '`TITLE`':
						$stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
						break;
					case '`TEXT`':
						$stmt->bindValue($identifier, $this->text, PDO::PARAM_STR);
						break;
					case '`PUBLISHED`':
						$stmt->bindValue($identifier, (int) $this->published, PDO::PARAM_INT);
						break;
					case '`TYPE`':
						$stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
						break;
					case '`LANGUAGE`':
						$stmt->bindValue($identifier, $this->language, PDO::PARAM_STR);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

		try {
			$pk = $con->lastInsertId();
		} catch (Exception $e) {
			throw new PropelException('Unable to get autoincrement id.', $e);
		}
		$this->setNewsid($pk);

		$this->setNew(false);
	}

	/**
	 * Update the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @see        doSave()
	 */
	protected function doUpdate(PropelPDO $con)
	{
		$selectCriteria = $this->buildPkeyCriteria();
		$valuesCriteria = $this->buildCriteria();
		BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
	}

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aDbUser !== null) {
				if (!$this->aDbUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDbUser->getValidationFailures());
				}
			}


			if (($retval = DbNewsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DbNewsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getNewsid();
				break;
			case 1:
				return $this->getUserid();
				break;
			case 2:
				return $this->getCtime();
				break;
			case 3:
				return $this->getTitle();
				break;
			case 4:
				return $this->getText();
				break;
			case 5:
				return $this->getPublished();
				break;
			case 6:
				return $this->getType();
				break;
			case 7:
				return $this->getLanguage();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['DbNews'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['DbNews'][$this->getPrimaryKey()] = true;
		$keys = DbNewsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getNewsid(),
			$keys[1] => $this->getUserid(),
			$keys[2] => $this->getCtime(),
			$keys[3] => $this->getTitle(),
			$keys[4] => $this->getText(),
			$keys[5] => $this->getPublished(),
			$keys[6] => $this->getType(),
			$keys[7] => $this->getLanguage(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aDbUser) {
				$result['DbUser'] = $this->aDbUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DbNewsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setNewsid($value);
				break;
			case 1:
				$this->setUserid($value);
				break;
			case 2:
				$this->setCtime($value);
				break;
			case 3:
				$this->setTitle($value);
				break;
			case 4:
				$this->setText($value);
				break;
			case 5:
				$this->setPublished($value);
				break;
			case 6:
				$this->setType($value);
				break;
			case 7:
				$this->setLanguage($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DbNewsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setNewsid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserid($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCtime($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setText($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPublished($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setType($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLanguage($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(DbNewsPeer::DATABASE_NAME);

		if ($this->isColumnModified(DbNewsPeer::NEWSID)) $criteria->add(DbNewsPeer::NEWSID, $this->newsid);
		if ($this->isColumnModified(DbNewsPeer::USERID)) $criteria->add(DbNewsPeer::USERID, $this->userid);
		if ($this->isColumnModified(DbNewsPeer::CTIME__)) $criteria->add(DbNewsPeer::CTIME__, $this->ctime__);
		if ($this->isColumnModified(DbNewsPeer::TITLE)) $criteria->add(DbNewsPeer::TITLE, $this->title);
		if ($this->isColumnModified(DbNewsPeer::TEXT)) $criteria->add(DbNewsPeer::TEXT, $this->text);
		if ($this->isColumnModified(DbNewsPeer::PUBLISHED)) $criteria->add(DbNewsPeer::PUBLISHED, $this->published);
		if ($this->isColumnModified(DbNewsPeer::TYPE)) $criteria->add(DbNewsPeer::TYPE, $this->type);
		if ($this->isColumnModified(DbNewsPeer::LANGUAGE)) $criteria->add(DbNewsPeer::LANGUAGE, $this->language);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DbNewsPeer::DATABASE_NAME);
		$criteria->add(DbNewsPeer::NEWSID, $this->newsid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getNewsid();
	}

	/**
	 * Generic method to set the primary key (newsid column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setNewsid($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getNewsid();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of DbNews (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUserid($this->getUserid());
		$copyObj->setCtime($this->getCtime());
		$copyObj->setTitle($this->getTitle());
		$copyObj->setText($this->getText());
		$copyObj->setPublished($this->getPublished());
		$copyObj->setType($this->getType());
		$copyObj->setLanguage($this->getLanguage());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setNewsid(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     DbNews Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     DbNewsPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new DbNewsPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a DbUser object.
	 *
	 * @param      DbUser $v
	 * @return     DbNews The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setDbUser(DbUser $v = null)
	{
		if ($v === null) {
			$this->setUserid(NULL);
		} else {
			$this->setUserid($v->getUserid());
		}

		$this->aDbUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the DbUser object, it will not be re-added.
		if ($v !== null) {
			$v->addDbNews($this);
		}

		return $this;
	}


	/**
	 * Get the associated DbUser object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     DbUser The associated DbUser object.
	 * @throws     PropelException
	 */
	public function getDbUser(PropelPDO $con = null)
	{
		if ($this->aDbUser === null && (($this->userid !== "" && $this->userid !== null))) {
			$this->aDbUser = DbUserQuery::create()->findPk($this->userid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aDbUser->addDbNewss($this);
			 */
		}
		return $this->aDbUser;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->newsid = null;
		$this->userid = null;
		$this->ctime__ = null;
		$this->title = null;
		$this->text = null;
		$this->published = null;
		$this->type = null;
		$this->language = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->applyDefaultValues();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

		$this->aDbUser = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(DbNewsPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseDbNews
