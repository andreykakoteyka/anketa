# -*- coding: utf-8 -*-
# Generated by Django 1.9.1 on 2016-01-07 22:33
from __future__ import unicode_literals

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Anketa',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('firstName', models.CharField(max_length=50)),
                ('familyName', models.CharField(max_length=50)),
                ('lastName', models.CharField(max_length=50)),
                ('birthDate', models.DateField()),
                ('phone', models.CharField(max_length=20)),
                ('email', models.CharField(max_length=255)),
                ('hasJob', models.BooleanField()),
                ('currentCompany', models.CharField(max_length=255)),
                ('currentPost', models.CharField(max_length=255)),
                ('hadJobBeforePractise', models.BooleanField()),
                ('companyBeforePractise', models.CharField(max_length=255)),
                ('postBeforePractise', models.CharField(max_length=255)),
                ('magHseNN', models.BooleanField()),
                ('magHseMoscow', models.BooleanField()),
                ('magOtherUniversity', models.BooleanField()),
                ('otherUniversityName', models.BooleanField()),
                ('changeJob', models.BooleanField()),
                ('changeJobCompany', models.CharField(max_length=255)),
                ('changeJobPost', models.CharField(max_length=255)),
                ('getJob', models.BooleanField()),
                ('getJobCompany', models.CharField(max_length=255)),
                ('getJobPost', models.CharField(max_length=255)),
                ('other', models.BooleanField()),
                ('otherText', models.CharField(max_length=255)),
                ('agreeMail', models.BooleanField()),
                ('agreePersonalData', models.BooleanField()),
            ],
        ),
        migrations.CreateModel(
            name='Faculty',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=255)),
            ],
        ),
        migrations.CreateModel(
            name='Group',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=20)),
                ('faculty', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='adminPanel.Faculty')),
            ],
        ),
        migrations.CreateModel(
            name='StudyStage',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=50)),
                ('cannotGoToMag', models.BooleanField()),
            ],
        ),
        migrations.AddField(
            model_name='faculty',
            name='stage',
            field=models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='adminPanel.StudyStage'),
        ),
        migrations.AddField(
            model_name='anketa',
            name='faculty',
            field=models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='adminPanel.Faculty'),
        ),
        migrations.AddField(
            model_name='anketa',
            name='group',
            field=models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='adminPanel.Group'),
        ),
        migrations.AddField(
            model_name='anketa',
            name='studyStage',
            field=models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='adminPanel.StudyStage'),
        ),
    ]
