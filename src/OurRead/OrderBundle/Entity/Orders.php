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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OurRead\UserBundle\Entity\Users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $userId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OurRead\LibraryBundle\Entity\Book")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     **/
    private $bookId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="taken_date", type="date")
     */
    private $takenDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="return_date", type="date")
     */
    private $returnDate;

    /**
     * 0-order, 1-reservation, 99 - ended
     * @var integer
     *
     * @ORM\Column(name="order_type", type="integer")
     **/
    private $orderType;

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
     * Set orderId
     *
     * @param integer $orderId
     * @return Orders
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->orderId;
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
     * Set takenDate
     *
     * @param \DateTime $takenDate
     * @return Orders
     */
    public function setTakenDate($takenDate)
    {
        $this->takenDate = $takenDate;

        return $this;
    }

    /**
     * Get takenDate
     *
     * @return \DateTime 
     */
    public function getTakenDate()
    {
        return $this->takenDate;
    }

    /**
     * Set backDate
     *
     * @param \DateTime $backDate
     * @return Orders
     */
    public function setBackDate($backDate)
    {
        $this->backDate = $backDate;

        return $this;
    }

    /**
     * Get backDate
     *
     * @return \DateTime 
     */
    public function getBackDate()
    {
        return $this->backDate;
    }

    /**
     * Set returnDate
     *
     * @param \DateTime $returnDate
     * @return Orders
     */
    public function setReturnDate($returnDate)
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    /**
     * Get returnDate
     *
     * @return \DateTime 
     */
    public function getReturnDate()
    {
        return $this->returnDate;
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
}
