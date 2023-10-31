import Loadable from 'app/components/Loadable';
import { lazy } from 'react';
import { authRoles } from '../../auth/authRoles';
const AppCustomers = Loadable(lazy(() => import('./customers/customerForm/AppForm')));
const AppCustomersAdd = Loadable(lazy(() => import('./customers/customerForm/addNewForm/AddNewCustomerForm')));
const AppCustomerTable = Loadable(lazy(() => import('./customers/customerTable/AppTable')));
const AppInvoices = Loadable(lazy(() => import('./invoices/invoicesTable/AppTable')));
const AppInvoicesAdd = Loadable(lazy(() => import('./invoices/invoicesForm/AddInvoiceForm')));
const AppSettings = Loadable(lazy(() => import('./settings/AppForm')));

const Analytics = Loadable(lazy(() => import('./Analytics')));

const dashboardRoutes = [
  { path: '/dashboard', element: <Analytics />, auth: authRoles.guest },
  {
    path: '/customers/update/:id',
    element: <AppCustomers />,
  },
  {
    path: '/customers',
    element: <AppCustomerTable />,
  },
  {
    path: '/customers/add',
    element: <AppCustomersAdd />,
  },
  {
    path: '/invoices',
    element: <AppInvoices />,
  },
  {
    path: '/invoices/add',
    element: <AppInvoicesAdd />,
  },
  {
    path: '/settings',
    element: <AppSettings />,
  },
];

export default dashboardRoutes;
