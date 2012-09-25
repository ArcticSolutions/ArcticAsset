<?php

namespace Arctic\AssetBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Arctic\AssetBundle\Entity\Type
 *
 * @ORM\Table(
 *      indexes={@ORM\Index(name="make_idx", columns={"make"})}
 * )
 * @ORM\Entity(repositoryClass="Arctic\AssetBundle\Entity\TypeRepository")
 * @UniqueEntity("model")
 */
class Type
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var string $make
     *
     * @ORM\Column(name="make", type="string", length=255)
     * @Assert\NotBlank
     */
    private $make;

    /**
     * @var string $model
     *
     * @ORM\Column(name="model", type="string", length=255, unique=true)
     * @Assert\NotBlank
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="types")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @Assert\NotNull
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="Asset", mappedBy="type")
     */
    protected $assets;

    public function __construct()
    {
        $this->assets = new ArrayCollection();
    }

    public function __toString()
    {
        return sprintf('%s %s', $this->make, $this->model);
    }

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
     * Set make
     *
     * @param string $make
     */
    public function setMake($make)
    {
        $this->make = $make;
    }

    /**
     * Get make
     *
     * @return string 
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Set model
     *
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }
    
    /**
     * Add assets
     *
     * @param Arctic\AssetBundle\Entity\Asset $assets
     */
    public function addAsset(\Arctic\AssetBundle\Entity\Asset $assets)
    {
        $this->assets[] = $assets;
    }

    /**
     * Get assets
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * Remove assets
     *
     * @param Arctic\AssetBundle\Entity\Asset $assets
     */
    public function removeAsset(\Arctic\AssetBundle\Entity\Asset $assets)
    {
        $this->assets->removeElement($assets);
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Type
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Type
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set category
     *
     * @param Arctic\AssetBundle\Entity\Category $category
     * @return Type
     */
    public function setCategory(\Arctic\AssetBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return Arctic\AssetBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}