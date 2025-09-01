
import reviewpoo.Caminhao;
import reviewpoo.Carro;


public class Reviewpoo {

    public static void main(String[] args) {
        /*
        Veiculo v = new("VW", "gol", 1995);
        v.exibirInfo();
         */
        Carro c = new Carro("VW", "gol", 1995, 90, 16);
        c.ligar();
        c.acelerar();
        c.exibirInfo();
        c.getPotencia();
        
        Caminhao cam = new Caminhao("Scania", "Scanner", 2005, 100, 40);
        cam.ligar();
        cam.acelerar();
        cam.exibirInfo();
        cam.getPotencia();
    }

}

