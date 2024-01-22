import Toast from "bootstrap/js/dist/toast";

export const showToast = (id) => {
  const toast = new Toast(id);
  toast.show();
  return id;
};
