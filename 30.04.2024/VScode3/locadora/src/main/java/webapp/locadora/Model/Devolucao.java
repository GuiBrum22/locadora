package webapp.locadora.Model;

import java.util.Date;

import jakarta.persistence.*;

@Entity
public class Devolucao {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idDevolucao;
    private Date dataDevolucao;
    private String condicao;
    private double custosAdicionais;

    @ManyToOne
    @JoinColumn(name = "id_locacao")
    private Aluga aluga;

    public int getIdDevolucao() {
        return idDevolucao;
    }

    public void setIdDevolucao(int idDevolucao) {
        this.idDevolucao = idDevolucao;
    }

    public Date getDataDevolucao() {
        return dataDevolucao;
    }

    public void setDataDevolucao(Date dataDevolucao) {
        this.dataDevolucao = dataDevolucao;
    }

    public String getCondicao() {
        return condicao;
    }

    public void setCondicao(String condicao) {
        this.condicao = condicao;
    }

    public double getCustosAdicionais() {
        return custosAdicionais;
    }

    public void setCustosAdicionais(double custosAdicionais) {
        this.custosAdicionais = custosAdicionais;
    }

    public Aluga getAluga() {
        return aluga;
    }

    public void setAluga(Aluga aluga) {
        this.aluga = aluga;
    }

    
}
