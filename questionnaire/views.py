from core.models import degreeChoices
from django.contrib.auth.decorators import login_required
from django.shortcuts import render

# Create your views here.


def anketa(request):
    return render(request, "anketaApp/anketa.html")
