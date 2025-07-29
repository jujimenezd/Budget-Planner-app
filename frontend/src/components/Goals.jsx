import React from 'react'
import {useState, useEffect} from 'react'

function Goals() {
    const[goals, setGoals]=useState([])

    useEffect(function (){
            const token = localStorage.getItem("token");
            fetch('http://127.0.0.1:8000/api/goals', {
                method: "get",
                headers:{
                    "Content-Type":"application/json",
                    Authorization: token ? `Bearer ${token}`:"",
                },
            })
            .then(function(response){
                return response.json()
            })
            .then((data)=>setGoals(data))
        },[]);

  return (
    <div className="container mt-5">
      <h1 className="text-center mb-5 text-white">Metas</h1>
      <div className="row">
        <div className="col-md-6">
          <button className="btn btn-primary mb-3" type="button">
            <i className="bi bi-plus-circle"></i>
            Agregar Meta
          </button>
          <table className="table table-bordered">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Monto Objetivo</th>
                <th>Monto Ahorrado</th>
                <th>Fecha Limite</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {goals.map((goal) => {
                return (
                  <tr key={goal.id}>
                    <td>{goal.name}</td>
                    <td>{goal.target_amount}</td>
                    <td>{goal.saved_amount}</td>
                    <td>{goal.deadline}</td>
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

export default Goals
