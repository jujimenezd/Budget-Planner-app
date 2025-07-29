import { Formik } from "formik";
import * as Yup from "yup";

import InputLabel from "../components/InputLabel";
import { Link } from "react-router-dom";

import { useNavigate } from "react-router-dom";

function Register() {
  const navigate = useNavigate();

  // valores iniciales del formulario
  const initialValues = {
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
  };

  // validaciones para el formulario
  const validationSchema = Yup.object({
    name: Yup.string()
      .min(3, "minimo 3 letras")
      .required("El nombre es requerido"),
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
    password_confirmation: Yup.string()
      .oneOf([Yup.ref("password"), null], "Las contraseñas no coinciden")
      .required("La confirmación de la contraseña es requerida"),
  });

  const register = (values) => {
    console.log(values);
    fetch("http://127.0.0.1:8000/api/auth/register", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(values),
    })
      .then((response) => {
        console.log("response", response);
        const status = response.status;
        return response.json().then((data) => ({ data, status }));
      })
      .then((result) => {
        console.log("data", result.data);
        if (result.status === 201) {
          localStorage.setItem("token", result.data.token);
          localStorage.setItem("user", JSON.stringify(result.data.user));

          // lanza un evento para notificar el cambio en la autenticacion
          window.dispatchEvent(new Event("loginStatusChange"));

          navigate("/dashboard");
        }
      })
      .catch((error) => {
        console.log("error de registro", error);
      });
  };

  return (
    <div className="container d-flex justify-content-center align-items-center">
      <Formik
        initialValues={initialValues}
        onSubmit={register}
        validationSchema={validationSchema}
      >
        {({ values, errors, handleChange, handleSubmit }) => (
          <form
            onSubmit={register}
            className="bg-dark-subtle text-dark-emphasis rounded-3 p-3 w-50"
          >
            <h3 className="text-center mb-2">Registrate</h3>
            <InputLabel
              name="name"
              type="text"
              label="Nombre"
              id="name"
              placeholder="Ingrese su nombre"
              error={errors.name}
              onChange={handleChange}
              value={values.name}
            />
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
            <InputLabel
              name="password_confirmation"
              type="password"
              label="Confirmar contraseña"
              id="password_confirmation"
              placeholder="Ingrese de nuevo su contraseña"
              error={errors.password_confirmation}
              onChange={handleChange}
              value={values.password_confirmation}
            />
            <button
              type="submit"
              className="btn btn-primary w-100"
              onClick={handleSubmit}
            >
              Registrarme
            </button>
            <p className="text-center mt-2">
              Ya tienes una cuenta? <Link to="/login">Inicia sesión</Link>
            </p>
          </form>
        )}
      </Formik>
    </div>
  );
}

export default Register;
