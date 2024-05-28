package webapp.locadora.Model;

import jakarta.persistence.*;

@Entity
public class Realiza {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idComprovante;
    private String comprovante;
    
    public int getIdComprovante() {
        return idComprovante;
    }
    public void setIdComprovante(int idComprovante) {
        this.idComprovante = idComprovante;
    }
    public String getComprovante() {
        return comprovante;
    }
    public void setComprovante(String comprovante) {
        this.comprovante = comprovante;
    }

    
}
