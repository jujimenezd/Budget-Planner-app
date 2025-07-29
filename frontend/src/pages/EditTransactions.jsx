import React, { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import InputFormTransaction from "../components/InputFormTransaction";
import SelectFormTransactions from "../components/SelectFormTransactions";

function EditTransactions() {
  const baseUrl = "http://127.0.0.1:8000/api";
  const { id } = useParams();
  const navigate = useNavigate();

  // valores que se van a mostrar en el formulario para editarlos
  const [description, setDescription] = useState("");
  const [amount, setAmount] = useState(0);
  const [transactionType, setTransactionType] = useState("");
  const [category, setCategory] = useState("");
  const [transactionDate, setTransactionDate] = useState("");

  // aca se guardan las categorias traidas desde la api para modificar el estado de la categoria actual
  const [categories, setCategories] = useState([]);

  // obtenemos el token y el usuario desde el localstorage
  const token = localStorage.getItem("token");
  const user = JSON.parse(localStorage.getItem("user"));

  // valores para actualizar la transaccion y enviarlos a la api
  const values = {
    amount: amount,
    transaction_type: transactionType,
    description: description,
    transaction_date: transactionDate,
    user_id: user.id,
    category_id: category,
  };

  const getTransactionId = () => {
    fetch(`${baseUrl}/transactions/${id}`, {
      method: "GET",
      headers: {
        "Content-type": "application/json",
        Authorization: token ? `Bearer ${token}` : "",
      },
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        setAmount(data.amount);
        setTransactionType(data.transaction_type);
        setDescription(data.description);
        setTransactionDate(data.transaction_date);
        setCategory(data.category_id);
      });
  };

  const getCategories = () => {
    fetch(`${baseUrl}/categories`)
      .then((response) => response.json())
      .then((data) => {
        console.log("respuesta categorias", data);
        setCategories(data);
      })
      .catch((error) => {
        console.error("Error al obtener las categorías", error);
      });
  };

  const updateTransaction = () => {
    fetch(`${baseUrl}/transactions/${id}`, {
      method: "PUT",
      headers: {
        "Content-type": "application/json",
        Authorization: token ? `Bearer ${token}` : "",
      },
      body: JSON.stringify(values),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        navigate("/transactions");
      })
      .catch((error) => {
        console.error("Error al actualizar la transacción", error);
      });
  };
  useEffect(() => {
    getTransactionId();
    getCategories();
  }, []);

  return (
    <div className="container mt-3">
      <h1 className="text-center mb-5 text-white">Editar transacción {id}</h1>
      <div className="row mb-5">
        <div className="col-md-6 bg-light rounded-3">
          <form className="form-group mb-3 p-3">
            <h4 className="text-center mb-3 text-gray-600">
              Actualizar transacción
            </h4>
            <div className="row text-gray-600 fw-semibold">
              <InputFormTransaction
                labelName="Descripcion"
                type="text"
                id="description"
                placeholder="Descripción"
                value={description}
                onChange={(e) => {
                  return setDescription(e.target.value);
                }}
              />
              <InputFormTransaction
                labelName="Monto"
                type="number"
                id="amount"
                placeholder="Monto"
                value={amount}
                onChange={(e) => {
                  return setAmount(e.target.value);
                }}
              />
              <SelectFormTransactions
                labelName="Tipo de transaccion"
                id="transactionType"
                value={transactionType}
                onChange={(e) => {
                  return setTransactionType(e.target.value);
                }}
                options={[
                  { value: "income", label: "Ingreso" },
                  { value: "expense", label: "Gasto" },
                ]}
              />

              <SelectFormTransactions
                labelName="Categoría"
                id="category"
                value={category}
                onChange={(e) => {
                  return setCategory(e.target.value);
                }}
                options={categories.map((category) => ({
                  value: category.id,
                  label: category.name,
                }))}
              />

              <InputFormTransaction
                labelName="Fecha"
                type="date"
                id="transactionDate"
                placeholder="Fecha"
                value={transactionDate}
                onChange={(e) => {
                  return setTransactionDate(e.target.value);
                }}
              />
              <div className="col-md-12">
                <button
                  className="btn w-100 text-white fw-semibold py-2 shadow-lg custom-gradient-btn"
                  type="button"
                  onClick={updateTransaction}
                >
                  Actualizar transacción
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}

export default EditTransactions;
