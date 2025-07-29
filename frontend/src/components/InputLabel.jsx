function InputLabel({
  name,
  type,
  label,
  id,
  placeholder,
  error,
  onChange,
  value,
}) {
  return (
    <div className="mb-3">
      <label htmlFor={name} className="form-label">
        {label}
      </label>
      <input
        type={type}
        className="form-control"
        id={id}
        placeholder={placeholder}
        onChange={onChange}
        value={value}
      />
      {error && <small className="text-danger">{error}</small>}
    </div>
  );
}

export default InputLabel;
