setup:
	gnome-terminal -- make setup_frontend && make setup_backend

destroy:
	gnome-terminal -- make destroy_frontend && make destroy_backend

build_frontend:
	cd frontend && make build

setup_frontend:
	cd frontend && make setup

setup_backend:
	cd backend && make setup

destroy_frontend:
	cd frontend && make destroy

destroy_backend:
	cd backend && make destroy