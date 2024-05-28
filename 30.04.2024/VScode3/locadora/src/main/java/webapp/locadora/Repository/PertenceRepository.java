package webapp.locadora.Repository;

import org.springframework.data.jpa.repository.JpaRepository;

import webapp.locadora.Model.Pertence;

public interface PertenceRepository extends JpaRepository<Pertence, Integer> {
    
}
