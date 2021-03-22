<?php

namespace api\Model;

class ChatmessagesService extends AbstractService
{

    private static $instance;

    /**
     * Liefert die Instanz der Singleton-Klasse
     *
     * @param \Laminas\Db\Adapter\Adapter $databaseConnection
     * @throws \Exception
     * @return ChatmessagesService
     */
     public static function getInstance($databaseConnection = NULL)
    {
        if (! isset(self::$instance)) {
            if (is_null($databaseConnection)) {
                throw new \Exception('No database connection');
            }
            self::$instance = new ChatmessagesService($databaseConnection);
        }
        return self::$instance;
    }

    /**
     * Gitb das (per id) erfragte Record zurück.
     *
     * @param String $name
     * @return ChatmessagesModel
     */
    public function get($id)
    {
        $condition = array(
            'id' => $id
        );

        return $this->newChatmessages($condition);
    }

    /**
     * @param null $condition
     * @param null $sort
     * @return \Laminas\Db\ResultSet\ResultSet
     */
    public function getAll($condition = NULL, $sort = NULL)
    {
        $newObject = new ChatmessagesModel(self::getDatabaseConnection());

        $objectArray = ChatmessagesModel::findAll($condition, $sort);
        return $objectArray;
    }

    /**
     * Erstellt einen Eintrag
     *
     * @param $data
     * @throws \Exception
     * @return boolean
     */
    public function create($data){

        if(!isset($data['chatId'])){
            throw new \Exception("Error: Chat-Id is required on create.");
        }

        if(!isset($data['message'])){
            throw new \Exception("no message sent.");
        }

        if(!isset($data['timestamp'])){
            throw new \Exception("no timestamp given");
        }

        $rowObj = $this->newChatmessages();
        $rowObj = $this->setObjectData($rowObj, $data);

        $rowObj->save();

        return true;
    }

    /**
     * Editiert einen Eintrag per data Array.
     *
     * @param $data
     * @throws \Exception
     */
    public function update($data){

        if(!isset($data['id'])){
            throw new \Exception("Error: id is required on update.");
        }
        $rowObj = $this->get($data['id']);
        $rowObj = $this->setObjectData($rowObj, $data);

        $rowObj->save();
    }

    /**
     * Löscht einen Eintrag per Id
     * @param $id
     */
    public function delete($id){

        $rowObj = $this->get($id);
        if(is_null($rowObj)){
            throw new \Exception("row with id " . $id . " didn't exist.");
        }
        $rowObj->delete();
    }

    /**
     * Setzt die Informationen der einzelnen Spalten
     *
     * @param $rowObj
     * @param $data
     * @return mixed
     */
    private function setObjectData($rowObj, $data){

        $rowObj->roomId = $data['chatId'];

        $rowObj->message = $data['message'];

        $rowObj->timestamp = $data['timestamp'];

        return $rowObj;
    }


    /**
     * Liefert ein neues User-Objekt oder ein User-Objekt anhand einer Condition
     *
     * Wird entsprechend der Condition kein Datensatz gefunden, wird NULL zurückgegeben
     * Wird keine Condition übergeben, wird ein neues Objekt zurückgegeben
     *
     * @param string|array|null $condition ID als String oder ein konkretes Condition-Array
     */
    public function newChatmessages($condition = NULL)
    {
        $newObject = new ChatmessagesModel(self::getDatabaseConnection());

        if ($condition !== null) {
            $object = ChatmessagesModel::find($condition);
            if ($object instanceof ChatmessagesModel) {
                return $object;
            }
            return NULL;
        }
        return $newObject;
    }
}