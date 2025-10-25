from django.db import models
from django.contrib.auth import get_user_model
from django.urls import reverse

User = get_user_model()

class Post(models.Model):
    title = models.CharField("Başlık", max_length=200)
    content = models.TextField("İçerik")
    #author = models.ForeignKey(User, on_delete=models.CASCADE)
    created_at = models.DateTimeField("Oluşturulma tarihi", auto_now_add=True)
    updated_at = models.DateTimeField("Güncelleme tarihi", auto_now=True)
    published = models.BooleanField("Yayınlandı mı?", default=False)
    # like_count = models.PositiveIntegerField("Beğeni Sayısı", default=0)
    # comment_count = models.PositiveIntegerField("Yorum Sayısı", default=0)

    class Meta:
        ordering = ['-created_at']
        verbose_name = 'Eser'
        verbose_name_plural = 'Eserler'

    def __str__(self):
        return self.title
    
    def get_absolute_url(self):
        return reverse('post_detail', kwargs={'pk': self.pk})