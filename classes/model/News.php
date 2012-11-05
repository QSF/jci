<?php 

use Doctrine\Common\Collections\ArrayCollection;

/**
* @Entity
* @Table(name = "news")
*/
class News{

    public function __construct() {
        $this->donations = new ArrayCollection();
    }

    /**
     *@Id @Column(type="integer")
     *@GeneratedValue
     **/
    protected $id;

    /**
    *@Column(type = "string", nullable = false)
    */
    protected $title;

    /**
    *@Column(type="boolean")
    */
    protected $public = false;

    /**
    *@Column(type="text", nullable=false)
    */
    protected $content;

    /**
     * @ManyToOne(targetEntity="Moderator", inversedBy="news")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     **/
    protected $author;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getPublic(){
        return $this->public;
    }

    public function setPublic($public){
        $this->public = $public;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function setAuthor($author){
        $this->author = $author;
    }
}

?>