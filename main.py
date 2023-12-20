from flask import Flask, request, jsonify
import pickle
from keras.models import load_model
from keras.preprocessing.sequence import pad_sequences
from nltk.stem import WordNetLemmatizer
from nltk.tokenize import word_tokenize
import nltk
import asyncio

app = Flask(__name__)

nltk.download('wordnet')
nltk.download('punkt')

token = 'token.pickle'

with open(token, 'rb') as token_file:
    credentials = pickle.load(token_file)

model = load_model('model.h5')
lemmatizer = WordNetLemmatizer()

def preprocess_text(text):
    words_list = word_tokenize(text)
    lemmas = [lemmatizer.lemmatize(word.lower(), pos='v') for word in words_list]
    return ' '.join(lemmas)

async def predict_async(data):
    title = data.get('title', '')
    location = data.get('location', '')
    department = data.get('department')
    salary_range = data.get('salary_range', '')
    company_profile = data.get('company_profile', '')
    description = data.get('description', '')
    requirements = data.get('requirements', '')
    benefits = data.get('benefits', '')
    telecommuting = data.get('telecommuting', '')

    text = f"{title} {location} {department} {salary_range} {company_profile} {description} {requirements} {benefits} {telecommuting}"

    processed_text = preprocess_text(text)
    train_wordemb2 = credentials.texts_to_sequences([processed_text])
    train_wordemb2 = pad_sequences(train_wordemb2, padding='post', maxlen=100)

    prediction = model.predict(train_wordemb2)
    real_probability = round(prediction[0, 0] * 100, 1)
    fake_probability = round(100 - real_probability, 1)

    result = 'Fake' if fake_probability >= 50 else 'Real'

    return {
        'error': False,
        'message': 'Data predicted successfully',
        'predictionResult': {
            'prediction': result,
            'fake_probability': fake_probability,
            'real_probability': real_probability
        }
    }

@app.route('/', methods=['GET'])
def welcome():
    return "OK"

@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.get_json(force=True)
        loop = asyncio.new_event_loop()
        asyncio.set_event_loop(loop)
        result = loop.run_until_complete(predict_async(data))
        return jsonify(result)
    except Exception as e:
        error_message = str(e)
        return jsonify({
            'error': True,
            'message': error_message
        }), 500

if __name__ == '__main__':
    app.run(debug=True)