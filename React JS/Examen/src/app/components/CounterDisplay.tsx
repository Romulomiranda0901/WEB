
import { useSelector } from 'react-redux';
import { RootState } from '../../app/store/store';

const CounterDisplay: React.FC = () => {
    // Obtén el valor del contador directamente desde el estado
    const counterValue = useSelector((state: RootState) => state.tasks.tasks.length);

    return (
        <div>
            Count: <span data-testid="counter-value">{counterValue}</span>
        </div>
    );
};

export default CounterDisplay;