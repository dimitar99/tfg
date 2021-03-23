package com.example.proyectofinal_v2.adapter;

import android.content.Context;
import android.media.Image;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseExpandableListAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.pojo.Routine;

import java.util.ArrayList;
import java.util.Map;


public class FragTrainingAdapter extends BaseExpandableListAdapter {

    private ArrayList<String> categories;
    private Map<String, ArrayList<Routine>> categoryChilds;
    private Context context;

    public FragTrainingAdapter(Context context, ArrayList<String> categories, Map<String, ArrayList<Routine>> categoryChilds) {
        this.context = context;
        this.categories = categories;
        this.categoryChilds = categoryChilds;
    }

    @Override
    public int getGroupCount() {
        return categories.size();
    }

    @Override
    public int getChildrenCount(int groupPosition) {
        return categoryChilds.get(categories.get(groupPosition)).size();
    }

    @Override
    public Object getGroup(int groupPosition) {
        return categories.get(groupPosition);
    }

    @Override
    public Object getChild(int groupPosition, int childPosition) {
        return categoryChilds.get(categories.get(groupPosition)).get(childPosition);
    }

    @Override
    public long getGroupId(int groupPosition) {
        return 0;
    }

    @Override
    public long getChildId(int groupPosition, int childPosition) {
        return 0;
    }

    @Override
    public boolean hasStableIds() {
        return false;
    }

    @Override
    public View getGroupView(int groupPosition, boolean isExpanded, View view, ViewGroup parent) {

        // Inflation
        view = LayoutInflater.from(context).inflate(R.layout.frag_training_elv_group, null);

        // Declaration and set title of type of training
        TextView txtCategoryTitle = (TextView) view.findViewById(R.id.fragTrainingExpandableListViewGroup);
        int type = context.getResources().getIdentifier("@string/routineType"+categories.get(groupPosition), "string", context.getPackageName());
        txtCategoryTitle.setText(type);

        return (view);
    }

    @Override
    public View getChildView(int groupPosition, int childPosition, boolean isLastChild, View view, ViewGroup parent) {
        // Inflation
        view = LayoutInflater.from(context).inflate(R.layout.frag_training_elv_child, null);

        // Declaration of the routine
        Routine routine = (Routine)getChild(groupPosition, childPosition);

        // ImageView of the routine
        ImageView imageView = (ImageView) view.findViewById(R.id.fragTrainingExpandableListViewPhoto);
        String group = getGroup(groupPosition).toString().toLowerCase();
        int resource = context.getResources().getIdentifier("@drawable/"+categories.get(groupPosition).toLowerCase(), "drawable", context.getPackageName());
        imageView.setImageResource(resource);

        // Name of the routine
        TextView name = (TextView) view.findViewById(R.id.fragTrainingExpandableListViewName);
        name.setText(routine.getName());

        return (view);
    }

    @Override
    public boolean isChildSelectable(int groupPosition, int childPosition) {
        return true;
    }

}