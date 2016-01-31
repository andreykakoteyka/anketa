from core.models import Questionnaire, Group, Faculty, degreeChoices
from core.serializers import UserDeepSerializer, UserGroupSerializer, GroupSerializer
from django.contrib.auth.models import User, Group as UserGroup
from rest_framework import viewsets
from rest_framework.filters import SearchFilter
from rest_framework.response import Response
from rest_framework import status
from .serializers import FacultySerializer, QuestionnaireSerializer
from django_filters import filters


class DegreeViewSet(viewsets.ViewSet):
    def list(self, request):
        result = (
            {
                "value" : value,
                "name":name
            }
            for value, name in degreeChoices
        )
        return Response(result, status=status.HTTP_200_OK)


class FacultyViewSet(viewsets.ModelViewSet):
    serializer_class = FacultySerializer
    queryset = Faculty.objects.all()

class GroupViewSet(viewsets.ModelViewSet):
    serializer_class = GroupSerializer
    queryset = Group.objects.all()

class QuestionnaireViewSet(viewsets.ModelViewSet):
    serializer_class = QuestionnaireSerializer
    queryset = Questionnaire.objects.all()
    filter_backends = (SearchFilter, )
    search_fields = ("firstName", "familyName", "lastName", "phone", "email")

class UserViewSet(viewsets.ModelViewSet):
    serializer_class = UserDeepSerializer
    queryset = User.objects.all()

class UserGroupViewSet(viewsets.ModelViewSet):
    serializer_class = UserGroupSerializer
    queryset = UserGroup.objects.all()

