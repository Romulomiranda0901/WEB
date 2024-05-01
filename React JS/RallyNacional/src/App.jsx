// routes
import Router from './routes';
// theme
import ThemeProvider from './theme';
// components
import Home from '../src/Pages/Home';
import ScrollToTop from './Components/ScrollToTop';
import { BaseOptionChartStyle } from './Components/chart/BaseOptionChart';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'react-bootstrap-table-next/dist/react-bootstrap-table2.min.css';
import 'react-bootstrap-table2-toolkit/dist/react-bootstrap-table2-toolkit.min.css';

// ----------------------------------------------------------------------

export default function App() {
  return (
    <ThemeProvider>
      <ScrollToTop />
      <BaseOptionChartStyle />

        <Router />
    </ThemeProvider>
  );
}