package webapp.locadora.Model;

import jakarta.persistence.*;

import java.time.LocalDateTime;

@Entity
public class Aluga {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idLocacao;
    private LocalDateTime dataLocacao;
    private LocalDateTime dataDevolucao;
    private double valorTotal;

    @ManyToOne
    @JoinColumn(name = "id_carro")
    private Carro carro;

    @ManyToOne
    @JoinColumn(name = "numero_agencia")
    private Agencia agencia;

    @ManyToOne
    @JoinColumn(name = "CNH")
    private Cliente cliente;

    public int getIdLocacao() {
        return idLocacao;
    }

    public void setIdLocacao(int idLocacao) {
        this.idLocacao = idLocacao;
    }

    public LocalDateTime getDataLocacao() {
        return dataLocacao;
    }

    public void setDataLocacao(LocalDateTime dataLocacao) {
        this.dataLocacao = dataLocacao;
    }

    public LocalDateTime getDataDevolucao() {
        return dataDevolucao;
    }

    public void setDataDevolucao(LocalDateTime dataDevolucao) {
        this.dataDevolucao = dataDevolucao;
    }

    public double getValorTotal() {
        return valorTotal;
    }

    public void setValorTotal(double valorTotal) {
        this.valorTotal = valorTotal;
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

    public Cliente getCliente() {
        return cliente;
    }

    public void setCliente(Cliente cliente) {
        this.cliente = cliente;
    }

    
}
