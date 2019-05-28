<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09/05/2019
 * Time: 23:37
 */

namespace Controllers;


use Doctrine\ORM\EntityManager;

/**
 * Class Controller - базовый класс контроллера
 * @package Controllers
 */
class Controller
{
    /**
     * Свойство менеджера сущностей, необходимо для работы с бд.
     * @var EntityManager
     */
    public $entityManager;

    /**
     * Controller constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }
}