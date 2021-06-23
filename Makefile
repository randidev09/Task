setup:
	gnome-terminal -- make setup_frontend && make setup_backend

build_frontend:
	cd frontend && make build

setup_frontend:
	cd frontend && make setup

setup_backend:
	cd backend && make setup