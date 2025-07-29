import { useState, useEffect } from "react";

function Main() {
  const [transactions, setTransactions] = useState([]);

  const baseUrl = "http://127.0.0.1:8000/api";
  const token = localStorage.getItem("token");
  const user = JSON.parse(localStorage.getItem("user"));

  console.log("user", user);

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

  useEffect(() => {
    getTransactions(baseUrl, token);
  }, []);

  return (
    <div className="container">
      <div className="col-md-6">
        <div className="row">
          <h1 className="text-light">Mi Actividad {user.name}</h1>
          <table className="table">
            <thead>
              <tr>
                <th scope="col">Descripcion</th>
                <th scope="col">Categoria</th>
                <th scope="col">Monto</th>
                <th scope="col">Presupuesto</th>
                <th scope="col">Fecha</th>
              </tr>
            </thead>
            <tbody>
              {transactions.map((transaction) => (
                <tr key={transaction.id}>
                  <td>{transaction.description}</td>
                  <td>{transaction.category.name}</td>
                  <td>{transaction.amount}</td>
                  <td>
                    {transaction.category.budgets.length > 0
                      ? transaction.category.budgets[0].limit
                      : "Sin presupuesto"}
                  </td>
                  <td>{transaction.transaction_date}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
}

export default Main;
