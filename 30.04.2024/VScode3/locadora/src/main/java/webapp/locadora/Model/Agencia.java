package webapp.locadora.Model;

import jakarta.persistence.*;

@Entity
public class Agencia {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int numeroAgencia;
    private String endereco;
    private int contato;
    private String estado;
    private String cidade;
    
    public int getNumeroAgencia() {
        return numeroAgencia;
    }
    public void setNumeroAgencia(int numeroAgencia) {
        this.numeroAgencia = numeroAgencia;
    }
    public String getEndereco() {
        return endereco;
    }
    public void setEndereco(String endereco) {
        this.endereco = endereco;
    }
    public int getContato() {
        return contato;
    }
    public void setContato(int contato) {
        this.contato = contato;
    }
    public String getEstado() {
        return estado;
    }
    public void setEstado(String estado) {
        this.estado = estado;
    }
    public String getCidade() {
        return cidade;
    }
    public void setCidade(String cidade) {
        this.cidade = cidade;
    }

    
}
