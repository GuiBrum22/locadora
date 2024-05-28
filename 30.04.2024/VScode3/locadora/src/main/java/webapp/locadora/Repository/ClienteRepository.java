package webapp.locadora.Repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;

import webapp.locadora.Model.Cliente;

import java.util.List;

public interface ClienteRepository extends JpaRepository<Cliente, Integer> {

    @Query("SELECT c FROM Cliente c WHERE c.CNH IN (SELECT CNH FROM Aluga GROUP BY CNH HAVING COUNT(*) > 1)")
    List<Cliente> findClientesComMaisDeUmAluguel();
}
