<?php

namespace api\Model;

class ChatroomsService extends AbstractService
{

    private static $instance;

    /**
     * Liefert die Instanz der Singleton-Klasse
     *
     * @param \Laminas\Db\Adapter\Adapter $databaseConnection
     * @throws \Exception
     * @return ChatroomsService
     */
    public static function getInstance($databaseConnection = NULL)
    {
        if (! isset(self::$instance)) {
            if (is_null($databaseConnection)) {
                throw new \Exception('No database connection');
            }
            self::$instance = new ChatroomsService($databaseConnection);
        }
        return self::$instance;
    }

    /**
     * Gitb den Namen des (per id) erfragten Records zurück.
     *
     * @param String $id
     * @return ChatroomsModel;
     */
    public function get($id)
    {
        $condition = array(
            'id' => $id
        );

        return $this->newChatrooms($condition);
    }

    /**
     * Erstellt einen Eintrag
     *
     * @param $data
     * @throws \Exception
     */
    public function create($data){

        if(!isset($data['id'])){
            throw new \Exception("Error: Chat-Id is required on create.");
        }

        $rowObj = $this->newChatrooms();
        $rowObj = $this->setObjectData($rowObj, $data);

        $rowObj->save();
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
        $rowObj->id = $data['id'];
        
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
    public function newChatrooms($condition = NULL)
    {
        $newObject = new ChatroomsModel(self::getDatabaseConnection());
        
        if ($condition !== null) {
            $object = ChatroomsModel::find($condition);
            if ($object instanceof ChatroomsModel) {
                return $object;
            }
            return NULL;
        }
        return $newObject;
    }
}