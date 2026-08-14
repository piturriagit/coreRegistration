from selenium import webdriver
import os
from datetime import datetime

from features.utils import take_screenshot

def before_all(context):
    timestamp = datetime.now().strftime("%Y%m%d_%H%M%S")

    context.screenshot_dir = os.path.join(
        "screenshots",
        f"run_{timestamp}"
    )

    if os.getenv("SCREENSHOTS", "false").lower() == "true":
        os.makedirs(context.screenshot_dir, exist_ok=True)
        print(f"📁 Carpeta de screenshots: {context.screenshot_dir}")
    else:
        print("⚠️  La variable de entorno SCREENSHOTS no está activada. No se guardarán capturas de pantalla.")

def before_scenario(context, scenario):
    context.driver = webdriver.Chrome()
    context.screenshot_id = 1

def after_scenario(context, scenario):
    if scenario.status == "failed":
        take_screenshot(context, "FAILED")

    context.driver.quit()