import React from "react";

function LabelFormTransaction({
  labelName,
  type,
  id,
  placeholder,
  value,
  onChange,
}) {
  return (
    <div className="col-md-6 mb-3">
      <label className="form-label" htmlFor={id}>
        {labelName}
      </label>
      <input
        className="form-control"
        type={type}
        id={id}
        placeholder={placeholder}
        value={value}
        onChange={onChange}
      />
    </div>
  );
}

export default LabelFormTransaction;
