package com.example.proyectofinal_v2.fragment;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.adapter.ApiAdapter;
import com.example.proyectofinal_v2.api.ApiClient;
import com.example.proyectofinal_v2.api.ApiInterface;
import com.example.proyectofinal_v2.api_models.Article;
import com.example.proyectofinal_v2.api_models.News;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class FragmentMain extends Fragment implements SwipeRefreshLayout.OnRefreshListener {

    public static final String API_KEY = "45b9f5d21b5b4ccfa2dc3dc099881882";
    private RecyclerView recyclerView;
    private RecyclerView.LayoutManager layoutManager;
    private List<Article> articles = new ArrayList<>();
    private ApiAdapter apiAdapter;
    private String TAG = getTag();
    private SwipeRefreshLayout swipeRefreshLayout;
    private Context context;

    public FragmentMain(Context context) {
        this.context = context;
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_main, container, false);

        // Swipe Refresh Layout
        swipeRefreshLayout = v.findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(this);
        swipeRefreshLayout.setColorSchemeColors(getResources().getColor(R.color.colorAccent));

        // Recycler View
        recyclerView = v.findViewById(R.id.recyclerView);
        layoutManager = new LinearLayoutManager(v.getContext());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setItemAnimator(new DefaultItemAnimator());
        recyclerView.setNestedScrollingEnabled(false);

        return v;
    }

    @Override
    public void onActivityCreated(Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        onLoadingSwipeRefresh();
    }

    // Method for get json of web
    public void LoadJson() {

        swipeRefreshLayout.setRefreshing(true);

        ApiInterface apiInterface = ApiClient.getApiClient().create(ApiInterface.class);
        Call<News> call;

        SharedPreferences sharedPreferences = PreferenceManager.getDefaultSharedPreferences(getContext());
        String language = sharedPreferences.getString("prefLanguage", "es");
        String q = "fitness";
        String sortBy = "publishedAt";
        String pageSize = "pageSize";

        call = apiInterface.getNews(language, q, sortBy, pageSize, API_KEY);

        call.enqueue(new Callback<News>() {
            @Override
            public void onResponse(Call<News> call, Response<News> response) {
                if (response.isSuccessful() && response.body().getArticle() != null) {

                    articles = response.body().getArticle();
                    apiAdapter = new ApiAdapter(articles, getContext());
                    recyclerView.setAdapter(apiAdapter);
                    apiAdapter.notifyDataSetChanged();

                    swipeRefreshLayout.setRefreshing(false);

                } else {
                    swipeRefreshLayout.setRefreshing(false);

                    String errorCode;
                    switch (response.code()) {
                        case 404:
                            errorCode = "404 not found";
                            break;
                        case 500:
                            errorCode = "500 server broken";
                            break;
                        default:
                            errorCode = "unknown error";
                            break;
                    }
                }
                swipeRefreshLayout.setRefreshing(false);
            }

            @Override
            public void onFailure(Call<News> call, Throwable t) {
                swipeRefreshLayout.setRefreshing(false);
                Toast.makeText(context, R.string.fui_no_internet, Toast.LENGTH_SHORT).show();
            }
        });

    }

    // Method for refresh information
    @Override
    public void onRefresh() {
        LoadJson();
    }

    // Method for refresh information
    private void onLoadingSwipeRefresh() {
        swipeRefreshLayout.post(
                new Runnable() {
                    @Override
                    public void run() {
                        LoadJson();
                    }
                }
        );
    }

    @Override
    public void onResume() {
        super.onResume();
    }
}