package webapp.locadora.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

import webapp.locadora.Model.Pertence;
import webapp.locadora.Repository.PertenceRepository;

import java.util.List;

@Controller
public class PertenceController {

    @Autowired
    private PertenceRepository pr;

    @GetMapping("/pertences")
    public String listarPertences(Model model) {
        List<Pertence> pertences = pr.findAll();
        model.addAttribute("pertences", pertences);
        return "lista-pertences";
    }
}
