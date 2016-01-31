from django.conf.urls import url, include
from . import views

urlpatterns = [
    url(r'^$', views.admin),
    url(r'^login$', views.login_page),
    #url(r'^auth/', include('rest_framework.urls', namespace='rest_framework'))
    url(r'^auth/logout$', views.logout),
    url(r'^auth/login$', views.Login.as_view())
]
