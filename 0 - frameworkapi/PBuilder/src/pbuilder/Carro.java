/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package pbuilder;

/**
 *
 * @author suporte
 */
public class Carro {
    private boolean roda;
    private boolean teto_solar;
    private boolean vidro_eletrico;
    private boolean camera;
    private boolean milha;
    private boolean trava;
    private boolean som;
   /* 
    public Carro(boolean roda, boolean teto_solar, 
            boolean vidro_eletrico,
                boolean camera, boolean milha, 
                        boolean trava, boolean som){
        this.camera=camera;
        this.milha=milha;
        this.roda=roda;
        this.teto_solar=teto_solar;
        this.trava=trava;
        this.som=som;
        this.vidro_eletrico=vidro_eletrico;
                            
    }  
*/

    public boolean isRoda() {
        return roda;
    }

    public void setRoda(boolean roda) {
        this.roda = roda;
    }

    public boolean isTeto_solar() {
        return teto_solar;
    }

    public void setTeto_solar(boolean teto_solar) {
        this.teto_solar = teto_solar;
    }

    public boolean isVidro_eletrico() {
        return vidro_eletrico;
    }

    public void setVidro_eletrico(boolean vidro_eletrico) {
        this.vidro_eletrico = vidro_eletrico;
    }

    public boolean isCamera() {
        return camera;
    }

    public void setCamera(boolean camera) {
        this.camera = camera;
    }

    public boolean isMilha() {
        return milha;
    }

    public void setMilha(boolean milha) {
        this.milha = milha;
    }

    public boolean isTrava() {
        return trava;
    }

    public void setTrava(boolean trava) {
        this.trava = trava;
    }

    public boolean isSom() {
        return som;
    }

    public void setSom(boolean som) {
        this.som = som;
    }

    @Override
    public String toString() {
        return "Carro{" + "roda=" + roda + ", teto_solar=" + teto_solar + ", vidro_eletrico=" + vidro_eletrico + ", camera=" + camera + ", milha=" + milha + ", trava=" + trava + ", som=" + som + '}';
    }
    
    
}
