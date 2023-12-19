# Python image to use.
FROM python:3.10-slim

ENV PYTHONUNBUFFERED True

# Copy the local code to the container image
ENV APP_HOME /app
WORKDIR $APP_HOME
COPY . ./

# Install all required packages specified in requirements.txt
RUN pip install -r requirements.txt

# Run web service on container using gunicorn
CMD exec gunicorn --bind :$PORT --workers 1 --threads 8 --timeout 0 main:app