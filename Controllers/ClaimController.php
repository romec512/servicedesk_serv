<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09/05/2019
 * Time: 17:11
 */

namespace Controllers;


use Database\Claims;

/**
 * Класс заявок
 * Class ClaimController
 * @package Controllers
 */
class ClaimController extends Controller
{
    /**
     * Получает на вход post запрос с параметрами title, description и user_id
     * @param array
     * @return false|string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function actionCreate($params)
    {
        $claim = new Claims();
        $claim->setTitle($params['title']);
        $claim->setDescription($params['description']);
        $claim->setCreatorId($params['user_id']);
        $claim->setDate(date("d-m-Y"));
        $claim->setInvId($params['inv_id']);
        $claim->setServicemanId(-1);
        // ToDo: change status to ENUM;
        $claim->setStatus(0);
        $this->entityManager->persist($claim);
        $this->entityManager->flush();
        return json_encode($claim->getProperties());
    }

    /**
     * @param $params - массив post параметров должен содержать id заявки
     * @return string - статус выполнения, если параметр id заявки не задан или задан, но не число, возврашает код 400
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function actionDelete($params)
    {
        if(!isset($params['id']) || !is_numeric($params['id']))
        {
            return json_encode(['status' => '400', 'message' => 'invalid_parameter_id']);
        }
        $claim = $this->entityManager->getRepository('Database\Claims')->find($params['id']);
        if(!is_null($claim)){
            $this->entityManager->remove($claim);
            $this->entityManager->flush();
            return json_encode(['status' => 200]);
        } else {
            return json_encode(['status' => 404]);
        }
    }

    /**
     * @param $params - массив post параметров должен содержать параметр status и id заявки
     * @return false|string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @description $params['status'] - статус заявки 0 - ожидает назначения техника, 1 - выполняется, 2 - ожидает подтверждения выполнения 3 - выполнена
     */
    public function actionUpdateStatus($params)
    {
        $claim = $this->entityManager->getRepository('Database\Claims')->find( $params['id']);
        if(!is_null($claim)) {
            $claim->setStatus($params['status']);
            $this->entityManager->persist($claim);
            $this->entityManager->flush();
            return json_encode(['status' => 200, 'data' => $claim->getProperties()]);
        } else {
            return json_encode(['status' => 404]);
        }
    }
    /**
     * @param $params - массив post параметров должен содержать параметр id техника и id заявки
     * @return false|string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function actionAttachServiceman($params)
    {
        $claim = $this->entityManager->getRepository('Database\Claims')->find( $params['id']);
        if(!is_null($claim)) {
            $claim->setServicemanId($params['serviceman_id']);
            $claim->setStatus(1);
            $this->entityManager->persist($claim);
            $this->entityManager->flush();
            return json_encode(['status' => 200, 'data' => $claim->getProperties()]);
        } else {
            return json_encode(['status' => 404]);
        }
    }


    /**
     * Получение всех заявок
     * @param $params
     * @return false|string
     */
    public function actionGetAll($params)
    {
        $claims = $this->entityManager->getRepository('Database\Claims')->findBy([], ['id' => 'ASC']);
        $result = [];
        foreach ($claims as $claim){
            $result[] = $claim->getProperties();
        }
        return json_encode($result);
    }

    /**
     * Функция получения всех заявок пользователя
     * @param $params - параметры пост запроса, содержащие ключ user_id
     * @return false|string
     */
    public function actionGetUsers($params)
    {
        $claims = $this->entityManager->getRepository('Database\Claims')->findBy(['creator_id' => $params['user_id']]);
        $result = [];
        foreach ($claims as $claim){
            $result[] = $claim->getProperties();
        }
        return json_encode($result);
    }

    /**
     * Функция получения всех заявок, назначенных технику
     * @param $params - параметры пост запроса, содержащие ключ serviceman_id
     * @return false|string
     */
    public function actionGetServicemans($params)
    {
        $claims = $this->entityManager->getRepository('Database\Claims')->findBy(['serviceman_id' => $params['serviceman_id'], 'status' => 1]);
        $result = [];
        foreach ($claims as $claim){
            $result[] = $claim->getProperties();
        }
        return json_encode($result);
    }

    /**
     * Функция изменения заголовка и описания заявки
     * @param $params id, title, description
     * @return false|string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function actionEdit($params)
    {
        $claim = $this->entityManager->getRepository('Database\Claims')->find($params['id']);
        $claim->setDescription($params['description']);
        $claim->setTitle($params['title']);
        $claim->setInvId($params['inv_id']);
        $this->entityManager->persist($claim);
        $this->entityManager->flush();
        return json_encode($claim->getProperties());
    }
}