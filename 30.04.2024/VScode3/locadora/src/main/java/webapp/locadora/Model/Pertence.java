package webapp.locadora.Model;

import jakarta.persistence.*;

@Entity
public class Pertence {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;
    
    @ManyToOne
    @JoinColumn(name = "numero_agencia")
    private Agencia agencia;
    
    @ManyToOne
    @JoinColumn(name = "id_carro")
    private Carro carro;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Agencia getAgencia() {
        return agencia;
    }

    public void setAgencia(Agencia agencia) {
        this.agencia = agencia;
    }

    public Carro getCarro() {
        return carro;
    }

    public void setCarro(Carro carro) {
        this.carro = carro;
    }

    
}
