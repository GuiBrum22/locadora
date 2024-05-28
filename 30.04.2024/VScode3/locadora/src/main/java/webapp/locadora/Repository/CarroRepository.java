package webapp.locadora.Repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;

import webapp.locadora.Model.Carro;

import java.util.List;

public interface CarroRepository extends JpaRepository<Carro, String> {

    @Query("SELECT c FROM Carro c LEFT JOIN Aluga a ON c.placa = a.carro.placa WHERE a IS NULL")
    List<Carro> findCarrosNuncaAlugados();

    @Query("SELECT c FROM Carro c WHERE c.placa IN (SELECT DISTINCT m.carro.placa FROM Manutencao m ORDER BY m.dataManutencao DESC)")
    List<Carro> findCarrosComManutencaoRecente();

    List<Carro> findByDisponibilidadeTrue();
}
