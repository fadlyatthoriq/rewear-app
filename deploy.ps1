# Railway Deployment Script for Windows PowerShell

Write-Host "🚀 Starting Railway Deployment for Rewear App..." -ForegroundColor Green

# Check if git is initialized
if (-not (Test-Path ".git")) {
    Write-Host "❌ Git repository not found. Please initialize git first:" -ForegroundColor Red
    Write-Host "   git init" -ForegroundColor Yellow
    Write-Host "   git add ." -ForegroundColor Yellow
    Write-Host "   git commit -m 'Initial commit'" -ForegroundColor Yellow
    Write-Host "   git remote add origin YOUR_GITHUB_REPO_URL" -ForegroundColor Yellow
    Write-Host "   git push -u origin main" -ForegroundColor Yellow
    exit 1
}

# Check if all required files exist
Write-Host "📋 Checking required files..." -ForegroundColor Cyan

$requiredFiles = @("Procfile", "railway.json", "nixpacks.toml", "composer.json")
foreach ($file in $requiredFiles) {
    if (-not (Test-Path $file)) {
        Write-Host "❌ Required file $file not found!" -ForegroundColor Red
        exit 1
    }
}

Write-Host "✅ All required files found!" -ForegroundColor Green

# Check if .env exists
if (-not (Test-Path ".env")) {
    Write-Host "⚠️  .env file not found. Please create one based on .env.example" -ForegroundColor Yellow
    Write-Host "   Copy .env.example to .env" -ForegroundColor Yellow
    Write-Host "   Then edit .env with your configuration" -ForegroundColor Yellow
    exit 1
}

# Check git status
Write-Host "📊 Checking git status..." -ForegroundColor Cyan
$gitStatus = git status --porcelain
if ($gitStatus) {
    Write-Host "⚠️  You have uncommitted changes. Please commit them first:" -ForegroundColor Yellow
    Write-Host "   git add ." -ForegroundColor Yellow
    Write-Host "   git commit -m 'Update for deployment'" -ForegroundColor Yellow
    Write-Host "   git push" -ForegroundColor Yellow
} else {
    Write-Host "✅ Working directory is clean" -ForegroundColor Green
}

Write-Host ""
Write-Host "🎯 Next Steps:" -ForegroundColor Green
Write-Host "1. Go to https://railway.app" -ForegroundColor White
Write-Host "2. Sign up/Login with your GitHub account" -ForegroundColor White
Write-Host "3. Click 'New Project' → 'Deploy from GitHub repo'" -ForegroundColor White
Write-Host "4. Select your repository" -ForegroundColor White
Write-Host "5. Add PostgreSQL database service" -ForegroundColor White
Write-Host "6. Configure environment variables (see DEPLOYMENT.md)" -ForegroundColor White
Write-Host "7. Deploy!" -ForegroundColor White
Write-Host ""
Write-Host "📖 For detailed instructions, see DEPLOYMENT.md" -ForegroundColor Cyan
Write-Host ""
Write-Host "🔧 Manual deployment commands:" -ForegroundColor Yellow
Write-Host "   git add ." -ForegroundColor White
Write-Host "   git commit -m 'Prepare for Railway deployment'" -ForegroundColor White
Write-Host "   git push origin main" -ForegroundColor White 