package webapp.locadora.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

import webapp.locadora.Model.Recebe;
import webapp.locadora.Repository.RecebeRepository;

import java.util.List;

@Controller
public class RecebeController {

    @Autowired
    private RecebeRepository rp;

    @GetMapping("/recebes")
    public String listarRecebes(Model model) {
        List<Recebe> recebes = rp.findAll();
        model.addAttribute("recebes", recebes);
        return "lista-recebes";
    }
}
