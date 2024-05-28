package webapp.locadora.Model;
import java.util.Date;

import jakarta.persistence.*;

@Entity
public class Feedback {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idFeedback;
    private String comentario;
    private String avaliacao;
    private Date dataFeedback;

    public int getIdFeedback() {
        return idFeedback;
    }
    public void setIdFeedback(int idFeedback) {
        this.idFeedback = idFeedback;
    }
    public String getComentario() {
        return comentario;
    }
    public void setComentario(String comentario) {
        this.comentario = comentario;
    }
    public String getAvaliacao() {
        return avaliacao;
    }
    public void setAvaliacao(String avaliacao) {
        this.avaliacao = avaliacao;
    }
    public Date getDataFeedback() {
        return dataFeedback;
    }
    public void setDataFeedback(Date dataFeedback) {
        this.dataFeedback = dataFeedback;
    }

    
}
