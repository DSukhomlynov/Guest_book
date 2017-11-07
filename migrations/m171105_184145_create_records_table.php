<?php

use yii\db\Migration;

/**
 * Handles the creation of table `records`.
 */
class m171105_184145_create_records_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('records', [
            'id' => $this->primaryKey(),
            'author' => $this->string(),
            'content' => $this->text(),
            'date' => $this->timestamp()->defaultValue(null),
            'link' => $this->string(),
            'likes' => $this->integer()->defaultValue(0),
        ]);

        $this->insert('records', [
            'author' => 'Dmitry',
            'content' => 'Каталонские политики предстанут перед следственным судьей, который решит, выдавать ли их Испании.
                          Отстраненный Мадридом экс-глава правительства Каталонии Карлес Пучдемон и четверо экс-министров 
                          добровольно сдались полиции Бельгии. Об этом сообщают местные СМИ в воскресенье, 5 ноября.',
            'link' => 'https://www.linkedin.com/in/dmytro-sukhomlynov/',
            'likes' => '1',
        ]);

        $this->insert('records', [
            'author' => 'Symon',
            'content' => 'Берлин выделил 400 млн евро на три разведывательных спутника.
                          Берлин уже до конца текущего месяца может оформить заказ на изготовление трех спутников-шпионов 
                          для Федеральной разведывательной службы Германии (BND).
                          Об этом сообщают газеты медиагруппы Redaktionsnetzwerk Deutschland со ссылкой на источники.',
            'link' => 'https://www.linkedin.com/in/simon-lee-0b3587149/',
            'likes' => '0',
        ]);

        $this->insert('records', [
            'author' => 'Olia',
            'content' => 'В Афганистане правительство планирует заблокировать мессенджеры Telegram и WhatsApp, сообщает DW.
                          По информации местных СМИ, сначала запрет будет введен временно - на 20 дней. 
                          Власти Афганистана объясняют подобный шаг необходимостью борьбы с террористами.',
            'link' => 'https://www.linkedin.com/in/olya-titarenko/',
            'likes' => '1',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('records');
    }
}