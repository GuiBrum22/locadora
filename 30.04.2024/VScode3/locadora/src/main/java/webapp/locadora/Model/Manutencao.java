package webapp.locadora.Model;

import jakarta.persistence.*;
import java.util.Date;

@Entity
public class Manutencao {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idManutencao;
    private Date dataManutencao;
    private String tipoManutencao;
    private String descricao;
    private double km;
    private double custo;
    @ManyToOne
    @JoinColumn(name = "placa_carro")
    private Carro carro;

    public int getIdManutencao() {
        return idManutencao;
    }
    public void setIdManutencao(int idManutencao) {
        this.idManutencao = idManutencao;
    }
    public Date getDataManutencao() {
        return dataManutencao;
    }
    public void setDataManutencao(Date dataManutencao) {
        this.dataManutencao = dataManutencao;
    }
    public String getTipoManutencao() {
        return tipoManutencao;
    }
    public void setTipoManutencao(String tipoManutencao) {
        this.tipoManutencao = tipoManutencao;
    }
    public String getDescricao() {
        return descricao;
    }
    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }
    public double getKm() {
        return km;
    }
    public void setKm(double km) {
        this.km = km;
    }
    public double getCusto() {
        return custo;
    }
    public void setCusto(double custo) {
        this.custo = custo;
    }
    public Carro getCarro() {
        return carro;
    }
    public void setCarro(Carro carro) {
        this.carro = carro;
    }
}
