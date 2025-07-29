import { Navigate, Outlet } from "react-router-dom";

const ProtectedRoute = () => {
  const isAuthenticated = localStorage.getItem("token") !== null;

  if (!isAuthenticated) {
    // Redireccionar al login con información de que viene de una ruta protegida
    return (
      <Navigate to="/login" replace state={{ fromProtectedRoute: true }} />
    );
  }

  // Si está autenticado, renderizar los componentes hijos
  return <Outlet />;
};

export default ProtectedRoute;
