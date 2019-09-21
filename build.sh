echo
echo Installing Dependencies...
composer install
echo
echo Enforcing Code Style and Code Quality...
cp git/pre-commit .git/hooks
git/pre-commit
echo
echo Building Docker Containers...
docker-compose up
