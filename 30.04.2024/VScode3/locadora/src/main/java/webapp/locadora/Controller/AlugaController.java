package webapp.locadora.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

import webapp.locadora.Model.Aluga;
import webapp.locadora.Repository.AlugaRepository;

import java.time.LocalDateTime;
import java.util.List;

@Controller
public class AlugaController {

    @Autowired
    private AlugaRepository ar;

    @GetMapping("/alugueis")
    public String listarAlugueis(Model model) {
        List<Aluga> alugueis = ar.findAll();
        model.addAttribute("alugueis", alugueis);
        return "lista-alugueis";
    }

    @GetMapping("/alugueis-por-data")
    public String listarAlugueisPorData(Model model,LocalDateTime data) {
        List<Aluga> alugueis = ar.findByDataLocacao(data);
        model.addAttribute("alugueis", alugueis);
        return "lista-alugueis-por-data";
    }

    @GetMapping("/carros-alugados-por-cliente")
    public String listarCarrosAlugadosPorCliente(Model model, int CNH,LocalDateTime dataLocacao,LocalDateTime dataDevolucao) {
        List<Aluga> alugueis = ar.findByClienteCNHAndDataLocacaoBetween(CNH, dataLocacao, dataDevolucao);
        model.addAttribute("alugueis", alugueis);
        return "lista-carros-alugados-por-cliente";
    }

    @GetMapping("/alugueis-completo")
    public String listarAlugueisCompleto(Model model) {
        List<Aluga> alugueis = ar.findAll();
        model.addAttribute("alugueis", alugueis);
        return "lista-alugueis-completo";
    }

    @GetMapping("/todos-alugueis")
    public String listarTodosAlugueis(Model model) {
        List<Aluga> alugueis = ar.findAll();
        model.addAttribute("alugueis", alugueis);
        return "lista-todos-alugueis";
    }

    @GetMapping("/receita-total")
    public String calcularReceitaTotal(Model model,LocalDateTime dataLocacao,LocalDateTime dataDevolucao) {
        double receitaTotal = ar.calcularReceitaTotal(dataLocacao, dataDevolucao);
        model.addAttribute("receitaTotal", receitaTotal);
        return "receita-total";
    }

    @GetMapping("/media-dias-alugados")
    public String calcularMediaDiasAlugados(Model model) {
        double mediaDiasAlugados = ar.calcularMediaDiasAlugados();
        model.addAttribute("mediaDiasAlugados", mediaDiasAlugados);
        return "media-dias-alugados";
    }
}