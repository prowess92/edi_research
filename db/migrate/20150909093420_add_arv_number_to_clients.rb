class AddArvNumberToClients < ActiveRecord::Migration
  def change
    add_column :clients, :arv_number, :string
  end
end
