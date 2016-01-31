from core.views import FacultyViewSet, GroupViewSet, QuestionnaireViewSet, UserGroupViewSet, UserViewSet, DegreeViewSet
from django.conf.urls import url, include
from . import views

from rest_framework import routers

router = routers.SimpleRouter()
router.register(r'faculties', FacultyViewSet)
router.register(r'groups', GroupViewSet)
router.register(r'questionnaires', QuestionnaireViewSet)
router.register(r'usergroups', UserGroupViewSet)
router.register(r'users', UserViewSet)
router.register(r'degrees', DegreeViewSet, base_name="degrees")

urlpatterns = [
    url(r'^', include(router.urls)),
    #url(r'^ankets/(?P<id>[0-9]+)$', views.get_anketa),
    #url(r'^degrees/(?P<id>[0-9]+)$', views.DegreeAPI.as_view()),
    #url(r'^degrees$', views.DegreeAPI.as_view()),
    # url(r'^ankets/(?P<id>[0-9]+)$', views.get_anketa),
    # url(r'^ankets$', views.get_ankets),
    # url(r'^ankets/(?P<id>[0-9]+)$', views.get_anketa),
]