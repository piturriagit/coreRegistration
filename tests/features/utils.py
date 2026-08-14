import os

def take_screenshot(context, nombre):

    if os.getenv("SCREENSHOTS", "false").lower() == "false":
        return
    tags = context.scenario.tags
    if tags:
        test_id = tags[0]
    else:
        test_id = "test.???"

    i = context.screenshot_id
    ruta = os.path.join(
        context.screenshot_dir,
        f"{test_id}_{i}_{nombre}.png"
    )
    context.screenshot_id += 1
    
    context.driver.save_screenshot(ruta)

    print(f"Captura guardada: {ruta}")