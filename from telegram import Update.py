from telegram import Update
from telegram.ext import Updater, CommandHandler, MessageHandler, Filters, CallbackContext


Token = "8039204890:AAGunDb5W6kM4HQ1vB7_Mlzqrfj9-KZ92QA"

def start(update: Update, context: CallbackContext) -> None:
  update.message.reply_text("Привет! Я твой бот. Напиши мне что-нибудь!")

def echo(update: Update, context: CallbackContext) -> None:
  update.message.reply_text(update.message.text)

def main():
  updater = Updater(Token, use_context=True)
  dp = updater.dispatcher

  dp.add_handler(CommandHandler("start", start))
  dp.add_handler(MessageHandler(Filters.text & ~Filters.command, echo))

  updater.start_polling()
  updater.idle()

  if __name__ == "__main__":
    main()