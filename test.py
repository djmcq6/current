import pandas as pd
import yfinance as yf
import mysql.connector
from datetime import datetime

# Connect to MySQL database
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="website"
)

mycursor = mydb.cursor()

# List of tickers
tickers = [
    '^TYX'
]

# Iterate through each ticker
for ticker in tickers:
    # Fetch data using yfinance
    data = yf.download(ticker)

    # Insert data into MySQL table without checking for duplicates
    num_rows = 0
    for index, row in data.iterrows():
        formatted_date = index.strftime('%Y-%m-%d %H:%M:%S')  # Convert timestamp to the desired format

        # Insert the record without checking for duplicates
        sql_insert = "INSERT INTO ticker_ohlcav (date_ohlcav, ticker_ohlcav, open, high, low, close, adj_close, volume) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
        val_insert = (formatted_date, ticker, float(row['Open']), float(row['High']), float(row['Low']), float(row['Close']), float(row['Adj Close']), float(row['Volume']))
        mycursor.execute(sql_insert, val_insert)
        num_rows += 1

    mydb.commit()

    print(f"{num_rows} record(s) inserted for {ticker}.")
