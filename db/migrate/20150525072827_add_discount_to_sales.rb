class AddDiscountToSales < ActiveRecord::Migration
  def change
    add_column :sales, :discount, :string
  end
end
