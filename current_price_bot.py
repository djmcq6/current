import mysql.connector
import yfinance as yf
import datetime

# Connect to MySQL database
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="website"
)

mycursor = mydb.cursor()

# Fetch tickers from the database
mycursor.execute("SELECT ticker_name FROM tickers")
tickers = [ticker[0] for ticker in mycursor.fetchall()]

try:
    for ticker in tickers:
        # Download historical data for the ticker
        data = yf.download(ticker, period='1d', interval='1m')

        if 'Close' in data:  # Check if 'Close' data is available
            # Get the most recent close price
            current_price = data['Close'].iloc[-1]

            # Round to the nearest 2 decimal places
            current_price = round(current_price, 2)

            # Get the current timestamp
            current_timestamp = datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')

            # Update the current_price in the database
            update_query = f"UPDATE tickers SET current_price = {current_price} WHERE ticker_name = '{ticker}'"
            mycursor.execute(update_query)

            # Update the price_timestamp in the database
            timestamp_query = f"UPDATE tickers SET price_timestamp = '{current_timestamp}' WHERE ticker_name = '{ticker}'"
            mycursor.execute(timestamp_query)

            mydb.commit()

            print(f"Updated {ticker} - Current Price: {current_price}, Timestamp: {current_timestamp}")
        else:
            print(f"No 'Close' data found for {ticker}")
except Exception as e:
    print(f"Error updating ticker: {e}")

# Close the database connection
mydb.close()
