package webapp.locadora.Model;

import jakarta.persistence.*;

@Entity
public class Recebe {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;
    
    @ManyToOne
    @JoinColumn(name = "id_manutencao")
    private Manutencao manutencao;
    
    @ManyToOne
    @JoinColumn(name = "id_carro")
    private Carro carro;
    
    @ManyToOne
    @JoinColumn(name = "numero_agencia")
    private Agencia agencia;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Manutencao getManutencao() {
        return manutencao;
    }

    public void setManutencao(Manutencao manutencao) {
        this.manutencao = manutencao;
    }

    public Carro getCarro() {
        return carro;
    }

    public void setCarro(Carro carro) {
        this.carro = carro;
    }

    public Agencia getAgencia() {
        return agencia;
    }

    public void setAgencia(Agencia agencia) {
        this.agencia = agencia;
    }

    
}

