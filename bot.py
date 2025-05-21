from telegram import Update
from telegram.ext import Application, CommandHandler, MessageHandler, filters, CallbackContext

TOKEN = "8039204890:AAGunDb5W6kM4HQ1vB7_Mlzqrfj9-KZ92QA"

async def start(update: Update, context: CallbackContext) -> None:
    await update.message.reply_text("Привет! Я твой бот. Напиши мне что-нибудь!")

async def echo(update: Update, context: CallbackContext) -> None:
    await update.message.reply_text(update.message.text)

def main():
    app = Application.builder().token(TOKEN).build()

    app.add_handler(CommandHandler("start", start))
    app.add_handler(MessageHandler(filters.TEXT & ~filters.COMMAND, echo))

    print("Бот запущен!")
    app.run_polling()

if __name__ == "__main__":
    main()
