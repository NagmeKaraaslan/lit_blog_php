from django import forms
from .models import Post

class PostForm(forms.ModelForm):
    class Meta:
        model = Post
        fields = ['title', 'content']
        widgets = {
            'title': forms.TextInput(attrs={
                'class': 'title-input',
                'placeholder': 'Başlık giriniz',
            }),
            'content': forms.Textarea(attrs={
                'class': 'yeni içerik',
                'rows': 5,
                'placeholder': 'Yeni yazım:',
            }),
        }
        labels = {
            'title': '',
            'content': '',
        }
