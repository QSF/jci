<?php 

use Doctrine\Common\Collections\ArrayCollection;

/**
* @Entity
* @Table(name = "news")
* @HasLifecycleCallbacks
*/
class News{

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

    /**
    * @Column(type="datetime", nullable = true)
    * @var TimeStamp
    */
    protected $date;

    /**
    *   @PrePersist
    *   Método que seta a data como atual.
    */
    public function onPersist(){
         $this->date = new \DateTime("now");
    }

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

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }
}

?>