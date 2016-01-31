# -*- coding: utf-8 -*-
# Generated by Django 1.9.1 on 2016-01-30 14:21
from __future__ import unicode_literals

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Faculty',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=255)),
                ('degree', models.CharField(choices=[('bach', 'Бакалавриат'), ('mag', 'Магистратура')], default='bach', max_length=4)),
            ],
            options={
                'permissions': (('add_faculty', 'Позволяет просматривать факультеты'), ('change_faculty', 'Позволяет изменять факультеты'), ('delete_faculty', 'Позволяет удалять факультеты')),
                'default_permissions': (),
            },
        ),
        migrations.CreateModel(
            name='Group',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=20)),
                ('faculty', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='core.Faculty')),
            ],
            options={
                'permissions': (('add_studentsGroup', 'Позволяет просматривать студенческие группы'), ('change_studentsgroup', 'Позволяет изменять студенческие группы'), ('remove_studentsgroup', 'Позволяет удалять студенческие группы')),
                'default_permissions': (),
            },
        ),
        migrations.CreateModel(
            name='Questionnaire',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('firstName', models.CharField(max_length=50)),
                ('familyName', models.CharField(max_length=50)),
                ('lastName', models.CharField(blank=True, max_length=50)),
                ('birthday', models.DateField()),
                ('phone', models.CharField(max_length=20)),
                ('email', models.CharField(max_length=255)),
                ('degree', models.CharField(choices=[('bach', 'Бакалавриат'), ('mag', 'Магистратура')], default='bach', max_length=4)),
                ('hasJob', models.BooleanField()),
                ('currentCompany', models.CharField(blank=True, max_length=255)),
                ('currentPost', models.CharField(blank=True, max_length=255)),
                ('hadJobBeforePractise', models.BooleanField()),
                ('companyBeforePractise', models.CharField(blank=True, max_length=255)),
                ('postBeforePractise', models.CharField(blank=True, max_length=255)),
                ('magHseNN', models.BooleanField()),
                ('magHseMoscow', models.BooleanField()),
                ('magOtherUniversity', models.BooleanField()),
                ('otherUniversityName', models.CharField(blank=True, max_length=255)),
                ('changeJob', models.BooleanField()),
                ('changeJobCompany', models.CharField(blank=True, max_length=255)),
                ('changeJobPost', models.CharField(blank=True, max_length=255)),
                ('getJob', models.BooleanField()),
                ('getJobCompany', models.CharField(blank=True, max_length=255)),
                ('getJobPost', models.CharField(blank=True, max_length=255)),
                ('other', models.BooleanField()),
                ('otherText', models.CharField(blank=True, max_length=255)),
                ('agreeMail', models.BooleanField()),
                ('agreePersonalData', models.BooleanField()),
                ('faculty', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='core.Faculty')),
                ('group', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='core.Group')),
            ],
            options={
                'permissions': (('change_questionnaire', 'Позволяет изменять анкеты выпускников'), ('delete_questionnaire', 'Позволяет удалять анкеты выпускников')),
                'default_permissions': (),
            },
        ),
    ]
