package com.example.proyectofinal_v2.principal;

import android.app.FragmentManager;
import android.app.FragmentTransaction;
import android.content.SharedPreferences;
import android.content.res.Configuration;
import android.content.res.Resources;
import android.os.Build;
import android.os.Bundle;
import android.preference.EditTextPreference;
import android.preference.ListPreference;
import android.preference.Preference;
import android.preference.PreferenceActivity;
import android.preference.PreferenceFragment;
import android.preference.PreferenceManager;
import android.preference.SwitchPreference;
import android.util.DisplayMetrics;

import androidx.annotation.RequiresApi;

import com.example.proyectofinal_v2.R;

import java.util.Locale;


public class SettingsScreen extends PreferenceActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        // Fragment manager for set the default container to a Preference Fragment
        FragmentManager fragmentManager = getFragmentManager();
        FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
        fragmentTransaction.replace(android.R.id.content, new PreferenciasFragment());
        fragmentTransaction.commit();

    }

    // Method for configurate language
    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN_MR1)
    public void setAppLocale(){
        SharedPreferences sharedPreferences = PreferenceManager.getDefaultSharedPreferences(this);
        String language = sharedPreferences.getString("prefLanguage", "es");

        Resources res = getResources();
        DisplayMetrics dm = res.getDisplayMetrics();
        Configuration configuration = res.getConfiguration();
        configuration.setLocale(new Locale(language));
        res.updateConfiguration(configuration, dm);
    }

    public static class PreferenciasFragment extends PreferenceFragment {

        @Override
        public void onCreate(final Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            addPreferencesFromResource(R.xml.settings_options);

            // Instance of sharedPreferences for change them if the user wants
            final SharedPreferences sharedPreferences = PreferenceManager.getDefaultSharedPreferences(this.getActivity());
            final SharedPreferences.Editor editor = sharedPreferences.edit();

            // LANGUAGE
            // Instance of ListPreference language for commit every change that user do
            ListPreference language = (ListPreference) findPreference("prefLanguage");
            language.setOnPreferenceChangeListener(new Preference.OnPreferenceChangeListener() {
                @Override
                public boolean onPreferenceChange(Preference preference, Object newValue) {

                    Locale locale = new Locale(newValue.toString(), newValue.toString().toUpperCase());
                    Locale.setDefault(locale);
                    Configuration config_es = new Configuration();
                    config_es.locale = locale;
                    getResources().updateConfiguration(config_es, getResources().getDisplayMetrics());
                    editor.putString("language", newValue.toString());

                    //Restart activity for instant changes
                    getActivity().recreate();
                    editor.commit();
                    return true;
                }
            });

            // NICK
            // Instance of EditTextPreference nick for commit every change that user do
            EditTextPreference nick = (EditTextPreference) findPreference("prefNick");
            nick.setOnPreferenceChangeListener(new Preference.OnPreferenceChangeListener() {
                @Override
                public boolean onPreferenceChange(Preference preference, Object newValue) {

                    String n = nick.getEditText().toString();
                    editor.putString("nick", n);
                    editor.commit();
                    return false;
                }
            });

            // FONT FAMILY
            // Instance of ListPreference font for commit every change that user do
            ListPreference font = (ListPreference) findPreference("prefFont");
            font.setOnPreferenceChangeListener(new Preference.OnPreferenceChangeListener() {
                @Override
                public boolean onPreferenceChange(Preference preference, Object newValue) {

                    editor.putString("font", newValue.toString());

                    //Restart activity for instant changes
                    getActivity().recreate();
                    editor.commit();
                    return true;
                }
            });

            // DARK MODE
            // Instance of SwitchPreference darkMode for commit every change that user do
            SwitchPreference darkMode = (SwitchPreference) findPreference("prefDarkMode");
            darkMode.setOnPreferenceChangeListener(new Preference.OnPreferenceChangeListener() {
                @Override
                public boolean onPreferenceChange(Preference preference, Object newValue) {

                    editor.putString("darkMode", newValue.toString());

                    //Restart activity for instant changes
                    getActivity().recreate();
                    editor.commit();
                    return true;
                }
            });

            // NOTIFICATIONS
            // Instance of SwitchPreference notifications for commit every change that user do
            SwitchPreference notifications = (SwitchPreference) findPreference("prefNotifications");
            notifications.setOnPreferenceChangeListener(new Preference.OnPreferenceChangeListener() {
                @Override
                public boolean onPreferenceChange(Preference preference, Object newValue) {
                    editor.putString("notifications", newValue.toString());
                    //Restart activity for instant changes
                    getActivity().recreate();
                    editor.commit();
                    return true;
                }
            });

        }
    }

}
