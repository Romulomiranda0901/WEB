// TasksPage.tsx
import { Container, Row, Col, Button } from 'react-bootstrap';
import TaskList from '../components/TaskList';
import AddTaskModal from '../components/AddTaskModal';

const TasksPage: React.FC = () => {
    return (
        <Container className="mt-5">
            <h1>Tasks Page</h1>
            <Row className="mb-3">
                <Col>
                    <TaskList />
                </Col>
            </Row>
            <Row>
                <Col>
                    <AddTaskModal />
                </Col>
            </Row>
        </Container>
    );
};

export default TasksPage;
