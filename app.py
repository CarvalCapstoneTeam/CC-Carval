from flask import Flask, request, jsonify
import pickle
from keras.models import load_model
from keras.preprocessing.sequence import pad_sequences
from nltk.stem import WordNetLemmatizer

app = Flask(__name__)

token = 'token.pickle'

with open(token, 'rb') as token_file:
    credentials = pickle.load(token_file)

model = load_model('model.h5')

lemmatizer = WordNetLemmatizer()

@app.route('/', methods=['GET'])
def welcome():
    return "Hello World"

@app.route('/predict', methods=['POST'])
def predict():
    data = request.get_json(force=True)

    text = ""
    for _, value in data.items():
        text += str(value) + " "
    text = text.rstrip()

    words_list = []
    for i in text :
        words_list.extend(text.split())

    lemmas = [lemmatizer.lemmatize(word.lower(), pos='v') for word in words_list]
    train_wordemb2 = credentials.texts_to_sequences([lemmas])
    train_wordemb2 = pad_sequences(train_wordemb2, padding='post', maxlen=100)
    
    prediction = model.predict(train_wordemb2)
    fake_probability = round(prediction[0, 0] * 100, 1)
    real_probability = round(100 - fake_probability, 1)

    if fake_probability >= 50:
        result = 'Fake'
    else:
        result = 'Real'
        
    return jsonify({
        'prediction': result,
        'fake_probability': fake_probability,
        'real_probability': real_probability
    })

if __name__ == '__main__':
    app.run(port=5000, debug=True)