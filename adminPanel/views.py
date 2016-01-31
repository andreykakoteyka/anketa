# Create your views here.
import json

from anketa import settings
from django.contrib.auth.decorators import login_required
from django.http import HttpResponseRedirect
from django.shortcuts import render
from django.contrib.auth import authenticate, login, logout as logOut
from rest_framework import status, views
from rest_framework.response import Response

# Create your views here.

#login user
class Login(views.APIView):
    def post(self, request, format = None):
        #encode json
        data = request.data

        #get login data
        username = data.get('username', None)
        password = data.get('password', None)

        account = authenticate(username = username, password = password)

        if account is not None:
            if account.is_active:
                login(request, account)
                return Response(status=status.HTTP_301_MOVED_PERMANENTLY)
                #serialized = json.JSONEncoder().encode(account)
            else:
                return Response({
                    'status': 'Unauthorized',
                    'message': 'This account has been disabled.'
                }, status=status.HTTP_401_UNAUTHORIZED)
        else:
            return Response({
                'status': 'Unauthorized',
                'message': 'Username/password combination invalid.'
            }, status=status.HTTP_401_UNAUTHORIZED)


def logout(request):
    logOut(request)
    return HttpResponseRedirect(settings.LOGIN_URL)


def login_page(request):
    if request.user.is_authenticated():
        return HttpResponseRedirect(settings.LOGIN_REDIRECT_URL)

    return render(request, 'adminPanel/login.html')


@login_required()
def admin(request):
    return render(request, 'adminPanel/index.html')