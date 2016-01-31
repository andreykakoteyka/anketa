# -*- coding: utf-8 -*-
# Generated by Django 1.9.1 on 2016-01-08 11:31
from __future__ import unicode_literals

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('adminPanel', '0001_initial'),
    ]

    operations = [
        migrations.AlterModelOptions(
            name='anketa',
            options={'permissions': (('anketa/add', 'Позволяет просматривать анкеты выпускников'), ('anketa/change', 'Позволяет изменять анкеты выпускников'), ('anketa/remove', 'Позволяет удалять анкеты выпускников'))},
        ),
        migrations.AlterModelOptions(
            name='faculty',
            options={'permissions': (('faculty/add', 'Позволяет просматривать факультеты'), ('faculty/change', 'Позволяет изменять факультеты'), ('facullty/remove', 'Позволяет удалять факультеты'))},
        ),
        migrations.AlterModelOptions(
            name='group',
            options={'permissions': (('studentsGroup/add', 'Позволяет просматривать студенческие группы'), ('studentsGroup/change', 'Позволяет изменять студенческие группы'), ('studentsGroup/remove', 'Позволяет удалять студенческие группы'))},
        ),
        migrations.AlterModelOptions(
            name='studystage',
            options={'permissions': (('studyStage/add', 'Позволяет просматривать уровни обучения'), ('studyStage/change', 'Позволяет изменять уровни обучения'), ('studyStage/remove', 'Позволяет удалять уровни обучения'))},
        ),
    ]