package com.example.proyectofinal_v2.adapter;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentStatePagerAdapter;

import java.util.List;

public class ViewPagerAdapter extends FragmentStatePagerAdapter {

    private List<Fragment> fragmentList;

    public ViewPagerAdapter(FragmentManager fragmentManager,List<Fragment> fragmentList) {
        super(fragmentManager);
        this.fragmentList = fragmentList;
    }

    public Fragment createFragment(int position) {
        return null;
    }

    public Fragment getItem(int position) {
        Fragment f = fragmentList.get(position);
        return f;
    }

    @Override
    public int getCount() {
        return fragmentList.size();
    }
}
