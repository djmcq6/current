import yfinance as yf

# Replace 'AAPL' with the desired stock ticker symbol
ticker = yf.Ticker('AAPL')

# Get options data for the specified expiration date
options_data = ticker.options

print(options_data)
