package com.example.proyectofinal_v2.fragment;

import android.content.Intent;
import android.media.Image;
import android.net.Uri;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ExpandableListView;
import android.widget.ImageView;
import android.widget.Toast;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.adapter.FragTrainingAdapter;
import com.example.proyectofinal_v2.bd.Routines;
import com.example.proyectofinal_v2.pojo.Routine;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;
import java.util.Objects;

public class FragmentTraining extends Fragment {

    private ExpandableListView expandableListView;
    private FragTrainingAdapter fragTrainingAdapter;
    private ArrayList<String> types;
    private Map<String, ArrayList<Routine>> routines;
    private Routines r;

    private ImageView groupImage;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_training, container, false);
    }

    @Override
    public void onActivityCreated(Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);

        // Instance of Routines DB
        r = new Routines(this.getContext());

        // Getting all different types of routines from DB
        types = r.getRoutinesType();

        // Declaration of HashMap
        routines = new HashMap<>();

        // ExpandableListView declaration and inflation
        expandableListView = (ExpandableListView) getView().findViewById(R.id.fragTrainingExpandableListView);
        fragTrainingAdapter = new FragTrainingAdapter(this.getContext(), types, routines);
        loadData();
        expandableListView.setOnGroupClickListener(new ExpandableListView.OnGroupClickListener() {
            @Override
            public boolean onGroupClick(ExpandableListView parent, View v, int groupPosition, long id) {
                groupImage = v.findViewById(R.id.fragTrainingExpandableGroupPhoto);

                if(groupImage.getDrawable() == getResources().getDrawable(R.drawable.ic_arrow_down)){
                    groupImage.setImageResource(R.drawable.ic_arrow_up);
                }else{
                    groupImage.setImageResource(R.drawable.ic_arrow_down);
                }
                return false;
            }
        });
        expandableListView.setOnChildClickListener(new ExpandableListView.OnChildClickListener() {
            @Override
            public boolean onChildClick(ExpandableListView parent, View v, int groupPosition, int childPosition, long id) {
                Routine r = (Routine) fragTrainingAdapter.getChild(groupPosition, childPosition);
                Uri uri = Uri.parse(r.getUrl());
                Intent intent = new Intent(Intent.ACTION_VIEW, uri);
                startActivity(intent);
                return false;
            }
        });
    }

    // Get data from ArrayList and set adapter for load the expandable list view
    private void loadData() {
        ArrayList<Routine> cardioRoutines = r.getRoutinesByTipe(Routine.Type.CARDIO);
        ArrayList<Routine> chestRoutines = r.getRoutinesByTipe(Routine.Type.CHEST);
        ArrayList<Routine> absRoutines = r.getRoutinesByTipe(Routine.Type.ABS);
        ArrayList<Routine> armsRoutines = r.getRoutinesByTipe(Routine.Type.ARMS);
        ArrayList<Routine> backRoutines = r.getRoutinesByTipe(Routine.Type.BACK);
        ArrayList<Routine> legsRoutines = r.getRoutinesByTipe(Routine.Type.LEGS);

        routines.put(types.get(0), cardioRoutines);
        routines.put(types.get(1), chestRoutines);
        routines.put(types.get(2), absRoutines);
        routines.put(types.get(3), armsRoutines);
        routines.put(types.get(4), backRoutines);
        routines.put(types.get(5), legsRoutines);

        // Setting adapter to ExpandableListView
        expandableListView.setAdapter(fragTrainingAdapter);

    }
}