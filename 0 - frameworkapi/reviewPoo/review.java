
public class review {

    public static void main(String[] args) {
        /*
        Veiculo v = new("VW", "gol", 1995);
        v.exibirInfo();
         */
        Carro c = new Carro("VW", "gol", 1995);
        c.ligar();
        c.acelerar();
        c.exibirInfo();
    }

}

