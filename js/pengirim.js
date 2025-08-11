pengirimCell.innerHTML = `
    <select name="pengirim" required>
        <option value="OPS" ${pengirim === "OPS" ? "selected" : ""}>Operasional</option>
        <option value="HC" ${pengirim === "HC" ? "selected" : ""}>Human Capital</option>
        <option value="LOG" ${pengirim === "LOG" ? "selected" : ""}>Logistik</option>
        <option value="ADK" ${pengirim === "ADK" ? "selected" : ""}>Administrasi Keuangan</option>
        <option value="RMFT" ${pengirim === "RMFT" ? "selected" : ""}>RMFT</option>
    </select>
`;