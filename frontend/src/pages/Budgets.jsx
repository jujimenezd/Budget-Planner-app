import React from 'react'
import { useEffect, useState } from 'react'

function Budgets() {
    const [budgets, setBudgets]=useState([])

    useEffect(function (){
        const token = localStorage.getItem("token");
        fetch('http://127.0.0.1:8000/api/budgets', {
            method: "get",
            headers:{
                "Content-Type":"application/json",
                Authorization: token ? `Bearer ${token}`:"",
            },
        })
        .then(function(response){
            return response.json()
        })
        .then((data)=>setBudgets(data))
    },[]);


  return (
    <div className="container mt-5">
      <h1 className="text-center mb-5 text-white">Presupuestos</h1>
      <div className="row">
        <div className="col-md-6">
          <button className="btn btn-primary mb-3" type="button">
            <i className="bi bi-plus-circle"></i>
            Agregar Presupuesto
          </button>
          <table className="table table-bordered">
            <thead>
              <tr>
                <th>Mes</th>
                <th>limite</th>
                <th>Categoria</th>
                <th>Usuario</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {budgets.map((budget) => {
                return (
                  <tr key={budget.id}>
                    <td>{budget.month}</td>
                    <td>{budget.limit}</td>
                    <td>{budget.category_id}</td>
                    <td>{budget.user_id}</td>
                    <td>
                      <button className="btn btn-primary me-2" type="button">
                        <i className="bi bi-pencil-square"></i>
                      </button>
                      <button className="btn btn-danger me-2" type="button">
                        <i className="bi bi-trash"></i>
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

export default Budgets
