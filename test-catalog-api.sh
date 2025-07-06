#!/bin/bash
set -e

# Aller dans le répertoire backend
cd /workspaces/php/monorepo/backend

# Compiler le projet
echo "🔨 Compilation du backend..."
npm run build

# Démarrer le serveur en arrière-plan
echo "🚀 Démarrage du serveur..."
node dist/main.js &
SERVER_PID=$!

# Attendre que le serveur démarre
echo "⏳ Attente du démarrage du serveur..."
sleep 10

# Tester l'API
echo "🧪 Test de l'API catalog..."
curl -i http://localhost:3000/api/catalog

# Arrêter le serveur
echo "🛑 Arrêt du serveur..."
kill $SERVER_PID

echo "✅ Test terminé."
