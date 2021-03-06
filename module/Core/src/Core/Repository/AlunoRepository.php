<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;

class AlunoRepository extends EntityRepository {

    public function ajaxFindByMatricula($matricula) {
        $dql = "SELECT a.situacaoEscolar, p.nome, c.descricao as curso, pe.descricao as periodo
        FROM Core\Entity\Aluno a
        JOIN a.idPessoa p
        JOIN a.idCurso c
        JOIN c.idPeriodo pe
        WHERE a.matricula = ?1";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, $matricula);
        $result = $query->getResult();
        if (count($result) > 0) {
            return $result[0];
        }
        return null;
    }

    public function listar($restricao = null, $offset = 0) {
        $params = array();

        $dql = "SELECT a.matricula, p.nome, c.descricao as curso, pe.descricao as periodo, a.situacaoEscolar
            FROM Core\Entity\Aluno a
            JOIN a.idPessoa p
            JOIN a.idCurso c
            JOIN c.idPeriodo pe";

        if (! empty($restricao)) {
            if (preg_match('/\d+/', $restricao)) {
                $dql .= ' WHERE a.matricula = ?1 ';
                $params[1] = $restricao;
            } else {
                $dql .= ' WHERE p.nome LIKE UPPER(?1) ';
                $params[1] = '%' . $restricao . '%';
            }
        }

        $dql .= ' ORDER BY p.nome ';

        $query = $this->getEntityManager()->createQuery( $dql );
        $query->setParameters($params);
        $query->setMaxResults(10);
        $query->setFirstResult($offset);
        return $query->getResult();
    }
}
