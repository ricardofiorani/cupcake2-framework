<?php

namespace CupSeo\Models;

use InvalidArgumentException;

/**
 * @Entity @Table(name="cup_seo")
 * */
class Seo {

    const ATIVO_SIM = 'Sim';
    const ATIVO_NAO = 'Não';

    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;

    /** @Column(type="string") * */
    protected $url;

    /** @Column(type="string") * */
    protected $keywords;

    /** @Column(type="string") * */
    protected $description;

    /** @Column(type="string") * */
    protected $ativo;

    public function getId() {
        return $this->id;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getKeywords() {
        return $this->keywords;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setAtivo($ativo) {
        if (!in_array($ativo, array(self::ATIVO_NAO, self::ATIVO_SIM))) {
            throw new InvalidArgumentException("Opção Inválida");
        }
        $this->ativo = $ativo;
    }

}
