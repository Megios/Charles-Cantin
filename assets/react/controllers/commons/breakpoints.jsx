const size = {
  xs: "500px",
  sm: "900px",
  lg: "1200px",
};

const device = {
  xs: `(max-width:${size.xs})`,
  sm: `(max-width:${size.sm})`,
  lg: `(min-width:${size.lg})`,
};
export default device;
