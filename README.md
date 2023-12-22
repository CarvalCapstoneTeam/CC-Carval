# CC-Carval

This is a branch for developing a RESTful API using [Flask](https://flask.palletsprojects.com/en/3.0.x/) to make predictions with machine learning models and deploying it using [Google Cloud Run](https://cloud.google.com/run). Later, the results will be passed back to the Laravel app in branch [main](https://github.com/CarvalCapstoneTeam/CC-Carval/tree/main).

You can see the results that have been deployed in:
https://predict-lhp755lcvq-uc.a.run.app
 
## Requirements
Install python (we use python 3.10)

## How to run
- Clone the repository
 
        git clone https://github.com/CarvalCapstoneTeam/CC-Carval.git carval-flask

- Switch to the repo folder

        cd carval-flask
        
- Install all required packages
        
        pip install -r requirements.txt

- Run the server on the local computer

        python main.py
        
- The server is currently running at http://localhost:5000 and you can send a request to make a request at http://localhost:5000/predict
- Example of JSON Request
        
        {
            "title": "Mobile Developer",
            "location": "Jakarta, Indonesia",
            "department": "Information Technology",
            "salary_range": "80000-100000",
            "company_profile": "Carval is a startup company...",
            "description": "We need a mobile developer with experience...",
            "requirements": "Have 3 years of experience...",
            "benefits": "Great salary, flexible working hours....",
            "telecommuting": 0
        }

- Example of JSON Response:

        {
            "error": false,
            "message": "Data predicted successfully",
            "predictionResult": {
                "fake_probability": 79.2,
                "prediction": "Fake",
                "real_probability": 20.8
            }
        }