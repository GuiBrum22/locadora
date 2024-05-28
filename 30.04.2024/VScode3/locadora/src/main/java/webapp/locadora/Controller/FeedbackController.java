package webapp.locadora.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

import webapp.locadora.Model.Feedback;
import webapp.locadora.Repository.FeedbackRepository;

import java.util.List;

@Controller
public class FeedbackController {

    @Autowired
    private FeedbackRepository fr;

    @GetMapping("/feedbacks")
    public String listarFeedbacks(Model model) {
        List<Feedback> feedbacks = fr.findAll();
        model.addAttribute("feedbacks", feedbacks);
        return "lista-feedbacks";
    }
}
