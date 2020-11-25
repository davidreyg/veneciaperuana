import CategoryService from 'modules/category/services/categoryService'
import ProductService from 'modules/product/services/productService'
// import TipoDocumentoService from './TipoDocumentoService'
const services = {
  categories: CategoryService,
  products: ProductService
  // tipoDocumentos: TipoDocumentoService
  // other repositories ...
}

export const ServiceFactory = {
  get: name => services[name]
}
