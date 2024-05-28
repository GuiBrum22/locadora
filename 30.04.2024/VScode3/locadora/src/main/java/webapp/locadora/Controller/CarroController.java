package webapp.locadora.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

import webapp.locadora.Model.Carro;
import webapp.locadora.Repository.CarroRepository;

import java.util.List;

@Controller
public class CarroController {

    @Autowired
    private CarroRepository cr;

    @GetMapping("/carros-disponiveis")
    public String listarCarrosDisponiveis(Model model) {
        List<Carro> carrosDisponiveis = cr.findByDisponibilidadeTrue();
        model.addAttribute("carros", carrosDisponiveis);
        return "lista-carros-disponiveis";
    }

    @GetMapping("/carros-e-manutencao")
    public String listarCarrosEManutencao(Model model) {
        List<Carro> carros = cr.findAll();
        model.addAttribute("carros", carros);
        return "lista-carros-e-manutencao";
    }

    @GetMapping("/carros-nunca-alugados")
    public String listarCarrosNuncaAlugados(Model model) {
        List<Carro> carros = cr.findCarrosNuncaAlugados();
        model.addAttribute("carros", carros);
        return "lista-carros-nunca-alugados";
    }

    @GetMapping("/carros-manutencao-recente")
    public String listarCarrosManutencaoRecente(Model model) {
        List<Carro> carros = cr.findCarrosComManutencaoRecente();
        model.addAttribute("carros", carros);
        return "lista-carros-manutencao-recente";
    }
}
