package webapp.locadora.Repository;

import org.springframework.data.jpa.repository.JpaRepository;

import webapp.locadora.Model.Feedback;

public interface FeedbackRepository extends JpaRepository<Feedback, Integer> {
    
}
