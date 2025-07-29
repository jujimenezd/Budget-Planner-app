import { Link, useNavigate, useLocation } from "react-router-dom";
import { useEffect, useState } from "react";

function Header() {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const navigate = useNavigate();
  const location = useLocation();

  // Función para comprobar si el usuario está autenticado
  const checkUserLoggedIn = () => {
    const token = localStorage.getItem("token");
    setIsLoggedIn(!!token);
  };

  // verifica si el usuario esta autenticado al cargar el componente y cuando cambia la ruta
  useEffect(() => {
    checkUserLoggedIn();
  }, [location]);

  // escucha los cambios en localStorage de otras pestañas/ventanas
  useEffect(() => {
    window.addEventListener("storage", checkUserLoggedIn);

    // escucha los cambios en localStorage dentro de la misma página
    window.addEventListener("loginStatusChange", checkUserLoggedIn);

    return () => {
      window.removeEventListener("storage", checkUserLoggedIn);
      window.removeEventListener("loginStatusChange", checkUserLoggedIn);
    };
  }, []);

  const logout = () => {
    // se elimina el token y  los datos del usuario que estan guardados en el localstorage
    localStorage.removeItem("token");
    localStorage.removeItem("user");
    setIsLoggedIn(false);

    // lanza un evento para que los otros componentes lo entiendan
    window.dispatchEvent(new Event("loginStatusChange"));

    navigate("/");
  };

  return (
    <header className="p-3">
      <div className="container container-nav rounded-3 d-flex justify-content-between align-items-center">
        <a className="navbar-brand" href="#">
          <h4 className="text-white">Logo</h4>
        </a>
        <nav className="navbar navbar-expand-lg">
          <div className="container-fluid">
            <button
              className="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarNav"
              aria-controls="navbarNav"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span className="navbar-toggler-icon"></span>
            </button>
            <div className="collapse navbar-collapse" id="navbarNav">
              <ul className="navbar-nav fs-5">
                {isLoggedIn ? (
                  <li className="nav-item">
                    <Link className="nav-link" to="/dashboard">
                      Dashboard
                    </Link>
                  </li>
                ) : (
                  <li className="nav-item">
                    <Link className="nav-link" to="/">
                      Inicio
                    </Link>
                  </li>
                )}
                <li className="nav-item">
                  <Link className="nav-link" to="/transactions">
                    Transacciones
                  </Link>
                </li>
                <li className="nav-item">
                  <Link className="nav-link" to="/categories">
                    Categorías
                  </Link>
                </li>
                <li className="nav-item">
                  <Link className="nav-link" to="/budgets">
                    Presupuestos
                  </Link>
                </li>
                <li className="nav-item">
                  <Link className="nav-link" to="/goals">
                    Metas
                  </Link>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <div className="d-flex align-items-center">
          <div className="d-flex gap-2">
            {isLoggedIn ? (
              <button onClick={logout} className="btn btn-danger">
                Cerrar sesión
              </button>
            ) : (
              <>
                <Link to="/register" className="btn btn-primary">
                  Registrarse
                </Link>
                <Link to="/login" className="btn btn-outline-info">
                  Iniciar sesión
                </Link>
              </>
            )}
          </div>
        </div>
      </div>
    </header>
  );
}

export default Header;
