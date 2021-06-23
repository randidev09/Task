setup:
	gnome-terminal -- make setup_frontend && make setup_backend

setup_frontend:
	cd frontend && make setup

setup_backend:
	cd backend && make setup