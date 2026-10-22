from flask import Flask, jsonify, request
from flask_cors import CORS

app = Flask(__name__)
CORS(app)  # Ativa o CORS para permitir requisições do front-end

# Lista inicial de projetos para simular a base de dados
projetos = [
    {"nome": "Portfólio Interativo", "tecnologia": "HTML, CSS & JS", "status": "Concluído"},
    {"nome": "API de Gestão com Flask", "tecnologia": "Python & Flask", "status": "Em Andamento"}
]

# Rota GET para listar os projetos
@app.route('/projetos', methods=['GET'])
def listar_projetos():
    return jsonify(projetos), 200

# Rota POST para cadastrar um novo projeto
@app.route('/projetos', methods=['POST'])
def cadastrar_projeto():
    dados = request.get_json() # Recebe os dados em JSON enviados pelo HTML
    
    novo_projeto = {
        "nome": dados.get("nome"),
        "tecnologia": dados.get("tecnologia"),
        "status": dados.get("status")
    }
    projetos.append(novo_projeto)
    
    return jsonify({'mensagem': 'Projeto cadastrado com sucesso!', 'projeto': novo_projeto}), 201

if __name__ == '__main__':
    app.run(debug=True)