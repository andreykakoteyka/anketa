from core.models import Faculty, Group, Questionnaire
from django.contrib.auth.models import User, Group as UserGroup
from rest_framework import serializers

# class DegreeSerializer(serializers.ModelSerializer):
#     class Meta:
#         model = Degree


class FacultySerializer(serializers.ModelSerializer):
    class Meta:
        model = Faculty

class GroupSerializer(serializers.ModelSerializer):
    class Meta:
        model = Group

class QuestionnaireSerializer(serializers.ModelSerializer):

    class Meta:
        model = Questionnaire

class UserSerializer(serializers.ModelSerializer):
    class Meta:
        model = User
        fields = ('id', 'username', 'groups', 'firstname', 'lastname', 'email', 'user_permissions', 'is_superuser')


class UserGroupSerializer(serializers.ModelSerializer):
    class Meta:
        model = UserGroup


class UserDeepSerializer(serializers.ModelSerializer):
    groups = serializers.ListSerializer(
        child=UserGroupSerializer(),
        required=True,
        allow_null=False,
        read_only=False,
    )
    class Meta:
        model = User
        fields = ('id', 'username', 'groups', 'first_name', 'last_name', 'email', 'user_permissions', 'is_superuser')


