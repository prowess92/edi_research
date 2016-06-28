
Edi::Application.routes.draw do
  
  match '/clients/arvresult' => 'clients#arvresult' 

  resources :client_medicals

  resources :appointments

  resources :clients

  resources :logins

  resources :users
  
  resources :sessions

  resources :items

  resources :sales

  resources :stocks


  root :to => "dashboard#index"
  
  match '/appointments/:id/destroy' => 'appointments#destroy'
  match '/users/:id/destroy' => 'users#destroy'
  match '/sales/:id/edit' => 'sales#destroy'
  match '/sales/:id' => 'sales#index'
  match '/stocks/:id' => 'stocks#index'
  match '/items/:id' => 'items#index'
  match '/sales/:id/destroy' => 'sales#destroy'
  match '/stocks/:id/destroy' => 'stocks#destroy'
  match '/items/:id/destroy' => 'items#destroy'
  match '/items/:id/merge' => 'items#merge'
  match '/items/new' => 'items#index'
  match '/items/price_list' => 'items#priceList'
  match '/users/:id' => 'users#show'
  match '/sessions/' => 'sessions#new'
  match '/sessions/new' => 'sessions#new'
  match '/sales' => 'sales#index'
  match '/report/perdiem' => 'report#perdiem'
  match '/sessions/destroy' => 'sessions#destroy'
  match '/report/range' => 'report#range'
  match '/report/range.pdf' => 'report#range'
  match '/report/stores' => 'report#stores'
  match '/report/remainder' => 'report#remainder'
  match '/report/salesgraph' => 'report#salesgraph'
  match '/items/duplicate' => 'items#duplicate'
  match '/items/merger' => 'items#merger' 
  match '/items/merged' => 'items#merged'
  

  get "clients/_form"

  get "clients/index"

  get "clients/show"

  get "clients/edit"

  get "report/index"

  get "report/show"
 
  get "items/duplicate"
 
  get "items/merger"

  post "items/merged"

  get "dashboard/index"

  get "items/itemslist"

  get "sessions/new"

  get "users/index"

  get "users/show"

  get "users/new"

  get "users/edit"
  # Sample of named route:
  #   match 'products/:id/purchase' => 'catalog#purchase', :as => :purchase
  # This route can be invoked with purchase_url(:id => product.id)

  # Sample resource route (maps HTTP verbs to controller actions automatically):
  #   resources :products

  # Sample resource route with options:
  #   resources :products do
  #     member do
  #       get 'short'
  #       post 'toggle'
  #     end
  #
  #     collection do
  #       get 'sold'
  #     end
  #   end

  # Sample resource route with sub-resources:
  #   resources :products do
  #     resources :comments, :sales
  #     resource :seller
  #   end

  # Sample resource route with more complex sub-resources
  #   resources :products do
  #     resources :comments
  #     resources :sales do
  #       get 'recent', :on => :collection
  #     end
  #   end

  # Sample resource route within a namespace:
  #   namespace :admin do
  #     # Directs /admin/products/* to Admin::ProductsController
  #     # (app/controllers/admin/products_controller.rb)
  #     resources :products
  #   end

  # You can have the root of your site routed with "root"
  # just remember to delete public/index.html.
  # root :to => "welcome#index"

  # See how all your routes lay out with "rake routes"

  # This is a legacy wild controller route that's not recommended for RESTful applications.
  # Note: This route will make all actions in every controller accessible via GET requests.
  # match ':controller(/:action(/:id(.:format)))'
end
