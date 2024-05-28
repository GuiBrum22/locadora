package webapp.locadora.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

import webapp.locadora.Model.Cliente;
import webapp.locadora.Repository.ClienteRepository;

import java.util.List;

@Controller
public class ClienteController {

    @Autowired
    private ClienteRepository cr;

    @GetMapping("/clientes-e-carros-alugados")
    public String listarClientesECarrosAlugados(Model model) {
        List<Cliente> clientes = cr.findAll();
        model.addAttribute("clientes", clientes);
        return "lista-clientes-e-carros-alugados";
    }

    @GetMapping("/clientes-alugaram-mais-de-um-carro")
    public String listarClientesAlugaramMaisDeUmCarro(Model model) {
        List<Cliente> clientes = cr.findClientesComMaisDeUmAluguel();
        model.addAttribute("clientes", clientes);
        return "lista-clientes-alugaram-mais-de-um-carro";
    }
}
