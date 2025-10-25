from django.urls import path
from .views import PostListView, new_post

app_name = 'blog_app'

urlpatterns = [
    path('', PostListView.as_view(), name='main_page'),
    path('new-post/', new_post, name='new_post'),
]
