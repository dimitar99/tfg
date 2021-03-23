package com.example.proyectofinal_v2.bd;

import android.content.Context;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.pojo.Routine;

import java.util.ArrayList;

public class Routines {

    private ArrayList<Routine> routines;
    private Context context;

    public Routines(Context context){
        this.context = context;
        this.routines = new ArrayList<Routine>();
        routines.add(new Routine(Routine.Type.CARDIO, context.getResources().getString(R.string.cardio15Minutes), "https://www.youtube.com/watch?v=uSD5IxmEQdI"));
        routines.add(new Routine(Routine.Type.CARDIO, context.getResources().getString(R.string.cardio20Minutes), "https://www.youtube.com/watch?v=yOkFhJBEKwo"));
        routines.add(new Routine(Routine.Type.BACK, context.getResources().getString(R.string.backWithEquipment), "https://www.youtube.com/watch?v=VGGtdTPtQsI"));
        routines.add(new Routine(Routine.Type.BACK, context.getResources().getString(R.string.backWithoutEquipment), "https://www.youtube.com/watch?v=fexiNfc1PZI"));
        routines.add(new Routine(Routine.Type.ARMS, context.getResources().getString(R.string.bicepsTricepsWithEquipment), "https://youtu.be/0YbBlQbrtIE"));
        routines.add(new Routine(Routine.Type.ARMS, context.getResources().getString(R.string.bicepsTricepsWithoutEquipmen), "https://www.youtube.com/watch?v=nkT6AbWPg-Y"));
        routines.add(new Routine(Routine.Type.ARMS, context.getResources().getString(R.string.tricepsWithEquipment), "https://www.youtube.com/watch?v=rPXSJHtARtQ&t=94s"));
        routines.add(new Routine(Routine.Type.ARMS, context.getResources().getString(R.string.tricepsWithoutEquipment), "https://www.youtube.com/watch?v=OnXJcinN2sg"));
        routines.add(new Routine(Routine.Type.ARMS, context.getResources().getString(R.string.bicepsWithEquipment), "https://www.youtube.com/watch?v=-_fnPO49Bpo&t=338s"));
        routines.add(new Routine(Routine.Type.ARMS, context.getResources().getString(R.string.shouldersWithEquipment), "https://www.youtube.com/watch?v=QhLtriTDdeo&t=239s"));
        routines.add(new Routine(Routine.Type.ARMS, context.getResources().getString(R.string.shouldersWithoutEquipment), "https://www.youtube.com/watch?v=d1h5kxiD62Y"));
        routines.add(new Routine(Routine.Type.CHEST, context.getResources().getString(R.string.chestWithEquipment), "https://www.youtube.com/watch?v=cd8Q6y3MQsI"));
        routines.add(new Routine(Routine.Type.CHEST, context.getResources().getString(R.string.chestWithoutEquipment), "https://www.youtube.com/watch?v=wLGn8XmLeEM"));
        routines.add(new Routine(Routine.Type.LEGS, context.getResources().getString(R.string.legsWithEquipment), "https://www.youtube.com/watch?v=C31mN7CixTg"));
        routines.add(new Routine(Routine.Type.LEGS, context.getResources().getString(R.string.legsWithoutEquipment), "https://www.youtube.com/watch?v=RPQ1vfBUIis"));
        routines.add(new Routine(Routine.Type.ABS, context.getResources().getString(R.string.absStarter), "https://www.youtube.com/watch?v=jSvkNH_oklA"));
        routines.add(new Routine(Routine.Type.ABS, context.getResources().getString(R.string.absAdvanced), "https://www.youtube.com/watch?v=9GInaGRIggE"));
    }

    public ArrayList<Routine> getRoutines(){
        return routines;
    }

    public void setRoutines(ArrayList<Routine> routines){
        this.routines = routines;
    }

    public ArrayList<String> getRoutinesType(){
        ArrayList<String> types = new ArrayList<>();
        types.add(String.valueOf(Routine.Type.CARDIO));
        types.add(String.valueOf(Routine.Type.CHEST));
        types.add(String.valueOf(Routine.Type.ABS));
        types.add(String.valueOf(Routine.Type.ARMS));
        types.add(String.valueOf(Routine.Type.BACK));
        types.add(String.valueOf(Routine.Type.LEGS));
        return types;
    }

    public ArrayList<Routine> getRoutinesByTipe(Routine.Type type){
        ArrayList<Routine> types = new ArrayList<>();
        for (Routine r : getRoutines()){
            if(r.getType() == type) types.add(r);
        }
        return types;
    }

}
