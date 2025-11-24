<?php

include_once(__DIR__ . "/Local.php");
include_once(__DIR__ . "/TipoMissao.php");

class Missao
{

    private ?int $id = null;
    private ?string $titulo = null;
    private ?float $recompensa = null;
    private ?string $dificuldade = null;

    private ?Local $local = null;
    private ?TipoMissao $tipoMissao = null;

    public function getDificuldadeDesc()
    {
        switch ($this->dificuldade) {
            case 'E':
                return "Easy (Fácil)";
            case 'N':
                return "Normal";
            case 'H':
                return "Hard (Difícil)";
            case 'S':
                return "Super (Lendário)";
            default:
                return "Desconhecida";
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): self
    {
        $this->titulo = $titulo;
        return $this;
    }

    public function getRecompensa(): ?float
    {
        return $this->recompensa;
    }

    public function setRecompensa(?float $recompensa): self
    {
        $this->recompensa = $recompensa;
        return $this;
    }

    public function getDificuldade(): ?string
    {
        return $this->dificuldade;
    }

    public function setDificuldade(?string $dificuldade): self
    {
        $this->dificuldade = $dificuldade;
        return $this;
    }

    public function getLocal(): ?Local
    {
        return $this->local;
    }

    public function setLocal(?Local $local): self
    {
        $this->local = $local;
        return $this;
    }

    public function getTipoMissao(): ?TipoMissao
    {
        return $this->tipoMissao;
    }

    public function setTipoMissao(?TipoMissao $tipoMissao): self
    {
        $this->tipoMissao = $tipoMissao;
        return $this;
    }
}
