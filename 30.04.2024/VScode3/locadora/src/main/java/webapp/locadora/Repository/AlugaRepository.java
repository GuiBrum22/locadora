package webapp.locadora.Repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;

import webapp.locadora.Model.Aluga;

import java.time.LocalDateTime;
import java.util.List;

public interface AlugaRepository extends JpaRepository<Aluga, Integer> {

    List<Aluga> findByDataLocacao(LocalDateTime data);

    @Query("SELECT SUM(a.valorTotal) FROM Aluga a WHERE a.dataLocacao BETWEEN ?1 AND ?2")
    Double calcularReceitaTotal(LocalDateTime dataLocacao, LocalDateTime dataDevolucao);

    @Query("SELECT AVG(TIMESTAMPDIFF(DAY, a.dataLocacao, a.dataDevolucao)) FROM Aluga a")
    Double calcularMediaDiasAlugados();

    @Query("SELECT a FROM Aluga a WHERE a.cliente.CNH = ?1 AND a.dataLocacao BETWEEN ?2 AND ?3")
    List<Aluga> findByClienteCNHAndDataLocacaoBetween(int CNH, LocalDateTime dataLocacao, LocalDateTime dataDevolucao);
}