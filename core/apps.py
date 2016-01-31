from django.apps import AppConfig
from core.models import StudyStage


class CoreConfig(AppConfig):
    name = 'core'

    def __init__(self, app_name, app_module):
        super().__init__(app_name, app_module)


