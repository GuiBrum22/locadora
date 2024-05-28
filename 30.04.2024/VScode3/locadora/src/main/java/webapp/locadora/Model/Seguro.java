package webapp.locadora.Model;

import jakarta.persistence.*;

@Entity
public class Seguro {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idSeguro;
    private String seguradora;
    private String tipoSeguro;
    private String cobertura;

    @ManyToOne
    @JoinColumn(name = "id_carro")
    private Carro carro;

    public int getIdSeguro() {
        return idSeguro;
    }

    public void setIdSeguro(int idSeguro) {
        this.idSeguro = idSeguro;
    }

    public String getSeguradora() {
        return seguradora;
    }

    public void setSeguradora(String seguradora) {
        this.seguradora = seguradora;
    }

    public String getTipoSeguro() {
        return tipoSeguro;
    }

    public void setTipoSeguro(String tipoSeguro) {
        this.tipoSeguro = tipoSeguro;
    }

    public String getCobertura() {
        return cobertura;
    }

    public void setCobertura(String cobertura) {
        this.cobertura = cobertura;
    }

    public Carro getCarro() {
        return carro;
    }

    public void setCarro(Carro carro) {
        this.carro = carro;
    }

    
}
