import React, { useState, useEffect } from "react";
import InputFormTransaction from "../components/InputFormTransaction";
import SelectFormTransactions from "../components/SelectFormTransactions";
import { Link } from "react-router-dom";

function Transactions() {
  const [transactions, setTransactions] = useState([]);
  const [description, setDescription] = useState("");
  const [amount, setAmount] = useState(0);
  const [transactionType, setTransactionType] = useState("");
  const [transactionDate, setTransactionDate] = useState("");
  const [category, setCategory] = useState("");

  // guardar categorias desde la api
  const [categories, setCategories] = useState([]);

  // obtenemos el usuario desde el localstorage
  const user = JSON.parse(localStorage.getItem("user"));

  const values = {
    amount: amount,
    transaction_type: transactionType,
    description: description,
    transaction_date: transactionDate,
    user_id: user.id,
    category_id: category,
  };

  // url base de la api y adicionalmente el token de autenticacion guardado en el localstorage
  const baseUrl = "http://127.0.0.1:8000/api";
  const token = localStorage.getItem("token");

  // Enviar transaccion a la api cuando el usuario haga click en el boton de agregar transaccion
  const SendTransaction = () => {
    const resetFormFields = () => {
      setDescription("");
      setAmount(0);
      setTransactionType("");
      setCategory("");
      setTransactionDate("");
    };
    fetch(`${baseUrl}/transactions`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: token ? `Bearer ${token}` : "",
      },
      body: JSON.stringify(values),
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        // actualizamos el estado de las transacciones, agregando la nueva transaccion creada
        if (transactions.length === 0) {
          setTransactions([data]);
        } else {
          setTransactions([...transactions, data]);
        }
        resetFormFields();
        navigate("/");
      })
      .catch((error) => {
        console.error("error al momento de crear la transaccion", error);
      });
  };

  const getTransactions = (baseUrl, token) => {
    fetch(`${baseUrl}/transactions`, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        // se envia el token para que el servidor nos retorne las transacciones del usuario autenticado
        Authorization: token ? `Bearer ${token}` : "",
      },
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        setTransactions(data);
      })
      .catch((error) => {
        console.error("error al momento de obtener las transacciones", error);
      });
  };

  const getCategories = (baseUrl) => {
    fetch(`${baseUrl}/categories`, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        setCategories(data);
      })
      .catch((error) => {
        console.error("error al momento de obtener las categorias", error);
      });
  };

  const deleteTransaction = (id) => {
    fetch(`${baseUrl}/transactions/${id}`, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        Authorization: token ? `Bearer ${token}` : "",
      },
    })
      .then((data) => {
        getTransactions(baseUrl, token);
      })
      .catch((error) => {
        console.error("error al momento de eliminar la transaccion", error);
      });
  };

  // useEffect para ejecutar las funciones almacenadas en las constantes
  useEffect(() => {
    getTransactions(baseUrl, token);
    getCategories(baseUrl);
  }, []);

  return (
    <div className="container mt-3">
      <h1 className="text-center mb-5 text-white">Transacciones</h1>
      <div className="row mb-5">
        <div className="col-md-6 bg-light rounded-3">
          <form className="form-group mb-3 p-3">
            <h4 className="text-center mb-3 text-gray-600">
              Agregar ingresos o gastos
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
                  onClick={SendTransaction}
                >
                  Agregar transacción
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div className="row">
        <div className="col-md-12">
          <table className="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Monto</th>
                <th>Tipo</th>
                <th>Categoría</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {transactions.map((transaction) => {
                return (
                  <tr key={transaction.id}>
                    <td>{transaction.id}</td>
                    <td>{transaction.description}</td>
                    <td>{transaction.amount}</td>
                    <td>{transaction.transaction_type}</td>
                    <td>
                      {
                        categories.find(
                          (category) => category.id === transaction.category_id
                        )?.name
                      }
                    </td>
                    <td>{transaction.transaction_date}</td>
                    <td>
                      <Link
                        className="btn btn-primary me-2"
                        to={`/transactions/edit/${transaction.id}`}
                      >
                        <i className="bi bi-pencil-square">Editar</i>
                      </Link>
                      <button
                        className="btn btn-danger me-2"
                        type="button"
                        onClick={() => deleteTransaction(transaction.id)}
                      >
                        <i className="bi bi-trash"> Eliminar</i>
                      </button>
                    </td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
}

export default Transactions;
