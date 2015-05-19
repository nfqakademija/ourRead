<?php

namespace OurRead\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="OurRead\UserBundle\Entity\Users", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $userId;

    /**
     *
     * @ORM\ManyToOne(targetEntity="OurRead\LibraryBundle\Entity\Book", inversedBy="orders")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     **/
    private $bookId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date")
     */
    private $endDate;

    /**
     * 0-order, 1-reservation
     * @var integer
     *
     * @ORM\Column(name="order_type", type="integer")
     **/
    private $orderType;

    /**
     * 0-active, 1-ended
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     **/
    private $status;

    /**
     * 0-false 1-true
     * @var integer
     *
     * @ORM\Column(name="confirmStatus", type="integer")
     **/
    private $confirmStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="extended_status", type="integer")
     **/
    private $extendedStatus;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Orders
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set bookId
     *
     * @param integer $bookId
     * @return Orders
     */
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;

        return $this;
    }

    /**
     * Get bookId
     *
     * @return integer
     */
    public function getBookId()
    {
        return $this->bookId;
    }


    /**
     * Set orderType
     *
     * @param integer $orderType
     * @return Orders
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;

        return $this;
    }

    /**
     * Get orderType
     *
     * @return integer
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Orders
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set confirmStatus
     *
     * @param integer $confirmStatus
     * @return Orders
     */
    public function setConfirmStatus($confirmStatus)
    {
        $this->confirmStatus = $confirmStatus;

        return $this;
    }

    /**
     * Get confirmStatus
     *
     * @return integer
     */
    public function getConfirmStatus()
    {
        return $this->confirmStatus;
    }

    /**
     * Set extendedStatus
     *
     * @param integer $extendedStatus
     * @return Orders
     */
    public function setExtendedStatus($extendedStatus)
    {
        $this->extendedStatus = $extendedStatus;

        return $this;
    }

    /**
     * Get extendedStatus
     *
     * @return integer
     */
    public function getExtendedStatus()
    {
        return $this->extendedStatus;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Orders
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Orders
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}
