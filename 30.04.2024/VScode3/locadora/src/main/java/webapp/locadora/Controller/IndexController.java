package webapp.locadora.Controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class IndexController {
    @GetMapping("/")
    public String index() {
        return "index";
    }

    @GetMapping("/area-do-funcionario")
    public String acessoFuncionario() {
        return "internas/area-do-funcionario";
    }

    @GetMapping("/lista-alugueis-completo")
    public String listaAlugueisCompleto() {
        return "listas/lista-alugueis-completo";
    }

    @GetMapping("/lista-alugueis-por-data")
    public String listaAlugueisPorData() {
        return "listas/lista-alugueis-por-data";
    }

    @GetMapping("/lista-alugueis")
    public String listaAlugueis() {
        return "listas/lista-alugueis";
    }

    @GetMapping("/lista-carros-alugados-por-cliente")
    public String listaCarrosAlugadosPorCliente() {
        return "listas/lista-carros-alugados-por-cliente";
    }

    @GetMapping("/lista-carros-disponiveis")
    public String listaCarrosDisponiveis() {
        return "listas/lista-carros-disponiveis";
    }

    @GetMapping("/lista-carros-e-manutencao")
    public String listaCarrosEManutencao() {
        return "listas/lista-carros-e-manutencao";
    }

    @GetMapping("/lista-carros-manutencao-recente")
    public String listaCarrosManutencaoRecente() {
        return "listas/lista-carros-manutencao-recente";
    }

    @GetMapping("/lista-carros-nunca-alugados")
    public String listaCarrosNuncaAlugados() {
        return "listas/lista-carros-nunca-alugados";
    }

    @GetMapping("/lista-clientes-alugaram-mais-de-um-carro")
    public String listaClientesAlugaramMaisDeUmCarro() {
        return "listas/lista-clientes-alugaram-mais-de-um-carro";
    }

    @GetMapping("/lista-clientes-e-carros-alugados")
    public String listaClientesECarrosAlugados() {
        return "listas/lista-clientes-e-carros-alugados";
    }

    @GetMapping("/lista-todos-alugueis")
    public String listaTodosAlugueis() {
        return "listas/lista-todos-alugueis";
    }
}
