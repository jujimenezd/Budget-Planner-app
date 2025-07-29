import React from 'react'
import { useEffect, useState } from 'react'

function Categories() {
    const [categories, setCategories]=useState([])
    
    useEffect(function(){
        fetch('http://127.0.0.1:8000/api/categories')
            .then(function (response){
                return response.json();
            })
            .then(function (data){
                setCategories(data);
            });
    },[]);
  return (
    <div className="container mt-5">
      <h1 className="text-center mb-5 text-white">Categories</h1>
      <div className="row">
        <div className="col-md-6">
          <button className="btn btn-primary mb-3" type="button">
            <i className="bi bi-plus-circle"></i>
            Agregar categoria
          </button>
          <table className="table table-bordered">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {categories.map((categorie) => {
                return (
                  <tr key={categorie.id}>
                    <td>{categorie.name}</td>
                    <td>{categorie.type}</td>
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

export default Categories
