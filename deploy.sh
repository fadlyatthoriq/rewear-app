#!/bin/bash

echo "🚀 Starting Railway Deployment for Rewear App..."

# Check if git is initialized
if [ ! -d ".git" ]; then
    echo "❌ Git repository not found. Please initialize git first:"
    echo "   git init"
    echo "   git add ."
    echo "   git commit -m 'Initial commit'"
    echo "   git remote add origin YOUR_GITHUB_REPO_URL"
    echo "   git push -u origin main"
    exit 1
fi

# Check if all required files exist
echo "📋 Checking required files..."

required_files=("Procfile" "railway.json" "nixpacks.toml" "composer.json")
for file in "${required_files[@]}"; do
    if [ ! -f "$file" ]; then
        echo "❌ Required file $file not found!"
        exit 1
    fi
done

echo "✅ All required files found!"

# Check if .env exists
if [ ! -f ".env" ]; then
    echo "⚠️  .env file not found. Please create one based on .env.example"
    echo "   cp .env.example .env"
    echo "   Then edit .env with your configuration"
    exit 1
fi

# Check git status
echo "📊 Checking git status..."
if [ -n "$(git status --porcelain)" ]; then
    echo "⚠️  You have uncommitted changes. Please commit them first:"
    echo "   git add ."
    echo "   git commit -m 'Update for deployment'"
    echo "   git push"
else
    echo "✅ Working directory is clean"
fi

echo ""
echo "🎯 Next Steps:"
echo "1. Go to https://railway.app"
echo "2. Sign up/Login with your GitHub account"
echo "3. Click 'New Project' → 'Deploy from GitHub repo'"
echo "4. Select your repository"
echo "5. Add PostgreSQL database service"
echo "6. Configure environment variables (see DEPLOYMENT.md)"
echo "7. Deploy!"
echo ""
echo "📖 For detailed instructions, see DEPLOYMENT.md"
echo ""
echo "🔧 Manual deployment commands:"
echo "   git add ."
echo "   git commit -m 'Prepare for Railway deployment'"
echo "   git push origin main" 