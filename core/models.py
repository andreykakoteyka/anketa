from django.db import models

# Create your models here.
from django.db.models.expressions import Date


# class Degree(models.Model):
#     name            = models.CharField(max_length=50)
#     cannotGoToMag   = models.BooleanField(default=False)
#
#     def __str__(self):
#         return self.name
#
#     class Meta:
#         default_permissions = ()
#         permissions = (
#             ("add_studystage", "Позволяет просматривать уровни обучения"),
#             ("change_studystage", "Позволяет изменять уровни обучения"),
#             ("delete_studystage", "Позволяет удалять уровни обучения"),
#         )
bachelor = "bach"
mag = "mag"
degreeChoices = (
        (bachelor, "Бакалавриат"),
        (mag, "Магистратура")
    )


class Faculty(models.Model):
    name    = models.CharField(max_length=255)
    degree   = models.CharField(max_length=4, choices=degreeChoices, default=bachelor)

    def __str__(self):
        return self.name

    class Meta:
        default_permissions = ()
        permissions = (
            ("add_faculty", "Позволяет просматривать факультеты"),
            ("change_faculty", "Позволяет изменять факультеты"),
            ("delete_faculty", "Позволяет удалять факультеты"),
        )

class Group(models.Model):
    name    = models.CharField(max_length=20)
    faculty = models.ForeignKey(Faculty)

    def __str__(self):
        return self.name

    class Meta:
        default_permissions = ()
        permissions = (
            ("add_studentsGroup", "Позволяет просматривать студенческие группы"),
            ("change_studentsgroup", "Позволяет изменять студенческие группы"),
            ("remove_studentsgroup", "Позволяет удалять студенческие группы"),
        )



class Questionnaire(models.Model):
    createdAt   = models.DateTimeField().auto_now_add

    firstName   = models.CharField(max_length=50)
    familyName  = models.CharField(max_length=50)
    lastName    = models.CharField(max_length=50, blank=True)

    birthday   = models.DateField()
    phone       = models.CharField(max_length=20)
    email       = models.CharField(max_length=255)


    degree      = models.CharField(max_length=4, choices=degreeChoices, default=bachelor)
    faculty     = models.ForeignKey(Faculty)
    group       = models.ForeignKey(Group)

    hasJob          = models.BooleanField()
    currentCompany  = models.CharField(max_length=255, blank=True)
    currentPost     = models.CharField(max_length=255, blank=True)

    hadJobBeforePractise    = models.BooleanField()
    companyBeforePractise   = models.CharField(max_length=255, blank=True)
    postBeforePractise      = models.CharField(max_length=255, blank=True)

    magHseNN        = models.BooleanField()
    magHseMoscow    = models.BooleanField()

    magOtherUniversity  = models.BooleanField()
    otherUniversityName = models.CharField(max_length=255, blank=True)

    changeJob           = models.BooleanField()
    changeJobCompany =  models.CharField(max_length=255, blank=True)
    changeJobPost =     models.CharField(max_length=255, blank=True)

    getJob          = models.BooleanField()
    getJobCompany   = models.CharField(max_length=255, blank=True)
    getJobPost      = models.CharField(max_length=255, blank=True)

    other       = models.BooleanField()
    otherText   = models.CharField(max_length=255, blank=True)

    agreeMail           = models.BooleanField()
    agreePersonalData   = models.BooleanField()

    def __str__(self):
        return self.familyName + ' ' + self.firstName + ' ' + self.lastName

    def save(self, force_insert=False, force_update=False, using=None,
             update_fields=None):

        if not self.agreePersonalData:
            return

        if self.degree == mag:
            self.magHseNN = False
            self.magHseMoscow = False
            self.magOtherUniversity = False

        if self.hasJob:
            self.getJob = False
        else:
            self.changeJob = False

        if not self.hasJob:
            self.currentCompany = ""
            self.currentPost = ""

        if not self.hadJobBeforePractise:
            self.companyBeforePractise = ""
            self.postBeforePractise = ""

        if not self.getJob:
            self.getJobCompany = ""
            self.getJobPost = ""

        if not self.changeJob:
            self.changeJobCompany = ""
            self.changeJobPost = ""

        if not self.magOtherUniversity:
            self.otherUniversityName = ""

        if not self.other:
            self.otherText = ""

        super(Questionnaire, self).save(force_insert, force_update, using, update_fields)

    class Meta:
        default_permissions = ()
        permissions = (
            ("change_questionnaire", "Позволяет изменять анкеты выпускников"),
            ("delete_questionnaire", "Позволяет удалять анкеты выпускников"),
        )

