<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products`.
 */
class m171030_201335_create_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Products', [
            'id' => $this->primaryKey()->notNull(),
            'ASIN' => $this->string(),
            'Title' => $this->string(),
            'Price' => $this->string(),
            'Picture' => $this->text(),
            'EAN' => $this->string(),
            'Brand' => $this->string(),
        ]);
        //$this->alterColumn('Products2', 'id', $this->smallInteger(8).' NOT NULL AUTO_INCREMENT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('Products');
    }
}
