?php

namespace OurRead\OurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
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
     * @var array
     *
     * @ORM\Column(name="1", type="simple_array")
     */
    private $1;


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
     * Set 1
     *
     * @param array $1
     * @return User
     */
    public function set1($1)
    {
        $this->1 = $1;

        return $this;
    }

    /**
     * Get 1
     *
     * @return array 
     */
    public function get1()
    {
        return $this->1;
    }
}
