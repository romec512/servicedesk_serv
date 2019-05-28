<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09/05/2019
 * Time: 22:41
 */

namespace Database;

/**
 * @Entity @Table(name="claims")
 **/
class Claims
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     **/
    protected $id;
    /** @Column(type="text") **/
    protected $description;
    /** @Column(type="integer") **/
    protected $creator_id;
    /** @Column(type="integer") **/
    protected $status;
    /**
     * @Column(type="integer", nullable=true)
     **/
    protected $serviceman_id;
    /**
     * @Column(type="text", nullable = true)
     */
    protected $title;

    /**
     * @Column(type="integer", nullable = true)
     */
    protected $date;

    /**
     * @Column(type="integer", nullable = true)
     */
    protected $inv_id;

    /**
     * @return mixed
     */
    public function getServicemanId()
    {
        return $this->serviceman_id;
    }

    /**
     * @param mixed $serviceman_id
     */
    public function setServicemanId($serviceman_id)
    {
        $this->serviceman_id = $serviceman_id;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCreatorId()
    {
        return $this->creator_id;
    }

    /**
     * @param mixed $creator_id
     */
    public function setCreatorId($creator_id)
    {
        $this->creator_id = $creator_id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return date("d-m-Y", $this->date);
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = strtotime($date);
    }

    /**
     * @return mixed
     */
    public function getInvId()
    {
        return $this->inv_id;
    }

    /**
     * @param mixed $inv_id
     */
    public function setInvId($inv_id)
    {
        $this->inv_id = $inv_id;
    }




    /**
     * Возвращает массив свойств для отправки ответа клиенту
     * @return array
     */
    public function getProperties()
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'creator_id' => $this->creator_id,
            'status' => $this->status,
            'serviceman_id' => $this->serviceman_id,
            'title' => $this->title,
            'date' => $this->getDate(),
            'inv_id' => $this->inv_id
        ];
    }
}