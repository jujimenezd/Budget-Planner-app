import { Formik } from "formik";
import * as Yup from "yup";
import InputLabel from "../components/InputLabel";
import { Link, useNavigate, useLocation } from "react-router-dom";
import { useEffect, useState } from "react";

function Login() {
  const navigate = useNavigate();
  const location = useLocation();
  const [showMessage, setShowMessage] = useState(false);

  // Mostrar mensaje si el usuario fue redirigido desde una ruta protegida
  useEffect(() => {
    if (location.state && location.state.fromProtectedRoute) {
      setShowMessage(true);
    }
  }, [location]);

  const initialValues = {
    email: "",
    password: "",
  };
  // validaciones para el formulario
  const validationSchema = Yup.object({
    email: Yup.string()
      .matches(
        /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        "El correo electrónico no es válido"
      )
      .required("El correo electrónico es requerido"),
    password: Yup.string()
      .min(5, "minimo 5 caracteres")
      .max(15, "maximo 15 caracteres")
      .required("La contraseña es requerida"),
  });

  const login = (values) => {
    console.log(values);
    fetch("http://127.0.0.1:8000/api/auth/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(values),
    })
      .then((response) => {
        console.log("response", response);
        const status = response.status;
        // desestructuramos la respuesta en data y status para validar si la respuesta fue exitosa o no
        return response.json().then((data) => ({ data, status }));
      })
      .then((result) => {
        console.log("data", result.data);
        if (result.status === 200) {
          // Guardamos el token y los datos del usuario en el localstorage
          localStorage.setItem("token", result.data.token);
          localStorage.setItem("user", JSON.stringify(result.data.user));

          // lanza un evento para notificar el cambio en la autenticacion
          window.dispatchEvent(new Event("loginStatusChange"));

          navigate("/dashboard");
        }
      })
      .catch((error) => {
        console.log("error de inicio de sesion", error);
      });
  };
  return (
    <div className="container d-flex justify-content-center align-items-center">
      <Formik
        initialValues={initialValues}
        onSubmit={login}
        validationSchema={validationSchema}
      >
        {({ values, errors, handleChange, handleSubmit }) => (
          <form
            onSubmit={login}
            className="bg-dark-subtle text-dark-emphasis rounded-3 p-3 w-50"
          >
            <h3 className="text-center mb-2">Inicia sesión</h3>

            {showMessage && (
              <div className="alert alert-warning">
                Debes iniciar sesión para acceder a esta sección
              </div>
            )}

            <InputLabel
              name="email"
              type="email"
              label="Correo electrónico"
              id="email"
              placeholder="example@example.com"
              error={errors.email}
              onChange={handleChange}
              value={values.email}
            />
            <InputLabel
              name="password"
              type="password"
              label="Contraseña"
              id="password"
              placeholder="Ingrese su contraseña"
              error={errors.password}
              onChange={handleChange}
              value={values.password}
            />

            <button
              type="submit"
              className="btn btn-primary w-100"
              onClick={handleSubmit}
            >
              Iniciar sesión
            </button>
            <p className="text-center mt-2">
              No tienes una cuenta? <Link to="/register">Regístrate</Link>
            </p>
          </form>
        )}
      </Formik>
    </div>
  );
}

export default Login;
