<?php
/**
 *
 * Base sql functions
 * @author Misha
 *
 */
interface  IDatabaseFunction {
	/**
	 *
	 * Select from table
	 * @param string $order
	 */
	public function select($order);

	/**
	 *
	 * Insert into table
	 * @param assoc_array $value
	 */
	public function insert($value);

	/**
	 *
	 * Update record by id
	 * @param int $id
	 * @param assoc_array $value
	 */
	public function update($id, $value);

	/**
	 *
	 * Delete rows from table by id
	 * @param int $id
	 */
	public function delete($id);

	/**
	 *
	 * Searh values into table
	 * @param string $part_of_word
	 */
	public function search($part_of_word);

	/**
	 *
	 * Return html combo box as (<select><option>value_1</option>...<option>value_n</option></select>)
	 */
	public static function getList();
}
?>