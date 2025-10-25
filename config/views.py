from django.shortcuts import redirect

def home(request):
    """
    Home view that redirects to the blog main page
    """
    return redirect('blog_app:main_page')