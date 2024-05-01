import React, { useEffect, useState } from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import { Modal, Button } from "react-bootstrap";
import { FaArrowCircleDown, FaEye, FaYoutube } from "react-icons/fa";
import { fetchData, fetchDataDepend, fetchList } from "../../Libs/Fetch";
import Swal from "sweetalert2";

function Youtube(prop) {
  // hook
  const [show, setShow] = useState(false);
  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);

  return (
    <div>
      <Button className="btn btn-danger" onClick={handleShow}>
        <FaYoutube />
      </Button>

      <Modal show={show} onHide={handleClose} centered>
        <Modal.Header closeButton>
          <Modal.Title>Video de evaluación</Modal.Title>
        </Modal.Header>
        <Modal.Body className="row g-3">
          <iframe
            width="560"
            height="315"
            src="https://www.youtube.com/embed/j3WmUtNtXPs"
            title="Video de youtube del participante"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
          ></iframe>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleClose}>
            Close
          </Button>
          {/* <Button variant="primary" autoFocus type="submit" >
                            Guardar
                        </Button> */}
        </Modal.Footer>
      </Modal>
    </div>
  );
}

export default Youtube;
