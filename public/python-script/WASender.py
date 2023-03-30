import pywhatkit
import time 
import pyautogui
from pynput.keyboard import Key, Controller
from selenium import webdriver

keyboard = Controller()

def send_message(data):
    # take noTelp from data
    noTelp = data['noTelp']
    # take msg from data
    msg = data['msg']

    try:
        driver = webdriver.Safari()
        # driver.get("https://web.whatsapp.com/")
        # time.sleep(20) # wait for user to scan the QR code

        # Get the cookie and add it to the driver instance
        cookies = driver.get_cookies()

        for cookie in cookies:
            driver.add_cookie(cookie)
        # Open the same URL again
        driver.get("https://web.whatsapp.com/")

        pywhatkit.sendwhatmsg_instantly(noTelp, msg, 10 ,tab_close=True)
        time.sleep(5)
        pyautogui.click()
        time.sleep(2)
        keyboard.press(Key.enter)
        keyboard.release(Key.enter)
        print('Success Sending Message to ' + noTelp)

        driver.quit()
    except Exception as e:
        print(str(e))
        print('Error')







# Backup code
# import pywhatkit
# import time 
# import pyautogui
# from pynput.keyboard import Key, Controller
# from selenium import webdriver

# keyboard = Controller()

# def send_message(msg: str):
#     noTelp = '+6288275169992'

#     try:
#         driver = webdriver.Safari()
#         # driver.get("https://web.whatsapp.com/")
#         # time.sleep(20) # wait for user to scan the QR code

#         # Get the cookie and add it to the driver instance
#         cookies = driver.get_cookies()

#         for cookie in cookies:
#             driver.add_cookie(cookie)
#         # Open the same URL again
#         driver.get("https://web.whatsapp.com/")

#         pywhatkit.sendwhatmsg_instantly(noTelp, msg, 10 ,tab_close=True)
#         time.sleep(5)
#         pyautogui.click()
#         time.sleep(2)
#         keyboard.press(Key.enter)
#         keyboard.release(Key.enter)
#         print('Success Sending Message to ' + noTelp)

#         driver.quit()
#     except Exception as e:
#         print(str(e))
#         print('Error')


# if __name__ == '__main__':
#     pesan = 'janji ni yang terakhir kok kel, harusnya da bisa'
#     send_message(pesan)
