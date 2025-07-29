import React from "react";

function SelectFormTransactions({ labelName, id, value, onChange, options }) {
  return (
    <div className="col-md-6 mb-3">
      <label className="form-label" htmlFor={id}>
        {labelName}
      </label>
      <select className="form-select" id={id} value={value} onChange={onChange}>
        <option value="">Seleccione una categoría</option>
        {options.map((option) => (
          <option key={option.value} value={option.value}>
            {option.label}
          </option>
        ))}
      </select>
    </div>
  );
}

export default SelectFormTransactions;
